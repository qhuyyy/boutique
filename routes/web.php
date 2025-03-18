<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome.welcome');
})->name('welcome');
Route::get('/about', function () {
    return view('about.index');
})->name('about');
Route::get('/shop', function () {
    return view('shop.index');
})->name('shop');
Route::get('/blog', function () {
    return view('blog.index');
})->name('blog');
Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');