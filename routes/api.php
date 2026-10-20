<?php

use App\Http\Controllers\TodolistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/todolist',[TodolistController::class,'index']);
Route::post('/todolist',[TodolistController::class,'store']);
Route::get('/todolist/{id}',[TodolistController::class,'show']);
Route::put('/todolist/{id}',[TodolistController::class,'update']);
Route::delete('/todolist/{id}',[TodolistController::class,'destroy']);
