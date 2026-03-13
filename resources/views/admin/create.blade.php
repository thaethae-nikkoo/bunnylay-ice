@extends('layout.main')
@section('html-title', 'Admin')
@section('page-title', 'Admin Create')
@section('main-content-template')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="fw-light">အသုံးပြုသူများ /</span>
            {{ __('template_names.create_title_text') }} </h4>
        <div class="card">
            <form id="kt_stepper_form" action="{{ route('adminStore') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('admin.includes.input')
                    <div class="card-action mt-3">
                        <button class="btn btn-primary" data-kt-stepper-action="submit" type="submit">
                            <span class="indicator-label">သိမ်းမည်</span>
                            <span class="indicator-progress" style="display: none;">စောင့်ပါ...
                                <span class="spinner-border spinner-border-sm"></span>
                            </span>
                        </button>
                        <a href="{{ route('adminLists') }}" class="btn btn-secondary">ပြန်ထွက်
                            <i class="fas fa-reply"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('includes.input_form')
@endsection
