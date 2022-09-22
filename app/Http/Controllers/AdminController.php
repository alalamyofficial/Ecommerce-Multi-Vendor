<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
