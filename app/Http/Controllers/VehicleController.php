<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function getVehicles() {
        try {
            $vehicles = Vehicle::with("motor", "car")->get();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'total' => $vehicles->count(),
                'data' => $vehicles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function sold($id) {
        try {
            $vehicle = Vehicle::find($id);
    
            if ($vehicle) {
                $vehicle->delete();
            }
    
            return response()->json([
                'code' => 200,
                'status' => 'vehicle sold out!',
                'total' => $vehicles->count()
            ]);
        } catch (\Expection $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
