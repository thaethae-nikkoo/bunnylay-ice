@extends('layout.main')
@section('html-title', 'Sale')
@section('page-title', 'Sale Lists')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
    {!! __('messages.delete_alert') !!}
</x-delete-confirm>

<div class="container-xxl flex-grow-1">
    <h4 class="fw-bold mb-4"><span class="fw-light">ကုန်ရောင်းစာရင်း /</span>
        {{ __('template_names.list_title_text') }} </h4>
    <!-- Good Sale  -->

    <h5 class="d-flex justify-content-end">
        <a href="{{ route('goodSaleCreate') }}" class="btn btn-primary">
            {{ __('template_names.create_title_text') }}
        </a>
        <a href="#" class="btn btn-primary ms-2 search-toggle">
            {{ __('template_names.search') }}
        </a>
    </h5>

    @include('good_sale.filter')

    @if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
    @endif
    @if (session()->has('error'))
    <x-alert type="danger" :message="session('error')" />
    @endif

    <div class="card">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="ms-4">
                ကုန်အရောင်းစာရင်း စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ $sales->total() }} ခု</span>
            </div>
            <div class="me-4">
                ကုန် KG စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ clean_number($totalSummary['total_kg']) }} KG</span>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="ms-4">
                ကျသင့်ငွေ စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ clean_number($totalSummary['total_in_kyat']) }}
                    ကျပ်</span>
            </div>
            <div class="me-4">
                ကျသင့်ငွေ စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                    {{ clean_number($totalSummary['total_in_baht']) }}
                    ဘတ်</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover trans-table">
                    <thead>
                        <tr>
                            <th class="w60 nowrap">စဥ်</th>
                            <th class="w140 nowrap">ရက်စွဲ</th>
                            <th class="w160 nowrap">ထိုင်းကားနံပါတ်</th>
                            <th class="w220 wrap-text">ကုန်ပစ္စည်းများ</th>
                            <th class="w160 nowrap">kg</th>
                            <th class="w160 nowrap">ဈေးနှုန်း(ဘတ်)</th>
                            <th class="w160 nowrap">ဈေးနှုန်း(ကျပ်)</th>
                            <th class="w160 nowrap">ဘတ်ငွေ</th>
                            <th class="w160 nowrap">ကျပ်ငွေ</th>
                            <th class="w240 wrap-text">မှတ်ချက်</th>
                            <th class="w220 nowrap">{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($sales))
                        @forelse ($sales as $index => $sale)
                        <tr>
                            <td>{{ $sales->firstItem() + $index }}</td>
                            <td class="nowrap">{{ format_date($sale->sale_date) }}</td> <!-- d/m/Y -->
                            <td class="nowrap">{{ $sale->thai_truck_no }}</td>
                            <td class="wrap-text">
                                {{ optional($sale->item)->name ?? '-' }}
                            </td>
                            <td class="nowrap text-end">
                                {{ clean_number($sale->kg) }}
                            </td>
                            <td class="text-end">{{ clean_number($sale->price_per_kg_baht) }}</td>
                            <td class="text-end">{{ clean_number($sale->price_per_kg_kyat) }}</td>
                            <td class="text-end">{{ clean_number($sale->total_price_baht) }}</td>
                            <td class="text-end">{{ clean_number($sale->total_price_kyat) }}</td>
                            <td class="wrap-text">{{ $sale->remark }}</td>
                            <td>
                                <a class="btn btn-sm btn-info"
                                    href="{{ route('goodSaleDetail', $sale->good_sale_id) }}"><i
                                        class='bx bx-dots-vertical-rounded'></i>
                                </a>
                                <a class="btn btn-sm btn-primary mx-3"
                                    href="{{ route('goodSaleEdit', $sale->good_sale_id) }}"><i
                                        class="bx bx-edit-alt"></i>
                                </a>
                                @if ($sale->payments->isEmpty())
                                <a class="btn btn-sm btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="{{ $sale->good_sale_id }}"
                                    data-resource-name="good_sale_id"
                                    data-url="{{ route('goodSaleDelete', $sale->good_sale_id) }}"
                                    href="javascript:void(0);"><i class="bx bx-trash"></i>
                                </a>
                                @endif
                            </td>
                        <tr>
                            @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                ဒီလအတွင်း ကုန်အရောင်း စာရင်း မရှိသေးပါ
                            </td>
                        </tr>
                        @endforelse
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $sales->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <!--/ Good Sale  -->


</div>
@endsection
