<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.index');
});

Route::get('dashboard', function () {
    return view('layout.index');
});

// Route::middleware('auth')->group(function () {
//     Route::get('dashboard', function () {
//         return view('Admin.index');
//     });
// });
