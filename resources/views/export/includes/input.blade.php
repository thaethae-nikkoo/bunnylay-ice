@php
$exportDate = old('export_date', isset($_resource->export_date) && $_resource->export_date
? \Carbon\Carbon::parse($_resource->export_date)->format('d/m/Y')
: null);

$departureTime = old('departure_time', isset($_resource->departure_time) && $_resource->departure_time
? \Carbon\Carbon::parse($_resource->departure_time)->format('d/m/Y H:i')
: null);

$truckNo = old('truck_no', isset($_resource->truck_no) ? $_resource->truck_no : null);
$driverName = old('driver_name', isset($_resource->driver_name) ? $_resource->driver_name : null);
$driverPhone = old('driver_phone', isset($_resource->driver_phone) ? $_resource->driver_phone : null);
$driverNrc = old('driver_nrc', isset($_resource->driver_nrc) ? $_resource->driver_nrc : null);
$remark = old('remark', isset($_resource->remark) ? $_resource->remark : null);
$truckFee = old('truck_fee', isset($_resource->truck_fee) ? $_resource->truck_fee : null);
$truckFeeDownPayment = old('truck_fee_down_payment', isset($_resource->truck_fee_down_payment) ? $_resource->truck_fee_down_payment : null);
$dutyFee = old('duty_fee', isset($_resource->duty_fee) ? $_resource->duty_fee : null);
$dutyFeeDownPayment = old('duty_fee_down_payment', isset($_resource->duty_fee_down_payment) ? $_resource->duty_fee_down_payment : null);
$truckOwnerName = old('truck_owner_name', isset($_resource->truck_owner_name) ? $_resource->truck_owner_name : null);

@endphp
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="export_date" class="form-label">ရက်စွဲ <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="export_date" id="export_date" placeholder="DD/MM/YYYY"
            value="{{$exportDate}}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="truck_no" class="form-label">ကားနံပါတ် <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="truck_no" id="truck_no" value="{{$truckNo}}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="driver_name" class="form-label">ယာဥ်မောင်း <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="driver_name" id="driver_name"
            value="{{$driverName}}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="driver_phone" class="form-label">ဖုန်းနံပါတ် <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="driver_phone" id="driver_phone"
            value="{{$driverPhone}}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="driver_nrc" class="form-label">မှတ်ပုံတင်နံပါတ်</label>
        <input type="text" class="form-control shadow-none" name="driver_nrc" id="driver_nrc" value="{{$driverNrc}}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="truck_owner_name" class="form-label">ကားဥန္နာ</label>
        <input type="text" class="form-control shadow-none" name="truck_owner_name" id="truck_owner_name"
            value="{{$truckOwnerName}}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="departure_time" class="form-label">ကားစတင်ထွက်ချိန် </label>
        <input type="text" class="form-control shadow-none" name="departure_time" id="departure_time"
            placeholder="DD/MM/YYYY H:m" value="{{ $departureTime }}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="truck_fee" class="form-label">ကားခ </label>
        <input type="text" class="form-control shadow-none" name="truck_fee" id="truck_fee" value="{{ $truckFee }}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="duty_fee" class="form-label">ဂျူတီခ </label>
        <input type="text" class="form-control shadow-none" name="duty_fee" id="duty_fee" value="{{ $dutyFee }}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="truck_fee_down_payment" class="form-label">ကားခ စရံငွေ</label>
        <input type="text" class="form-control shadow-none" name="truck_fee_down_payment" id="truck_fee_down_payment" value="{{ $truckFeeDownPayment }}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="duty_fee_down_payment" class="form-label">ဂျူတီခ စရံငွေ</label>
        <input type="text" class="form-control shadow-none" name="duty_fee_down_payment" id="duty_fee_down_payment" value="{{ $dutyFeeDownPayment }}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label for="remark" class="form-label">မှတ်ချက်</label>
        <input type="text" class="form-control shadow-none" name="remark" id="remark" value="{{ $remark }}" />
    </div>
</div>
<hr>
<div class="d-flex justify-content-end">
    <a href="#" class="btn btn-xs btn-primary mx-3" id="add_item">ထပ်ထည့် </a>
</div>
<div class="clone-error"></div>
<div class="row cloneTarget">
    <div class="col-md-10">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                <label for="item_id" class="form-label">ကုန်အမျိုးအစား <span class="required-star">*</span></label>
                <div class="item_id-error-element custom-select">
                    <select class="form-select form-control shadow-none select item_id single-select" name="item_id"
                        id="item_id">
                        <option value="">--ရွေးချယ်ပါ--</option>
                        @if (!empty($items))
                        @foreach ($items as $item)
                        <option value="{{ $item->item_id }}">
                            {{ $item->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                <label for="basket_count" class="form-label">ခြင်းအရေအတွက် </label>
                <input type="text" class="form-control shadow-none" name="basket_count" id="basket_count"
                    value="{{ old('basket_count') }}" />
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                <label for="kg" class="form-label">KG </label>
                <input type="text" class="form-control shadow-none" name="kg" id="kg" value="{{ old('kg') }}" />
            </div>
        </div>
    </div>
</div>
<script>
    @if (isset($_resource))
    const export_id = {{$_resource->export_id}};
    let exportItems = {!! json_encode($_resource->exportItems) !!};
    @endif
</script>
