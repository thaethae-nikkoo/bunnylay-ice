<?php

namespace App\Contracts\Services;

use App\Models\PaymentMethod;

interface PaymentMethodServiceInterface
{
    public function getAll();
    public function getActivePayments($isPDFInvoice = false);
    public function update(int $paymentMethodId, array $newData);
    public function create(array $request);
    public function delete(int $paymentMethodId);
    public function changeStatus(PaymentMethod $method);
}
