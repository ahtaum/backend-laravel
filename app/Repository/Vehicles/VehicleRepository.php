<?php

namespace App\Repository\Vehicles;

use App\Models\Vehicle;
use Carbon\Carbon;

class VehicleRepository implements VehicleRepositoryInterface {
    public function getAll() {
        return Vehicle::with("motor", "car")->get();
    }

    public function getById($id) {
        return Vehicle::with("motor", "car")->find($id);
    }

    public function updateSold($id) {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Vehicle not found'
            ], 404);
        }

        if ($vehicle->sold) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Vehicle already sold'
            ], 400);
        }

        $vehicle->sold = true;
        $vehicle->sold_at = Carbon::now();
        $vehicle->save();

        return true;
    }

    public function getSoldReport() {
        $vehicles = Vehicle::where("sold", true)->with("motor", "car")->get();
    
        return $vehicles->filter(function ($item) {
            return $item->motor || $item->car;
        })->groupBy(function ($item) {
            return $item->motor ? $item->motor->machine : $item->car->model;
        })->map(function ($items) {
            $totalSold = $items->count();
            $totalPrice = $items->sum('price');
            return [
                'total_sold' => $totalSold,
                'total_price' => $totalPrice,
                'average_price' => $totalSold > 0 ? $totalPrice / $totalSold : 0,
            ];
        });
    }
}
