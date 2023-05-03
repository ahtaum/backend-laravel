<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;

use App\Models\Vehicle;
use App\Models\Car;

class CarController extends Controller
{
    public function getCars() {
        try {
            $cars = Car::all();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'total' => $cars->count(),
                'data' => $cars
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(CarRequest $request) {
        try {
            $data = $request->validated();
    
            $vehicle = new Vehicle;
            $vehicle->year = $data["year"];
            $vehicle->color = $data["color"];
            $vehicle->price = $data["price"];
            $vehicle->save();
    
            $cars = new Car();
            $cars->machine = $data["machine"];
            $cars->capacity = $data["capacity"];
            $cars->type = $data["type"];
            $cars->vehicle()->associate($vehicle);
            $cars->save();
    
            $vehicle->car()->associate($cars);
            $vehicle->save();
    
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Cars data added!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
