<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page_title }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts ->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->

    <!-- Fontfaces CSS-->
    <link href="{{ asset('dashboard_assets/font-face.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('dashboard_assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard_assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('dashboard_assets/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard_assets/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard_assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">


    <!-- -->
    <!-- <link href="vendor/wow/animate.css" rel="stylesheet" media="all"> -->

    <!-- <link href="vendor/slick/slick.css" rel="stylesheet" media="all"> -->
    <!-- <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all"> -->



    <!-- Main CSS-->
    <link href="{{ asset('dashboard_assets/css/theme.css') }}" rel="stylesheet" media="all">

    <!-- MY CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        .overview-box .icon {

            display: block !important;
        }

        .icon h2 {

            float: right;
            /* margin: 0% 10%; */
            color: whitesmoke;
        }

        .navbar__sub-list li a i {

            margin-right: 5% !important;
        }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <!-- <img src="images/icon/logo.png" alt="CoolAdmin" /> -->
                            THE QUESTION BANK
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub {{Request::is('/','home') ? 'li-active' : '' }}">
                            <a class="js-arrow" href="{{ URL::to('/') }}">
                                <i class="fas fa-tachometer-alt"></i>THE BANK</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-file-text"></i> Question Papers </a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{ Route('all_question_papers') }}"> <i class="fa fa-list-ul"></i> All Question Papers </a>
                                </li>
                                @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin"))
                                <li>
                                    <a href="{{ Route('add_question_paper_form') }}"> <i class="zmdi zmdi-file-plus"></i> Upload Question Paper </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-library"></i> Course Units </a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{ Route('all_course_units') }}"> <i class="fa fa-list-ul"></i> All Course Unites </a>
                                </li>
                                @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin") )
                                <li>
                                    <a href="{{ Route('add_course_unit_form') }}"> <i class="fa fa-plus-square"></i> Register New Course Unit </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-library"></i> Courses </a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{ Route('all_courses') }}"> <i class="fa fa-list-ul"></i> All Courses </a>
                                </li>
                                @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin") )
                                <li>
                                    <a href="{{ Route('add_course_form') }}"> <i class="fa fa-plus-square"></i> Register New Course </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-store"></i>Colleges</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{ Route('all_colleges') }}"> <i class="fa fa-list-ul"></i>All Colleges</a>
                                </li>
                                @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin" ))
                                <li>
                                    <a href="{{ Route('add_college_form') }}"> <i class="fa fa-plus-square"></i> Register New College</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin"))
                        <li class="has-sub {{Request::is('all_users','add_user_form','edit_user_form/*') ? 'active' : '' }}">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-accounts-list"></i> Users</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="{{Request::is('all_users') ? 'active' : '' }}">
                                    <a href="{{ route('all_users') }}"> <i class="fa fa-list-ul"></i> All Users </a>
                                </li>

                                <li class="{{Request::is('add_user_form') ? 'active' : '' }}">
                                    <a href="{{ route('add_user_form') }}"> <i class="zmdi zmdi-account-add"></i> Register New User</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <!-- <img src="images/icon/logo.png" alt="Cool Admin" /> -->
                    THE QUESTION BANK
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="{{Request::is('/','home') ? 'li-active' : '' }}">
                            <a class="js-arrow" href="{{ URL::to('/') }}">
                                <i class="fas fa-tachometer-alt"></i>THE BANK
                            </a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow {{Request::is('all_question_papers','add_question_paper_form','edit_question_paper_form/*') ? 'active' : '' }}" href="#">
                                <i class="zmdi zmdi-file-text"></i> Question Papers </a>
                            <ul class="navbar__sub-list list-unstyled js-sub-list">
                                <li class="{{Request::is('all_question_papers') ? 'active' : '' }}" >
                                    <a href="{{ Route('all_question_papers') }}"> <i class="zmdi zmdi-collection-pdf"></i> All Question Papers</a>
                                </li>
                                @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin"))
                                <li class="{{Request::is('add_question_paper_form') ? 'active' : '' }}">
                                    <a href="{{ Route('add_question_paper_form') }}"> <i class="zmdi zmdi-file-plus"></i> Upload New Question Paper </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow {{Request::is('all_course_units','add_course_unit_form','edit_course_unit_form/*') ? 'active' : '' }}" href="#">
                                <i class="zmdi zmdi-book"></i> Course Units </a>
                            <ul class="navbar__sub-list list-unstyled js-sub-list">
                                <li class="{{Request::is('all_course_units') ? 'active' : '' }}">
                                    <a href="{{route('all_course_units')}}"> <i class="zmdi zmdi-collection-bookmark"></i> All Course Units </a>
                                </li>
                                @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin"))
                                <li class="{{Request::is('add_course_unit_form') ? 'active' : '' }}">
                                    <a href="{{route('add_course_unit_form')}}"> <i class="zmdi zmdi-collection-plus"></i> Register New Course Unit </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow {{Request::is('all_courses','add_course_form','edit_course_form/*') ? 'active' : '' }}" href="#">
                                <i class="zmdi zmdi-library"></i> Courses </a>
                            <ul class="navbar__sub-list list-unstyled js-sub-list">
                                <li class="{{Request::is('all_courses') ? 'active' : '' }}">
                                    <a href="{{route('all_courses')}}"> <i class="zmdi zmdi-collection-text"></i> All Courses </a>
                                </li>
                                @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin"))
                                <li class="{{Request::is('add_course_form') ? 'active' : '' }}">
                                    <a href="{{route('add_course_form')}}"> <i class="fa fa-plus-square"></i> Register New Course </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow {{Request::is('all_colleges','add_college_form','edit_college_form/*') ? 'active' : '' }}" href="#">
                                <i class="zmdi zmdi-store"></i> Colleges</a>
                            <ul class="navbar__sub-list list-unstyled js-sub-list">
                                <li class="{{Request::is('all_colleges') ? 'active' : '' }}">
                                    <a href="{{route('all_colleges')}}"> <i class="fa fa-list-ul"></i> All Colleges </a>
                                </li>
                                @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin"))
                                <li class="{{Request::is('add_college_form') ? 'active' : '' }}">
                                    <a href="{{route('add_college_form')}}"> <i class="fa fa-plus-square"></i> Register New College</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin"))
                        <li class="has-sub">
                            <a class="js-arrow {{Request::is('all_users','add_user_form','edit_user_form/*') ? 'active' : '' }}" href="#">
                                <i class="zmdi zmdi-accounts-list"></i> Users</a>
                            <ul class="navbar__sub-list list-unstyled js-sub-list">
                                <li class="{{Request::is('all_users') ? 'active' : '' }}">
                                    <a href="{{ route('all_users') }}"> <i class="fa fa-list-ul"></i> All Users </a>
                                </li>
                                <li class="{{Request::is('add_user_form') ? 'active' : '' }}">
                                    <a href="{{ route('add_user_form') }}"> <i class="zmdi zmdi-account-add"></i> Register New User</a>
                                </li>

                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
                </i>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <!--header search form-->
                            <!-- <form class="form-header" action="" method="POST">-->
                            <!--    <input class="au-input au-input--md" type="text" name="search" placeholder="Search for datas &amp; reports..." />-->
                            <!--    <button class="au-btn--submit" type="submit">-->
                            <!--        <i class="zmdi zmdi-search"></i>-->
                            <!--    </button>-->
                            <!--</form>-->
                            <!--page title in the header-->
                            <div class="header_page_title">
                                {{ $page_title }}
                            </div>
                            <div class="header-button ml-auto">
                                @guest
                                <nav class="navbar navbar-expand-lg">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav ml-auto my-2 my-lg-0">
                                            @if ($number_of_users != 0)
                                            <li class="nav-item">
                                                <a class="btn btn-outline-primary btn-sm my-2 my-sm-0" href="{{-- route('login') --}}#" data-toggle="modal" data-target="#login_modal">{{ __('Login')}}</a>
                                            </li>
                                            @else
                                            <li class="nav-item">
                                                <a class="btn btn-outline-success btn-sm my-2 my-sm-0" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </nav>
                                @else
                                <div class="noti-wrap">
                                    <!-- <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">1</span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>You have 2 news message</p>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-06.jpg" alt="Michelle Moreno" />
                                                </div>
                                                <div class="content">
                                                    <h6>Michelle Moreno</h6>
                                                    <p>Have sent a photo</p>
                                                    <span class="time">3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-04.jpg" alt="Diane Myers" />
                                                </div>
                                                <div class="content">
                                                    <h6>Diane Myers</h6>
                                                    <p>You are now connected on message</p>
                                                    <span class="time">Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="mess__footer">
                                                <a href="#">View all messages</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <span class="quantity">1</span>
                                        <div class="email-dropdown js-dropdown">
                                            <div class="email__title">
                                                <p>You have 3 New Emails</p>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, 3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-05.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-04.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, April 12,,2018</span>
                                                </div>
                                            </div>
                                            <div class="email__footer">
                                                <a href="#">See all emails</a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p> Notification One </p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Notification two</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p> Notification three </p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="{{ asset('images/icon/avatar-01.jpg') }}" alt="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}" />
                                            {{-- HTML::image('img/stuvi-logo.png', 'alt text', array('class' => 'css-class')) --}}
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}">
                                                {{ Auth::user()->last_name }} {{ Auth::user()->first_name }} </a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{ asset('images/icon/avatar-01.jpg') }}" alt="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"> {{ Auth::user()->last_name }} {{ Auth::user()->first_name }} </a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }} </span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">

                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('edit_user_form' ,['security'=>md5('security'),'user_id'=>Auth::user()->id]) }}" title="Edit Your Account">
                                                        <i class="zmdi zmdi-settings"></i>Edit Your Account</a>
                                                </div>
                                                <!-- <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div> -->
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{-- __('Logout') --}}
                                                    <i class="zmdi zmdi-power"></i>Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        @if (session('please_log_in'))
                        <div class="">
                            <div class="alert alert-warning alert-dismissible session_alerts col-4">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times; </a>
                                <strong> {!! session('please_log_in') !!} </strong>
                            </div>
                        </div>
                        @endif
                        @if (session('info'))
                        <div class="">
                            <div class="alert alert-info alert-dismissible session_alerts col-4">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times; </a>
                                <strong> {!! session('info') !!} </strong>
                            </div>
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="">
                            <div class="alert alert-success alert-dismissible session_alerts col-4">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times; </a>
                                <strong> {!! session('success') !!} </strong>
                            </div>
                        </div>
                        @endif
                        @if (session('warning'))
                        <div class="">
                            <div class="alert alert-warning alert-dismissible session_alerts col-4">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times; </a>
                                <strong> {!! session('warning') !!} </strong>
                            </div>
                        </div>
                        @endif
                        @if (session('no_access'))
                        <div class="">
                            <div class="alert alert-warning alert-dismissible session_alerts col-4">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times; </a>
                                <strong> {!! session('no_access') !!} </strong>
                            </div>
                        </div>
                        @endif

                        @yield('content')
                        <!--//where the content from the different pages goes-->

                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

            <footer class="footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2019 &nbsp;&nbsp; KK - Designs <i class="fa fa-smile"></i> &nbsp;&nbsp; All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- MODALS for registration and logging in -->
    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="first_time_register_modalTitle">LOG IN </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-content">
                        <!-- <div class="login-logo">
                            <a href="#">

                            </a>
                        </div>-->
                        <div class="login-form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full  @error('username') is-invalid @enderror" type="text" name="username" placeholder="Username Here ...." required autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password Here....">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="login-checkbox">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    &nbsp;&nbsp;
                                    <label>
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Log in</button>

                            </form>
                            @if($number_of_users == 0)
                            <div class="">
                                <p>
                                    No accounts created yet ? &nbsp;&nbsp;
                                    <a class="btn btn-outline-success btn-sm" href="{{ route('register') }}">Register Here</a>
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                    <!--<button type="submit" class="btn btn-primary btn-md"> {{ __('Login') }}  </button>-->
                </div>
            </div>
        </div>
    </div>

</body>

<!-- Jquery JS-->
<script src="{{ asset('dashboard_assets/vendor/jquery-3.2.1.min.js') }}"></script>

<!-- Bootstrap JS-->
<script src="{{ asset('dashboard_assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>

<!-- Dependencies JS -->
<script src="{{ asset('dashboard_assets/vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<!-- Main JS-->
<script src="{{ asset('dashboard_assets/js/main.js') }}"></script>

{{-- script to show the name of the file that has been chosen --}}
<script type = "text/javascript">
          $(document).ready(function(){

              $(".custom-file-input").on("change", function() {
              var fileName = $(this).val().split("\\").pop();
              $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
              });

          });
</script>
<!-- Vendor JS      ->
        <script src="vendor/slick/slick.min.js">
        </script>
        <!-- <script src="vendor/wow/wow.min.js"></script> ->


        </script>
        <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendor/counter-up/jquery.counterup.min.js">
        </script>
        <script src="vendor/circle-progress/circle-progress.min.js"></script>

        <script src="vendor/chartjs/Chart.bundle.min.js"></script>
        <script src="vendor/select2/select2.min.js">
        </script> -->

</html>
<!-- end document-->
