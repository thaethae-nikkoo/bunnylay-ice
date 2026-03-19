<?php

namespace App\Contracts\Services;

interface MachineServiceInterface
{
    public function getAll();
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function updateStatus(int $id, int $status);
    public function changeStatus(int $id);
    public function findById(int $id);
}
