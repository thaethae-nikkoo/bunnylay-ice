@extends('layout.main')
@section('html-title', 'Description Group')
@section('page-title', 'Description Group')
@section('main-content-template')
    <x-delete-confirm btn-txt="Delete"></x-delete-confirm>
    @include('pages.description.include.gp_input_modal')
    <div class="container-xxl flex-grow-1">
        <div class="d-flex justify-content-between">
            <h6 class="fw-bold mb-4"><span class="fw-light">အကြောင်းအရာအုပ်စုများ /</span>
                {{ __('template_names.list_title_text') }} </h6>

            <h5 class="d-flex justify-content-end">
                <a href="javascript:void(0);" id="create-btn" class="btn btn-sm btn-primary">
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
                    <table id="gp-datatable" class="table table-bordered table-striped datatable table-hover gp-table">
                        <thead>
                            <tr>
                                <th class="w30">#</th>
                                <th>အကြောင်းအရာ</th>
                                <th>အမျိုးအစား</th>
                                <th>{{ __('template_names.table_header_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($descGps as $index => $gp)
                                <tr id="{{ $gp->description_gp_id }}" data-id="{{ $gp->description_gp_id }}">
                                    <td class="w30 row-number">{{ $index + 1 }}</td>
                                    <td class="gp-name">{{ $gp->gp_name }}</td>
                                    <td class="description-type-text">{{ $gp->description_type_text }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-user-action">
                                            <a class="btn btn-sm btn-icon btn-info me-2"
                                                href="{{ route('description_gps.descriptions.list', $gp->description_gp_id) }}"
                                                title="အသေးစိတ်">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </a>

                                            @if ($gp->is_user_manual)
                                                <button class="btn btn-sm btn-icon edit-btn btn-warning me-2"
                                                    data-gp_name="{{ $gp->gp_name }}"
                                                    data-url="{{ route('description_gps.update', $gp->description_gp_id) }}"
                                                    data-description_type="{{ $gp->description_type }}">
                                                    <i class="bx bx-edit-alt"></i>
                                                </button>

                                                <button class="btn btn-sm btn-icon btn-danger show-delete-modal"
                                                    data-bs-toggle="modal" data-bs-target="#delete_confirm"
                                                    data-url="{{ route('description_gps.delete', $gp->description_gp_id) }}"
                                                    data-resource-name="description_gp_id" title="Delete"
                                                    href="javascript:void(0);" data-id="{{ $gp->description_gp_id }}">
                                                    <i class="bx bx-trash"></i>
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
    <template id="row-template">
        <tr>
            <td class="w30 row-number"></td>
            <td class="gp-name"></td>
            <td class="description-type-text"></td>
            <td>
                <div class="d-flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-info detail-link me-2" href="#"><span class="btn-inner"><i
                                class="bx bx-dots-vertical-rounded"></i></span></a>
                    <button class="btn btn-sm btn-icon edit-btn btn-warning me-2"><span class="btn-inner"> <i
                                class="bx bx-edit-alt"></i></span></button>
                    <button class="btn btn-sm btn-icon btn-danger show-delete-modal" data-bs-toggle="modal"
                        data-resource-name="description_gp_id" title="Delete" href="javascript:void(0);"
                        data-bs-target="#delete_confirm"><span class="btn-inner"> <i
                                class="bx bx-trash"></i></span></button>
                </div>
            </td>
        </tr>
    </template>
    @include('includes.input_form', ['radioElements' => ['description_type']])
    @scope([
        'detail_url' => route('description_gps.descriptions.list', ['description_gp_id' => '__resourceId__']),
        'edit_url' => route('description_gps.update', ['description_gp_id' => '__resourceId__']),
        'create_url' => route('description_gps.create'),
        'delete_url' => route('description_gps.delete', ['description_gp_id' => '__resourceId__']),
    ])
@endsection
