@extends('layout.main')
@section('html-title', 'Expense')
@section('page-title', 'Expense Create')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
    {!! __('messages.delete_alert') !!}
</x-delete-confirm>

<div class="container-xxl flex-grow-1">
    <div class="d-flex justify-content-between align-items center">
        <h4 class="fw-bold mb-4"><span class="fw-light">ထွက်ငွေ-အသုံးငွေ /</span>
            {{ __('template_names.list_title_text') }} </h4>
        <h5 class="d-flex justify-content-end">
            <a href="{{ route('expenseCreate') }}" class="btn btn-primary">
                {{ __('template_names.create_title_text') }}
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
    <div class="card sec-filter mb-2" @if (request()->filled('payment_date') ||
        request()->filled('description') ||
        request()->filled('amount_in_kyat') ||
        request()->filled('amount_in_baht') ||
        request()->filled('payment_method') ||
        request()->filled('remark') ||
        request()->filled('from_date') ||
        request()->filled('to_date')) style="display: block;" @endif>
        <form action="{{ route('expenseList') }}" method="GET">
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
                <div class="col-12 col-sm-12 col-lg-3">
                    <label class="form-label mb-1">ရက်စွဲ</label>
                    <input type="text" name="payment_date" id="payment_date" class="form-control"
                        value="{{ request('payment_date') }}" placeholder="DD/MM/YYYY" autocomplete="off">
                </div>

                {{-- Description --}}
                <div class="col-12 col-sm-12 col-lg-3">
                    <label class="form-label mb-1">အကြောင်းအရာ</label>
                    <input type="text" name="description" class="form-control" value="{{ request('description') }}">
                </div>

                {{-- Amount in Kyat --}}
                <div class="col-6 col-sm-12 col-lg-2">
                    <label class="form-label mb-1">အမောင့် (ကျပ်)</label>
                    <input type="text" name="amount_in_kyat" class="form-control"
                        value="{{ request('amount_in_kyat') }}">
                </div>

                {{-- Amount in Baht --}}
                <div class="col-6 col-sm-12 col-lg-2">
                    <label class="form-label mb-1">အမောင့် (ဘတ်)</label>
                    <input type="text" name="amount_in_baht" class="form-control"
                        value="{{ request('amount_in_baht') }}">
                </div>

                {{-- Payment Method --}}
                <div class="col-6 col-sm-12 col-lg-3">
                    <label class="form-label mb-1">ငွေလွှဲအမျိုးအစား</label>
                    <input type="text" name="payment_method" class="form-control"
                        value="{{ request('payment_method') }}">
                </div>

                {{-- Remark --}}
                <div class="col-6 col-sm-12 col-lg-3">
                    <label class="form-label mb-1">မှတ်ချက်</label>
                    <input type="text" name="remark" class="form-control" value="{{ request('remark') }}">
                </div>

                <div class="col-12 col-sm-auto ms-sm-auto">
                    <div class="d-flex gap-2 flex-column flex-sm-row">
                        <button type="submit" class="btn btn-primary w-100 w-sm-auto" title="ရှာရန်">
                            <i class="fas fa-search mr-1"></i>
                        </button>
                        <a href="{{ route('expenseList') }}" class="btn btn-primary w-100 w-sm-auto"
                            title="ပုံသေသို့ ပြန်ရန်">
                            <i class="fas fa-sync-alt mr-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Expense list  -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="mb-2">
                    ထွက်ငွေ-အသုံးငွေစာရင်း စုစုပေါင်း <span class="ms-2">-</span> <span class="ms-2">
                        {{ $expenses->count() }} ခု</span>
                </div>

                <div class="mb-2">
                    စုစုပေါင်းထွက်ငွေ -
                    {{ number_format($monthlySummaryCostInKyat, floor($monthlySummaryCostInKyat ==
                    $monthlySummaryCostInKyat ? 0 : 2)) }}
                    ကျပ်/
                    {{ number_format($monthlySummaryCostInBaht, floor($monthlySummaryCostInBaht ==
                    $monthlySummaryCostInBaht ? 0 : 2)) }}
                    ဘတ်
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover trans-table">
                    <thead>
                        <tr>
                            <th class="w60 nowrap">စဥ်</th>
                            <th class="w120 nowrap">ရက်စွဲ</th>
                            <th class="w220 wrap-text">အကြောင်းအရာ</th>
                            <th class="w120 nowrap">ဘတ်</th>
                            <th class="w120 nowrap">ကျပ်</th>
                            <th class="w220 wrap-text">ငွေလွှဲအမျိုးအစား</th>
                            <th class="w220 wrap-text">မှတ်ချက်</th>
                            <th class="w160 nowrap">{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($expenses))
                        @forelse ($expenses as $key => $expense)
                        <tr>
                            <td>{{ $expenses->firstItem() + $key }}</td>
                            <td class="nowrap">
                                {{ $expense->date ? \Carbon\Carbon::createFromFormat('Y-m-d',
                                $expense->date)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="wrap-text">
                                {{ $expense->description }}
                            </td>
                            <td class="nowrap text-end">
                                {{ $expense->amount_in_baht !== null ? remove_unvaluable_zero($expense->amount_in_baht)
                                : '-' }}
                            </td>
                            <td class="nowrap text-end">
                                {{ $expense->amount_in_kyat !== null
                                ? number_format($expense->amount_in_kyat, floor($expense->amount_in_kyat) ==
                                $expense->amount_in_kyat ? 0 : 2)
                                : '-' }}
                            </td>
                            <td class="wrap-text">
                                {{ $expense->payment_method ?? '-' }}
                            </td>
                            <td class="wrap-text">
                                {{ $expense->remark ?? '-' }}
                            </td>
                            <td class="nowrap">
                                @if(is_null($expense->export_id))
                                <a class="btn btn-sm btn-primary mx-1"
                                    href="{{ route('expenseEdit', $expense->expense_id) }}">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <a class="btn btn-sm btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="{{ $expense->expense_id }}"
                                    data-resource-name="expense_id" data-url="{{ route('expenseDelete') }}"
                                    href="javascript:void(0);">
                                    <i class="bx bx-trash"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                ဒီလအတွင်း ထွက်ငွေ/အသုံးငွေ စာရင်း မရှိသေးပါ
                            </td>
                        </tr>
                        @endforelse
                        @endif
                    </tbody>
                </table>

                <div>
                    {{ $expenses->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
    <!--/ Expense list  -->
</div>
@endsection
