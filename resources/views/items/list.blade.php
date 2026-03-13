@extends('layout.main')
@section('html-title', 'Items')
@section('page-title', 'Items Lists')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
    {!! __('messages.delete_alert') !!}
</x-delete-confirm>
@include('items.input_modal')

<div class="container-xxl flex-grow-1">
    <div class="d-flex justify-content-between">
        <h4 class="fw-bold mb-4"><span class="fw-light">ကုန်ပစ္စည်းအမျိုးအစားများ /</span>
            {{ __('template_names.list_title_text') }} </h4>
        <!-- Bordered Table -->
        <h5 class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_or_edit_item"
                onclick="setupCreateModal()">
                {{ __('template_names.create_title_text') }}
            </button>
        </h5>
    </div>

    <div id="alert-container"></div>
    @if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
    @endif
    @if (session()->has('error'))
    <x-alert type="danger" :message="session('error')" />
    @endif
    <div class="card">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="ms-4">
                ကုန်ပစ္စည်း စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2" id="item-count">
                    {{ $items->count() }} ခု</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable table-bordered table-hover trans-table">
                    <thead>
                        <tr>
                            <th class="w60 nowrap">စဥ်</th>
                            <th class="w240 wrap-text">ကုန်ပစ္စည်းအမည်</th>
                            <th class="w160 nowrap">{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($items))
                        @foreach ($items as $key => $item)
                        <tr data-id="{{ $item->item_id }}">
                            <td>{{ $key + 1 }}</td>
                            <td class="wrap-text">
                                {{ $item->name }}
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary mx-3 btn-edit" data-id="{{ $item->item_id }}"
                                    data-name="{{ $item->name }}" data-bs-toggle="modal"
                                    data-bs-target="#create_or_edit_item">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <a class="btn btn-sm btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="{{ $item->item_id }}"
                                    data-resource-name="item_id" data-url="{{ route('itemDelete') }}"
                                    href="javascript:void(0);"><i class="bx bx-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->
</div>
@scope([
'create_url' => route('itemCreate'),
'update_url' => route('itemUpdate', ['item_id' => '__resourceId__']),
'delete_url' => route('itemDelete'),
])
@endsection
