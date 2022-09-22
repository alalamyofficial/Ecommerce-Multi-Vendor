<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/',[HomeController::class,'index']);

//site
Route::get('/product/details/{title}',
        [HomeController::class,'product_details'])
        ->name('product_details');

Route::post('/add/to/cart/{id}',
        [HomeController::class,'add_to_cart'])
        ->name('add_to_cart');   

Route::get('/cart/show',
        [HomeController::class,'cart_show'])
        ->name('cart.show');   

Route::get('/remove/item/cart/{id}',
        [HomeController::class,'remove_item_from_cart'])
        ->name('remove.item.cart'); 

        
Route::get('/cash/order',
        [HomeController::class,'cash_order'])
        ->name('cash.order'); 

Route::get('/stripe/{totalPrice}',
        [HomeController::class,'stripe'])
        ->name('stripe.order'); 

Route::post('stripe/{totalPrice}', 
        [HomeController::class,'stripePost'])
        ->name('stripe.post');
        
        
//Admin

Route::get('/redirect',[HomeController::class,'redirect']);

//categories
Route::get('categories',[AdminController::class,'categories'])
        ->name('categories');
Route::get('create/category',[AdminController::class,'create_category'])
        ->name('category.create');
Route::post('create/category',[AdminController::class,'store_category'])
        ->name('category.store');
Route::get('edit/category/{id}',[AdminController::class,'edit_category'])
        ->name('category.edit');
Route::get('delete/category/{id}',[AdminController::class,'destroy_category'])
        ->name('category.delete');
Route::patch('update/category/{id}',[AdminController::class,'update_category'])
        ->name('category.update');

//products
Route::get('products',[AdminController::class,'products'])
        ->name('products');
Route::get('create/product',[AdminController::class,'create_product'])
        ->name('product.create');
Route::post('create/product',[AdminController::class,'store_product'])
        ->name('product.store');
Route::get('edit/product/{id}',[AdminController::class,'edit_product'])
        ->name('product.edit');
Route::get('delete/product/{id}',[AdminController::class,'destroy_product'])
        ->name('product.delete');
Route::patch('update/product/{id}',[AdminController::class,'update_product'])
        ->name('product.update');
Route::get('product/{title}',[AdminController::class,'single_product'])
        ->name('single_product');        

