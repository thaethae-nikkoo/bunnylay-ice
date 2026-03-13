<?php

namespace App\Dao;

use App\Contracts\Dao\AdminDaoInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminDao implements AdminDaoInterface
{
    /**
     * List Admin Data
     * @return Admin[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        $activeAdmin = Admin::latest()->get();
        $deletedAdmin = Admin::onlyTrashed()->get();
        return [$activeAdmin, $deletedAdmin];
    }

    /**
     * Store Admin Data
     * @param array $adminData
     * @return void
     */
    public function store(array $adminData)
    {
        DB::transaction(function () use ($adminData) {
            Admin::create($adminData);
        });
    }

    /**
     * Update Admin Data
     * @param array $newAdminData
     * @param Admin $oldAdminData
     * @return void
     */
    public function update(Admin $oldAdminData, array $newAdminData)
    {
        DB::transaction(function () use ($oldAdminData, $newAdminData) {
            $oldAdminData->update($newAdminData);
        });
    }

    /**
     * Delete Admin Data
     * @param int $adminId
     * @return void
     */
    public function manageAdmin(array $data)
    {
        DB::transaction(function () use ($data) {
            $action = $data['action'];
            $admin_id = $data['admin_id'];
            $admin = Admin::withTrashed()->findOrFail($admin_id);
            switch ($action) {
                case 'ban':
                    if (!$admin->trashed()) {
                        $admin->delete();
                    }
                    break;
                case 'delete':
                    $admin->forceDelete();
                    break;
                case 'restore':
                    if ($admin->trashed()) {
                        $admin->restore();
                    }
                    break;
                default:
                    break;
            }
        });
    }
}
