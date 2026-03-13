@extends('layout.main')
@section('html-title', 'Expense')
@section('page-title','Expense Create')
@section('main-content-template')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4"><span class="fw-light">ထွက်ငွေ-အသုံးငွေ /</span>
        {{__('template_names.create_title_text')}} </h4>
    <div class="card">
        <form action="{{route('expenseStore')}}" method="POST" id="kt_stepper_form">
            @csrf
            <div class="card-body">
                @include('expense.includes.input')
                <div class="card-action mt-3">
                    <button class="btn btn-primary" data-kt-stepper-action="submit" type="submit">
                        <span class="indicator-label">သိမ်းမည် <i class="fas fa-plus"></i></span>
                        <span class="indicator-progress" style="display: none;">စောင့်ပါ...
                            <span class="spinner-border spinner-border-sm"></span>
                        </span>
                    </button>
                    <a href="{{route('expenseList')}}" class="btn btn-secondary">ပြန်ထွက်
                        <i class="fas fa-reply"></i></a>
                </div>
            </div>
        </form>
    </div>

</div>
@include('includes.input_form')
@endsection
