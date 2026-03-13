@let($description = $_resource->description ?? null)
@let($amount_in_kyat = $_resource->amount_in_kyat ?? null)
@let($payment_method = $_resource->payment_method ?? null)
@let($remark = $_resource->remark ?? null)
@let($exportPaymentId = $_resource->export_payment_id ?? null)
@let($goodPurchasePaymentId = $_resource->good_purchase_payment_id ?? null)
@php
$isEdit = isset($_resource);
$modelDate = $isEdit && $_resource->date ? \Carbon\Carbon::parse($_resource->date)->format('d/m/Y') : '';
$payment_date_val = $errors->any() ? old('payment_date') : $modelDate;
$amount_in_baht = $isEdit && $_resource->amount_in_baht ? remove_unvaluable_zero($_resource->amount_in_baht) : null;
@endphp
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="payment_date" class="form-label">ရက်စွဲ <span class="required-star">*</span>
        </label>
        <input type="text" class="form-control shadow-none" name="payment_date" id="payment_date"
            value="{{ $payment_date_val }}" placeholder="DD/MM/YYYY" />
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="description" class="form-label">အကြောင်းအရာ <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="description" id="description" {{ $isEdit &&
        (!empty($goodPurchasePaymentId) || !empty($exportPaymentId))? 'readonly' : '' }}
            value="{{ old('description', $description) }}" />
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="amount_in_kyat" class="form-label">အမောင့် (ကျပ်) </label>
        <input type="text" class="form-control shadow-none" name="amount_in_kyat" id="amount_in_kyat"
            value="{{ old('amount_in_kyat', $amount_in_kyat) }}" />
    </div>
    <div class="col-md-6 col-sm-12 mb-3 only-number {{ $isEdit &&
        (!empty($goodPurchasePaymentId) || !empty($exportPaymentId))? 'hidden' : '' }}">
        <label for="amount_in_baht" class="form-label">အမောင့် (ဘတ်) </label>
        <input type="text" class="form-control shadow-none" name="amount_in_baht" id="amount_in_baht"
            value="{{ old('amount_in_baht', $amount_in_baht) }}" />
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="payment_method" class="form-label">ငွေလွှဲအမျိုးအစား </label>
        <input type="text" class="form-control shadow-none" name="payment_method" id="payment_method"
            value="{{ old('payment_method', $payment_method) }}" />
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="remark" class="form-label">မှတ်ချက်</label>
        <input type="text" class="form-control shadow-none" name="remark" id="remark"
            value="{{ old('remark', $remark) }}" />
    </div>
</div>
