<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="payment_modal" data-editmode="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalCenterTitle"></h5>
                        <!--ပြင်ဆင်ရန်-->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="payment_date" class="form-label">ရက်စွဲ <span
                                        class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control shadow-none" name="payment_date"
                                    id="payment_date" value="{{ old('payment_date') }}" placeholder="DD/MM/YYYY" />
                            </div>
                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">အကြောင်းအရာ  </label>
                                <input type="text" class="form-control shadow-none" name="description"
                                    id="description" value="{{ old('description') }}" />
                            </div>
                            <input type="hidden" name="good_sale_id" id="good_sale_id">
                            <input type="hidden" name="subject" id="subject">
                            <div class="col-12 mb-3">
                                <label for="amount-in-kyat" class="form-label">အမောင့် (ကျပ်) </label>
                                <input type="text" class="form-control shadow-none" name="amount_in_kyat" id="amount-in-kyat"
                                    value="{{ old('amount_in_kyat') }}" />
                            </div>
                            <div class="col-12 mb-3">
                                <label for="amount-in-baht" class="form-label">အမောင့် (ဘတ်) </label>
                                <input type="text" class="form-control shadow-none" name="amount_in_baht" id="amount-in-baht"
                                    value="{{ old('amount_in_baht') }}" />
                            </div>
                            <div class="col-12 mb-3">
                                <label for="payment_method" class="form-label">ငွေလွှဲအမျိုးအစား <span
                                        class="required-star">*</span></label>
                                <input type="text" class="form-control shadow-none" name="payment_method"
                                    id="payment_method" value="{{ old('payment_method') }}" />
                            </div>
                            <div class="col-12 mb-3">
                                <label for="remark" class="form-label">မှတ်ချက်</label>
                                <input type="text" class="form-control shadow-none" name="remark" id="remark"
                                    value="{{ old('remark') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" id="saveBtn"
                            class="btn btn-primary">{{ __('template_names.save_btn_text') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
