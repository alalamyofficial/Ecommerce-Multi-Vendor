<?php

namespace App\Http\Controllers;

use PDF;
use Notification;
use App\Models\Cart;
use App\Models\Mail;
use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    //Categories--------------------------------------------------

    public function categories(){

        $categories = Category::latest()->get();
 
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                return view('admin.categories.index',compact('categories'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function create_category(){
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                return view('admin.categories.create');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }

    }

    public function store_category(Request $request){

        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return redirect()
                    ->route('categories')
                    ->with('message','Category Created Successfully');
    }

    public function edit_category($id){
        
        $category = Category::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                return view('admin.categories.edit',compact('category'));
            }else{
                abort(404);
            }
        }else{

        }

    }

    public function update_category(Request $request , $id){

        $category = Category::find($id);

        $category_update = [
            'name' => $request->name,
        ];
        $category->update($category_update);
        return redirect()
                    ->route('categories')
                    ->with('message','Category Updated Successfully');

    }

    public function destroy_category($id){

        $category = Category::find($id);

        if(Auth::id()){
            if(Auth::user()->userType == 1){
                $category->delete();
                return redirect()
                        ->route('categories')
                        ->with('message','Category Deleted Successfully');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }

    }


    //Products--------------------------------------------------


    public function products(){

        if(Auth::id()){
            if(Auth::user()->userType == 1){
                $products = Product::latest()->get();
            }elseif(Auth::user()->userType == 2){
                $products = Product::where('user_id',Auth::id())->get();
            }else {
                $products = 0;
            }
    
            if(Auth::user()->userType == 1 || Auth::user()->userType ==2){
                return view('admin.products.index',compact('products'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }


    }
    
    public function create_product(){
        $categories = Category::latest()->get();
        if(Auth::id()){
            if(Auth::user()->userType == 1 || Auth::user()->userType ==2){
                return view('admin.products.create',compact('categories'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }

    }

    public function store_product(Request $request){

        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->user_id = Auth::id();
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        $product->discount_price = $request->dis_price;

        $img_file = $request->image;

        $new_image = time().'.'.$img_file->getClientOriginalName();

        $request->image->move('product_imgs/',$new_image);

        $product->image = 'product_imgs/'.$new_image;

        $product->save();
        return redirect()
                    ->route('products')
                    ->with('message','Product Created Successfully');
    }

    public function single_product($title){

        if(Auth::id()){
            if(Auth::user()->userType == 1){
                $product = Product::where('title',$title)->first();
                if($product){
                    return view('admin.products.product',compact('product'));
                }else
                {
                    abort(404);
                }                     
            }elseif(Auth::user()->userType == 2){
                $product = Product::where('title',$title)
                                    ->where('user_id',Auth::id())
                                    ->first();
                if($product){
                    return view('admin.products.product',compact('product'));
                }else
                {
                    abort(404);
                }                    
            }else 
            {
                abort(404);
            }
        }else{
            abort(404);
        }

    }

    public function edit_product($id){

        $categories = Category::latest()->get();

        if(Auth::id()){
            if(Auth::user()->userType == 1){
    
                $product = Product::find($id);
                return view('admin.products.edit',
                        compact('product','categories'));
    
            }elseif(Auth::user()->userType == 2){
    
                $product = Product::where('id',$id)->where('user_id',Auth::id())->first();
                if($product){
                    return view('admin.products.edit',
                            compact('product','categories'));
                }else{
                    abort(404);
                }
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }


    }

    public function update_product(Request $request , $id){

        $product = Product::find($id);

        if ($request->has('image')) {
            
            $img_file = $request->image;

            $new_image = time().'.'.$img_file->getClientOriginalName();

            $request->image->move('product_imgs/',$new_image);

            $product->image = 'product_imgs/'.$new_image;

            $product_update = [
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'user_id' => Auth::id(),
                'quantity' => $request->quantity,
                'category' => $request->category,
                'discount_price' => $request->dis_price,
                'image' =>  'product_imgs/'.$new_image
            ];

        }else{
          
            $product_update = [
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'user_id' => Auth::id(),
                'quantity' => $request->quantity,
                'category' => $request->category,
                'discount_price' => $request->dis_price,
            ];
            
        }

        $product->update($product_update);
        return redirect()
                    ->route('products')
                    ->with('message','Product Updated Successfully');

    }

    public function destroy_product($id){

        if(Auth::id()){
            if(Auth::user()->userType == 1){
    
                $product = Product::find($id);
                $product->delete();
                return redirect()
                            ->route('products')
                                ->with('message','Product Deleted Successfully');
            }elseif(Auth::user()->userType == 2){
    
                $product = Product::where('id',$id)->where('user_id',Auth::id())->first();
                if($product){
                    $product->delete();
                    return redirect()
                                ->route('products')
                                    ->with('message','Product Deleted Successfully');
                }else{
                    abort(404);
                }
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }


    //Orders--------------------------------------------------

    public function orders(){

        if(Auth::user()->userType == 1){
            $orders = Order::latest()->get();
            return view('admin.orders.index',compact('orders'));
        }elseif(Auth::user()->userType == 2){
            $product = Product::where('user_id',Auth::id())->first();
            $orders = Order::where('product_id',$product->id)
                            ->get();
            return view('admin.orders.index',compact('orders'));
        }else{
            abort(404);
        }

        if(Auth::id()){
            if(Auth::user()->userType == 1 || Auth::user()->userType ==2){
                $orders = Order::latest()->get();
                return view('admin.orders.index',compact('orders'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function single_order($id){
        $order = Order::where('id',$id)->first();
        if(Auth::id()){
            if(Auth::user()->userType == 1 || Auth::user()->userType ==2){
                return view('admin.orders.order',compact('order'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function delivered_order($id){

        $order = Order::find($id);
        $order->delivery_status = 'Delivered';
        $order->payment_status = 'Paid';

        if(Auth::id()){
            if(Auth::user()->userType == 1 || Auth::user()->userType ==2){
                $order->save();
                return redirect()
                    ->back()
                    ->with('message','Product Updated Successfully');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }

    }
    
    public function destroy_order($id){

        $order = Order::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                $order->delete();
                return redirect()
                        ->route('orders')
                        ->with('message','Order Deleted Successfully');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }


    public function print_pdf($id){

        $order = Order::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1 || Auth::user()->userType ==2){
                $pdf = PDF::loadview('admin.orders.pdf',compact('order'));
                return $pdf->download('order_details.pdf');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function send_mail($id){
        $order = Order::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1 || Auth::user()->userType ==2){
                return view('admin.orders.email_info',compact('order'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function send_user_email(Request $request,$id){
        $order = Order::find($id);

        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,
        ];

        Notification::send($order,new SendEmailNotification($details));

        return redirect()
                    ->back()
                        ->with('message','Mail Send Successfully');

    }

    public function mails(){

        $mails = Mail::latest()->get();
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                return view('admin.mails.index',compact('mails'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function show_mail($id){

        $mail = Mail::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                return view('admin.mails.mail',compact('mail'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }

    }

    public function destroy_mail($id){

        $mail = Mail::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                $mail->delete();
                return redirect()
                        ->route('mails')
                            ->with('message','Mail Deleted Successfully');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }

    }

    public function comments(){

        if(Auth::id()){
            if(Auth::user()->userType == 1){
                $comments = Comment::latest()->get();
                return view('admin.comments.index',compact('comments'));
            }elseif(Auth::user()->userType == 2){
                $product = Product::where('user_id',Auth::id())->first();
                $comments = Comment::where('product_id',$product->id)->latest()->get();
                return view('admin.comments.index',compact('comments'));
            }
        }else{
            abort(404);
        }
    }

    public function destroy_comment($id){

        $comment = Comment::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1 || Auth::user()->userType ==2){
                $comment->delete();
                return redirect()
                        ->route('comments')
                            ->with('message','Comment Deleted Successfully');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function users(){

        $users = User::latest()->get();
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                return view('admin.users.index',compact('users'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function show_user($id){

        $user = User::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                return view('admin.users.user',compact('user'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }

    }

    public function destroy_user($id){

        $user = User::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                $user->delete();
                return redirect()
                        ->route('users')
                            ->with('message','User Deleted Successfully');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }


    public function carts(){

        $carts = Cart::latest()->get();
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                return view('admin.carts.index',compact('carts'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function show_cart($id){

        $cart = Cart::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                return view('admin.carts.cart',compact('cart'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }

    }

    public function destroy_cart($id){

        $cart = Cart::find($id);
        if(Auth::id()){
            if(Auth::user()->userType == 1){
                $cart->delete();
                return redirect()
                        ->route('carts')
                            ->with('message','Cart Deleted Successfully');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

}
