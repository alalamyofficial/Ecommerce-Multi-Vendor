<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use App\Models\Cart;
use App\Models\Mail;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        $products = Product::latest()->paginate(6);
        $cart_details = Cart::where('user_id',Auth::id())->get();
        $categories = Category::latest()->get();
        return view('home.site_body',compact('products','cart_details','categories'));

    }

    public function redirect(){

        $userType = Auth::user()->userType;

        if($userType == 1){
            
            $products = Product::all();
            $orders = Order::all();
            $users = User::all();
            $categories = Category::latest()->get();
            $comments = Comment::latest()->get();
            $mails = Mail::latest()->get();
    
            $totalrevenue = 0;
    
            foreach($orders as $order){
                $totalrevenue = $totalrevenue + $order->price;
            }
    
            $total_delivered_order = Order::where('delivery_status','Delivered')->get();
            $total_processing_order = Order::where('delivery_status','Processing')->get();
            $total_processing_canceled = Order::where('delivery_status','You Canceled That Order')
                                        ->get();

            return view('admin.dashboard',
                compact('products','orders','users',
                        'totalrevenue','total_delivered_order',
                        'total_processing_order','total_processing_canceled',
                        'comments','mails'));                            
        }elseif($userType == 2){

            $products = Product::where('user_id',Auth::id())->get();
            $product = Product::where('user_id',Auth::id())->first();
            $orders = Order::where('product_id',$product->id)->get();
    
            $totalrevenue = 0;
    
            foreach($orders as $order){
                $totalrevenue = $totalrevenue + $order->price;
            }
    
            $total_delivered_order = Order::where('delivery_status','Delivered')
                                            ->where('product_id',$product->id)->get();
            $total_processing_order = Order::where('delivery_status','Processing')
                                            ->where('product_id',$product->id)->get();
            $total_processing_canceled = Order::where('delivery_status','You Canceled That Order')
                                            ->where('product_id',$product->id)->get();

            return view('admin.dashboard',
                compact('products','orders',
                        'totalrevenue','total_delivered_order',
                        'total_processing_order','total_processing_canceled'));

        }else{
            abort(404);
        }


    }

    public function product_details($title){
        
        $product = Product::where('title',$title)->first();
        $cart_details = Cart::where('user_id',Auth::id())->get();
        $comments = Comment::where('product_id',$product->id)
                            ->orderBy('id','desc')->get();
        $replies = Reply::orderBy('id','desc')->get();
        $categories = Category::latest()->get();


        return view('home.product_details',
                compact('product','cart_details','comments','replies','categories'));
    }

    public function add_to_cart(Request $request , $id){

        if(Auth::id()){
            $user = Auth::user();
            
            $product = Product::find($id);

            $product_exists_id = Cart::where('product_id',$id)
                                        ->where('user_id',$user->id)
                                        ->pluck('id')->first();
            
            if($product_exists_id !==Null){

                $cart = Cart::find($product_exists_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity+$request->quantity;
                $cart->save();
                return 
                    redirect()
                        ->back()
                            ->with('success','Product Added To Cart successfully!');

            }else{

                $cart = new Cart;
    
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->product_title = $product->title;
                $cart->quantity = $request->quantity;
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->user_id = $user->id;

                if($product->discount_price != null){
    
                    $cart->price = 
                        $product->discount_price * $request->quantity;
    
                }else{
                    
                    $cart->price = $product->price * $request->quantity;
                }
    
                $cart->save();
    
                return 
                    redirect()
                        ->back()
                            ->with('success','Product Added To Cart successfully!');
            }                            



        }else{
            return redirect('login');
        }

    }

    public function cart_show(){

        if(Auth::id()){
            $user_id = Auth::user()->id;
            $cart_details = Cart::where('user_id',$user_id)->get();
            $categories = Category::latest()->get();

            return 
                view('home.cart.show',compact('cart_details','categories'));
        }else{
            return 
                view('login');
        }
    }

    public function remove_item_from_cart($id){

        $cart_item = Cart::find($id);
        $cart_item->delete();
        return redirect()->back()->with('error','Item Removed Successfully');
    }

    public function cash_order(){

        $user = Auth::user();
        $user_id = $user->id;
        $cart_data = Cart::where('user_id',$user_id)->get();
        $categories = Category::latest()->get();

        foreach($cart_data as $data){

            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->user_id = $data->user_id;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Cash On Delivery';
            $order->delivery_status = 'Processing';

            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        return 
            redirect()
                ->back()
                    ->with('success','Order Proceed Successfully,
                             We Will Contact With You Soon');

    }

    public function stripe($totalPrice){
        $cart_details = Cart::where('user_id',Auth::id())->get();
        $categories = Category::latest()->get();

        return 
            view('home.cart.stripe',
            compact('totalPrice','cart_details','categories'));
    }

    public function stripePost(Request $request,$totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks For Your Payment" 
        ]);
  
        Session::flash('success', 'Payment successful!');

        $user = Auth::user();
        $user_id = $user->id;
        $cart_data = Cart::where('user_id',$user_id)->get();

        foreach($cart_data as $data){

            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->user_id = $data->user_id;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Paid';
            $order->delivery_status = 'Processing';

            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return back();
    }

    public function show_order(){
        
        if(Auth::id()){
            $user = Auth::user();
            $orders = Order::where('user_id',$user->id)->get();
            $cart_details = Cart::where('user_id',$user->id)->get();
            $categories = Category::latest()->get();

            return view('home.myOrder',compact('orders','cart_details','categories'));

        }else{
            return redirect('login');
        }
    }

    public function cancel_order($id){

        $user = Auth::user();

        $order = Order::find($id);

        $order->delivery_status = 'You Canceled That Order';

        $order->save();

        return 
            redirect()
                ->back()
                    ->with('success','Order Cancel Successfully');
    }

    public function add_comment(Request $request){

        $product_id = Product::first()->id;

        if(Auth::id()){

            $comment = new Comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->product_id = $product_id;
            $comment->comment = $request->comment;
            $comment->save();

            return 
                redirect()
                    ->back()
                        ->with('success','Comment Added Successfully');

        }else{
            return redirect('login');
        }

    }

    public function remove_comment($id){

        if(Auth::id()){

            $comment = Comment::find($id);

            if(Auth::id() == $comment->user_id){
                $comment->delete();
            }else{
                return 
                    redirect()
                        ->back()
                            ->with('error','Not Allowed');;
            }
            return 
                redirect()
                    ->back()
                        ->with('success','Comment Removed Successfully');

        }else{
            return redirect('login');
        }

    }

    public function add_reply(Request $request){

        if(Auth::id()){
            // $comment = Comment::find($id);
            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();

            return 
                redirect()
                    ->back()
                        ->with('success','Reply Added Successfully');

        }else{
            return redirect('login');
        }

    }

    public function remove_remove($id){

        if(Auth::id()){

            $reply = Reply::find($id);

            if(Auth::id() == $reply->user_id){
                $reply->delete();
            }else{
                return 
                    redirect()
                        ->back()
                            ->with('error','Not Allowed');;
            }
            return 
                redirect()
                    ->back()
                        ->with('success','reply Removed Successfully');

        }else{
            return redirect('login');
        }

    }

    public function all_products(){

        $user = Auth::user();
        $products = Product::latest()->get();
        $cart_details = Cart::where('user_id',$user->id)->get();
        $categories = Category::latest()->get();

        return view('home.all_products',compact('products','cart_details','categories'));

    }

    public function search_product(Request $request){

        $search_text = $request->get('search');
        $user = Auth::user();
        $products = Product::where('title','LIKE',"%{$search_text}%")
                            ->orWhere('category','LIKE',"%{$search_text}%")
                            ->paginate(10);
        $cart_details = Cart::where('user_id',$user->id)->get();
        $categories = Category::latest()->get();

        if($search_text !== Null){
            return view('home.all_products',compact('products','cart_details','categories'));
        }else{
            return redirect()->back();
        }


    }

    public function categories(){

        $categories = Category::latest()->get();
        return view('home.header');
    }

    public function category_product($category){

        $user = Auth::user();
        $products = Product::where('category',$category)->get();
        $categories = Category::latest()->get();
        $cart_details = Cart::where('user_id',$user->id)->get();

        return view('home.all_products',compact('products','categories','cart_details'));

    }

    public function contact_us(){

        $user = Auth::user();
        $categories = Category::latest()->get();
        $cart_details = Cart::where('user_id',$user->id)->get();

        return view('home.contact_us',compact('categories','cart_details'));
    }

    public function send_email(Request $request){

        $mail = new Mail;
        $mail->name = $request->name;
        $mail->email = $request->email;
        $mail->subject = $request->subject;
        $mail->bio = $request->body;

        $mail->save();
        return 
            redirect()
                ->back()
                    ->with('success','Mail Was Sent Successfully');
    }
}
