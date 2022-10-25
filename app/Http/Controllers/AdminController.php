<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    //Categories--------------------------------------------------

    public function categories(){

        $categories = Category::latest()->get();
        return view('admin.categories.index',compact('categories'));
    }

    public function create_category(){
        return view('admin.categories.create');
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
        return view('admin.categories.edit',compact('category'));
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
        $category->delete();
        return redirect()
                ->route('categories')
                ->with('message','Category Deleted Successfully');
    }


    //Products--------------------------------------------------


    public function products(){

        $products = Product::latest()->get();
        return view('admin.products.index',compact('products'));

    }
    
    public function create_product(){
        $categories = Category::latest()->get();
        return view('admin.products.create',compact('categories'));
    }

    public function store_product(Request $request){

        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
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
        $product = Product::where('title',$title)->first();
        return view('admin.products.product',compact('product'));
    }

    public function edit_product($id){
        $product = Product::find($id);
        $categories = Category::latest()->get();
        return view('admin.products.edit',compact('product','categories'));
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

        $product = Product::find($id);
        $product->delete();
        return redirect()
                ->route('products')
                ->with('message','Product Deleted Successfully');
    }


    //Orders--------------------------------------------------

    public function orders(){

        $orders = Order::latest()->get();
        return view('admin.orders.index',compact('orders'));

    }
    
    public function create_order(){
        $categories = Category::latest()->get();
        return view('admin.orders.create',compact('categories'));
    }

    public function single_order($id){
        $order = Order::where('id',$id)->first();
        return view('admin.orders.order',compact('order'));
    }

    public function delivered_order($id){

        $order = Order::find($id);
        $order->delivery_status = 'Delivered';
        $order->payment_status = 'Paid';
        $order->save();

        return redirect()
            ->back()
            ->with('message','Product Updated Successfully');
    }
    
    public function destroy_order($id){

        $order = Order::find($id);
        $order->delete();
        return redirect()
                ->route('orders')
                ->with('message','Order Deleted Successfully');
    }


    public function print_pdf($id){

        $order = Order::find($id);
        $pdf = PDF::loadview('admin.orders.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function send_mail($id){
        $order = Order::find($id);
        return view('admin.orders.email_info',compact('order'));
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
}
