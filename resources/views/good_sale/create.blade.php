@extends('layout.main')
@section('html-title', 'Good Sale')
@section('page-title','Good Sale Create')
@section('main-content-template')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4"><span class="fw-light">ကုန်အရောင်း /</span>
        {{__('template_names.create_title_text')}} </h4>
    @if (session()->has('error'))
    <x-alert type="danger" :message="session('error')" />
    @endif
    <div class="card">
        <form action="{{route('goodSaleStore')}}" method="POST" id="kt_stepper_form">
            @csrf
            <div class="card-body">
                @include('good_sale.includes.input')
                <div class="card-action mt-3">
                    <button class="btn btn-primary" type="submit" id="submit-form">
                        <span class="indicator-label">သိမ်းမည် <i class="fas fa-plus"></i></span>
                        <span class="indicator-progress" style="display: none;">စောင့်ပါ...
                            <span class="spinner-border spinner-border-sm"></span>
                        </span>
                    </button>
                    <a href="{{route('goodSaleList')}}" class="btn btn-secondary">ပြန်ထွက်
                        <i class="fas fa-reply"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>
@include('includes.input_form', [
'selectElements' => 'item_id'
])
@endsection
