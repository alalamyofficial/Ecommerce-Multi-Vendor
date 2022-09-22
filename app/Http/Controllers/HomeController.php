<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index(){

        $products = Product::latest()->paginate(6);
        $cart_details = Cart::where('user_id',Auth::id())->get();
        return view('home.site_body',compact('products','cart_details'));

    }

    public function redirect(){

        $userType = Auth::user()->userType;

        if($userType == '1'){
            return view('admin.home');
        }else{
            $products = Product::latest()->paginate(6);
            $cart_details = Cart::where('user_id',Auth::id())->get();
            return view('home.site_body',compact('products','cart_details'));
        }

    }

    public function product_details($title){
        $product = Product::where('title',$title)->first();
        $cart_details = Cart::where('user_id',Auth::id())->get();

        return view('home.product_details',compact('product','cart_details'));
    }

    public function add_to_cart(Request $request , $id){

        if(Auth::id()){
            $user = Auth::user();
            
            $product = Product::find($id);

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

        }else{
            return redirect('login');
        }

    }

    public function cart_show(){

        if(Auth::id()){
            $user_id = Auth::user()->id;
            $cart_details = Cart::where('user_id',$user_id)->get();
            return 
                view('home.cart.show',compact('cart_details'));
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
            $order->delivery_status = 'Procesing';

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
        return 
            view('home.cart.stripe',
            compact('totalPrice','cart_details'));
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
            $order->delivery_status = 'Procesing';

            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

          
        return back();
    }
}
