@extends('layout.main')
@section('html-title', 'Income')
@section('page-title','Income Edit')
@section('main-content-template')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4"><span class="fw-light">ဝင်ငွေလွှဲငွေရ /</span>
        {{__('template_names.edit_title_text')}} </h4>
    <div class="card">
        <form action="{{route('incomeUpdate', $_resource->income_id)}}" method="POST" id="kt_stepper_form">
            @csrf
            @method('PATCH')
            <div class="card-body">
                @include('income.includes.input')
                <div class="card-action mt-3">
                    <button class="btn btn-primary" data-kt-stepper-action="submit" type="submit">
                        <span class="indicator-label">သိမ်းမည် <i class="fas fa-plus"></i></span>
                        <span class="indicator-progress" style="display: none;">စောင့်ပါ...
                            <span class="spinner-border spinner-border-sm"></span>
                        </span>
                    </button>
                    <a href="{{route('incomeList')}}" class="btn btn-secondary">ပြန်ထွက်
                        <i class="fas fa-reply"></i></a>
                </div>
            </div>
        </form>
    </div>

</div>
@include('includes.input_form')
@endsection
