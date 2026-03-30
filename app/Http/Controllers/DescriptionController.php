<?php

namespace App\Http\Controllers;

use App\Http\Requests\DescriptionDeleteRequest;
use App\Http\Requests\DescriptionGroupDeleteRequest;
use App\Http\Requests\DescriptionGroupRequest;
use App\Http\Requests\DescriptionRequest;
use App\Services\DescriptionService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DescriptionController extends Controller
{
    private $descriptionService;
    public $_resource;

    /**
     * Constrator
     * @param DescriptionService $descriptionService
     */
    public function __construct(DescriptionService $descriptionService)
    {
        $this->descriptionService = $descriptionService;
    }

    /**
     * Description Group List
     *
     * @return View|JsonResponse
     */
    public function gpList(Request $request)
    {
        $descGps = $this->descriptionService->getAllDescriptionGps();
        if ($request->expectsJson()) {
            return response()->json($descGps);
        }
        return view('pages.description.gp_list', compact('descGps'));
    }

    /**
     * List of descriptions
     *
     * @return View
     */
    public function descriptionList(int $gpId)
    {
        $descriptions = $this->descriptionService->getDescriptionList($gpId);
        return view('pages.description.list', compact('descriptions'));
    }

    /**
     * create description
     *
     * @param DescriptionRequest $request
     * @return JsonResponse
     */
    public function createDescription(DescriptionRequest $request)
    {
        try {
            $data = $this->descriptionService->createDescription($request->validated());
            session()->flash('success', __('messages.create_success'));
            return response()->json(['success', 'data' => $data, 'message' => __("messages.create_success")], 200);
        } catch (Exception $e) {
            Log::error('Error in creating description: ' . $e->getMessage());
            return response()->json(['error', 'message' => __("messages.something_went_wrong")], 500);
        }
    }

    /**
     * Description Update
     *
     * @param DescriptionRequest $request
     * @return JsonResponse
     */
    public function updateDescription(DescriptionRequest $request)
    {
        try {
            $this->descriptionService->desUpdate($this->_resource->description_id, $request->validated());
            $data = $this->_resource->refresh();
            session()->flash('success', __('messages.update_success'));
            return response()->json(['success', 'data' => $data, 'message' => __("messages.update_success")], 200);
        } catch (Exception $e) {
            Log::error('Error in update description: ' . $e->getMessage());
            return response()->json(['error', 'message' => __("messages.something_went_wrong")], 500);
        }
    }

    /**
     * Delete Description
     *
     * @param DescriptionDeleteRequest $request
     * @return RedirectResponse
     */
    public function deleteDescription(Request $request)
    {
        $descId = (int) $request->route('description_id');
        $result = $this->descriptionService->deleteDescription($request['description_id']);
        if ($result) {
            return redirect()->route('description_gps.descriptions.list', $this->_resource->description_gp_id)->with('success', __("messages.delete_success"));
        } else {
            return redirect()->route('description_gps.descriptions.list', $this->_resource->description_gp_id)->with('error', __("messages.something_went_wrong"));
        }
    }

    /**
     * Create Description Groups
     *
     * @param DescriptionGroupRequest $request
     * @return void
     */
    public function gpcreate(DescriptionGroupRequest $request)
    {
        try {
            $data = $this->descriptionService->createDescriptionGp($request->validated());
            return response()->json(['success', 'data' => $data, 'message' => __("messages.create_success")], 200);
        } catch (Exception $e) {
            Log::error('Error in creating description group: ' . $e->getMessage());
            return response()->json(['error', 'message' => __("messages.something_went_wrong")], 500);
        }
    }

    /**
     * Delete Description group
     *
     * @param int $descGpId
     * @return RedirectResponse
     */
    public function gpDelete(int $descGpId)
    {
        $result = $this->descriptionService->deleteDescriptionGp($descGpId);
        if ($result) {
            return redirect()->route('description_gps.list')->with('success', __("messages.delete_success"));
        } else {
            return redirect()->route('description_gps.list')->with('error', __("messages.something_went_wrong"));
        }
    }

    /**
     * Update description group
     *
     * @param DescriptionGroupRequest $request
     * @return RedirectResponse
     */
    public function gpUpdate(DescriptionGroupRequest $request)
    {
        try {
            $this->descriptionService->descGpUpdate($this->_resource->description_gp_id, $request->validated());
            $data = $this->_resource->refresh();
            $data->append('description_type_text');
            return response()->json(['success', 'data' => $data, 'message' => __("messages.update_success")], 200);
        } catch (Exception $e) {
            Log::error('Error in update description group: ' . $e->getMessage());
            return response()->json(['error', 'message' => __("messages.something_went_wrong")], 500);
        }
    }
}
