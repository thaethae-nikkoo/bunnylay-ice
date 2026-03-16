<?php

namespace App\Contracts\Dao;

interface PaymentMethodDaoInterface
{
    public function getAll();
    public function getActivePayments($isPDFInvoice = false);
    public function update(int $paymentMethodId, array $newData);
    public function create(array $paymentMethod);
    public function delete(int $paymentMethodId);
    public function updateStatus(int $paymentMethodId, int $updatedStatus);
}
