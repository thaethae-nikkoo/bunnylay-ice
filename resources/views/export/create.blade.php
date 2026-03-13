@extends('layout.main')
@section('html-title', 'Export')
@section('page-title','Export Create')
@section('main-content-template')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4"><span class="fw-light">ပြည်ပတင်ပို့ခြင်း /</span>
        {{__('template_names.create_title_text')}} </h4>
    <div class="card">
        <form action="" method="POST" id="kt_stepper_form">
            @csrf
            <div class="card-body">
                @include('export.includes.input')
                <div class="card-action mt-3">
                    <button class="btn btn-primary" type="button" id="submit-form">
                        <span class="indicator-label">သိမ်းမည် <i class="fas fa-plus"></i></span>
                        <span class="indicator-progress" style="display: none;">စောင့်ပါ...
                            <span class="spinner-border spinner-border-sm"></span>
                        </span>
                    </button>
                    <a href="{{route('exportList')}}" class="btn btn-secondary">ပြန်ထွက်
                        <i class="fas fa-reply"></i></a>
                </div>
            </div>
        </form>
    </div>

</div>
@scope([
'list_url' => route('exportList'),
'create_url' => route('exportStore'),
]);
@endsection
