@let($saleDate = isset($_resource->sale_date) ? format_date($_resource->sale_date) : null)
@let($itemId = isset($_resource->item_id) ?? null)
@let($truckNo = isset($_resource->thai_truck_no) ?? null)
@let($kg = isset($_resource->kg)? remove_unvaluable_zero($_resource->kg):null)
@let($remark = old('remark', $_resource->remark ?? null))
@let($pricePerKgBaht = old('price_per_kg_baht', isset($_resource->price_per_kg_baht) ? remove_unvaluable_zero($_resource->price_per_kg_baht) : null))
@let($pricePerKgKyat = old('price_per_kg_kyat', isset($_resource->price_per_kg_kyat) ? remove_unvaluable_zero($_resource->price_per_kg_kyat) : null))
@let($totalPriceKyat = old('total_price_kyat', isset($_resource->total_price_kyat) ? remove_unvaluable_zero($_resource->total_price_kyat) : null))
@let($totalPriceBaht = old('total_price_baht', isset($_resource->total_price_baht) ? remove_unvaluable_zero($_resource->total_price_baht) : null))
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
        <label for="sale_date" class="form-label">ရက်စွဲ <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="sale_date" id="sale_date"
            value="{{ old('sale_date',$saleDate) }}" placeholder="DD/MM/YYYY" />
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
        <label for="item_id" class="form-label">ကုန်အမျိုးအစား <span class="required-star">*</span></label>
        <div class="item_id-error-element item_id-select custom-select">
            <select class="form-select form-control shadow-none select item_id single-select" name="item_id"
                id="item_id">
                <option value="">--ရွေးချယ်ပါ--</option>
                @if (!empty($items))
                @foreach ($items as $item)
                <option value="{{ $item->item_id }}" @if ($item->item_id == old('item_id',$itemId)) selected @endif>
                    {{ $item->name }}
                </option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
        <label for="thai_truck_no" class="form-label">ထိုင်းကားနံပါတ် </label>
        <input type="text" class="form-control shadow-none" name="thai_truck_no" id="thai_truck_no"
            value="{{ old('thai_truck_no', $truckNo) }}" />
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
        <label for="kg" class="form-label">KG <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="kg" id="kg" value="{{ old('kg', $kg) }}" />
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
        <label for="price_per_kg_baht" class="form-label">1Kg ဈေးနှုန်း(ဘတ်)</label>
        <input type="text" class="form-control shadow-none" name="price_per_kg_baht" id="price_per_kg_baht"
            value="{{ $pricePerKgBaht }}" />
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
        <label for="price_per_kg_kyat" class="form-label">1Kg ဈေးနှုန်း(ကျပ်)</label>
        <input type="text" class="form-control shadow-none" name="price_per_kg_kyat" id="price_per_kg_kyat"
            value="{{ $pricePerKgKyat }}" />
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
        <label for="total_price_baht" class="form-label">စုစုပေါင်းဘတ်ငွေ</label>
        <input type="text" class="form-control shadow-none" name="total_price_baht" id="total_price_baht"
            value="{{ $totalPriceBaht }}" />
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
        <label for="total_price_kyat" class="form-label">စုစုပေါင်းကျပ်ငွေ </label>
        <input type="text" class="form-control shadow-none" name="total_price_kyat" id="total_price_kyat"
            value="{{ $totalPriceKyat }}" />
    </div>
    <div class="col-lg-8 col-md-6 col-sm-12 mt-3">
        <label for="remark" class="form-label">မှတ်ချက်</label>
        <input type="text" class="form-control shadow-none" name="remark" id="remark"
            value="{{ $remark }}" />
    </div>

</div>
