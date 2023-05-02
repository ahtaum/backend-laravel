<?php

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

    Route::delete("/sold/{id}", "sold");
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
