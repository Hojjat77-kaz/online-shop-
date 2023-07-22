<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Home\CompareController;
use App\Http\Controllers\Home\HomeProductController;
use App\Http\Controllers\Home\UserProfileController;
use App\Http\Controllers\Home\WishlistController;
use Illuminate\Support\Facades\Route;

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

Route::get('admin-panel/dashboard', function () {
    return view('admin.dashbord');
})->name('admin.dashboard');

Route::prefix('admin-panel/management')->name('admin.')->group(function (){
    Route::resource('brands',\App\Http\Controllers\Admin\BrandController::class);
    Route::resource('attributes',\App\Http\Controllers\Admin\AttributeController::class);
    Route::resource('categories',\App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('tags',\App\Http\Controllers\Admin\TagController::class);
    Route::resource('products',\App\Http\Controllers\Admin\ProductController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('comments', \App\Http\Controllers\Admin\CommentController::class);

    Route::get('/comments/{comment}/change-approve', [CommentController::class, 'changeApprove'])->name('comments.change-approve');

    // Get Category Attributes
    Route::get('/category-attributes/{category}' ,[CategoryController::class , 'getCategoryAttributes']);

    // Edit Product Image
    Route::get('/products/{product}/images-edit' ,[ProductImageController::class , 'edit'])->name('products.images.edit');
    Route::delete('/products/{product}/images-destroy' ,[ProductImageController::class , 'destroy'])->name('products.images.destroy');
    Route::put('/products/{product}/images-set-primary' ,[ProductImageController::class , 'setPrimary'])->name('products.images.set_primary');
    Route::post('/products/{product}/images-add' ,[ProductImageController::class , 'add'])->name('products.images.add');

    Route::get('/products/{product}/category-edit' ,[ProductController::class , 'editCategory'])->name('products.category.edit');
    Route::put('/products/{product}/category-update' ,[ProductController::class , 'updateCategory'])->name('products.category.update');
});

Route::get('/',[\App\Http\Controllers\Home\HomeController::class,'index'])->name('home.index');
Route::get('/categories/{category:slug}',[\App\Http\Controllers\Home\HomeCategoryController::class,'show'])->name('home.categories.show');
Route::get('/products/{product:slug}' , [HomeProductController::class , 'show'])->name('home.products.show');
Route::post('/products/{product}' , [\App\Http\Controllers\Home\HomeCommentController::class , 'store'])->name('home.comments.store');


Route::get('/login/{provider}', [\App\Http\Controllers\Auth\AuthController::class,'redirectToProvider'])->name('provider.login');
Route::get('/login/{provider}/callback', [\App\Http\Controllers\Auth\AuthController::class,'handelProviderCallback']);

Route::prefix('profile')->name('home.')->group(function () {
    Route::get('/', [UserProfileController::class, 'index'])->name('users_profile.index');
    Route::get('/comments', [\App\Http\Controllers\Home\HomeCommentController::class, 'usersProfileIndex'])->name('comments.users_profile.index');
    Route::get('/wishlist', [WishlistController::class, 'usersProfileIndex'])->name('wishlist.users_profile.index');
    Route::get('/addresses', [\App\Http\Controllers\Admin\AddressesController::class, 'index'])->name('addresses.index');
    Route::post('/addresses', [\App\Http\Controllers\Admin\AddressesController::class, 'store'])->name('addresses.store');
    Route::put('/addresses/{address}', [\App\Http\Controllers\Admin\AddressesController::class, 'update'])->name('addresses.update');
});

Route::get('/add-to-wishlist/{product}', [WishlistController::class, 'add'])->name('home.wishlist.add');
Route::get('/remove-from-wishlist/{product}', [WishlistController::class, 'remove'])->name('home.wishlist.remove');



Route::get('/compare', [\App\Http\Controllers\Home\CompareController::class, 'index'])->name('home.compare.index');
Route::get('/add-to-compare/{product}', [CompareController::class, 'add'])->name('home.compare.add');
Route::get('/remove-to-compare/{product}', [CompareController::class, 'remove'])->name('home.compare.remove');

Route::post('/add-to-cart', [\App\Http\Controllers\Home\CartController::class, 'add'])->name('home.cart.add');
Route::get('/remove-from-cart/{rowId}', [\App\Http\Controllers\Home\CartController::class, 'remove'])->name('home.cart.remove');
Route::get('/cart', [\App\Http\Controllers\Home\CartController::class, 'index'])->name('home.cart.index');
Route::get('/cart-clear', [\App\Http\Controllers\Home\CartController::class, 'clear'])->name('home.cart.clear');
Route::put('/cart', [\App\Http\Controllers\Home\CartController::class, 'update'])->name('home.cart.update');
Route::get('/checkout', [\App\Http\Controllers\Home\CartController::class, 'checkout'])->name('home.orders.checkout');
Route::get('/get-province-cities-list' , [\App\Http\Controllers\Admin\AddressesController::class, 'getProvinceCitiesList']);

Route::get('/test',function (){
  auth()->logout();
});
