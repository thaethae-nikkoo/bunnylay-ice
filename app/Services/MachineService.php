<?php

namespace App\Services;

use App\Contracts\Dao\MachineDaoInterface;
use App\Contracts\Services\MachineServiceInterface;
use Illuminate\Support\Facades\Storage;

class MachineService implements MachineServiceInterface
{
    protected $machineDao;

    public function __construct(MachineDaoInterface $machineDao)
    {
        $this->machineDao = $machineDao;
    }

    public function getAll()
    {
        return $this->machineDao->getAll();
    }

    public function findById(int $id)
    {
        return $this->machineDao->findById($id);
    }

    public function create(array $data)
    {
        $data['photo_path'] = null;
        if (!empty($data['photo'])) {
            $data['photo_path'] = $this->uploadImage($data['photo']);
        }
        unset($data['photo']);
        unset($data['remove_photo']);
        $data['status'] = config('constants.machine_status.active');
        return $this->machineDao->create($data);
    }

    public function update(int $id, array $data)
    {
        $machine = $this->machineDao->findById($id);

        if (!empty($data['photo'])) {
            if ($machine->photo_path) {
                Storage::disk('public')->delete($machine->photo_path);
            }
            $data['photo_path'] = $this->uploadImage($data['photo']);
        } elseif (isset($data['remove_photo']) && $data['remove_photo'] == 1) {
            if ($machine->photo_path) {
                Storage::disk('public')->delete($machine->photo_path);
            }
            $data['photo_path'] = null;
        }

        unset($data['photo']);
        unset($data['remove_photo']);
        $this->machineDao->update($id, $data);
    }

    public function updateStatus(int $id, int $status)
    {
        $this->machineDao->updateStatus($id, $status);
    }

    public function changeStatus(int $id)
    {
        $machine = $this->machineDao->findById($id);
        $newStatus = $machine->status == config('constants.machine_status.active')
            ? config('constants.machine_status.inactive')
            : config('constants.machine_status.active');
        $this->machineDao->updateStatus($id, $newStatus);
    }

    public function delete(int $id)
    {
        $machine = $this->machineDao->findById($id);
        if ($machine->photo_path) {
            Storage::disk('public')->delete($machine->photo_path);
        }
        return $this->machineDao->delete($id);
    }

    private function uploadImage($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('machines', $fileName, 'public');
    }
}
