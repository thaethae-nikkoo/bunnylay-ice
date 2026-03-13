<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="payment_modal" data-editmode="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle"></h5>
                        <!--ပြင်ဆင်ရန်-->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="export_id" id="export_id" value="{{$_resource->export_id}}">
                            <div class="col-12 mb-3">
                                <label for="payment_date" class="form-label">ရက်စွဲ <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control shadow-none" name="payment_date"
                                    id="payment_date" value="" placeholder="DD/MM/YYYY"/>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="payment_date" class="form-label">အကြောင်းအရာ <span
                                        class="required-star">*</span>
                                </label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input description_type" type="radio" name="description_type"
                                            id="truck_fee" value="{{config('constants.export_payment_description_type.truck_fee')}}">
                                        <label class="form-check-label"
                                            for="truck_fee">ကားခ</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input description_type" type="radio" name="description_type"
                                            id="duty_fee" value="{{config('constants.export_payment_description_type.duty_fee')}}">
                                        <label class="form-check-label"
                                            for="duty_fee">ဂျူတီကြေး</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input description_type" type="radio" name="description_type" id="others"
                                            value="{{config('constants.export_payment_description_type.others')}}">
                                        <label class="form-check-label"
                                            for="others">အခြား</label>
                                    </div>
                                </div>
                                <span id="description_type_error"></span>
                            </div>
                            <div class="col-12 mb-3 desc_cont">
                                <input type="text" class="form-control shadow-none" name="description" id="description"
                                    value="" />
                            </div>
                            <div class="col-12 mb-3">
                                <label for="amount_in_kyat" class="form-label">အမောင့် (ကျပ်) <span
                                        class="required-star">*</span></label>
                                <input type="text" class="form-control shadow-none" name="amount_in_kyat" id="amount_in_kyat"
                                    value="" />
                            </div>
                            <div class="col-12 mb-3">
                                <label for="payment_method" class="form-label">ငွေလွှဲအမျိုးအစား</label>
                                <input type="text" class="form-control shadow-none" name="payment_method"
                                    id="payment_method" value="" />
                            </div>
                            <div class="col-12 mb-3">
                                <label for="remark" class="form-label">မှတ်ချက်</label>
                                <input type="text" class="form-control shadow-none" name="remark" id="remark"
                                    value="" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" id="saveBtn" class="btn btn-primary save-btn">{{ __('template_names.save_btn_text')
                            }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
