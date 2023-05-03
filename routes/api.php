<?php

use App\Http\Controllers\MotorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;

Route::controller(UserController::class)->prefix("users")->group(function () {
    Route::get("/", "getUsers");
    Route::get("/{id}", "getUser");

    Route::post("/add", "addUser");
    Route::put("/edit/{id}", "updateUser");
    Route::delete("/delete/{id}", "deleteUser");
});

Route::controller(VehicleController::class)->prefix("vehicles")->group(function () {
    Route::get("/", "getVehicles");
    Route::get("/{id}", "getVehicle");

    Route::delete("/sold/{id}", "sold");
});

Route::controller(MotorController::class)->prefix("motor")->group(function () {
    Route::get("/", "getMotors");

    Route::post("/add", "store");
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
