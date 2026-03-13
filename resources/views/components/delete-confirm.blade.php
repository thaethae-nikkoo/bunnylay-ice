<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="delete_confirm" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <img src="{{ asset('assets/img/delete.svg') }}" alt="" class="d-block mx-auto"> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="d-block mx-auto text-center text-danger fw-bold"> သေချာပါသလား? </h4>
                        <p class="font18 text-center mb-3" id="delete-alert-text"></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <form method="POST" action="" id="kt_stepper_form" accept-charset="UTF-8">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="act" id="act">
                            <button class="btn button delete-btn btn-danger" type="submit"
                                data-kt-stepper-action="submit"><span
                                    class="indicator-label">{{__('template_names.sure_btn')}}</span><span
                                    class="indicator-progress">စောင့်ပါ...
                                    <span class="spinner-border spinner-border-sm"></span></span></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
