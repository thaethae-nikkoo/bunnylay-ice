@extends('layout.main')
@section('html-title', 'Good Sale')
@section('page-title', 'Good Sale Details')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
    {!! __('messages.delete_alert') !!}
</x-delete-confirm>
@include('good_sale.includes.payment_input')
<div class="container-xxl flex-grow-1">
    <h4 class="fw-bold mb-4"><span class="fw-light">ကုန်အရောင်းစာရင်း /</span>
        {{ __('template_names.detail_title_text') }} </h4>
    <!-- Good Sale Detail -->
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
                                    {{ $_resource->sale_date ? format_date($_resource->sale_date) : '-' }}</span>
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
                                <span>KG</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ $_resource->kg }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ထိုင်းကားနံပါတ်</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ $_resource->thai_truck_no }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ဈေးနှုန်း (ဘတ်)</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ clean_number($_resource->price_per_kg_baht) }} ဘတ်</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ဈေးနှုန်း (ကျပ်)</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ clean_number($_resource->price_per_kg_kyat) }} ကျပ်</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>သင့်ငွေ (ဘတ်)</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ clean_number($_resource->total_price_baht) }} ဘတ်</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>သင့်ငွေ (ကျပ်)</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ clean_number($_resource->total_price_kyat) }} ကျပ်</span>
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
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <a href="{{ route('goodSaleList') }}">
                        <button class="btn btn-secondary">ကုန်အရောင်းစာရင်းများပြန်ကြည့်ရန်</button>
                    </a>
                    <a href="{{ route('goodSaleEdit', $_resource->good_sale_id) }}">
                        <button class="btn btn-primary">ပြင်ဆင်ရန်</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--/ Good Sale Detail -->

    <!-- Sale Payment List -->
    <h5 class="d-flex justify-content-between align-items-center my-3 px-2">
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
    <div class="card mb-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center my-4">
                <div>
                    စုစုပေါင်း (ကျပ်/ဘတ်)
                    <span class="ms-2">-</span>
                    <span class="ms-2 dt-total-amount-kyat">
                        {{ number_format($goodSalePayments->sum('amount_in_kyat')) }} ကျပ်
                    </span> /
                    <span class="ms-2 dt-total-amount-baht">
                        {{ number_format($goodSalePayments->sum('amount_in_baht')) }} ဘတ်
                    </span>
                </div>
                <div class="ms-4">
                    ကုန်ပစ္စည်းရောင်းချခြင်း ငွေပေးချေမှု စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2"
                        id="payment-count">
                        {{ $goodSalePayments->count() }} ခု</span>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table id="payment-table">
                    <tbody>
                        <tr id="payment-row-template" class="d-none" data-id="">
                            <td></td>
                            <td class="payment-date nowrap"></td>
                            <td class="payment-description wrap-text"></td>
                            <td class="payment-amount-in-kyat nowrap text-end"></td>
                            <td class="payment-amount-in-baht nowrap text-end"></td>
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
                            <th class="w160 nowrap">အမောင့် (ဘတ်)</th>
                            <th class="w220 wrap-text">ငွေလွှဲအမျိုးအစား</th>
                            <th class="w220 wrap-text">မှတ်ချက်</th>
                            <th class="w160 nowrap">{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($goodSalePayments as $key => $goodSalePayment)
                        <tr data-id="{{ $goodSalePayment->sale_payment_id }}">
                            <td>{{ $key + 1 }}</td>
                            <td class="nowrap">
                                {{ $goodSalePayment->payment_date
                                ? \Carbon\Carbon::createFromFormat('Y-m-d',
                                $goodSalePayment->payment_date)->format('d/m/Y')
                                : '-' }}
                            </td>
                            <td class="wrap-text">{{ $goodSalePayment->description ?? '-' }}</td>
                            <td class="nowrap text-end">
                                {{ $goodSalePayment->amount_in_kyat
                                ? number_format(
                                $goodSalePayment->amount_in_kyat,
                                floor($goodSalePayment->amount_in_kyat) == $goodSalePayment->amount_in_kyat ? 0 : 2,
                                )
                                : '-' }}
                            </td>
                            <td class="nowrap text-end">
                                {{ $goodSalePayment->amount_in_baht
                                ? number_format(
                                $goodSalePayment->amount_in_baht,
                                floor($goodSalePayment->amount_in_baht) == $goodSalePayment->amount_in_baht ? 0 : 2,
                                )
                                : '-' }}
                            </td>
                            <td class="wrap-text">{{ $goodSalePayment->payment_method }}</td>
                            <td class="wrap-text">{{ $goodSalePayment->remark ?? '-' }}</td>
                            <td class="nowrap">
                                <button class="btn btn-sm btn-primary mx-3 btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#payment_modal" data-id="{{ $goodSalePayment->sale_payment_id }}"
                                    data-date="{{ $goodSalePayment->payment_date ? \Carbon\Carbon::parse($goodSalePayment->payment_date)->format('d/m/Y') : '-' }}"
                                    data-description="{{ e($goodSalePayment->description) }}"
                                    data-amount-in-kyat="{{ $goodSalePayment->amount_in_kyat }}"
                                    data-amount-in-baht="{{ $goodSalePayment->amount_in_baht }}"
                                    data-method="{{ e($goodSalePayment->payment_method) }}"
                                    data-remark="{{ e($goodSalePayment->remark ?? '') }}">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <a class="btn btn-sm btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="{{ $goodSalePayment->sale_payment_id }}"
                                    data-resource-name="sale_payment_id"
                                    data-url="{{ route('goodSalePaymentDelete', $_resource->good_sale_id) }}"
                                    href="javascript:void(0);"><i class="bx bx-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Sale Payment List -->

</div>
@scope([
'good_sale_id' => $_resource->good_sale_id,
'create_url' => route('goodSalePaymentStore', ['good_sale_id' => $_resource->good_sale_id]),
'update_url' => route('goodSalePaymentUpdate', ['good_sale_id' => $_resource->good_sale_id, 'sale_payment_id' =>
'__resourceId__']),
'delete_url' => route('goodSalePaymentDelete', ['good_sale_id' => $_resource->good_sale_id]),
])
@endsection
