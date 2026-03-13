@extends('layout.main')
@section('html-title', 'Admin')
@section('page-title', 'Admin Lists')
@section('main-content-template')
<x-delete-confirm btn-txt="Delete">
</x-delete-confirm>
<div class="container-xxl flex-grow-1">
    <div class="d-flex justify-content-between">
        <h4 class="fw-bold mb-4"><span class="fw-light">အသုံးပြုသူစာရင်း /</span>
            {{ __('template_names.list_title_text') }} </h4>

        <!-- Bordered Table -->
        <h5 class="d-flex justify-content-end">
            <a href="{{ route('adminCreate') }}" class="btn btn-primary">
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
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered datatable table-hover">
                    <thead>
                        <tr>
                            <th>စဥ်</th>
                            <th>အမည်</th>
                            <th>Login Id</th>
                            <th>ဖုန်းနံပါတ်</th>
                            <th>လုပ်ပိုင်ခွင့်</th>
                            <th>{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeAdmin as $key => $admin)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>
                                {{ $admin->username }}
                            </td>
                            <td>{{ $admin->phone ?? '-' }}</td>
                            <td>
                                {{ $admin->role_name }}
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary mx-3"
                                    href="{{ route('adminEdit', $admin->admin_id) }}"><i class="bx bx-edit-alt"></i>
                                </a>
                                @if ($admin->admin_id != Auth::user()->admin_id)
                                <a class="btn btn-sm btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="{{ $admin->admin_id }}"
                                    data-resource-name="admin_id" data-action="ban"
                                    data-url="{{ route('manageAdmin') }}" href="javascript:void(0);"> <i
                                        class="bx bx-block"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!--/ Bordered Table -->

</div>

<div class="container-xxl flex-grow-1">
    <h4 class="fw-bold my-4"><span class="fw-light">Ban ထားသောစာရင်း /</span>
        {{ __('template_names.list_title_text') }} </h4>
    <!-- Bordered Table -->
    <div class="card">

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered datatable table-hover">
                    <thead>
                        <tr>
                            <th>စဥ်</th>
                            <th>အမည်</th>
                            <th>Login Id</th>
                            <th>ဖုန်းနံပါတ်</th>
                            <th>လုပ်ပိုင်ခွင့်</th>
                            <th>{{ __('template_names.table_header_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bannedAdmin as $key => $admin)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>
                                {{ $admin->username }}
                            </td>
                            <td>{{ $admin->phone ?? '-' }}</td>
                            <td>
                                {{ $admin->role_name }}
                            </td>
                            <td>
                                @if ($admin->admin_id != Auth::user()->admin_id)
                                <a class="btn btn-sm btn-danger show-delete-modal mx-3" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="{{ $admin->admin_id }}"
                                    data-resource-name="admin_id" data-action="delete"
                                    data-url="{{ route('manageAdmin') }}" href="javascript:void(0);"><i
                                        class="bx bx-trash"></i>
                                </a>
                                <a class="btn btn-sm btn-primary show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="{{ $admin->admin_id }}"
                                    data-resource-name="admin_id" data-action="restore"
                                    data-url="{{ route('manageAdmin') }}" href="javascript:void(0);"><i
                                        class="bx bx-revision"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!--/ Bordered Table -->

</div>
@endsection
