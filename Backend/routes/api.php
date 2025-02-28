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

Route::get('/employees/{employee}/index',[EmployeeController::class,'index'])->name('employee.index');
Route::get('/employees/create',[EmployeeController::class,'create'])->name('employee.create');
Route::get('/employees/{employee}/edit',[EmployeeController::class,'edit'])->name('employee.edit');
Route::put('/employees/{employee}',[EmployeeController::class,'update'])->name('employee.update');
Route::put('/employees/{empliyee}/isActive',[EmployeeController::class,'isActive'])->name('employee.isActive');

//this route does not use
Route::delete('/employees/{empliyee}',[EmployeeController::class,'destroy'])->name('employee.destroy');


//Person Operations
Route::apiResource('Person',PersonController::class);
Route::get('/Check_Id_card/{identity_card_number}',PersonController::class . '@checkIdentityCardNumber');


Route::get('/persons',[PersonController::class,'index'])->name('person.index');
Route::get('/persons/create',[PersonController::class,'create'])->name('person.create');
Route::post('/persons',[PersonController::class,'store'])->name('person.store');
Route::get('/persons/{person}',[PersonController::class,'show'])->name('person.show');
Route::get('/persons/{person}/edit',[PersonController::class,'edit'])->name('person.edit');
Route::put('/persons/{person}',[PersonController::class,'update'])->name('person.update');
Route::delete('/persons/{person}',[PersonController::class,'destroy'])->name('person.destroy');


