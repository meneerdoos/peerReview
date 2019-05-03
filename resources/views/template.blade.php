<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Light Bootstrap Dashboard by Creative Tim</title>
    <script src="@yield('script')"></script>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="/css/progressbar.css">
    <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans' rel='stylesheet' type='text/css'>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="/img/sidebar-4.jpg">

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="https://github.com/meneerdoos" class="simple-text">
                    Peer Review
                </a>
            </div>

            <ul class="nav">
                <li >
                    <a href="/">
                        <i class="fab fa-elementor"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li >
                    <a href="/peerReviews">
                        <i class="fas fa-edit"></i>
                        <p>Peer Reviews </p>
                    </a>
                </li>
                <li >
                    <a href="/lists">
                        <i class="fas fa-list"></i>
                        <p>Peer Reviews Criteria </p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    {{--<a class="navbar-brand" href="#">Dashboard</a>--}}
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p> @yield('title')</p>

                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <div class="col-md-3 dropdown">
                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">
                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                {{--<li>--}}
                                    {{--<a href="/editUser" class="dropdown-toggle" data-toggle="dropdown">--}}
                                        {{--Edit--}}

                                    {{--</a>--}}
                                {{--</li>--}}
                                <li>
                                    <a href="/logout" >
                                        <i class="fas fa-power-off"></i> Logout

                                    </a>
                                </li>

                            </ul>
                </div>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">

                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="https://github.com/meneerdoos">Meneer Doos</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>




<!--   Core JS Files   -->
<script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>


<!--  Charts Plugin -->
{{--<script src="/js/chartist.min.js"></script>--}}

<!--  Notifications Plugin    -->
{{--<script src="/js/bootstrap-notify.js"></script>--}}

<!--  Google Maps Plugin    -->
{{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
{{--<script src="/js/demo.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.0/parsley.js" type="text/javascript"></script>
</body>


</html>
