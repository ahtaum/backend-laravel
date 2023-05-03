<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotorRequest;
use Illuminate\Http\Request;

use App\Models\Vehicle;
use App\Models\Motor;

class MotorController extends Controller
{
    public function getMotors() {
        try {
            $motor = Motor::all();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'total' => $motor->count(),
                'data' => $motor
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(MotorRequest $request) {
        try {   
            $data = $request->validated();

            $vehicle = new Vehicle;
            $vehicle->year = $data["year"];
            $vehicle->color = $data["color"];
            $vehicle->price = $data["price"];
            $vehicle->save();
    
            $motor = new Motor();
            $motor->machine = $data["machine"];
            $motor->suspension_type = $data["suspension_type"];
            $motor->transmision_type = $data["transmision_type"];
            $motor->vehicle()->associate($vehicle);
            $motor->save();
    
            $vehicle->motor()->associate($motor);
            $vehicle->save();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'motor data added!'
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
