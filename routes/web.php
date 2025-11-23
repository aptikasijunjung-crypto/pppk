<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AparaturController;

Route::get('/', [AparaturController::class, "index"])->name('login');


Route::post('/proses/login', [AparaturController::class, "login"])->name('proses.login');
