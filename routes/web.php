<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Admin\UserManagementController;

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



// admin route
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin,employee']], function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/personal_page',[ProfileController::class,'index'])->name('admin.personal_page');
    Route::get('/change_password',[ProfileController::class,'changePassword'])->name('admin.change_password');
    Route::post('change_infos',[ProfileController::class,'update']);
    Route::post('/update_password',[ProfileController::class,'updatePassword']);

    //admin lists
    Route::get('/admin_accounts',[UserManagementController::class,'adminAccounts'])->name('admin.admin_accounts');
    Route::get('/get_admin_accounts',[UserManagementController::class,'getAdminAccounts']);
    //user lists
    Route::get('/user_accounts',[UserManagementController::class,'userAccounts'])->name('admin.user_accounts');
    Route::get('/get_user_accounts',[UserManagementController::class,'getUserAccounts']);


});

// user route
Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/profile',[UserController::class,'index']);
    Route::post('/update_info',[UserController::class,'updateInfos'])->name('update_infos');
    Route::post('/update_account',[UserController::class,'updateAccount']);
    Route::get('/checkout',[CheckoutController::class,'index']);
});

// Cart
Route::post('/add-to-cart',[CartController::class,'store'])->middleware('auth');
Route::get('/get_cart',[CartController::class,'getCart'])->middleware('auth');
Route::get('/cart',[CartController::class,'index'])->middleware('auth');
Route::post('/delete_book_in_cart',[CartController::class,'deleteBookInCart'])->middleware('auth');
Route::post('/update_qty_cart',[CartController::class,'updateQty'])->middleware('auth');

//checkout

Route::resource('/article',ArticleController::class);

Route::resource('/books',BookController::class);



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

