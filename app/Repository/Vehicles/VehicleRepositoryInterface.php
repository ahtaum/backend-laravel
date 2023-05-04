<?php

namespace App\Repository\Vehicles;

interface VehicleRepositoryInterface {
    public function getAll();
    public function getById($id);
    public function updateSold($id);
    public function getSoldReport();
}
