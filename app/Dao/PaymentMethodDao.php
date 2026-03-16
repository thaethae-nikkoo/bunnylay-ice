<?php

namespace App\Dao;

use App\Contracts\Dao\PaymentMethodDaoInterface;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentMethodDao implements PaymentMethodDaoInterface
{
    /**
     * Get All PaymentMethods
     *
     * @return \App\Models\PaymentMethod[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return PaymentMethod::latest()->get();
    }

    /**
     * Get active paument methods
     *
     * @return Collection
     */
    public function getActivePayments($isPDFInvoice = false)
    {
        $paymentMethods =  PaymentMethod::latest()
                            ->where('status', config('constants.payment_method_status_key.active'))
                            ->get();
        if ($isPDFInvoice) {
            $methodsConfig = config('payments');
            $paymentMethods = $paymentMethods
                        ->groupBy('account_type')
                        ->sortBy(function ($methods, $type) use ($methodsConfig) {
                        $config = collect($methodsConfig)
                            ->firstWhere('account_type', $type);
                    return $config['order'] ?? 999;
                });
        }
        return $paymentMethods;
    }

    /**
     * create paymentMethod
     *
     * @param array $paymentMethod
     * @return void
     */
    public function create(array $paymentMethod)
    {
        return DB::transaction(function () use ($paymentMethod) {
            return PaymentMethod::create($paymentMethod);
        });
    }

    /**
     * PaymentMethod Update
     *
     * @param integer $paymentMethodId
     * @param array $newData
     * @return void
     */
    public function update(int $paymentMethodId, array $newData)
    {
        DB::transaction(function () use ($paymentMethodId, $newData) {
            PaymentMethod::where('payment_method_id', $paymentMethodId)->update($newData);
        });
    }

    /**
     * PaymentMethod Update
     *
     * @param integer $paymentMethodId
     * @param int $updatedStatus
     * @return void
     */
    public function updateStatus(int $paymentMethodId, int $updatedStatus)
    {
        DB::transaction(function () use ($paymentMethodId, $updatedStatus) {
            PaymentMethod::where('payment_method_id', $paymentMethodId)->update([
                'status' => $updatedStatus,
                'updated_by' => Auth::id(),
            ]);
        });
    }

    /**
    * Delete PaymentMethod
    *
    * @param integer $paymentMethodId
    * @return boolean
    */
    public function delete(int $paymentMethodId)
    {
        return DB::transaction(function () use ($paymentMethodId) {
            return PaymentMethod::where('payment_method_id', $paymentMethodId)->delete();
        });
    }
}
