@extends('auth.layout.app')
@section('html-title', 'Password Update Page')
@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center">
                        <a href="#" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-px-50 h-auto">
                            </span>
                            <span class="app-brand-text demo text-body fw-bolder">Bunny Lay Co., Ltd</span>
                        </a>
                    </div>

                    @php
                    $userCredential = session('userCredential');
                    $encodedCredential = base64_encode(json_encode($userCredential));
                    @endphp



                    @if (is_array($userCredential) && isset($userCredential['username']))
                    <script>
                        document.cookie = "userCredential={{ $encodedCredential }}; path=/;";
                    </script>
                    @endif

                    <!-- /Logo -->
                    <form id="kt_stepper_form" class="mb-3" action="{{ route('passwordUpdate') }}" method="POST">
                        @csrf
                        <div class="mb-3 parent">
                            <label for="newPassword" class="form-label">စကားဝှက် အသစ် ရိုက်ထည့်ပါ</label>
                            <div class="input-group">
                                <input class="form-control" type="password" name="newPassword" id="newPassword"
                                    value="{{ old('newPassword') }}" />
                                <span class="input-group-text" id="toggleNewPassword" style="cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3 parent">
                            <label for="phone" class="form-label">စကားဝှက် အတည်ပြုရန် နောက်တစ်ကြိမ်
                                ရိုက်ထည့်ပါ</label>
                            <div class="input-group">
                                <input class="form-control" type="password" id="confirmPassword" name="confirmPassword"
                                    value="{{ old('confirmPassword') }}" />
                                <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <input type="hidden" name="username" id="userIdFromCookie">
                        <button class="btn btn-sm btn-primary d-grid w-100" type="submit" data-kt-stepper-action="submit">
                            <span class="indicator-label">သိမ်းမည်</span>
                            <span class="indicator-progress" style="display: none;">စောင့်ပါ...
                                <span class="spinner-border spinner-border-sm"></span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
</div>
@include('includes.input_form')
<script>
    window.appData = {
            forgetPassPageUrl: "{{ route('forgetPasswordPage') }}"
        };
</script>
@endsection
