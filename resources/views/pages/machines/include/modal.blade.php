<div class="modal fade" id="machine_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="machine_form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="form_method" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">ရေခဲစက် ထည့်သွင်းရန်</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="machine_name" class="form-label">စက်ပစ္စည်းနာမည် <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="machine_name" id="machine_name" required>
                            <div class="invalid-feedback" id="machine_name_error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" class="form-control" name="code" id="code">
                            <div class="invalid-feedback" id="code_error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="product_type" class="form-label">ထုတ်လုပ်သည့်ရေခဲအမျိုးအစား <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="product_type" id="product_type" required>
                                <option value="">Select Product Type</option>
                                @foreach(config('constants.machine_product_type_label') as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="product_type_error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="capacity_mode" class="form-label">Capacity Mode <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="capacity_mode" id="capacity_mode" required>
                                <option value="">Select Capacity Mode</option>
                                @foreach(config('constants.machine_capacity_mode_label') as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="capacity_mode_error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="capacity_value" class="form-label">Capacity Value <span
                                    class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="capacity_value"
                                id="capacity_value" required>
                            <div class="invalid-feedback" id="capacity_value_error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="location">
                            <div class="invalid-feedback" id="location_error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" name="remark" id="remark" rows="2"></textarea>
                            <div class="invalid-feedback" id="remark_error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo" accept="image/*">
                            <div class="invalid-feedback" id="photo_error"></div>
                            <div id="photo_preview" class="mt-2 position-relative" style="display: none; width: 100px;">
                                <img src="" alt="Preview" style="max-width: 100px; max-height: 100px;"
                                    class="rounded border">
                                <button type="button" id="remove_photo_btn"
                                    class="btn btn-sm btn-danger position-absolute"
                                    style="top: -10px; right: -10px; padding: 2px 5px; border-radius: 50%;">
                                    <i class="bx bx-x"></i>
                                </button>
                                <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>