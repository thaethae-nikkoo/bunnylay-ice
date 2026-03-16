@extends('layout.main')
@section('html-title', 'Payment Method')
@section('page-title', 'Payment Method Lists')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
</x-delete-confirm>
<x-change-status btn-txt="Update">
    {!! __('messages.status_change_alert') !!}
</x-change-status>
@include('pages.payment_method.include.input_modal')
<div class="container-xxl flex-grow-1">
    <div class="d-flex justify-content-between">
        <h6 class="fw-bold mb-4"><span class="fw-light">ငွေပေးချေမှုအမျိုးအစားများ /</span>
            {{ __('template_names.list_title_text') }} </h6>

        <!-- Bordered Table -->
        <h5 class="d-flex justify-content-end">
            <a href="javascript:void(0);" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#payment_method_modal">
                {{ __('template_names.create_title_text') }}
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
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-striped datatable table-hover">
                    <thead>
                        <tr>
                            <th class=" w30">#</th>
                            <th class=" ">အမည်</th>
                            <th class=" ">Account Name</th>
                            <th class=" ">Account No</th>
                            <th class=" ">Logo</th>
                            <th class=" ">အသုံးပြု/မပြု</th>
                            <th>{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($methods->isEmpty())
                        <tr class="no-data">
                            <td class="text-center" colspan="7">
                                ဒေတာမရှိသေးပါ။
                            </td>
                        </tr>
                        @endif
                        @foreach ($methods as $index => $m)
                        <tr data-id={{$m->payment_method_id}}>
                            <td class="w30">{{$index+1}}</td>
                            <td class="w50 method_name">{{$m->method_name}}</td>
                            <td class="w50 account_name">{{$m->account_name}}</td>
                            <td class="w50 account_no">{{$m->account_no}}</td>
                            <td class="w50 logo">
                                <img src="{{ $m->logo_path ? asset($m->logo_path) : '' }}" width="50">
                            </td>
                            <td class=" status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="{{$m->status_color}}" viewBox="0 0 24 24">
                                    <path d="M12 5a7 7 0 1 0 0 14 7 7 0 1 0 0-14"></path>
                                </svg>
                            </td>
                            <td class="">
                                @if ($m->method_name != config('constants.cash_payment_method_name'))
                                <button class="btn btn-xs btn-primary edit-btn"
                                    data-url="{{route('payment_method.update', $m->payment_method_id)}}"
                                    data-id="{{$m->payment_method_id}}"
                                    data-method_name="{{ $m->method_name }}"
                                    data-account_type="{{ $m->account_type }}"
                                    data-account_name="{{ $m->account_name }}"
                                    data-status="{{ $m->status }}"
                                    data-account_no={{$m->account_no}} data-bs-toggle="modal"
                                    data-bs-target="#create_or_edit_item">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                @endif

                                <button class="btn btn-xs btn-secondary show-status-modal mx-1" data-bs-toggle="modal"
                                data-bs-target="#change_status_confirm"
                                data-url="{{route('payment_method.changeStatus', $m->payment_method_id)}}"
                                data-id="{{$m->payment_method_id}}" data-bs-placement="top"
                                data-resource-name="payment_method_id" title="Change Status" href="javascript:void(0);">
                                    <i class="bx bx-circle"></i>
                                </button>
                                @if ($m->method_name != config('constants.cash_payment_method_name'))
                                <a class="btn btn-xs btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm"
                                    data-resource-name="payment_method_id"
                                    data-url="{{route('payment_method.delete', $m->payment_method_id)}}"
                                    data-id="{{$m->payment_method_id}}" data-bs-placement="top"
                                    data-resource-name="payment_method_id" data-url="{{ route('payment_method.delete', ['payment_method_id' => '__payment_method_id__']) }}"
                                    href="javascript:void(0);"><i class="bx bx-trash"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr class="cloneTarget" id="cloneTarget" hidden>
                            <td class="w30"></td>
                            <td class="method_name"></td>
                            <td class="account_name"></td>
                            <td class="account_no"></td>
                            <td class="logo">
                                <img src="" width="50">
                            </td>
                            <td class="status">
                                <svg xmlns="http://www.w3.org/2000/svg" class="circle" width="24" height="24" fill=""
                                    viewBox="0 0 24 24">
                                    <path d="M12 5a7 7 0 1 0 0 14 7 7 0 1 0 0-14"></path>
                                </svg>
                            </td>
                            <td>
                                <button class="btn btn-xs btn-primary edit-btn" data-id="" data-method_name=""
                                    data-bs-toggle="modal" data-bs-target="#create_or_edit_item">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <button class="btn btn-xs btn-secondary show-status-modal mx-1" data-bs-toggle="modal"
                                    data-bs-target="#change_status_confirm" data-url=""
                                    data-id="" data-bs-placement="top" data-resource-name="payment_method_id"
                                    title="Change Status" href="javascript:void(0);">
                                    <i class="bx bx-circle"></i>
                                </button>
                                <a class="btn btn-xs btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="" data-resource-name="item_id" data-url=""
                                    href="javascript:void(0);"><i class="bx bx-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!--/ Bordered Table -->

</div>
@scope([
'edit_url' => route('payment_method.update', ['payment_method_id' => '__payment_method_id__']),
'create_url' => route('payment_method.create'),
'delete_url' => route('payment_method.delete',['payment_method_id' => '__payment_method_id__'] ),
'change_status_url' => route('payment_method.changeStatus',['payment_method_id' => '__payment_method_id__'] ),
'asset' => asset('')
])
@endsection
