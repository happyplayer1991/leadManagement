<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Opal CRM</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" rel='stylesheet' type='text/css'>
    <link href="{{ URL::asset('css/all.css') }}" rel="stylesheet" type="text/css">
<!--link rel="stylesheet" href="{{ asset(elixir('css/app.css')) }}"-->
<!--link href="{{ URL::asset('css/material-kit.css')}}" rel="stylesheet" type="text/css"-->
    <link href="{{ URL::asset('css/material-dashboard.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,700" rel="stylesheet">
    <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="company" content="{{Auth::user()->company_id}}" />
<style>
    .dot {
    height: 10px;
    width: 10px;
    background-color: #20b218;
    border-radius: 50%;
    display: inline-block;
}
</style>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TN5NZHV');</script>
    <!-- End Google Tag Manager -->


</head>

<body >

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TN5NZHV"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<div class="wrapper">
    <div class="sidebar" data-active-color="rose" data-background-color="white" >
        <!--
    Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
    Tip 2: you can also add an image using data-image tag
    Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->
    <!--
        <div class="logo">
        @if(Session::get('logo_img') == "")
            <a href="/" class="simple-text logo-mini">
                OC
            </a>
            <a href="/" class="simple-text logo-normal">
                Opal CRM
            </a>
        @else
            <a href="/">
                <img src="{{asset('images/logo/'.Session::get('logo_img'))}}" alt="" onerror="javascript:$(this).hide();">
            </a>
        @endif
        </div>
    -->
        <div class="sidebar-wrapper">
        
            <ul class="nav">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }} {{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ route('pages.dashboard')}}">
                        <i class="material-icons notranslate">track_changes</i>
                        <p>{{ __('Lead Tracking') }}</p>
                    </a>
                </li>
                <li class="{{ Request::is('activities') ? 'active' : null }} ">
                    <a href="{{ route('activities.index')}}">
                        <i class="material-icons notranslate">group_work</i>
                        <p>{{ __('Activities') }}</p>
                    </a>
                </li>
                <li class="{{ Request::is('calendar') ? 'active' : null }} ">
                    <a href="{{ route('calendar.index')}}">
                        <i class="material-icons notranslate">event</i>
                        <p>{{ __('Calendar') }}</p>
                    </a>
                </li>
                <li class="{{ Request::is('leads') ? 'active' : null }} ">
                    <a href="{{ route('leads.index')}}">
                        <i class="material-icons notranslate">group</i>
                        <p>{{ __('My Leads') }}</p>
                    </a>
                </li>
                <li class="{{ Request::is('quotations') ? 'active' : null }}  {{ Request::is('quotations/*') ? 'active' : null }} ">
                    <a href="{{route('quotations.index')}}">
                        <i class="material-icons notranslate">library_books</i>
                        <p>{{ __('Quotations') }}</p>
                    </a>
                </li>
                <li class="{{ Request::is('invoices') ? 'active' : null }}  {{ Request::is('invoices/*') ? 'active' : null }}">
                    <a href="{{route('invoices.index')}}">
                        <i class="material-icons notranslate">insert_drive_file</i>
                        <p>{{ __('Invoices') }}</p>
                    </a>
                </li>
                <li class="{{ Request::is('pipeline') ? 'active' : null }} ">
                    <a href="{{ route('layouts.pipeline')}}">
                        <i class="material-icons notranslate">linear_scale</i>
                        <p>{{ __('Pipeline') }}</p>
                    </a>
                </li>
                @if(Entrust::hasRole('administrator'))
                <li class="{{ Request::is('report') ? 'active' : null }} ">
                    <a href="{{ route('dashboard.dashboard')}}">
                        <i class="material-icons notranslate">poll</i>
                        <p>{{ __('Reports') }}</p>
                    </a>
                </li>
                
                    <li class="{{ Request::is('interestView') ? 'active' : null }} ">
                        <a href="{{route('interestView.interestView')}}">
                            <i class="material-icons notranslate">view_module</i>
                            <p>{{ __('Lead/Product Interest view') }}</p>
                        </a>
                    </li>
                    

                    <!-- <li class="{{ Request::is('sources') ? 'active' : null }} ">
                        <a href="{{ route('sources.index')}}">
                            <i class="material-icons notranslate">cloud</i>
                            <p>{{ __('Possible Leads') }}</p>
                        </a>
                    </li> -->

                    <li class="{{ Request::is('controlpanel') ? 'active' : null }} ">

                        <a href="{{ route('controlpanel.index')}}">
                            <i class="material-icons notranslate">perm_identity</i>
                            <p>{{ __('Control Panel') }}</p>
                        </a>
                    </li>

                    <li class="{{ Request::is('settings') ? 'active' : null }} ">
                        <a href="{{ route('settings.index')}}">
                            <i class="material-icons notranslate">settings</i>
                            <p>{{ __('Settings') }}</p>
                        </a>
                    </li>



                <!--                     <li class="{{ Request::is('report') ? 'active' : null }} ">
                        <a data-toggle="collapse" href="#cpanelChild">
                            <i class="material-icons">perm_data_setting</i>
                            <p> Control Panel
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="cpanelChild">
                            <ul class="nav">
                                <li class="{{ Request::is('users') ? 'active' : null }} ">
                                    <a href="{{ route('users.index')}}">
                                        <i class="material-icons">account_box</i>
                                        <p>{{ __('Users') }}</p>
                                    </a>
                                </li>
                                <li class="{{ Request::is('departments') ? 'active' : null }}">
                                    <a href="{{ route('departments.index')}}">
                                        <i class="material-icons">domain</i>
                                        <span class="sidebar-normal"> Departments </span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#settingsChild">
                                        <i class="material-icons">settings</i>
                                        <p> Settings
                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <div class="collapse" id="settingsChild">
                                        <ul class="nav">
                                            <li class="{{ Request::is('settings') ? 'active' : null }}">
                                                <a href="{{ route('settings.index')}}">
                                                    <span class="sidebar-mini"> OS </span>
                                                    <span class="sidebar-normal"> Overall Settings </span>
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('roles') ? 'active' : null }}">
                                                <a href="{{ route('roles.index')}}">
                                                    <span class="sidebar-mini"> OS </span>
                                                    <span class="sidebar-normal"> Manage Roles </span>
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('products') ? 'active' : null }}">
                                                <a href="{{ route('products.index')}}">
                                                    <span class="sidebar-mini"> P </span>
                                                    <span class="sidebar-normal"> Products </span>
                                                </a>
                                            </li>
                                            <li class="{{ Request::is('integrations') ? 'active' : null }}">
                                                <a href="{{ route('integrations.index')}}">
                                                    <span class="sidebar-mini"> I </span>
                                                    <span class="sidebar-normal"> Integrations </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </li> -->
                @endif

                <li class="menut">
                    <a href="{{ url('/logout') }}" style="cursor: pointer">
                        <p class="text-justify"><i class="material-icons">exit_to_app</i> Sign Out</p>
                        <div class="ripple-container"></div></a>
                </li>
                {{--<li clas="menut">--}}

                        {{--<div id="google_translate_element1" style=""></div><script type="text/javascript">--}}
                            {{--function googleTranslateElementInit() {--}}
                                {{--new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element1');--}}
                            {{--}--}}
                        {{--</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>--}}
                    {{----}}
                {{--</li>--}}
                {{--<li class="menut">--}}

                    {{--<div id="google_translate_element" style="padding-top: 10px;"></div><script type="text/javascript">--}}
                        {{--function googleTranslateElementInit() {--}}
                            {{--new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');--}}
                        {{--}--}}
                    {{--</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>--}}
                {{--</li>--}}
            </ul>
        </div>
        {{--<div class="sidebar-background" style="background-image: url(../assets/img/sidebar-1.jpg) "></div>--}}
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top">
            <div class="container-fluid">

                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end pull-right">

                    <ul class="nav navbar-nav ">
                        <!--li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">dashboard</i>
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li-->

                        <li class="nav-item ">

                                <div id="google_translate_element2" style="padding-top: 10px;"></div><script type="text/javascript">
                                    function googleTranslateElementInit() {
                                        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element2');
                                    }
                                </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

                        </li>
                        <li class="nav-item dropdown">
                            <?php $notifications = auth()->user()->unreadNotifications; ?>

                                <a id="notification-clock" class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer">
                                    <i class="material-icons notranslate">notifications</i>
                                    <span class="notification">{{ $notifications->count() }}</span>
                                    <p class="hidden-lg hidden-md">
                                        Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>

                            <ul class="dropdown-menu dropdown-menu-right" style="width:370px; background-color: #4096ec;">
                                <div class="dropdown-item dropdown-header">
                                    <h4 style="text-align:center;font-weight: 600; color: #ffffff;">Notifications</h4>
                                </div>
                                <div class="dropdown-item" style="overflow-x: hidden; max-height: 400px; overflow-y: scroll">
                                @foreach($notifications as $notification)
                                    <li class="dropdown-item" style="display: block; margin-left: -4px;">
                                        @if ($notification->data['company_id'] == auth()->user()->company_id)
                                        <?php
                                            $array = explode(' ', $notification->data['message']);
                                            switch ($array[0]){
                                                case "Quotation" : $background = '#5cbcb2'; $color='whitesmoke'; $letter = 'Q'; break;
                                                case "Activity" : $background = '#7fc280'; $color='whitesmoke'; $letter = 'A'; break;
                                                case "Product" : $background = '#62c8dc'; $color='whitesmoke'; $letter = 'P'; break;
                                                case "Tax" : $background = 'grey'; $color='whitesmoke'; $letter = 'T'; break;
                                                default : $background = '#8fb16f'; $color='whitesmoke'; $letter = 'L';
                                            }
                                        ?>

                                        <div class="alert" style="top:0px;margin: 2px 4px; background-color: {{$color}}">
                                            <div class="btn  btn-just-icon btn-round" style="    font-size: 14px;color:{{$color}}; background-color: {{$background}}; margin-right: 2%">{{$letter}}</div>
                                            <a href="{{ route('notification.read', ['id' => $notification->id])}}" class="list" onClick="postRead({{$notification->id}})">
                                                <b><span  style="color:{{$background}}; font-weight: 400;">{{ $notification->data['message']}}</span></b>
                                            </a>&nbsp;
                                            <a class="pull-right"  href="{{route('notification.asread', ['id' => $notification->id])}}" onClick="postRead({{$notification->id }})">
                                                <button type="button" class="close-alert" style="color: black; margin-top: 95%">×</button>
                                            </a>
                                        </div>
                                        @endif
                                    </li>
                                @endforeach
                                </div>
                            </ul>
                        </li>
                        <li>
                            <div class="user">
                                <div class="photo text-center">
                                    <i class="material-icons">face</i>
                                </div>
                                <div class="info">
                                    <a data-toggle="collapse" href="#collapseExample" class="collapsed" aria-expanded="false">
                                            <span>
                                                Hello! {{\Auth::user()->name}}
                                                <b class="caret"></b>
                                            </span>
                                    </a>
                                    <div class="clearfix"></div>
                                    <div class="collapse" id="collapseExample" aria-expanded="false" style="height: 0px;">
                                        <ul class="nav">
                                            <li class="{{ Request::is('users/*') ? 'active' : '' }}">
                                                <a href="{{route('users.show', \Auth::id())}}">
                                                    <span class="sidebar-mini"> MP </span>
                                                    <span class="sidebar-normal"> My Profile </span>
                                                </a>
                                            </li>
                                        
                                            <li class="{{ Request::is('users/*/edit') ? 'active' : '' }}">
                                                <a href="{{route('users.edit', \Auth::id())}}">
                                                    <span class="sidebar-mini"> EP </span>
                                                    <span class="sidebar-normal"> Edit Profile </span>
                                                </a>
                                            </li>

                                        
                                        </ul>
                                        
                                    </div>
                                </div>
                            </div>
                        </li>
                        @push('scripts')
                        <script>
                            $('#notification-clock').click(function(e) {
                                e.stopPropagation();
                                $(".menu").toggleClass('bar')
                            });
                            $('body').click(function(e) {
                                if ($('.menu').hasClass('bar')) {
                                $(".menu").toggleClass('bar')
                                }
                            })
                            id = {};
                            function postRead(id) {
                            $.ajax({
                                type: 'post',
                                url: '{{url('/notifications/markread')}}',
                                data: {
                                    id: id,
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            }

                        </script>
                        @endpush

                        <!--li class="">
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="hidden-lg hidden-md">Profile</p>
                                <div class="ripple-container"></div></a>
                        </li-->
                        <li class="nav-item">
                            <a href="{{ url('/logout') }}" style="cursor: pointer">
                                <p class="text-justify"><i class="material-icons">exit_to_app</i> Sign Out</p>
                                <div class="ripple-container"></div></a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>

                    <!--form class="navbar-form navbar-right" role="search">
                        <div class="form-group form-search is-empty">
                            <input type="text" class="form-control" placeholder=" Search ">
                            <span class="material-input"></span>
                            <span class="material-input"></span></div>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </form-->

                </div>
            </div>
        </nav>

        <div class="content">
            @yield('content')
            @if(Session::has('notification_allowed') && Session::get('notification_allowed') == '1')
            <div id="notification">
                <notification></notification>
            </div>
            @endif
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href=" https://kloudportal.com/opalcrm-lead-management-crm-software/" target="_blank">Home</a>
                        </li>
                        <li>
                            <a href="https://kloudportal.com/" target="_blank">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href=" https://kloudportal.com/opalcrm-lead-management-crm-software/" target="_blank">
                                Kloud Pricing
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    © 2018
                    <a href="https://kloudportal.com/"> KloudPortal </a>, All rights reserved.
                </p>
            </div>

        </footer>
        <div class="backdrop"></div>

        <div>
            <input type="submit" class="btn btn-primary fab child" data-subitem="2" action="{{url('activities/create')}}" method="get" id="modal_fade" value="Add Activity">
        </div>
        <div>
            <button type="button" class="btn btn-primary fab child" data-subitem="1" data-toggle="modal" data-target="#create_lead_modal">New Lead</button>
        </div>

        <div class="fab" id="masterfab" style="width: 62px; height: 58px;"><span style="vertical-align: super;">+</span></div>
    </div>

</div>

@include('leads.create')
<div id="modal_window"></div>

@if(Session::has('error_msg'))
    <script type="text/javascript">
        $(document).ready(function () {
            toastr.error('', "{{Session::get('error_msg')}}");
        })
    </script>
@endif
@if(Session::has('success_msg'))
    <script type="text/javascript">
        $(document).ready(function () {
            toastr.success('', "{{Session::get('success_msg')}}");
        })
    </script>
@endif
<script type="text/javascript" src="{{ asset('js/dashboard-vendor.js')}}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js')}}"></script>
@if(Session::has('notification_allowed') && Session::get('notification_allowed') == '1')
<script type="text/javascript" src="{{ asset('js/app.js')}}"></script>
@endif
@stack('scripts')
</body>
</html>

