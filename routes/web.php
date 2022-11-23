<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\website\WebsiteController;
use App\Http\Controllers\website\WishlistController;
use App\Http\Controllers\website\CartController;



use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ManageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use Darryldecode\Cart\CartCondition;

Route::get('/', [WebsiteController::class, 'home'])->name('website.home');

Route::group(['prefix' => 'wishlist', 'middleware' => 'auth'], function(){
    Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/store/{slug}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::get('/delete/{slug}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

Route::group(['prefix' => 'cart', 'middleware' => 'auth'], function(){
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/{slug}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/delete/{slug}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/coupon/apply', [CartController::class, 'coupon_apply'])->name('cart.coupon.apply');
    Route::get('/coupon/remove', [CartController::class, 'coupon_remove'])->name('cart.coupon.remove');
    Route::post('/city/not/found',[CartController::class, 'city_list'])->name('city.not');
    Route::post('/quantity/update',[CartController::class, 'quantityUpdate'])->name('cart.quantity.update');

});



// // Google Login
// Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
// Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);
// // facebook Login
// Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
// Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);
// // Twitter Login
// // Route::get('login/twitter', [LoginController::class, 'redirectToTwitter'])->name('login.twitter');
// // Route::get('login/twitter/callback', [LoginController::class, 'handleTwitterCallback']);
// // Github Login

// Route::get('login/github', [LoginController::class, 'redirectToGithub'])->name('login.github');
// Route::get('login/github/callback', [LoginController::class, 'handleGithubCallback']);







Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function (){
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard.index');

    Route::group(['prefix' => 'user'], function (){
        Route::get('/', [ UserController::class, 'index'])->name('user.index')->middleware(['role_or_permission:view user|Super Admin|create user']);
        Route::get('/create', [ UserController::class, 'create'])->name('user.create')->middleware(['role_or_permission:create user']);
        Route::post('/', [ UserController::class, 'store'])->name('user.store')->middleware(['role_or_permission:create user']);
        Route::get('/show/{id}', [ UserController::class, 'show'])->name('user.show')->middleware(['role_or_permission:view user']);
        Route::get('/edit/{id}', [ UserController::class, 'edit'])->name('user.edit')->middleware(['role_or_permission:edit user']);
        Route::put('/update/{slug}', [ UserController::class, 'update'])->name('user.update')->middleware(['role_or_permission:edit user']);
        Route::get('/softdelete/{id}',[ UserController::class, 'softdelete' ])->name('user.softdelete')->middleware(['role_or_permission:delete user']);
        Route::get('/delete/{slug}',[ UserController::class, 'destroy' ])->name('user.destroy')->middleware(['role_or_permission:delete user']);
        Route::get('/suspend/{slug}',[ UserController::class, 'suspend' ])->name('user.suspend')->middleware(['role_or_permission:delete user']);
    });

    Route::group(['prefix' => 'coupon'], function(){
        Route::get('/', [CouponController::class, 'index'])->name('coupon.index');
        Route::get('/new', [CouponController::class, 'new'])->name('coupon.new');
        Route::post('/', [CouponController::class, 'store'])->name('coupon.store');
        Route::get('/edit/{slug}', [CouponController::class, 'edit'])->name('coupon.edit');
        Route::get('/softdelete/{slug}', [CouponController::class, 'softdelete'])->name('coupon.softdelete');
    });


    Route::group(['prefix' => 'partner'], function() {
        Route::get('/',[ PartnerController::class, 'index' ])->name('partner.index');
        Route::get('/create',[ PartnerController::class, 'create' ])->name('partner.create');
        Route::post('/',[ PartnerController::class, 'store' ])->name('partner.store');
        Route::get('/show/{slug}',[ PartnerController::class, 'show' ])->name('partner.show');
        Route::get('/edit/{slug}',[ PartnerController::class, 'edit' ])->name('partner.edit');
        Route::put('/update/{slug}',[ PartnerController::class, 'update' ])->name('partner.update');
        Route::get('/softdelete/{slug}',[ PartnerController::class, 'softdelete' ])->name('partner.softdelete');
        Route::get('/delete/{slug}',[ PartnerController::class, 'destroy' ])->name('partner.destroy');
    });


    Route::group(['prefix' => 'brand'], function (){
        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('/', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/show/{slug}', [BrandController::class, 'show'])->name('brand.show');
        Route::get('/edit/{slug}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::put('/update/{slug}', [BrandController::class, 'update'])->name('brand.update');
        Route::get('/softdelete/{slug}', [BrandController::class, 'softdelete'])->name('brand.softdelete');
        Route::get('/delete/{slug}', [BrandController::class, 'delete'])->name('brand.delete');
        Route::get('/suspend/{slug}', [BrandController::class, 'suspend'])->name('brand.suspend');
    });


    Route::group(['prefix' => 'product'], function(){
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::get('/show/{slug}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/edit/{slug}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/update/{slug}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/softdelete/{slug}', [ProductController::class, 'softdelete'])->name('product.softdelete');
        Route::get('/delete/{slug}', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('/suspend/{slug}', [ProductController::class, 'suspend'])->name('product.suspend');
    });


    Route::group(['prefix' => 'banner'], function(){
        Route::get('/', [BannerController::class, 'index'])->name('banner.index');
        Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
        Route::post('/', [BannerController::class, 'store'])->name('banner.store');
        Route::get('/show/{slug}', [BannerController::class, 'show'])->name('banner.show');
        Route::get('/edit/{slug}', [BannerController::class, 'edit'])->name('banner.edit');
        Route::put('/update/{slug}', [BannerController::class, 'update'])->name('banner.update');
        Route::get('/softdelete/{slug}', [BannerController::class, 'softdelete'])->name('banner.softdelete');
        Route::get('/delete/{slug}', [BannerController::class, 'delete'])->name('banner.delete');
        Route::get('/suspend/{slug}', [BannerController::class, 'suspend'])->name('banner.suspend');
    });


    // <<===== BASIC INFO ROUTE LIST ======>>
    Route::get('/basic-info',[ ManageController::class, 'basic_index' ])->name('basic.index');
    Route::post('/basic-info',[ ManageController::class, 'basic_update' ])->name('basic.update');

    // <<===== CONTACT INFO ROUTE LIST ======>>
    Route::get('/contact-info',[ ManageController::class, 'contact_index' ])->name('manage.contact.index');
    Route::post('/contact-info',[ ManageController::class, 'contact_update' ])->name('manage.contact.update');

    // <<===== SOCIAL MEDIA ROUTE LIST ======>>
    Route::get('/social-media',[ ManageController::class, 'social_index' ])->name('manage.social.index');
    Route::post('/social-media',[ ManageController::class, 'socail_update' ])->name('manage.social.update');

    Route::get('/permission',[ ManageController::class, 'permission' ])->name('permission')->middleware(['role_or_permission:view user|Super Admin|create user']);
    Route::get('/permission/edit/{role_id}',[ ManageController::class, 'editPermission' ])->name('permission.edit');
    Route::put('/permission/update/{role_id}',[ ManageController::class, 'updatePermission' ])->name('permission.update');




    Route::group(['prefix' => 'category'], function(){
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/show/{slug}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/edit/{slug}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/update/{slug}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/softdelete/{slug}', [CategoryController::class, 'softdelete'])->name('category.softdelete');
        Route::get('/delete/{slug}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('/suspend/{slug}', [CategoryController::class, 'suspend'])->name('category.suspend');
    });
});

require __DIR__.'/auth.php';
