<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="change_status_confirm" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="d-block mx-auto text-center text-danger fw-bold"> သေချာပါသလား? </h4>
                        <p class="font18 text-center my-3"> အခြေနေပြင်ဆင်ပါမည်။</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <form method="POST" action id="kt_stepper_form" accept-charset="UTF-8">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <button class="btn button btn-sm delete-btn btn-danger" type="submit"
                                data-kt-stepper-action="submit"><span class="indicator-label">သေချာပါသည်။</span><span
                                    class="indicator-progress">စောင့်ပါ...
                                    <span class="spinner-border spinner-border-sm"></span></span></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
