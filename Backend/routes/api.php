<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PersonController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);


//Employee Operations
Route::apiResource('Employee',EmployeeController::class);
Route::get('/search/{name}', EmployeeController::class . "@getByname");


//Person Operations
Route::apiResource('Person',PersonController::class);
Route::get('/Check_Id_card/{identity_card_number}',PersonController::class . '@checkIdentityCardNumber');



