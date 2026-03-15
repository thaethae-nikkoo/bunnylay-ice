<?php

namespace App\Services;

use App\Contracts\Dao\AdminDaoInterface;
use App\Contracts\Services\AdminServiceInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminService implements AdminServiceInterface
{
    private $adminDao;

    /**
     * Constructor
     * @method __construct
     * @param AdminDaoInterface $adminDao
     */
    public function __construct(
        AdminDaoInterface $adminDao,
    ) {
        $this->adminDao = $adminDao;
    }

    /**
     * List Admin Data
     * @return Admin[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return $this->adminDao->list();
    }

    /**
     * Store Admin Data
     * @param array $adminData
     * @return AdminDao
     */
    public function store(array $adminData)
    {
        $data = $this->prepareData($adminData);
        return $this->adminDao->store($data);
    }

    /**
     * Update Admin Data
     * @param array $newAdminData
     * @param Admin $oldAdminData
     * @return AdminDao
     */
    public function update(Admin $oldAdminData, array $newAdminData)
    {
        $data = $this->prepareData($newAdminData);
        return $this->adminDao->update($oldAdminData, $data);
    }

    /**
     * Delete Admin Data
     * @param int $adminId
     * @return AdminDao
     */
    public function manageAdmin(array $data)
    {
        return  $this->adminDao->manageAdmin($data);
    }

    /**
     * Arrange Data
     *
     * @param array $adminData
     */
    private function prepareData(array $adminData)
    {
        \Log::info(json_encode($adminData));
        $data = [
            'name' => $adminData['name'],
            'username' => $adminData['username'],
            'phone' => $adminData['phone'] ?? null,
            'role' => $adminData['role']
        ];
        if (!empty($adminData['password'])) {
            $data['password'] = Hash::make($adminData['password']);
        }
        return $data;
    }
}
