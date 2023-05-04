<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;

use App\Repository\Cars\CarRepositoryInterface;

class CarController extends Controller
{
    protected $carRepository;

    public function __construct(CarRepositoryInterface $carRepository) {
        $this->carRepository = $carRepository;
    }

    public function getCars() {
        try {
            $cars = $this->carRepository->getAllCars();

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
    
            $this->carRepository->createCar($data);
    
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
