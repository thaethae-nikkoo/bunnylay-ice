@extends('layout.main')
@section('html-title', 'Settings')
@section('page-title', 'Settings Lists')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
</x-delete-confirm>

<div class="container-xxl flex-grow-1">
    <div class="d-flex justify-content-between">
        <h6 class="fw-bold mb-4"><span class="fw-light">Settings /</span>
            {{ __('template_names.list_title_text') }} </h6>

        <!-- Bordered Table -->
        <h5 class="d-flex justify-content-end">
            <a href="javascript:void(0);" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#payment_method_modal">
                {{ __('template_names.edit_title_text') }}
            </a>
        </h5>
    </div>
    @if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
    @endif
    @if (session()->has('error'))
    <x-alert type="danger" :message="session('error')" />
    @endif
    <div class="card">
        <div class="card-body table-card">
            <!-- -->
        </div>
    </div>
    <!--/ Bordered Table -->

</div>
@endsection
