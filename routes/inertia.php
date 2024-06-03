<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/inertia', function () {
    return Inertia::render('Home', ['user' => "Inertia User"]);
})->middleware('auth')->name('inertia.home');
Route::get('/inertia/about', function () {
    return Inertia::render('About');
});
Route::get('/inertia/services', function () {
    return Inertia::render('Services');
});
