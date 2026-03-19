<?php

namespace App\Contracts\Dao;

interface MachineDaoInterface
{
    public function getAll();
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function updateStatus(int $id, int $status);
    public function findById(int $id);
}
