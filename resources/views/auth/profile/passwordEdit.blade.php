@extends('layout.main')
@section('html-title', 'Profile Page')
@section('page-title', 'Profile Page')
@section('main-content-template')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">ပရိုဖိုင် /</span> ကျွန်ုပ်၏ ပရိုဖိုင်</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('profile')}}"><i class="bx bx-user me-1"></i> ကျွန်ုပ်၏
                            ပရိုဖိုင်</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('passwordManagement')}}"><i
                                class="fas fa-key me-1"></i> စကားဝှက် ပြင်ဆင်ပြောင်းလဲခြင်း</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">စကားဝှက် ပြင်ဆင်ပြောင်းလဲခြင်း</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="kt_stepper_form" action="{{route('passwordUpdate')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-4 parent">
                                    <label for="oldPassword" class="form-label">စကားဝှက် အဟောင်း ရိုက်ထည့်ပါ</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="oldPassword" name="oldPassword"
                                            autofocus value="{{old('oldPassword')}}" />
                                        <span class="input-group-text" id="toggleOldPassword" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4 parent">
                                    <label for="newPassword" class="form-label">စကားဝှက် အသစ် ရိုက်ထည့်ပါ</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="newPassword" id="newPassword"
                                            value="{{old('newPassword')}}" />
                                        <span class="input-group-text" id="toggleNewPassword" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4 parent">
                                    <label for="phone" class="form-label">စကားဝှက်ကို အတည်ပြုပါ</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="confirmPassword"
                                            name="confirmPassword" value="{{old('confirmPassword')}}" />
                                        <span class="input-group-text" id="toggleConfirmPassword"
                                            style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
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

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
<!-- / Layout wrapper -->
@include('includes.input_form')
@endsection