<?php

namespace App\Contracts\Services;

use App\Models\Admin;

interface AdminServiceInterface
{
    public function list();
    public function store(array $adminData);
    public function update(Admin $oldAdminData, array $newAdminData);
    public function manageAdmin(array $data);
}
