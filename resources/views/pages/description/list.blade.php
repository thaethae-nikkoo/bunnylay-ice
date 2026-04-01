@extends('layout.main')
@section('html-title', 'Description')
@section('page-title', 'Description')
@section('main-content-template')
    <x-delete-confirm btn-txt="Delete"></x-delete-confirm>
    <x-change-status btn-txt="Update">
        {!! __('messages.status_change_alert') !!}
    </x-change-status>
    @include('pages.description.include.input_modal')

    <div class="container-xxl flex-grow-1">
        <div class="d-flex justify-content-between">
            <h6 class="fw-bold mb-4"><span class="fw-light"> {{ $_resource->gp_name ? '(' . $_resource->gp_name . ')' : '' }}
                    အကြောင်းအရာများ/</span>
                {{ __('template_names.list_title_text') }} </h6>

            <h5 class="d-flex justify-content-end">
                <a href="javascript:void(0);" class="btn btn-sm btn-primary" id="create-btn">
                    {{ __('template_names.create_title_text') }}
                </a>
            </h5>
        </div>

        <div id="alert-container">
            @if (session()->has('success'))
                <x-alert type="success" :message="session('success')" />
            @endif
        </div>

        <div class="card">
            <div class="card-body table-card">
                <div class="table-responsive text-nowrap">
                    <table id="description-table" class="table table-bordered table-striped datatable table-hover">
                        <thead>
                            <tr>
                                <th class="w30">#</th>
                                <th>အကြောင်းအရာ</th>
                                <th>{{ __('template_names.table_header_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($descriptions as $index => $desc)
                                <tr id="{{ $desc->description_id }}" data-id="{{ $desc->description_id }}">
                                    <td class="w30 row-index">{{ $index + 1 }}</td>
                                    <td class="name">{{ $desc->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-user-action">
                                            @if ($desc->is_user_manual)
                                                <button class="btn btn-sm btn-icon edit-btn btn-warning me-2"
                                                    data-name="{{ $desc->name }}"
                                                    data-url="{{ route('description_gps.descriptions.update', [
                                                        'description_gp_id' => $_resource->description_gp_id,
                                                        'description_id' => $desc->description_id,
                                                    ]) }}"
                                                    title="ပြင်ဆင်">
                                                    <span class="btn-inner">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </span>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-danger show-delete-modal"
                                                    data-bs-toggle="modal" data-bs-target="#delete_confirm"
                                                    data-resource-name="description_id" title="Delete"
                                                    href="javascript:void(0);"
                                                    data-url="{{ route('description_gps.descriptions.delete', [
                                                        'description_gp_id' => $_resource->description_gp_id,
                                                        'description_id' => $desc->description_id,
                                                    ]) }}"
                                                    data-id="{{ $desc->description_id }}" title="Delete">
                                                    <span class="btn-inner">
                                                        <i class="bx bx-trash"></i>
                                                    </span>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Row Template for JS --}}
    <template id="row-template">
        <tr>
            <td class="w30 row-index"></td>
            <td class="name"></td>
            <td>
                <div class="d-flex align-items-center list-user-action">
                    <button class="btn btn-sm btn-icon edit-btn btn-warning me-2" title="ပြင်ဆင်"><span class="btn-inner">
                            <i class="bx bx-edit-alt"></i></span></button>
                    <button class="btn btn-sm btn-icon btn-danger show-delete-modal" data-bs-toggle="modal"
                        data-resource-name="description_id" title="Delete" href="javascript:void(0);"
                        data-bs-target="#delete_confirm" title="Delete"><span class="btn-inner"> <i
                                class="bx bx-trash"></i></span></button>
                </div>
            </td>
        </tr>
    </template>
    @scope([
        'edit_url' => route('description_gps.descriptions.update', ['description_gp_id' => $_resource->description_gp_id, 'description_id' => '__desc_id__']),
        'create_url' => route('description_gps.descriptions.create', $_resource->description_gp_id),
        'delete_url' => route('description_gps.descriptions.delete', ['description_gp_id' => $_resource->description_gp_id, 'description_id' => '__desc_id__']),
    ])
@endsection
