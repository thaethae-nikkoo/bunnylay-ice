@extends('layout.main')
@section('html-title', 'Export')
@section('page-title','Export List')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
    {!! __('messages.delete_alert') !!}
</x-delete-confirm>
<div class="container-xxl flex-grow-1">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold"><span class="fw-light">ပြည်ပတင်ပို့ခြင်း /</span>
            {{__('template_names.list_title_text')}} </h4>

        <h5 class=" d-flex justify-content-end">
            <a href="{{route('exportCreate')}}" class="btn btn-primary">
                {{__('template_names.create_title_text')}}
            </a>
            <a href="#" class="btn btn-primary ms-2 search-toggle">
                {{ __('template_names.search') }}
            </a>
        </h5>
    </div>
    @if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
    @endif
    @if (session()->has('error'))
    <x-alert type="danger" :message="session('error')" />
    @endif
    <div class="card sec-filter mb-2" @if (request()->hasAny([
        'export_date',
        'item_id',
        'truck_no',
        'driver_name',
        'driver_phone',
        'driver_nrc',
        'truck_owner_name',
        'departure_time',
        'truck_fee_payment_status',
        'duty_payment_status',
        'from_date',
        'to_date'
        ])) style="display: block;" @endif>
        <form action="{{route('exportList')}}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-lg-6">
                    <label class="form-label mb-1">ရက်စွဲ (Range)</label>
                    <div class="input-group">
                        <input type="text" name="from_date" id="from_date" class="form-control"
                            value="{{ request('from_date') }}" placeholder="DD/MM/YYYY" autocomplete="off">
                        <span class="input-group-text">~</span>
                        <input type="text" name="to_date" id="to_date" class="form-control"
                            value="{{ request('to_date') }}" placeholder="DD/MM/YYYY" autocomplete="off">
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label mb-1">ရက်စွဲ</label>
                    <input type="text" name="export_date" id="export_date" class="form-control"
                        value="{{ request('export_date') }}" placeholder="DD/MM/YYYY" autocomplete="off">
                </div>

                <div class="col-12 col-sm-6 col-lg-4 item_id_search-select">
                    <label class="form-label mb-1">ကုန်အမျိုးအစား</label>
                    <select name="item_id" class="form-select single-select">
                        <option value="">--ရွေးချယ်ပါ--</option>
                        @foreach ($items as $item)
                        <option value="{{ $item->item_id }}" @selected(request('item_id')==$item->item_id)>
                            {{ $item->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label for="truck_no" class="form-label">ကားနံပါတ် </label>
                    <input type="text" class="form-control shadow-none" name="truck_no" id="truck_no"
                        value="{{ request('truck_no') }}" />
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label for="driver_name" class="form-label">ယာဥ်မောင်း </label>
                    <input type="text" class="form-control shadow-none" name="driver_name" id="driver_name"
                        value="{{ request('driver_name') }}" />
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label for="driver_phone" class="form-label">ဖုန်းနံပါတ် </label>
                    <input type="text" class="form-control shadow-none" name="driver_phone" id="driver_phone"
                        value="{{ request('driver_phone') }}" />
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label for="driver_nrc" class="form-label">မှတ်ပုံတင်နံပါတ်</label>
                    <input type="text" class="form-control shadow-none" name="driver_nrc" id="driver_nrc"
                        value="{{ request('driver_nrc') }}" />
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label for="truck_owner_name" class="form-label">ကားဥန္နာ</label>
                    <input type="text" class="form-control shadow-none" name="truck_owner_name" id="truck_owner_name"
                        value="{{ request('truck_owner_name') }}" />
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label for="departure_time" class="form-label">ကားစတင်ထွက်ချိန် </label>
                    <input type="text" class="form-control shadow-none" name="departure_time" id="departure_time"
                        placeholder="DD/MM/YYYY H:m" value="{{ request('departure_time') }}" />
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label for="truck_fee_payment_status" class="form-label">ကားခရှင်းပြီး/မပြီး </label>
                    <div class="truck_fee_payment_status-error-element truck_fee_payment_status-select custom-select">
                        <select
                            class="form-select form-control shadow-none select truck_fee_payment_status single-select"
                            name="truck_fee_payment_status" id="truck_fee_payment_status">
                            <option value="">--ရွေးချယ်ပါ--</option>
                            <option value="{{ config('constants.truck_fee_payment_status.pending') }}"
                                @selected(request('truck_fee_payment_status')==config('constants.truck_fee_payment_status.pending'))>
                                ကျန်
                            </option>
                            <option value="{{ config('constants.truck_fee_payment_status.complete') }}"
                                @selected(request('truck_fee_payment_status')==config('constants.truck_fee_payment_status.complete'))>
                                ရှင်းပြီး
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label for="duty_payment_status" class="form-label">ဂျူတီရှင်းပြီး/မပြီး </label>
                    <div class="duty_payment_status-error-element duty_payment_status-select custom-select">
                        <select class="form-select form-control shadow-none select duty_payment_status single-select"
                            name="duty_payment_status" id="duty_payment_status">
                            <option value="">--ရွေးချယ်ပါ--</option>
                            <option value="{{ config('constants.duty_payment_status.pending') }}"
                                @selected(request('duty_payment_status')==config('constants.duty_payment_status.pending'))>
                                ကျန်
                            </option>
                            <option value="{{ config('constants.duty_payment_status.complete') }}"
                                @selected(request('duty_payment_status')==config('constants.duty_payment_status.complete'))>
                                ရှင်းပြီး
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-auto ms-sm-auto">
                    <div class="d-flex gap-2 flex-column flex-sm-row">
                        <button type="submit" class="btn btn-primary w-100 w-sm-auto" title="ရှာရန်">
                            <i class="fas fa-search mr-1"></i>
                        </button>
                        <a href="{{ route('exportList') }}" class="btn btn-primary w-100 w-sm-auto"
                            title="ပုံသေသို့ ပြန်ရန်">
                            <i class="fas fa-sync-alt mr-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Export list  -->
    <div class="card">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="ms-4">
                ပြည်ပပို့စာရင်း စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ $exports->total() }} ခု</span>
            </div>

            <div class="me-4">
                ကုန်ကျငွေ စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ clean_number($exports->sum('payments_sum_amount_in_kyat')) }}
                    ကျပ်</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover trans-table">
                    <thead>
                        <tr>
                            <th class="w50 nowrap">စဥ်</th>
                            <th class="w120 nowrap">ရက်စွဲ</th>
                            <th class="w140 nowrap">ကုန်</th>
                            <th class="w90 nowrap">ခြင်း</th>
                            <th class="w180 nowrap">ရှင်း/ကျန်</th>
                            <th class="w130 nowrap">ကားခ ကျန်ငွေ</th>
                            <th class="w130 nowrap">ဂျူတီ ကျန်ငွေ</th>
                            <th class="w120 nowrap">ကားနံပါတ်</th>
                            <th class="w180 wrap-text">ယာဥ်မောင်း</th>
                            <th class="w150 wrap-text">ဖုန်းနံပါတ်</th>
                            <th class="w160 wrap-text">ကားဥန္နာ</th>
                            <th class="w120 nowrap">ကားခ</th>
                            <th class="w130 nowrap">ကားခ စရံငွေ</th>

                            <th class="w120 nowrap">ဂျူတီခ</th>
                            <th class="w140 nowrap">ဂျူတီခ စရံငွေ</th>

                            <th class="w140 nowrap">စုစုပေါင်း</th>
                            <th class="w220 nowrap">{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($exports->isNotEmpty())
                        @foreach ($exports as $index => $export)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td class="nowrap">{{ format_date($export->export_date) }}</td> <!-- d/m/Y -->
                            <td class="nowrap">
                                @foreach ($export->exportItems as $exportItem)
                                {{$exportItem->item->name}} <br />
                                @endforeach
                            </td>
                            <td class="nowrap">
                                @foreach ($export->exportItems as $exportItem)
                                {{remove_unvaluable_zero($exportItem->basket_count)}} <br />
                                @endforeach
                            </td>
                            <td>ကားခ - <i
                                    class='bx text-{{$export->truck_fee_payment_status_color}} bx-{{$export->truck_fee_payment_status_icon}}'></i>
                                ဂျူတီ - <i class='bx text-{{$export->duty_payment_status_color}} bx-{{$export->duty_payment_status_icon}}'></i>
                            </td>
                            <td class="text-end nowrap">
                                {{ clean_number(($export->truck_fee_balance ?? 0)) }}
                            </td>
                            <td class="text-end nowrap">
                                {{ clean_number(($export->duty_fee_balance ?? 0)) }}
                            </td>
                            <th class="nowrap">{{$export->truck_no}}</th>
                            <td class="wrap-text">{{$export->driver_name}}</td>
                            <td class="wrap-text">{{$export->driver_phone}}</td>
                            <td class="wrap-text">{{$export->truck_owner_name}}</td>
                            <td class="text-end nowrap">{{clean_number($export->truck_fee)}}</td>
                            <td class="text-end nowrap">{{clean_number($export->truck_fee_down_payment)}}</td>
                            <td class="text-end nowrap">{{clean_number($export->duty_fee)}}</td>
                            <td class="text-end nowrap">{{clean_number($export->duty_fee_down_payment)}}</td>

                            <td class="text-end nowrap">{{$export->payments->sum('amount_in_kyat')}}</td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{route('exportDetail', $export->export_id)}}"><i
                                        class='bx bx-dots-vertical-rounded'></i>
                                </a>
                                <a class="btn btn-sm btn-primary mx-1"
                                    href="{{route('exportEdit', $export->export_id)}}"><i class="bx bx-edit-alt"></i>
                                </a>
                                @if ($export->payments->isEmpty())
                                <a class="btn btn-sm btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="{{ $export->export_id }}"
                                    data-resource-name="export_id"
                                    data-url="{{ route('exportDelete', $export->export_id) }}"
                                    href="javascript:void(0);"><i class="bx bx-trash"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                ဒီလအတွင်း ပြည်ပပို့ စာရင်း မရှိသေးပါ
                            </td>
                        </tr>
                        @endif

                    </tbody>
                </table>
                {{$exports->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
    <!--/ Export list  -->
</div>
@endsection
