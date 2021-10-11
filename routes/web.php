<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Warehouse\ImportController;

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

Route::get('/welcome',
function(){
    return view('welcome');
});

Auth::routes();
Route::get('/',[HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Socials login Route
Route::get('/redirectGoogle', [SocialLoginController::class, 'redirectGoogle'])->name('redirectGoogle');
Route::get('/google_callback', [SocialLoginController::class, 'processLoginGoogle']);
Route::get('/redirect-facebook', [SocialLoginController::class, 'redirectFacebook'])->name('redirectFacebook');
Route::get('/facebook_callback', [SocialLoginController::class, 'processFacebookLogin']);


Route::delete('/user_delete/{user}',[UserManageController::class, 'deleteUser'])->middleware(['auth', 'role:admin'])->name('admin.deleteUser');
// admin route
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin,employee']], function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/personal_page',[ProfileController::class,'index'])->name('admin.personal_page');
    Route::get('/change_password',[ProfileController::class,'changePassword'])->name('admin.change_password');
    Route::put('change_infos/{user}',[ProfileController::class,'update']);
    Route::post('/update_password',[ProfileController::class,'updatePassword']);

    //admin lists
    Route::get('/admin_accounts',[UserManageController::class,'adminAccounts'])->name('admin.admin_accounts');
    //user lists
    Route::get('/user_accounts',[UserManageController::class,'userAccounts'])->name('admin.user_accounts');
    //block
    Route::post('/users/block/{user}', [UserManageController::class, 'blockUser']);
    Route::post('/users/unblock/{user}', [UserManageController::class, 'unBlockUser']);
    //delete
    //account details
    Route::get('/user/{user}',[UserManageController::class, 'showUser'])->name('admin.showUser');
    Route::post('/update_avatar/{user}',[ProfileController::class, 'updateAvatar']);
    // import
    Route::get('/import/create',[ImportController::class,'create'])->name('import.create');
    Route::post('/book',[BookController::class, 'store'])->name('books.store');
    Route::get('/import_bills',[ImportController::class, 'index'])->name('import_bills.index');
    Route::get('/import_details/{importBill}',[ImportController::class, 'show'])->name('import_bills.show');

    // orders
    Route::get('new_orders',[OrderController::class, 'newOrders'])->name('new_orders');
    Route::get('processing_orders',[OrderController::class, 'orderProcessing'])->name('processing_orders');
    Route::get('delivered_orders',[OrderController::class, 'orderDelivered'])->name('delivered_orders');
    Route::get('canceled_orders',[OrderController::class, 'orderCanceled'])->name('canceled_orders');
    Route::put('receive_order/{order}',[OrderController::class, 'receiveOrder'])->name('receive_order');
    Route::put('delivered/{order}',[OrderController::class, 'markDelivered'])->name('mark_delivered');
    Route::get('order/{order}',[OrderController::class, 'show'])->name('order.show');

    // books
    Route::get('/book_list',[BookController::class, 'adminBookList'])->name('books_list');
    Route::get('/admin_book/{book}',[BookController::class, 'adminShow'])->name('book.admin_show');
});
Route::put('canceled/{order}',[OrderController::class, 'markCanceled'])->middleware('auth')->name('mark_canceled');

// user route
Route::group(['middleware' => ['auth', 'role:user,author']], function () {
    Route::get('/profile',[UserController::class,'index']);
    Route::post('/update_info',[UserController::class,'updateInfos'])->name('update_infos');
    Route::post('/update_account',[UserController::class,'updateAccount']);
    Route::get('/checkout',[CheckoutController::class,'index']);
    Route::post('/checkout',[OrderController::class,'store']);
});

// Cart
Route::post('/add-to-cart',[CartController::class,'store'])->middleware('auth');
Route::get('/get_cart',[CartController::class,'getCart'])->middleware('auth');
Route::get('/cart',[CartController::class,'index'])->middleware('auth');
Route::post('/delete_book_in_cart',[CartController::class,'deleteBookInCart'])->middleware('auth');
Route::post('/update_qty_cart',[CartController::class,'updateQty'])->middleware('auth');
Route::post('/clearCart',[CartController::class,'clearCart'])->middleware('auth');
//checkout

Route::resource('/article',ArticleController::class);

Route::get('/books',[BookController::class,'index'])->name('books.index');
Route::get('/books/{book}',[BookController::class,'show'])->name('books.show');




// preview


Route::get('/blog',function(){
    return view('blog.blog');
});
Route::get('/blog/single',function(){
    return view('blog.single');
});
Route::get('/blog/create',function(){
    return view('blog.create');
});

Route::get('/about',function(){
    return view('client.about');
});

