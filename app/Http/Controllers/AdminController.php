<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AdminServiceInterface;
use App\Http\Requests\Auth\AdminManagementRequest;
use App\Http\Requests\Auth\AdminRequest;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public $_resource;
    private $adminService;

    /**
     * Constructor
     * @param AdminServiceInterface $adminService
     * @return void
     */
    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Admin create form
     *
     * @return View
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Admin store data
     *
     * @param AdminRequest $request
     * @return View
     */
    public function store(AdminRequest $request)
    {
        $adminData = $request->validated();
        $this->adminService->store($adminData);
        return redirect()->route('adminLists')->with('success', __('messages.create_success'));
    }

    /**
     * Admin list form
     *
     * @return View
     */
    public function list()
    {
        [$activeAdmin, $bannedAdmin] = $this->adminService->list();
        return view('admin.list', compact('activeAdmin', 'bannedAdmin'));
    }

    /**
     * Profile Detail
     *
     * @return View
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Admin Edit Form
     *
     * @return View
     */
    public function edit()
    {
        return view('admin.edit');
    }

    /**
     * Admin update data
     *
     * @param AdminRequest $request
     * @return View
     */
    public function update(AdminRequest $request)
    {
        $adminData = $request->validated();
        $this->adminService->update($this->_resource, $adminData);
        return redirect()->route('adminLists')->with('success', __('messages.update_success'));
    }

    /**
     * Delete Admin
     *
     * @param AdminDeleteRequest $request
     * @return View
     */
    public function manageAdmin(AdminManagementRequest $request)
    {
        $data = $request->validated();
        $this->adminService->manageAdmin($data);
        return redirect()->route('adminLists')->with('success', __('messages.ban_delete_restore'));
    }
}
