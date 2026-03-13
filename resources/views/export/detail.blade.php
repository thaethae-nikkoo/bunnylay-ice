@extends('layout.main')
@section('html-title', 'Export')
@section('page-title','Export Details')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
    {!! __('messages.delete_alert') !!}
</x-delete-confirm>
@include('export.includes.payment_input')
<div class="container-xxl flex-grow-1">
    <h4 class="fw-bold mb-4"><span class="fw-light">ပြည်ပတင်ပို့ခြင်း /</span>
        {{__('template_names.detail_title_text')}} </h4>
    <!-- Export Detail -->
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
                                <span>{{ format_date($_resource->export_date) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ကားခ</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{clean_number($_resource->truck_fee)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ကားနံပါတ်</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{ $_resource->truck_no }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ကားခ စရံငွေ</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{clean_number($_resource->truck_fee_down_payment)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ကားစထွက်ချိန်</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{format_date_time($_resource->departure_time)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ကားခ ကျန်ငွေ</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>
                                     {{ clean_number(($_resource->truck_fee ?? 0) - ($truck_fee_sum_in_kyat ?? 0)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ကားဥန္နာ</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{$_resource->truck_owner_name}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ဂျူတီကြေး</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{clean_number($_resource->duty_fee)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ယာဥ်မောင်း</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{$_resource->driver_name}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ဂျူတီကြေး စရံငွေ</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{clean_number($_resource->duty_fee_down_payment)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ဖုန်းနံပါတ်</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{$_resource->driver_phone}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ဂျူတီကြေး ကျန်ငွေ</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>
                                     {{ clean_number(($_resource->duty_fee ?? 0) - ($duty_fee_sum_in_kyat ?? 0)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>မှတ်ပုံတင်</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>{{$_resource->driver_nrc}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12">
                            <div class="title">
                                <span>ရှင်း/ကျန်</span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="text">
                                <span>ကားခ - <i
                                        class='bx text-{{$_resource->truck_fee_payment_status_color}} bx-{{$_resource->truck_fee_payment_status_icon}}'></i>
                                    ဂျူတီကြေး - <i
                                        class='bx text-{{$_resource->duty_payment_status_color}} bx-{{$_resource->duty_payment_status_icon}}'></i></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-2 col-sm-12">
                            <div class="title">
                                <span>မှတ်ချက်</span>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12">
                            <div class="text">
                                <span>{{$_resource->remark}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <a href="{{route('exportList')}}" class="btn btn-secondary">ပြည်ပပို့စာရင်းပြန်ကြည့်ရန်</a>
                    <a href="{{route('exportEdit', $_resource->export_id)}}"
                        class="btn btn-primary">{{__('template_names.edit_title_text')}}</a>
                </div>
            </div>
        </div>
    </div>
    <!--/ Good Purchase Detail -->
    <h5 class="px-2 mt-3 d-flex justify-content-between">
        <span>ကုန်ပစ္စည်းများ</span>
    </h5>
    <div class="card my-3 detail-card">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover trans-table">
                    <thead>
                        <tr>
                            <th class="w60">စဥ်</th>
                            <th class="w430">ကုန်ပစ္စည်းအမည်</th>
                            <th class="w140">ခြင်း</th>
                            <th class="w140">KG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($_resource->exportItems as $index => $exportItem)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$exportItem->item->name}}</td>
                            <td>{{$exportItem->basket_count}}</td>
                            <td>{{$exportItem->kg}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Purchase Payment List -->
    <h5 class="px-2 d-flex justify-content-between">
        <span>ငွေပေးချေမှုများ(ကုန်ကျငွေများ)</span>
        <button class="btn btn-primary create-btn" id="create-btn" data-bs-toggle="modal"
            data-bs-target="#payment_modal">
            {{__('template_names.create_title_text')}}
        </button>
    </h5>
    @if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
    @endif
    @if (session()->has('error'))
    <x-alert type="danger" :message="session('error')" />
    @endif
    <div id="alert-container"></div>
    <div class="card my-3">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="ms-4">
                စာရင်း စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ $_resource->payments->count() }} ခု</span>
            </div>
            <div class="mx-4">
                ကုန်ကျငွေ စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ $_resource->payments->sum('amount_in_kyat') }} ကျပ်</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable payment-table table-bordered table-hover trans-table">
                    <thead>
                        <tr>
                            <th class="w60 nowrap">စဥ်</th>
                            <th class="w140 nowrap">ရက်စွဲ</th>
                            <th class="w270 nowrap">အကြောင်းအရာ</th>
                            <th class="w160 nowrap">အမောင့် (ကျပ်)</th>
                            <th class="w220 nowrap">ငွေလွှဲအမျိုးအစား</th>
                            <th class="w300 nowrap">မှတ်ချက်</th>
                            <th class="w220 nowrap">{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="cloneTarget" data-id="" hidden>
                            <td class="w90"></td>
                            <td class="w60 payment_date"></td> <!-- d/m/Y -->
                            <td class="w170 description"></td>
                            <td class="w160 amount_in_kyat text-end"></td>
                            <td class="w220 payment_method"></td>
                            <td class="w430 remark"></td>
                            <td class="w220">
                                <button data-bs-toggle="modal" data-bs-target="#payment_modal"
                                    class="btn btn-sm btn-primary edit-btn mx-3"><i class="bx bx-edit-alt"></i>
                                </button>
                                <a class="btn btn-sm btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" href="javascript:void(0);"><i
                                        class="bx bx-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @foreach ($_resource->payments as $index => $payment)
                        <tr data-id="{{$payment->export_payment_id}}">
                            <td class="w90">{{$index+1}}</td>
                            <td class="w120 payment_date">{{format_date($payment->payment_date)}}</td> <!-- d/m/Y -->
                            <td class="w320 description">{{$payment->custom_description}}</td>
                            <td class="w160 amount_in_kyat text-end">{{clean_number($payment->amount_in_kyat)}}</td>
                            <td class="w220 payment_method">{{$payment->payment_method}}</td>
                            <td class="w400 remark">{{$payment->remark}}</td>
                            <td class="w220">
                                <button data-bs-toggle="modal" data-bs-target="#payment_modal"
                                    data-payment_date="{{format_date($payment->payment_date)}}"
                                    data-description_type="{{$payment->description_type}}"
                                    data-description="{{$payment->description}}" data-url="{{route('editExportPayment',
                                    ['export_id'=> $_resource->export_id, 'export_payment_id' =>
                                    $payment->export_payment_id])}}" data-payment_method="{{$payment->payment_method}}"
                                    data-amount_in_kyat="{{$payment->amount_in_kyat}}"
                                    data-remark="{{$payment->remark}}" class="btn btn-sm btn-primary edit-btn mx-3"><i
                                        class="bx bx-edit-alt"></i>
                                </button>
                                <a class="btn btn-sm btn-danger show-delete-modal"
                                    data-id="{{$payment->export_payment_id}}" data-resource-name="export_payment_id"
                                    data-url="{{route('deleteExportPayment',
                                ['export_id'=> $_resource->export_id, 'export_payment_id' =>
                                $payment->export_payment_id])}}" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" href="javascript:void(0);"><i
                                        class="bx bx-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Purchase Payment List -->
    @scope([
    'create_payment_url' => route('createPayment',$_resource->export_id),
    'edit_payment_url' => route('editExportPayment',[
    'export_id'=> $_resource->export_id,
    'export_payment_id' =>'__export_payment_id__']),
    'delete_payment_url' => route('deleteExportPayment',
    ['export_id'=> $_resource->export_id,'export_payment_id' =>
    '__export_payment_id__']),
    ])
</div>
@endsection
