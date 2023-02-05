<?php

use App\Http\Controllers\admin\dashboard;
use Illuminate\Support\Facades\Route;

Route::controller(dashboard::class)->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/get_register', 'get_register')->name('get_register');
        Route::post('/post_register', 'post_register')->name('post_register');
        Route::get('/get_login', 'get_login')->name('get_login');
        Route::post('/post_login', 'post_login')->name('post_login');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/get_dashboard', 'get_dashboard')->name('get_dashboard');
        Route::get('/edit/{id?}', 'edit')->name('edit');
        Route::get('/delete/{id?}', 'delete')->name('delete');
        Route::post('/post_edit_record', 'post_edit_record')->name('post_edit_record');
        Route::get('/get_destroy_login', 'get_destroy_login')->name('get_destroy_login');
        Route::post("/post_add_record",[dashboard::class,'post_add_record']);
    });
});
Route::get("/event/{id}",[dashboard::class,'event'])->name('event');
Route::get("/download",[dashboard::class,'download'])->name('download');
Route::post("/download_view",[dashboard::class,'download'])->name('download');
Route::get("/download_count",[dashboard::class,'download_count'])->name('download_count');
