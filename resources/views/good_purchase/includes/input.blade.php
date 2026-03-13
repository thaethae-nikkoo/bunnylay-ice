@let($item_id = old('item_id', $_resource->item_id ?? null))
@let($farmer_name = $_resource->farmer_name ?? null)
@let($viss = isset($_resource) ? formatViss($_resource->viss, false) : null)
@let($price_per_viss = $_resource->price_per_viss ?? null)
@let($total_price = $_resource->total_price ?? null)
@let($remark = $_resource->remark ?? null)
@php
$isEdit = isset($_resource);
$total_price = $isEdit ? $total_price : 0;
$modelDate =
$isEdit && $_resource->purchase_date ? \Carbon\Carbon::parse($_resource->purchase_date)->format('d/m/Y') : '';
$purchase_date_val = $errors->any() ? old('purchase_date') : $modelDate;
@endphp
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="purchase_date" class="form-label">ရက်စွဲ <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="purchase_date" id="purchase_date"
            value="{{ $purchase_date_val }}" placeholder="DD/MM/YYYY" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3 selection">
        <label for="item_id" class="form-label">ကုန်အမျိုးအစား <span class="required-star">*</span></label>
        <div class="item_id-error-element item_id-select custom-select">
            <select class="form-select form-control shadow-none select item_id single-select" name="item_id"
                id="item_id">
                <option value="">--ရွေးချယ်ပါ--</option>
                @if (!empty($items))
                @foreach ($items as $item)
                <option value="{{ $item->item_id }}" @if ($item->item_id == $item_id) selected @endif>
                    {{ $item->name }}
                </option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="farmer_name" class="form-label">တောင်သူအမည် <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="farmer_name" id="farmer_name"
            value="{{ old('farmer_name', $farmer_name) }}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="viss" class="form-label">အရေအတွက်(ပိဿာချိန်) <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="viss" id="viss" value="{{ old('viss', $viss) }}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="price_per_viss" class="form-label">ဈေးနှုန်း(ကျပ်) <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="price_per_viss" id="price_per_viss"
            value="{{ old('price_per_viss', $price_per_viss) }}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="total_price" class="form-label">သင့်ငွေ(ကျပ်) <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="total_price" id="total_price"
            value="{{ old('total_price', $total_price) }}" />
    </div>
    <div class="col-lg-8 col-md-6 col-sm-12 mt-3">
        <label for="remark" class="form-label">မှတ်ချက်</label>
        <input type="text" class="form-control shadow-none" name="remark" id="remark"
            value="{{ old('remark', $remark) }}" />
    </div>
</div>
