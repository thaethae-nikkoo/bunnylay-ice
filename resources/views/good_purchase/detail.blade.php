@extends('layout.main')
@section('html-title', 'Good Purchase')
@section('page-title', 'Good Purchase Details')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
    {!! __('messages.delete_alert') !!}
</x-delete-confirm>
@include('good_purchase.includes.payment_input')
<div class="container-xxl flex-grow-1 ">
    <h4 class="fw-bold"><span class="fw-light">ကုန်ဝယ်ယူမှုစာရင်း /</span>
        {{ __('template_names.detail_title_text') }} </h4>
    <!-- Good Purchase Detail -->
    <div class="card detail-card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ရက်စွဲ</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>
                                    {{ format_date($_resource->purchase_date) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ကုန်ပစ္စည်း</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ optional($_resource->item)->name ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>တောင်သူ</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ $_resource->farmer_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>အရေအတွက်</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ formatViss($_resource->viss) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ဈေးနှုန်း</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ number_format($_resource->price_per_viss, floor($_resource->price_per_viss) ==
                                    $_resource->price_per_viss ? 0 : 2) }}
                                    ကျပ်</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>သင့်ငွေ</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ number_format($_resource->total_price, floor($_resource->total_price) ==
                                    $_resource->total_price ? 0 : 2) }}
                                    ကျပ်</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>မှတ်ချက်</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ $_resource->remark ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>KG</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ $_resource->kg ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <a href="{{ route('goodPurchaseSearchList') }}">
                        <button class="btn btn-secondary">ကုန်ဝယ်ယူမှုစာရင်းများပြန်ကြည့်ရန်</button>
                    </a>
                    <a href="{{ route('goodPurchaseEdit', $_resource->good_purchase_id) }}">
                        <button class="btn btn-primary">ပြင်ဆင်ရန်</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--/ Good Purchase Detail -->
    <h5 class="my-3 px-1 d-flex justify-content-between align-items-center">
        <span>ငွေပေးချေမှုများ</span>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#payment_modal"
            onclick="setupCreateModal()">
            {{ __('template_names.create_title_text') }}
        </button>
    </h5>
    <div id="alert-container"></div>
    @if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
    @endif
    @if (session()->has('error'))
    <x-alert type="danger" :message="session('error')" />
    @endif
    <!-- Purchase Payment List -->

    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center my-2">
                <span>
                    စုစုပေါင်း (ကျပ်) <span class="ms-2">-</span> <span class="ms-2 dt-total-amount">
                        {{ number_format($goodPurchasePayments->sum('amount')) }} ကျပ်</span>
                </span>
                <span>
                    ငွေပေးချေမှု စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2" id="payment-count">
                        {{ $goodPurchasePayments->count() }} ခု</span>
                </span>
            </div>
            <div class="table-responsive">
                <table id="payment-table">
                    <tbody>
                        <tr id="payment-row-template" class="d-none" data-id="">
                            <td></td>
                            <td class="payment-date nowrap"></td>
                            <td class="payment-description wrap-text"></td>
                            <td class="payment-amount nowrap text-end"></td>
                            <td class="payment-method wrap-text"></td>
                            <td class="payment-remark wrap-text"></td>
                            <td class="nowrap">
                                <button class="btn btn-sm btn-primary mx-3 btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#payment_modal">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <a class="btn btn-sm btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" href="javascript:void(0);"><i
                                        class="bx bx-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table datatable table-bordered table-hover trans-table">
                    <thead>
                        <tr>
                            <th class="w60 nowrap">စဥ်</th>
                            <th class="w110 nowrap">ရက်စွဲ</th>
                            <th class="w220 wrap-text">အကြောင်းအရာ</th>
                            <th class="w160 nowrap">အမောင့် (ကျပ်)</th>
                            <th class="w220 wrap-text">ငွေလွှဲအမျိုးအစား</th>
                            <th class="w220 wrap-text">မှတ်ချက်</th>
                            <th class="w160 nowrap">{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($goodPurchasePayments as $key => $goodPurchasePayment)
                        <tr data-id="{{ $goodPurchasePayment->purchase_payment_id }}">
                            <td>{{ $key + 1 }}</td>
                            <td class="nowrap">
                                {{ $goodPurchasePayment->payment_date ? format_date($goodPurchasePayment->payment_date)
                                : '-' }}
                            </td>
                            <td class="wrap-text">{{ $goodPurchasePayment->description }}</td>
                            <td class="nowrap text-end">
                                {{ number_format($goodPurchasePayment->amount, floor($goodPurchasePayment->amount) ==
                                $goodPurchasePayment->amount ? 0 : 2) }}
                            </td>
                            <td class="wrap-text">{{ $goodPurchasePayment->payment_method }}</td>
                            <td class="wrap-text">{{ $goodPurchasePayment->remark ?? '-' }}</td>
                            <td class="nowrap">
                                <button class="btn btn-sm btn-primary mx-3 btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#payment_modal"
                                    data-id="{{ $goodPurchasePayment->purchase_payment_id }}"
                                    data-date="{{ $goodPurchasePayment->payment_date ? format_date($goodPurchasePayment->payment_date) : '-' }}"
                                    data-description="{{ e($goodPurchasePayment->description) }}"
                                    data-amount="{{ $goodPurchasePayment->amount }}"
                                    data-method="{{ e($goodPurchasePayment->payment_method) }}"
                                    data-remark="{{ e($goodPurchasePayment->remark ?? '') }}">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <a class="btn btn-sm btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm"
                                    data-id="{{ $goodPurchasePayment->purchase_payment_id }}"
                                    data-resource-name="purchase_payment_id"
                                    data-url="{{ route('goodPurchasePaymentDelete', $_resource->good_purchase_id) }}"
                                    href="javascript:void(0);"><i class="bx bx-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Purchase Payment List -->

</div>
@scope([
'good_purchase_id' => $_resource->good_purchase_id,
'create_url' => route('goodPurchasePaymentStore', ['good_purchase_id' => $_resource->good_purchase_id]),
'update_url' => route('goodPurchasePaymentUpdate', ['good_purchase_id' => $_resource->good_purchase_id,
'purchase_payment_id' => '__resourceId__']),
'delete_url' => route('goodPurchasePaymentDelete', ['good_purchase_id' => $_resource->good_purchase_id]),
])
@endsection
