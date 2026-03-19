<?php

namespace App\Http\Controllers;

use App\Contracts\Services\MachineServiceInterface;
use App\Http\Requests\MachineRequest;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    protected $machineService;

    public function __construct(MachineServiceInterface $machineService)
    {
        $this->machineService = $machineService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $machines = $this->machineService->getAll();
        return view('pages.machines.index', compact('machines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MachineRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo');
        }
        $this->machineService->create($data);
        return redirect()->route('machines.index')->with('success', 'Machine created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MachineRequest $request, int $id)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo');
        }
        $this->machineService->update($id, $data);
        return redirect()->route('machines.index')->with('success', 'Machine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->machineService->delete($id);
        return redirect()->route('machines.index')->with('success', 'Machine deleted successfully.');
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(int $id)
    {
        $this->machineService->changeStatus($id);
        return redirect()->route('machines.index')->with('success', 'Machine status updated successfully.');
    }

    /**
     * Get machine details for edit modal.
     */
    public function edit(int $id)
    {
        $machine = $this->machineService->findById($id);
        return response()->json($machine);
    }
}
