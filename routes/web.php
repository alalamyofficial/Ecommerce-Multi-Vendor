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

Route::get('/product/details/{title}',
        [HomeController::class,'product_details'])
        ->name('product_details');


Route::get('all/products/',
        [HomeController::class,'all_products'])
        ->name('products.all');        

Route::get('search/product/',
        [HomeController::class,'search_product'])
        ->name('product.search');

Route::get('category/{name}/',
        [HomeController::class,'category_product'])
        ->name('category.product');

Route::get('contact/us/',
        [HomeController::class,'contact_us'])
        ->name('contact.us');

Route::post('send/email/',
        [HomeController::class,'send_email'])
        ->name('send_email');

Route::group(['middleware' => 'auth'], function (){
        //site
        
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

        Route::get('/show/my/orders',
                [HomeController::class,'show_order'])
                ->name('order.show'); 

        Route::get('/cancel/order/{id}',
                [HomeController::class,'cancel_order'])
                ->name('order.cancel');        
                
        Route::get('/stripe/{totalPrice}',
                [HomeController::class,'stripe'])
                ->name('stripe.order'); 
        
        Route::post('stripe/{totalPrice}', 
                [HomeController::class,'stripePost'])
                ->name('stripe.post');

        Route::post('/add/comment/',
                [HomeController::class,'add_comment'])
                ->name('comment.create');

        Route::get('/remove/comment/{id}',
                [HomeController::class,'remove_comment'])
                ->name('comment.remove');        

        Route::post('/add/reply/',
                [HomeController::class,'add_reply'])
                ->name('reply.create');  
                
        Route::get('/remove/reply/{id}',
                [HomeController::class,'remove_reply'])
                ->name('reply.remove');  

});

        
        
//Admin

Route::get('/redirect',[HomeController::class,'redirect'])
        ->middleware('auth','verified');

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


//orders
Route::get('orders',[AdminController::class,'orders'])
        ->name('orders');
Route::post('create/order',[AdminController::class,'store_order'])
        ->name('order.store');
Route::get('delivered/order/{id}',[AdminController::class,'delivered_order'])
        ->name('order.delivered');
Route::get('delete/order/{id}',[AdminController::class,'destroy_order'])
        ->name('order.delete');

Route::get('order/{id}',[AdminController::class,'single_order'])
        ->name('single_order');  

Route::get('print/pdf/{id}',[AdminController::class,'print_pdf'])
        ->name('print_pdf');  

Route::get('send/mail/{id}',[AdminController::class,'send_mail'])
        ->name('send_mail');        
Route::post('send/user/email/{id}',[AdminController::class,'send_user_email'])
        ->name('send_user_email');        


//mails        
Route::get('mails',[AdminController::class,'mails'])
        ->name('mails');

Route::get('show/mail/{id}',[AdminController::class,'show_mail'])
        ->name('mail.show');

Route::get('delete/mail/{id}',[AdminController::class,'destroy_mail'])
        ->name('mail.delete');

//comments        
Route::get('comments',[AdminController::class,'comments'])
        ->name('comments');
        
Route::get('delete/comment/{id}',[AdminController::class,'destroy_comment'])
        ->name('comment.delete');   
        
        

//users        
Route::get('users',[AdminController::class,'users'])
        ->name('users');

Route::get('show/user/{id}',[AdminController::class,'show_user'])
        ->name('user.show');

Route::get('delete/user/{id}',[AdminController::class,'destroy_user'])
        ->name('user.delete');


//carts        
Route::get('carts',[AdminController::class,'carts'])
        ->name('carts');

Route::get('show/cart/{id}',[AdminController::class,'show_cart'])
        ->name('carts.show');

Route::get('delete/cart/{id}',[AdminController::class,'destroy_cart'])
        ->name('cart.delete');        