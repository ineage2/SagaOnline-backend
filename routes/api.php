<?php

use Illuminate\Support\Facades\Route;

Route::get('/news', function () {
    return view('welcome');
});
