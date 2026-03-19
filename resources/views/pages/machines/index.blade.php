@extends('layout.main')
@section('html-title', 'Machine')
@section('page-title', 'Machine Lists')

@section('main-content-template')
<x-delete-confirm btn-txt="Delete"></x-delete-confirm>
<x-change-status btn-txt="Update">
    {!! __('messages.status_change_alert') !!}
</x-change-status>

@include('pages.machines.include.modal')

<div class="container-xxl flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">
            <span class="fw-light">စက်များ /</span> {{ __('template_names.list_title_text') }}
        </h6>
        <button type="button" class="btn btn-sm btn-primary" id="create_machine_btn">
            {{ __('template_names.create_title_text') }}
        </button>
    </div>

    @if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-striped datatable table-hover w-100 trans-table" id="machines_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="w150">Machine Name</th>
                            <th class="w150">Code</th>
                            <th class="w120">ရေခဲအမျိုးအစား</th>
                            <th class="w100">အချိန်</th>
                            <th class="w100">ထွက်အား</th>
                            <th class="w250">Remark</th>
                            <th class="w150">Status</th>
                            <th class="w150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($machines as $index => $machine)
                        <tr data-id="{{ $machine->machine_id }}">
                            <td>{{ $index + 1 }}</td>
                            <td class="text-wrap w150">{{ $machine->machine_name }}</td>
                            <td class="text-wrap w150">{{ $machine->code }}</td>
                            <td class="w120">{{ config('constants.machine_product_type_label')[$machine->product_type] ?? '' }}</td>
                            <td class="w100">{{ config('constants.machine_capacity_mode_label')[$machine->capacity_mode] ?? '' }}
                            </td>
                            <td class="w100">{{ $machine->capacity_value }}</td>
                            <td class="text-wrap w250">{{ $machine->remark }}</td>
                            <td class="w150">
                                <span
                                    class="badge bg-{{ $machine->status == config('constants.machine_status.active') ? 'success' : 'danger' }}">
                                    {{ config('constants.machine_status_label')[$machine->status] ?? '' }}
                                </span>
                            </td>
                            <td>
                                @if ($machine->photo_path)
                                <a class="btn btn-xs btn-info" target="_blank"
                                    href="{{ asset('storage/' . $machine->photo_path) }}" title="View Image">
                                    <i class="bx bx-image"></i>
                                </a>
                                @endif
                                <button class="btn btn-xs btn-primary edit-machine-btn"
                                    data-id="{{ $machine->machine_id }}" title="Edit">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <button class="btn btn-xs btn-secondary show-status-modal mx-1" data-bs-toggle="modal"
                                    data-bs-target="#change_status_confirm" data-id="{{ $machine->machine_id }}"
                                    data-resource-name="machine_id"
                                    data-url="{{ route('machines.status', $machine->machine_id) }}"
                                    title="Change Status">
                                    <i class="bx bx-refresh"></i>
                                </button>
                                <button class="btn btn-xs btn-danger show-delete-modal" data-bs-toggle="modal"
                                    data-bs-target="#delete_confirm" data-id="{{ $machine->machine_id }}"
                                    data-resource-name="machine_id"
                                    data-url="{{ route('machines.destroy', $machine->machine_id) }}"
                                    data-action="delete" title="Delete">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@scope([
'edit_url' => route('machines.edit', ['id' => '__machine_id__']),
'update_url' => route('machines.update', ['id' => '__machine_id__']),
'create_url' => route('machines.store'),
'delete_url' => route('machines.destroy',['id' => '__machine_id__'] ),
'change_status_url' => route('machines.status',['id' => '__machine_id__'] ),
'asset' => asset('')
])

@endsection
