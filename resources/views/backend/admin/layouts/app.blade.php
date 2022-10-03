<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culturefy - @yield('title')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('backend/admin/assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{URL::asset('backend/admin/assets/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{URL::asset('backend/admin/assets/vendors/dripicons/webfont.css')}}">
    <link rel="stylesheet" href="{{URL::asset('backend/admin/assets/css/pages/dripicons.css')}}">
    <link rel="stylesheet" href="{{URL::asset('backend/admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{URL::asset('backend/admin/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{URL::asset('backend/admin/assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{URL::asset('backend/admin/assets/images/favicon.svg')}}" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="{{URL::asset('backend/admin/assets/images/logo/logo.png')}}" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    @include('backend.admin.partials._left_menu')
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
           @yield('secton')
            <footer>
                @include('backend.admin.partials._footer')
            </footer>
        </div>
    </div>
    <script src="{{URL::asset('backend/admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{URL::asset('backend/admin/assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{URL::asset('backend/admin/assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{URL::asset('backend/admin/assets/js/pages/dashboard.js')}}"></script>

    <script src="{{URL::asset('backend/admin/assets/js/main.js')}}"></script>
</body>

</html>
