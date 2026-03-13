<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="create_or_edit_item" data-editmode="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="form-label">ကုန်ပစ္စည်းအမည် <span
                                        class="required-star">*</span></label>
                                <input type="text" id="name" class="form-control" />
                                <div id="name-error" class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button id="saveBtn" type="button" class="btn btn-primary">
                            {{ __('template_names.save_btn_text') }}
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
