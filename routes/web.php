<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Warehouse\ExportController;
use App\Http\Controllers\Warehouse\ImportController;
use App\Http\Controllers\Warehouse\AdminCartController;
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

Route::get(
    '/welcome',
    [HomeController::class, 'index']
);

Auth::routes();
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Socials login Route
Route::get('/redirectGoogle', [SocialLoginController::class, 'redirectGoogle'])->name('redirectGoogle');
Route::get('/google_callback', [SocialLoginController::class, 'processLoginGoogle']);
Route::get('/redirect-facebook', [SocialLoginController::class, 'redirectFacebook'])->name('redirectFacebook');
Route::get('/facebook_callback', [SocialLoginController::class, 'processFacebookLogin']);


// admin route
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin,employee', 'checkBlock']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/personal_page', [ProfileController::class, 'index'])->name('admin.personal_page');
    Route::get('/change_password', [ProfileController::class, 'changePassword'])->name('admin.change_password');
    Route::put('change_infos/{user}', [ProfileController::class, 'update']);
    Route::post('/update_password', [ProfileController::class, 'updatePassword']);

    //admin lists
    Route::get('/admin_accounts', [UserManageController::class, 'adminAccounts'])->name('admin.admin_accounts');
    //user lists
    Route::get('/user_accounts', [UserManageController::class, 'userAccounts'])->name('admin.user_accounts');
    //block
    Route::post('/users/block/{user}', [UserManageController::class, 'blockUser']);
    Route::post('/users/unblock/{user}', [UserManageController::class, 'unBlockUser']);

    //account details
    Route::get('/user/{user}', [UserManageController::class, 'showUser'])->name('admin.showUser');
    Route::post('/update_avatar/{user}', [ProfileController::class, 'updateAvatar']);
    // import
    Route::get('/import/create', [ImportController::class, 'create'])->name('import.create');
    Route::post('/book', [BookController::class, 'store'])->name('books.store');
    Route::get('/import_bills', [ImportController::class, 'index'])->name('import_bills.index');
    Route::get('/import_details/{importBill}', [ImportController::class, 'show'])->name('import_bills.show');

    // orders
    Route::get('new_orders', [OrderController::class, 'newOrders'])->name('new_orders');
    Route::get('processing_orders', [OrderController::class, 'orderProcessing'])->name('processing_orders');
    Route::get('delivered_orders', [OrderController::class, 'orderDelivered'])->name('delivered_orders');
    Route::get('canceled_orders', [OrderController::class, 'orderCanceled'])->name('canceled_orders');
    Route::put('receive_order/{order}', [OrderController::class, 'receiveOrder'])->name('receive_order');
    Route::put('delivered/{order}', [OrderController::class, 'markDelivered'])->name('mark_delivered');
    Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');

    // books
    Route::get('/book_list', [BookController::class, 'adminBookList'])->name('books_list');
    Route::get('/admin_book/{book}', [BookController::class, 'adminShow'])->name('book.admin_show');
    Route::put('/book/{book}', [BookController::class, 'update'])->name('book.update');

    //admin cart
    Route::post('/add-to-cart', [AdminCartController::class, 'store']);
    Route::get('/get_cart', [AdminCartController::class, 'getCart']);
    Route::get('/cart', [AdminCartController::class, 'index']);
    Route::post('/delete_book_in_cart', [AdminCartController::class, 'deleteBookInCart']);
    Route::post('/update_qty_cart', [AdminCartController::class, 'update']);
    Route::post('/clearCart', [AdminCartController::class, 'clearCart']);
    // export bill
    Route::post('/export_bill', [ExportController::class, 'createExportBill']);
    Route::get('/export_bill/history', [ExportController::class, 'history'])->name('export_bill_history');
    Route::get('/export_bill/history/{bill}', [ExportController::class, 'show'])->name('export_bill_show');
});

//// ADMIN
Route::put('canceled/{order}', [OrderController::class, 'markCanceled'])->middleware('auth')->name('mark_canceled');
Route::get('/admin_book/{book}/edit', [BookController::class, 'edit'])->middleware(['auth', 'role:admin', 'checkBlock'])->name('book.edit');

//delete book
Route::delete('admin/book/{book}', [BookController::class, 'destroy'])->middleware(['auth', 'role:admin', 'checkBlock']);

// delete
Route::delete('/admin/export_bill/{bill}', [ExportController::class, 'deleteBill'])->middleware(['auth', 'role:admin', 'checkBlock'])->name('export_bill_delete');
Route::delete('/user_delete/{user}', [UserManageController::class, 'deleteUser'])->middleware(['auth', 'role:admin', 'checkBlock'])->name('admin.deleteUser');
Route::delete('/admin/order/{order}', [OrderController::class, 'destroy'])->middleware(['auth', 'role:admin', 'checkBlock']);

//Category
Route::resource('/admin/category', CategoryController::class)->middleware(['auth', 'role:admin', 'checkBlock']);
Route::get('/admin/dmbv', [CategoryController::class, 'listdmbv'])->middleware(['auth', 'role:admin', 'checkBlock'])->name('listdmbv');
Route::post('/category/update-category/{category}', [CategoryController::class, 'updateDM'])->middleware(['auth', 'role:admin', 'checkBlock'])->name('admin.updatecategory');

// user route
Route::group(['middleware' => ['auth', 'role:user,author', 'checkBlock']], function () {
    Route::get('/profile', [UserController::class, 'index']);
    Route::post('/update_info', [UserController::class, 'updateInfos'])->name('update_infos');
    Route::post('/update_account', [UserController::class, 'updateAccount']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout', [OrderController::class, 'store']);
});

// Cart
Route::post('/add-to-cart', [CartController::class, 'store'])->middleware(['auth', 'checkBlock']);
Route::get('/get_cart', [CartController::class, 'getCart'])->middleware(['auth', 'checkBlock']);
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth', 'checkBlock']);
Route::post('/delete_book_in_cart', [CartController::class, 'deleteBookInCart'])->middleware(['auth', 'checkBlock']);
Route::post('/update_qty_cart', [CartController::class, 'updateQty'])->middleware(['auth', 'checkBlock']);
Route::post('/clearCart', [CartController::class, 'clearCart'])->middleware(['auth', 'checkBlock']);

//Supplier
Route::get('/supplier/list-supplier', [SupplierController::class, 'index'])->middleware(['auth', 'role:admin', 'checkBlock'])->name('admin.listSupplier');
Route::get('/supplier/create-supplier', [SupplierController::class, 'create'])->middleware(['auth', 'role:admin', 'checkBlock'])->name('admin.createSupplier');
Route::post('/supplier/add-supplier', [SupplierController::class, 'store'])->middleware(['auth', 'role:admin', 'checkBlock']);
Route::get('/supplier/edit-supplier/{supplier}', [SupplierController::class, 'edit'])->middleware(['auth', 'role:admin', 'checkBlock'])->name('admin.editSupplier');
Route::post('/supplier/update-supplier/{supplier}', [SupplierController::class, 'update'])->middleware(['auth', 'role:admin', 'checkBlock'])->name('admin.updateSupplier');
Route::delete('/supplier/destroy-supplier/{supplier}', [SupplierController::class, 'destroy'])->middleware(['auth', 'role:admin', 'checkBlock'])->name('admin.destroySupplier');


Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// preview

Route::get('/blog', function () {
    return view('blog.blog');
});
Route::get('/blog/single', function () {
    return view('blog.single');
});
Route::get('/blog/create', function () {
    return view('blog.create');
});

Route::get('/about', function () {
    return view('client.about');
});
