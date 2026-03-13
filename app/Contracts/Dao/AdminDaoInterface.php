<?php

namespace App\Contracts\Dao;

use App\Models\Admin;

interface AdminDaoInterface
{
    public function list();
    public function store(array $adminData);
    public function update(Admin $oldAdminData, array $newAdminData);
    public function manageAdmin(array $data);
}
