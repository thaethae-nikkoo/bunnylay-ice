<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PaymentMethodServiceInterface;
use App\Http\Requests\PaymentMethodDeleteRequest;
use App\Http\Requests\PaymentMethodRequest;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentMethodController extends Controller
{
    public $_resource;
    private $paymentMethodService;

    /**
     * Constrator
     * @param PaymentMethodServiceInterface $paymentMethodService
     */
    public function __construct(PaymentMethodServiceInterface $paymentMethodService)
    {
        $this->paymentMethodService = $paymentMethodService;
    }

    /**
     * List Page
     *
     * @return View
     */
    public function list(Request $request)
    {
        $methods = $this->paymentMethodService->getAll();
        if ($request->expectsJson()) {
            return response()->json($methods);
        }
        return view('pages.payment_method.list', compact('methods'));
    }

    /**
    * create payment_method
    *
    * @param PaymentMethodRequest $request
    * @return JsonResponse
    */
    public function create(PaymentMethodRequest $request)
    {
        try {
            $request = $request->validated();
            $request['status'] =  config('constants.payment_method_status_key.active');
            $data = $this->paymentMethodService->create($request);
            return response()->json(['success', 'data' => $data, 'message' => __("messages.create_success")], 200);
        } catch (Exception $e) {
            Log::error('Error in creating payment method: '.$e->getMessage());
            return response()->json(['error', 'message' => __("messages.something_went_wrong")], 500);
        }
    }

    /**
     * Brand Update
     *
     * @param PaymentMethodRequest $request
     * @return JsonResponse
     */
    public function update(PaymentMethodRequest $request)
    {
        try {
            $this->paymentMethodService->update($this->_resource->payment_method_id, $request->validated());
            $data = $this->_resource->refresh();
            return response()->json(['success', 'data' => $data, 'message' => __("messages.update_success")], 200);
        } catch (Exception $e) {
            Log::error('Error in updating payment_method: '.$e->getMessage());
            return response()->json(['error', 'message' => __("messages.something_went_wrong")], 500);
        }
    }

    /**
    * Delete Payment Method
    *
    * @param PaymentMethodDeleteRequest $request
    * @return RedirectResponse
    */
    public function delete(PaymentMethodDeleteRequest $request)
    {
        $request = $request->validated();
        $result = $this->paymentMethodService->delete($request['payment_method_id']);
        if ($result) {
            return redirect()->route('payment_method.list')->with('success', __("messages.delete_success"));
        } else {
            return redirect()->route('payment_method.list')->with('error', __("messages.something_went_wrong"));
        }
    }

    /**
     * Change Status of payment method
     *
     * @return RedirectResponse
     */
    public function changeStatus()
    {
        try {
            $this->paymentMethodService->changeStatus($this->_resource);
            return redirect()->route('payment_method.list')->with('success', __("messages.update_success"));
        } catch (Exception $e) {
            Log::error('Error in updating payment_method status: '.$e->getMessage());
            return redirect()->route('payment_method.list')->with('success', __("messages.update_success"));
        }
    }
}
