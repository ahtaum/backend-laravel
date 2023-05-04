<?php

namespace App\Repository\Motor;

interface MotorRepositoryInterface {
    public function getAll();

    public function create(array $data);
}
