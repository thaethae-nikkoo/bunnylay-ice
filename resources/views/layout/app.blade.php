<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('html-title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/clockpicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-clockpicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jquery-clockpicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/clockpicker.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }} "></script>

    <!-- Flatpicker date time picker -->
    <script src="{{ asset('assets/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.min.css') }}" />
</head>

<body>
    <div id="loader">
        <div class="spinner"></div>
    </div>
    @yield('content')

    @scriptIf($__view->name)
    @cssIf($__view->name)
    <!--   Core JS Files   -->

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <!-- Select2 JS Select inputs-->
    <script src="{{ asset('assets/js/plugin/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/select.js') }}"></script>
    <!-- Datepicker -->
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Draft Sort in table JS -->
    <script src="{{ asset('assets/js/modals.js') }}"></script>
    <script src="{{ asset('assets/js/controlevent.js') }}"></script>
    <script src="{{ asset('js/lib.js') }} "></script>
    <script>
        $(window).on("load", function () {
            $("#loader").hide();
            $("#content").show();
        });
    </script>
</body>

</html>
