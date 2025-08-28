<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('APP-TITLE') - {{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/MacWSS.ico') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
        crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Data Table -->
    <link rel="stylesheet" href="{{ asset('plugins/data-table/css/bootstrap-table.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/data-table/css/bootstrap-table-filter-control.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/data-table/css/bootstrap-table-fixed-columns.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/data-table/css/bootstrap-table-page-jump-to.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/data-table/css/bootstrap-table-sticky-header.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.css') }}">
    <!-- Bootstrap Fileinput -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
    <!--FS Lightbox -->
    <script src="https://cdn.jsdelivr.net/npm/fslightbox/index.js"></script>
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body class="sidebar-main-active right-column-fixed">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <div class="iq-sidebar">
            <div class="iq-navbar-logo d-flex justify-content-between">
                <a href="index.html" class="header-logo">
                    <img src="{{ asset('images/MacWSS.jpg') }}" class="img-fluid rounded" alt="">
                    <span>MacWSS</span>
                </a>
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-menu-line"></i></div>
                        <div class="hover-circle"><i class="ri-close-fill"></i></div>
                    </div>
                </div>
            </div>
            <div id="sidebar-scrollbar">
                <nav class="iq-sidebar-menu">
                    <ul id="iq-sidebar-toggle" class="iq-menu">
                        @include('admin.sidebar')
                    </ul>
                </nav>
                <div class="p-3"></div>
            </div>
        </div>
        <!-- TOP Nav Bar -->
        @include('layouts.top_bar')
        <!-- TOP Nav Bar END -->

        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    @yield('APP-CONTENT')
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper END -->
    <!-- Footer -->
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright 2020 <a href="#">{{ env('APP_NAME') }}</a> All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('js/jquery.appear.js') }}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{ asset('js/countdown.min.js') }}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <!-- Slick JavaScript -->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
    <!-- lottie JavaScript -->
    <script src="{{ asset('js/lottie.js') }}"></script>
    <!-- am core JavaScript -->
    <script src="{{ asset('js/core.js') }}"></script>
    <!-- am charts JavaScript -->
    <script src="{{ asset('js/charts.js') }}"></script>
    <!-- am animated JavaScript -->
    <script src="{{ asset('js/animated.js') }}"></script>
    <!-- am kelly JavaScript -->
    <script src="{{ asset('js/kelly.js') }}"></script>
    <!-- am maps JavaScript -->
    <script src="{{ asset('js/maps.js') }}"></script>
    <!-- am worldLow JavaScript -->
    <script src="{{ asset('js/worldLow.js') }}"></script>
    <!-- Style Customizer -->
    <script src="{{ asset('js/style-customizer.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('js/chart-custom.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- Data Table -->
    <script src="{{ asset('plugins/data-table/js/bootstrap-table.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-addrbar.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-auto-refresh.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-custom-view.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-defer-url.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-editable.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-export.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-filter-control.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-fixed-columns.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-mobile.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-multiple-sort.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-page-jump-to.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-pipeline.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-print.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-resizable.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-sticky-header.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/bootstrap-table-toolbar.js') }}"></script>
    <script src="{{ asset('plugins/data-table/js/utils.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <!-- Bootstrap Fileinput -->
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/themes/fa5/theme.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // CSRF token setup for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#signOut').click(function(event) {
                event.preventDefault();

                $.ajax({
                    method: 'POST',
                    url: '{{ route('logout') }}',
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        toastr.success(response.message);
                        location.href = "{{ route('signIn') }}";
                    },
                    error: function(xhr) {
                        let message = 'Unable to logout.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message);
                    }
                });
            });
        });
    </script>
    @yield('APP-SCRIPT')
</body>

</html>
