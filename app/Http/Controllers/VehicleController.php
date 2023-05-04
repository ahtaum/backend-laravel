<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Vehicle;
use Carbon\Carbon;

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

    public function sellVehicle(SaleRequest $request) {
        try {
            $data = $request->validated();

            $vehicle = Vehicle::find($data["vehicle_id"]);

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

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Vehicle sold!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getReports() {
        try {
            $vehicles = Vehicle::where("sold", true)->with("motor", "car")->get();

            $reportData = $vehicles->groupBy(function ($item) {
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

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'total' => $reportData->count(),
                'data' => $reportData
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
