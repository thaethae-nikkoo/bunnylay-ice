@extends('auth.layout.app')
@section('html-title', 'Forget Password Page')
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
                    @if (session()->has('error'))
                    <x-alert type="danger" :message="session('error')" />
                    @endif
                    <form id="kt_stepper_form" class="mb-3" action="{{ route('forgetPasswordFunction') }}" method="GET">
                        @csrf
                        <div class="mb-3 parent">
                            <label for="username" class="form-label">အသုံးပြုသူ ID</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="အသုံးပြုသူ ID ကို ရိုက်ထည့်ပေးပါ" autofocus />
                        </div>
                        <button class="btn btn-sm btn-primary d-grid w-100" data-kt-stepper-action="submit" type="submit">
                            <span class="indicator-label">သိမ်းမည်</span>
                            <span class="indicator-progress" style="display: none;">စောင့်ပါ...
                                <span class="spinner-border spinner-border-sm"></span>
                            </span>
                        </button>
                    </form>
                    <div class="text-center">
                        <a href="{{route('loginForm')}}" class="d-flex align-items-center justify-content-center">
                            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                            နောက်ပြန်သွားမည်
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
</div>
@include('includes.input_form')
@endsection
