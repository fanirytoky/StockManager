<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>GESTOCK</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="{{url('images/fevicon.png')}}" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}" />
    <!-- site css -->
    <link rel="stylesheet" href="{{url('style.css')}}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{url('css/responsive.css')}}" />
    <!-- color css -->
    <link rel="stylesheet" href="{{url('css/colors.css')}}" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="{{url('css/bootstrap-select.css')}}" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{url('css/perfect-scrollbar.css')}}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{url('css/custom.css')}}" />
    <!-- calendar file css -->
    <link rel="stylesheet" href="{{url('js/semantic.min.css')}}" />

    <link rel="stylesheet" href="{{url('css/fullcalendar.css')}}" />

    <link rel="stylesheet" href="{{url('css/boxicons.css')}}" />

    <!-- jQuery -->
    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <!-- wow animation -->
    <script src="{{url('js/animate.js')}}"></script>
    <!-- select country -->
    <script src="{{url('js/bootstrap-select.js')}}"></script>
    <!-- owl carousel -->
    <script src="{{url('js/owl.carousel.js')}}"></script>
    <!-- chart js -->
    <script src="{{url('js/Chart.min.js')}}"></script>
    <script src="{{url('js/Chart.bundle.min.js')}}"></script>
    <script src="{{url('js/utils.js')}}"></script>
    <script src="{{url('js/analyser.js')}}"></script>
    <!-- nice scrollbar -->
    <script src="{{url('js/perfect-scrollbar.min.js')}}"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- custom js -->
    <script src="{{url('js/custom.js')}}"></script>
    <!-- calendar file css -->
    <script src="{{url('js/semantic.min.js')}}"></script>
    <script src="{{url('js/jquery.calendar.min.js')}}"></script>
    <script src="{{url('js/jquery-ui.min.js')}}"></script>
    <script src="{{url('js/moment.min.js')}}"></script>
    <script src="{{url('js/fullcalendar.min.js')}}"></script>
    <script src="{{url('js/sweetalert.min.js')}}"></script>
    <!-- jQuery library -->
    <script src="{{url('js/jquery2.min.js')}}"></script>

    <!-- Latest minified bootstrap js -->
    <script src="{{url('js/bootstrap2.min.js')}}"></script>



</head>

<body class="inner_page contact_page">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            @include('Menu.sideBar')
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                @include('TopBar.topBar')
                <!-- end topbar -->
                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">

                        <!-- contenu -->
                        @yield('vue')
                        <!-- contenu -->

                        <!-- footer -->
                        <div class="container-fluid">
                            <div class="footer">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="footer_botom" style="display: flex;justify-content: space-between;align-items: center;">
                                            <img src="{{url('images/logo/ISO-02.png')}}" title="" style="width: 125px; height: 75px;margin-right:30px;" />
                                            <p class="copyright">© 2022 SALAMA</p>
                                            <img src="{{url('images/logo/devise-01.png')}}" title="" style="width: 125px; height: 75px;margin-right:30px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end dashboard inner -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>