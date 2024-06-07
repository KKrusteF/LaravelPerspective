<?php

use App\Http\Controllers\KeyValueController;
use App\Http\Controllers\StackController;
use Illuminate\Support\Facades\Route;

Route::post('/stack/add', [StackController::class, 'addToStack']);
Route::get('/stack/get', [StackController::class, 'getFromStack']);

Route::post('/key-value/add', [KeyValueController::class, 'addKeyValue']);
Route::get('/key-value/get/{key}', [KeyValueController::class, 'getKeyValue']);
Route::delete('/key-value/delete/{key}', [KeyValueController::class, 'deleteKeyValue']);
