<!-- Modal -->
<div class="modal fade" id="description_gp_modal" data-editmode="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">အကြောင်းအရာအုပ်စု ထည့်သွင်းရန်</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="kt_stepper_form" method="POST">
                @csrf
                <div class="modal-body p30">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="gp_name" class="form-label">အကြောင်းအရာအုပ်စု အမည် <span
                                    class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control shadow-none" name="gp_name" id="gp_name"
                                value="{{ old('gp_name') }}" />
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="description_type-radio-group" id="description_type">
                                    <div class="radio-check">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input description_type" type="radio"
                                                value="{{config('constants.description_type_key.income')}}"
                                                name="description_type" id="description_type_income" {{
                                                old('description_type')==config('constants.description_type_key.income')
                                                ? 'checked' : '' }}>
                                            <label class="form-check-label" for="description_type_income">
                                                Income
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input description_type" type="radio"
                                                value="{{config('constants.description_type_key.expense')}}"
                                                name="description_type" id="description_type_expense" {{
                                                old('description_type')==config('constants.description_type_key.expense')
                                                ? 'checked' : '' }}>
                                            <label class="form-check-label" for="description_type_expense">
                                                Expense
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input description_type" type="radio"
                                                value="{{config('constants.description_type_key.both')}}"
                                                name="description_type" id="description_type_both" {{
                                                old('description_type')==config('constants.description_type_key.both')
                                                ? 'checked' : '' }}>
                                            <label class="form-check-label" for="description_type_both">
                                                Income/Expense
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-sm btn-primary save-btn" type="button" data-kt-stepper-action="submit">
                        <span class="indicator-label">သိမ်းမည် </span>
                        <span class="indicator-progress" style="display: none;">စောင့်ပါ...
                            <span class="spinner-border spinner-border-sm"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
