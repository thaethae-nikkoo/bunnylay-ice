@if (session('alert_message'))
    <div class="alert alert-{{ session('alert_type') }} alert-dismissible fade show" role="alert">
        <strong>{{ ucfirst(session('alert_type')) }}!</strong> {{ session('alert_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
