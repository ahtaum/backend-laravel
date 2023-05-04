<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotorRequest;
use App\Repository\Motor\MotorRepositoryInterface;

use App\Models\Vehicle;
use App\Models\Motor;

class MotorController extends Controller
{
    protected $motorRepository;

    public function __construct(MotorRepositoryInterface $motorRepository)
    {
        $this->motorRepository = $motorRepository;
    }

    public function getMotors() {
        try {
            $motor = $this->motorRepository->getAll();

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

            $this->motorRepository->create($data);

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
