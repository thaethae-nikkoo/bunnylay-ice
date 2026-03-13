@extends('layout.app')
@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('components.sidenav')
        <div class="layout-page">
            @include('components.header')
            <div class="content-wrapper">
                @yield('main-content-template')
            </div>
              @include('components.footer')
        </div>
        <!-- Menu -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</div>
@endsection
