<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Football - Assessment Application</title>
    <!-- plugins:css -->
    {!! Html::style('admin/vendors/iconfonts/mdi/css/materialdesignicons.css') !!}
    <!-- endinject -->
    <!-- vendor css for this page -->
    @stack('page-specific-css-lib')
    <!-- End vendor css for this page -->
    <!-- inject:css -->
    {!! Html::style('admin/css/shared/style.css') !!}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css') !!}
    <!-- endinject -->
    <!-- Layout style -->
    {!! Html::style('admin/css/demo_1/style.css') !!}
    <!-- Layout style -->
    <link rel="shortcut icon" href="../asssets/images/favicon.ico" />



        <style type="text/css">

        .bootstrap-datetimepicker-widget.dropdown-menu {
            width: 28rem;
        }

        .is-overrequest {
            background-color: yellow !important;
        }
        .is-threshold {
            background-color: orange !important;
        }
        .is-stockout {
            background-color: orangered !important;
        }
        .is-stockout td {
            color: white !important;
        }

        .display-avatar span{
            background-color: blue;
            border: 1px solid red;
            width: 70px;
            height: 70px;
            border-radius: 100%;
            font-size: 45px;
            padding: 0 15px;
        }

        @keyframes ldio-d2abanf8u0n {
          0% { transform: rotate(0deg) }
          50% { transform: rotate(180deg) }
          100% { transform: rotate(360deg) }
        }
        .ldio-d2abanf8u0n div {
          position: absolute;
          animation: ldio-d2abanf8u0n 1.12s linear infinite;
          width: 60px;
          height: 60px;
          top: 20px;
          left: 20px;
          border-radius: 50%;
          box-shadow: 0 4.7px 0 0 #fff;
          transform-origin: 30px 32.35px;
        }
        .loadingio-spinner-eclipse-2hg1v3tsxef {
          width: 30px;
          height: 30px;
          display: inline-block;
          overflow: hidden;
          background: rgba(NaN, NaN, NaN, 0);
        }
        .ldio-d2abanf8u0n {
          width: 100%;
          height: 100%;
          position: relative;
          transform: translateZ(0) scale(0.3);
          backface-visibility: hidden;
          transform-origin: 0 0; /* see note above */
        }
        .ldio-d2abanf8u0n div { box-sizing: content-box; }
        /* generated by https://loading.io/ */
        </style>

</head>

<body class="header-fixed">
    <!-- partial:partials/_header.html -->
    <nav class="t-header">
        <div class="t-header-brand-wrapper">
            <a href="/" class="text-primary mx-auto mt-lg-5">
                {!! Html::image('images/logo/logo.png', 'PAM', array('class' => 'logo')) !!}
                {!! Html::image('images/logo/logo.png', 'PAM', array('class' => 'logo-mini', 'style'=>'width:50px;')) !!}
            </a>
        </div>
        <div class="t-header-content-wrapper">
            <div class="t-header-content">
                <button class="t-header-toggler t-header-mobile-toggler d-block d-lg-none">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="nav ml-auto">
                    <ul class="nav">
                        <li class="d-none" id="notification-global-counter">
                            <a href="{{url('requirement')}}" class="badge badge-success mt-2">
                                <i class="mdi mdi-bell"></i>
                                <span>
                                    0 Requests
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{url('logout')}}">
                                <i class="mdi mdi-logout mdi-1x"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- partial -->
    <div class="page-body">
        <!-- partial:partials/_sidebar.html -->
        <div class="sidebar">
            <div class="user-profile">
                {{-- <div class="display-avatar">
                    <span>E</span>
                </div> --}}
                <div class="info-wrapper">
                    <p class="user-name">{{auth()->guard('admin')->user()->name}}</p>
                    {{--            <h6 class="display-income">$3,400,00</h6>--}}
                </div>
            </div>
            <ul class="navigation-menu">
                <li class="nav-category-divider">MAIN</li>
                <li>
                    <a href="{{url('/')}}">
                        <span class="link-title">Dashboard</span>
                        <i class="mdi mdi-gauge link-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="#teams-nav" data-toggle="collapse" aria-expanded="false">
                    <span class="link-title">Teams</span>
                        <i class="mdi mdi-star-circle link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu @if(request()->path() == 'teams' || request()->path() == 'teams/add'  || request()->path() == 'teams/assign') show @endif" id="teams-nav">
                        <li>
                            <a href="{{url('teams')}}">View All</a>
                        </li>
                        <li>
                            <a href="{{url('teams/add')}}">Add New</a>
                        </li>
                        <li>
                            <a href="{{url('teams/assign')}}">Assign a player</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#players-nav" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Players</span>
                        <i class="mdi mdi-account-multiple link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu @if(request()->path() == 'players' || request()->path() == 'players/add') show @endif" id="players-nav">
                        <li>
                            <a href="{{url('players')}}">View All</a>
                        </li>
                        <li>
                            <a href="{{url('players/add')}}">Add New</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#imports-nav" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Import</span>
                        <i class="mdi mdi-cloud-download link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu @if(request()->path() == 'imports/teams' || request()->path() == 'imports/players') show @endif" id="imports-nav">
                        <li>
                            <a href="{{url('imports', array('teams'))}}">Import Teams</a>
                        </li>
                        <li>
                            <a href="{{url('imports', array('players'))}}">Import Players</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('logs') }}" aria-expanded="false">
                        <span class="link-title">Log</span>
                        <i class="mdi mdi-tumblr-reblog link-icon"></i>
                    </a>
                </li>
            </ul>

        </div>
        <!-- partial -->
        <div class="page-content-wrapper">

            @if(session()->has('message'))
            <div class="alert alert-{{session()->get('message')[0]}} alert-dismissible fade show" role="alert">
                {{ session()->get('message')[1] }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @yield('content')

            <!-- content viewport ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="row">
                    {{-- <div class="col-sm-6 text-center text-sm-right order-sm-1">
                        <ul class="text-gray">
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div> --}}
                    <div class="col-sm-6 text-center text-sm-left mt-3 mt-sm-0">
                        <small class="text-muted d-block">Copyright © {{Carbon::now()->year}} <a
                                href="#" target="_blank">Football</a>. All rights
                            reserved</small>
                        <small class="text-gray mt-2">Handcrafted With Transporter<i
                                class="mdi mdi-heart text-danger"></i></small>
                    </div>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- page content ends -->
    </div>
    <!--page body ends -->
    <!-- SCRIPT LOADING START FORM HERE /////////////-->
    <!-- plugins:js -->
    {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') !!}
    {{-- {!! Html::script('admin/vendors/axios/axios.min.js') !!} --}}
    {!! Html::script('admin/vendors/js/core.js') !!}
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js') !!}
    <!-- endinject -->
    <!-- Vendor Js For This Page-->
    @stack('page-specific-js-lib')
    <!-- Vendor Js For This Page Ends-->
    <!-- build:js -->
    {!! Html::script('admin/js/template.js') !!}
    <!-- endbuild -->

    @stack('page-specific-script')

    <script>
        toastr.options.escapeHtml = true;
        toastr.options.closeButton = true;
        toastr.options.closeHtml = '<button><i class="icon-off"></i></button>';

        @if(request()->session()->get('form-save'))
            toastr.success('OK!', 'Data Saved.')
        @elseif(request()->session()->get('item-delete'))
            toastr.warning('OK!', 'Item Deleted')
        @endif

        @if(session()->get('form-action'))
            toastr.{{ request()->session()->get('form-action')[0] }}('{{ request()->session()->get('form-action')[1] }}')
        @endif

        @if(auth()->check())

            var total_notification = 0;
            var ajax_notification_call = function(initial=false) {
                $.ajax({
                    type: "get",
                    url: "{{url('notifications')}}",
                    // data: sendData, // serializes the form's elements.
                    dataType: 'json',
                    success: function(result) {
                        if( result.status == 'OK' ) {
                            if(!initial){
                                if(total_notification < result.notification_count){
                                    toastr.success('Notification!', 'You have '+(result.notification_count - total_notification)+' new notification');
                                }
                            }
                            total_notification = result.notification_count;
                            if(total_notification){
                                $('#notification-global-counter').removeClass('d-none').find('.badge span').html(total_notification+' Requests');
                            }else{
                                $('#notification-global-counter').addClass('d-none').find('.badge span').html('0 Requests');
                            }
                        }
                    },
                });
            };

            ajax_notification_call('init');
            var interval = 30000;
            setInterval(ajax_notification_call, interval);

        @endif
    </script>


</body>

</html>
