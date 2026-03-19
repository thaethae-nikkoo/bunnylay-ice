<?php

namespace App\Dao;

use App\Contracts\Dao\MachineDaoInterface;
use App\Models\Machine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MachineDao implements MachineDaoInterface
{
    /**
     * Get All Machines
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Machine::latest()->get();
    }

    /**
     * Find Machine by Id
     *
     * @param integer $id
     * @return \App\Models\Machine
     */
    public function findById(int $id)
    {
        return Machine::findOrFail($id);
    }

    /**
     * Create Machine
     *
     * @param array $data
     * @return \App\Models\Machine
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['created_by'] = Auth::id();
            return Machine::create($data);
        });
    }

    /**
     * Update Machine
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data)
    {
        DB::transaction(function () use ($id, $data) {
            $data['updated_by'] = Auth::id();
            Machine::where('machine_id', $id)->update($data);
        });
    }

    /**
     * Update Machine Status
     *
     * @param integer $id
     * @param integer $status
     * @return void
     */
    public function updateStatus(int $id, int $status)
    {
        DB::transaction(function () use ($id, $status) {
            Machine::where('machine_id', $id)->update([
                'status' => $status,
                'updated_by' => Auth::id(),
            ]);
        });
    }

    /**
     * Delete Machine
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id)
    {
        return DB::transaction(function () use ($id) {
            return Machine::where('machine_id', $id)->delete();
        });
    }
}
