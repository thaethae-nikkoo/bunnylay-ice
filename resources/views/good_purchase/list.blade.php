@extends('layout.main')
@section('html-title', 'Good Purchase')
@section('page-title', 'Good Purchase Lists')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
    {!! __('messages.delete_alert') !!}
</x-delete-confirm>

<div class="container-xxl flex-grow-1">
    <div class="d-flex justify-content-between">
        <h4 class="fw-bold mb-4"><span class="fw-light">ကုန်ဝယ်ယူမှုစာရင်း /</span>
            {{ __('template_names.list_title_text') }} </h4>

        <h5 class="d-flex justify-content-end">
            <a href="{{ route('goodPurchaseCreate') }}" class="btn btn-primary">
                {{ __('template_names.create_title_text') }}
            </a>
            <a href="#" class="btn btn-primary ms-2 search-toggle">
                {{ __('template_names.search') }}
            </a>
        </h5>
    </div>

    <!-- Good Purchase  -->
    @if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
    @endif
    @if (session()->has('error'))
    <x-alert type="danger" :message="session('error')" />
    @endif
    <div class="card sec-filter mb-2" @if (request()->filled('purchase_date') ||
        request()->filled('item_id') ||
        request()->filled('farmer_name') ||
        request()->filled('viss') ||
        request()->filled('price_per_viss') ||
        request()->filled('total_price') ||
        request()->filled('from_date') ||
        request()->filled('to_date')) style="display: block;" @endif>
        <form action="{{ route('goodPurchaseSearchList') }}" method="GET">
            <div class="row g-3 align-items-end">
                {{-- Date range --}}
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

                {{-- Exact date --}}
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label mb-1">ရက်စွဲ</label>
                    <input type="text" name="purchase_date" id="purchase_date" class="form-control"
                        value="{{ request('purchase_date') }}" placeholder="DD/MM/YYYY" autocomplete="off">
                </div>

                {{-- Item --}}
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

                {{-- Farmer --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label mb-1">တောင်သူအမည်</label>
                    <input type="text" name="farmer_name" class="form-control" value="{{ request('farmer_name') }}">
                </div>

                {{-- Viss --}}
                <div class="col-6 col-sm-3 col-lg-2">
                    <label class="form-label mb-1">အရေအတွက်</label>
                    <input type="text" name="viss" class="form-control" value="{{ request('viss') }}">
                </div>

                {{-- Price per viss --}}
                <div class="col-6 col-sm-3 col-lg-2">
                    <label class="form-label mb-1">ဈေးနှုန်း</label>
                    <input type="text" name="price_per_viss" class="form-control"
                        value="{{ request('price_per_viss') }}">
                </div>

                {{-- Total price --}}
                <div class="col-6 col-sm-3 col-lg-2">
                    <label class="form-label mb-1">သင့်ငွေ</label>
                    <input type="text" name="total_price" class="form-control" value="{{ request('total_price') }}">
                </div>

                <div class="col-12 col-sm-auto ms-sm-auto">
                    <div class="d-flex gap-2 flex-column flex-sm-row">
                        <button type="submit" class="btn btn-primary w-100 w-sm-auto" title="ရှာရန်">
                            <i class="fas fa-search mr-1"></i>
                        </button>
                        <a href="{{ route('goodPurchaseSearchList') }}" class="btn btn-primary w-100 w-sm-auto"
                            title="ပုံသေသို့ ပြန်ရန်">
                            <i class="fas fa-sync-alt mr-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="ms-4">
                ကျသင့်ငွေ စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ number_format($monthlySummaryCost, floor($monthlySummaryCost == $monthlySummaryCost ? 0 : 2)) }}
                    ကျပ်</span>
            </div>

            <div class="me-4">
                ပိဿာ စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ formatViss($monthlySummaryViss) }} </span>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="ms-4">
                ရှင်းပြီးငွေ စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ number_format($monthlyPayments, floor($monthlyPayments == $monthlyPayments ? 0 : 2)) }}
                    ကျပ်</span>
            </div>

            <div class="me-4">
                ကုန်ဝယ်ယူမှုစာရင်း စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ $goodPurchases->total() }} ခု</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover trans-table">
                    <thead>
                        <tr>
                            <th class="w60 nowrap">စဥ်</th>
                            <th class="w110 nowrap">ရက်စွဲ</th>
                            <th class="w200 wrap-text">ကုန်ပစ္စည်းအမည်</th>
                            <th class="w160 nowrap">ရှင်းပြီးငွေ</th>
                            <th class="w220 wrap-text">တောင်သူအမည်</th>
                            <th class="w200 nowrap">အရေအတွက်</th>
                            <th class="w160 nowrap">သင့်ငွေ(ကျပ်)</th>
                            <th class="w220 nowrap">{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($goodPurchases))
                        @forelse ($goodPurchases as $key => $goodPurchase)
                        <tr>
                            <td> {{ $goodPurchases->firstItem() + $key }}</td>
                            <td class="nowrap">
                                {{ $goodPurchase->purchase_date
                                ? \Carbon\Carbon::createFromFormat('Y-m-d',
                                $goodPurchase->purchase_date)->format('d/m/Y')
                                : '-' }}
                            </td>
                            <td class="wrap-text">
                                {{ optional($goodPurchase->item)->name ?? '-' }}
                            </td>
                            <td class="text-end">
                                {{ number_format($goodPurchase->paid_amount ?? 0) }}
                            </td>
                            <td class="wrap-text">{{ $goodPurchase->farmer_name }}</td>
                            <td class="wrap-text">{{ formatViss($goodPurchase->viss, true) }}</td>
                            <td class="text-end">{{ number_format(
                                $goodPurchase->total_price,
                                floor($goodPurchase->total_price) == $goodPurchase->total_price ? 0 : 2,
                                ) }}
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info"
                                    href="{{ route('goodPurchaseDetail', $goodPurchase->good_purchase_id) }}"><i
                                        class='bx bx-dots-vertical-rounded'></i>
                                </a>
                                <a class="btn btn-sm btn-primary mx-1"
                                    href="{{ route('goodPurchaseEdit', $goodPurchase->good_purchase_id) }}"><i
                                        class="bx bx-edit-alt"></i>
                                </a>
                                @if ($goodPurchase->payments_count == 0)
                                <a class="btn btn-sm btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="{{ $goodPurchase->good_purchase_id }}"
                                    data-resource-name="good_purchase_id" data-url="{{ route('goodPurchaseDelete') }}"
                                    href="javascript:void(0);"><i class="bx bx-trash"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                ဒီလအတွင်း ကုန်ဝယ်ယူမှု စာရင်း မရှိသေးပါ
                            </td>
                        </tr>
                        @endforelse
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $goodPurchases->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <!--/ Good Purchase  -->
</div>
@endsection
