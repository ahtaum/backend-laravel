<?php

namespace App\Http\Controllers;

use App\Repository\Vehicles\VehicleRepositoryInterface;
use App\Http\Requests\SaleRequest;

class VehicleController extends Controller {
    private $vehicleRepository;

    public function __construct(VehicleRepositoryInterface $vehicleRepository) {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function getVehicles() {
        try {
            $vehicles = $this->vehicleRepository->getAll();

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

            $this->vehicleRepository->updateSold($data["vehicle_id"]);

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
            $reportData = $this->vehicleRepository->getSoldReport();

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
