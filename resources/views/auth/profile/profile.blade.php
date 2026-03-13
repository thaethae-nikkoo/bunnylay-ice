@extends('layout.main')
@section('html-title', 'Profile Page')
@section('page-title', 'Profile Page')
@section('main-content-template')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">ပရိုဖိုင် /</span> ကျွန်ုပ်၏ ပရိုဖိုင်</h4>
        @if (session()->has('success'))
        <x-alert type="success" :message="session('success')" />
        @endif
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('profile') }}"><i class="bx bx-user me-1"></i>
                            ကျွန်ုပ်၏
                            ပရိုဖိုင်</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('passwordManagement') }}"><i class="fas fa-key me-1"></i>
                            စကားဝှက် ပြင်ဆင်ပြောင်းလဲခြင်း</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">ပရိုဖိုင် အသေးစိတ်</h5>
                    <!-- Account -->
                    <div class="card-body d-flex">
                        <div class="d-flex align-items-start align-items-sm-center gap-4 w-25">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block rounded"
                                height="100" width="100" id="uploadedAvatar" />
                        </div>
                        <div class="">
                            <label class="text-primary">အမည်</label>
                            <h6>{{ Auth::user()->name }}</h6>
                            <label class="text-primary">အသုံးပြုသူ၏ ID</label>
                            <h6>{{ Auth::user()->username }}</h6>
                            <label class="text-primary">ဖုန်းနံပါတ်</label>
                            <h6>{{ Auth::user()->phone ?? '-' }}</h6>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="kt_stepper_form" action="{{ route('updateProfile') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-4 parent">
                                    <label for="name" class="form-label">အမည်</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ old('name', Auth::user()->name) }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-4 parent">
                                    <label for="username" class="form-label">အသုံးပြုသူ၏ ID</label>
                                    <input class="form-control" type="text" name="username" id="username"
                                        value="{{ old('username', Auth::user()->username) }}" />
                                </div>
                                <div class="mb-3 col-md-4 parent">
                                    <label for="phone" class="form-label">ဖုန်းနံပါတ်</label>
                                    <input class="form-control" type="text" id="phone" name="phone"
                                        value="{{ old('phone', Auth::user()->phone) }}" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-primary" data-kt-stepper-action="submit" type="submit">
                                    <span class="indicator-label">သိမ်းမည်</span>
                                    <span class="indicator-progress" style="display: none;">စောင့်ပါ...
                                        <span class="spinner-border spinner-border-sm"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
<!-- / Layout wrapper -->
@include('includes.input_form')
@endsection
