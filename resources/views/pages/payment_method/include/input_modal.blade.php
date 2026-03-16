<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="payment_method_modal" data-editmode="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Method Name <span
                                        class="required-star">*</span></label>
                                <input type="text" class="form-control" name="method_name" id="method_name"
                                    value="{{old('method_name')}}" />
                                <div id="method_name-error" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="account_type" class="form-label ">Account
                                    Type </label>
                                <div class="account_type-error-element account_type-select custom-select">
                                    <select class="form-select form-control select single-select" name="account_type"
                                        id="account_type">
                                        <option value="" selected>--ရွေးချယ်ပါ--</option>
                                        @foreach (config('payments') as $payment)
                                        <option value="{{$payment['account_type']}}"
                                            {{old('account_type')==$payment['account_type'] ? 'selected' : '' }}>
                                            {{$payment['account_type']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="account_type-error" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="account_name" class="form-label">Account Name </label>
                                <input type="text" class="form-control" name="account_name" id="account_name"
                                    value="{{old('account_name')}}" />
                                <div id="account_name-error" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="account_no" class="form-label">Account No </label>
                                <input type="text" class="form-control" name="account_no" id="account_no"
                                    value="{{old('account_no')}}" />
                                <div id="account_no-error" class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button id="saveBtn" type="button" class="btn btn-sm save-btn btn-primary">
                            {{ __('template_names.save_btn_text') }}
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
