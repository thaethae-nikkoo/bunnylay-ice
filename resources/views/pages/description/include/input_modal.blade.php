<!-- Modal -->
<div class="modal fade" id="description_modal" data-editmode="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">အကြောင်းအရာ ထည့်သွင်းရန်</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="kt_stepper_form" method="POST">
                @csrf
                <div class="modal-body p30">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="hidden" name="description_gp_id" id="description_gp_id" value="{{$_resource->description_gp_id}}">
                            <label for="name" class="form-label">အကြောင်းအရာ အမည် <span
                                    class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control shadow-none" name="name" id="name"
                                value="{{ old('name') }}" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-sm btn-primary save-btn" type="submit" data-kt-stepper-action="submit">
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
