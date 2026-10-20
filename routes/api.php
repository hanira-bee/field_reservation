<?php

use App\Http\Controllers\API\FieldApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/fields', [FieldApiController::class, 'index']);
Route::apiResource('fields', FieldApiController::class);