@extends('auth.layout.app')
@section('html-title', 'Login Page')
@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
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
                    @if (session()->has('error'))
                    <x-alert type="danger" :message="session('error')" />
                    @endif
                    <form id="kt_stepper_form" class="mb-3" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3 parent">
                            <label for="username" class="form-label">အသုံးပြုသူ ID</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="အသုံးပြုသူ ID ကို ရိုက်ထည့်ပေးပါ..." autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle parent">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">စကားဝှက်</label>
                                <a href="{{ route('forgetPasswordPage') }}">
                                    <small>စကားဝှက် မေ့သွားပြီလား?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control w-75" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            <div class="password-error-element mt-1"></div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" data-kt-stepper-action="submit" type="submit">
                                <span class="indicator-label">အကောင့်ဝင်ရန်</span>
                                <span class="indicator-progress" style="display: none;">စောင့်ပါ...
                                    <span class="spinner-border spinner-border-sm"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.input_form', [
'selectElements' => ['role'],
]);
@endsection
