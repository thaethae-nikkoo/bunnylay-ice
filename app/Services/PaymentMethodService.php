<?php

namespace App\Services;

use App\Contracts\Dao\PaymentMethodDaoInterface;
use App\Contracts\Services\PaymentMethodServiceInterface;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class PaymentMethodService implements PaymentMethodServiceInterface
{
    private $paymentMethodDao;

    /**
     * Constructor
     * @method __construct
     * @param PaymentMethodDaoInterface $paymentMethodDao
     */
    public function __construct(
        PaymentMethodDaoInterface $paymentMethodDao,
    ) {
        $this->paymentMethodDao = $paymentMethodDao;
    }

    /**
     * Get All Payment Methods
     *
     * @return \App\Models\PaymentMethod[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->paymentMethodDao->getAll();
    }

    /**
     * Get active paument methods
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActivePayments($isPDFInvoice = false)
    {
        return $this->paymentMethodDao->getActivePayments($isPDFInvoice);
    }

    /**
     * Create
     *
     * @param array $request
     * @return void
     */
    public function create(array $request)
    {
        $prepareData = $this->prepareData($request);
        $paymentMethod =  $this->paymentMethodDao->create($prepareData);
        $paymentMethod->append('status_color');
        return $paymentMethod;
    }

    /**
     * Update
     *
     * @param integer $paymentMethodId
     * @param array $newData
     * @return void
     */
    public function update(int $paymentMethodId, array $newData)
    {
        $prepareData = $this->prepareData($newData);
        $prepareData['updated_by'] = Auth::id();
        $this->paymentMethodDao->update($paymentMethodId, $prepareData);
    }

    /**
    * Delete
    *
    * @param integer $paymentMethodId
    * @return boolean
    */
    public function delete(int $paymentMethodId)
    {
        return $this->paymentMethodDao->delete($paymentMethodId);
    }

    /**
     * Update payment method status
     *
     * @param PaymentMethod $method
     * @return void
     */
    public function changeStatus(PaymentMethod $method)
    {
        $updatedStatus = $this->toggleStatus($method->status);
        return $this->paymentMethodDao->updateStatus($method->payment_method_id, $updatedStatus);
    }

    /**
     * Prepare data for create and update
     *
     * @param array $data
     * @return array
     */
    private function prepareData(array $data)
    {
        $payment = collect(config('payments'))
                 ->firstWhere('account_type', $data['account_type']);
        return [
            'method_name' => $data['method_name'],
            'account_type' => $data['account_type'] ?? null,
            'account_name' => $data['account_name'] ?? null,
            'account_no' => $data['account_no'] ?? null,
            'logo_path' => $payment['logo_path'] ?? null,
            'status' => config('constants.payment_method_status_key.active'),
        ];
    }

    /**
     * Toggle status
     *
     * @param integer $status
     * @return integer
     */
    private function toggleStatus(int $status)
    {
       if ($status == config('constants.payment_method_status_key.active')){
            return config('constants.payment_method_status_key.inactive');
       } else {
            return config('constants.payment_method_status_key.active');
       }
    }
}
