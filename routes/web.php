<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//route for home page
route::get('/', [HomeController::class, 'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

//show the category page
route::get('/view_category', [AdminController::class, 'view_category']);

//add category
route::post('/add_category', [AdminController::class, 'add_category']);

//delete category name
route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

//route to view products
route::get('/view_product', [AdminController::class, 'view_product']);

//add product route
route::post('/add_product', [AdminController::class, 'add_product']);

//route for added product page
route::get('/show_product', [AdminController::class, 'show_product']);

//route to delete added product
route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);

//route to update product
route::get('/update_product/{id}', [AdminController::class, 'update_product']);

//show order page route
route::get('/order', [AdminController::class, 'order']);

//delivered status
route::get('/delivered/{id}', [AdminController::class, 'delivered']);

//route for pdf print
route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);

//email notification route
route::get('/send_email/{id}', [AdminController::class, 'send_email']);

//send user notification route
route::post('/send_user_email/{id}', [AdminController::class, 'send_user_email']);

//search route
route::get('/search', [AdminController::class, 'searchdata']);


//route to update product details
route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);

//route for product details
route::get('/product_details/{id}', [HomeController::class, 'product_details']);

//route for add to cart
route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

//route to show cart
route::get('/show_cart', [HomeController::class, 'show_cart']);

//route to remove cart item
route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);

//route for cash on delivery
route::get('/cash_order', [HomeController::class, 'cash_order']);

//stripe payment page
route::get('/stripe/{totalprice}', [HomeController::class, 'stripe']);

//stripe payment
Route::post('stripe/{totalprice}', [HomeController::class, 'stripePost'])->name('stripe.post');

//show order route
route::get('/show_order', [HomeController::class, 'show_order']);

//cancel order route
route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);

//comment route
route::post('/add_comment', [HomeController::class, 'add_comment']);

//reply route
route::post('/add_reply', [HomeController::class, 'add_reply']);

//search product route
route::get('/product_search', [HomeController::class, 'product_search']);

//product search route for product page
route::get('/search_product', [HomeController::class, 'search_product']);

//delete comment route
Route::delete('/delete_comment/{id}',  [HomeController::class, 'delete_comment'])->name('delete_comment');

//ptoduct route
route::get('/products', [HomeController::class, 'product']);

route::get('auth/google', [GoogleController::class, 'googlepage']);

route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);
