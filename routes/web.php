<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function (){
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard.index');
});

require __DIR__.'/auth.php';
