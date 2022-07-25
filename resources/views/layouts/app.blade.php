<!DOCTYPE html>
<html>
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title') | Santara Chat Group</title>
    {{-- <title>@yield('title') | {{ getAppName() }}</title> --}}
    <meta name="description" content="@yield('title') - {{getAppName()}}">
    <meta name="keyword" content="CoreUI,Bootstrap,Admin,Template,InfyOm,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- PWA  -->
    <meta name="theme-color" content="#009ef7"/>
    <link rel="apple-touch-icon" href="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/favicon.ico">
    {{-- <link rel="apple-touch-icon" href="{{ asset('assets/images/logo-30x30.png') }}"> --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="shortcut icon" type="image/x-icon"
    href="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/favicon.ico">

    <!-- Bootstrap 4.1.3 -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <link rel="stylesheet" href="{{ mix('assets/css/coreui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetime-picker.css') }}"/>
    <link rel="stylesheet" href="{{ mix('assets/css/jquery.toast.min.css') }}">
    <script src="{{ mix('assets/js/jquery.min.js') }}"></script>

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    @if(\App\Helper\Auth::User()->is_subscribed)
        @include('layouts.one_signal')
    @endif

    @livewireStyles
    @routes
    <link rel="stylesheet" href="{{ mix('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/emojionearea.min.css') }}">
    @yield('page_css')
    <link rel="stylesheet" href="{{ mix('assets/css/style.css') }}">
    @yield('css')
    <link rel="stylesheet" href="{{ mix('assets/css/custom-style.css') }}">

<style>
    .card-portofolio {
  border: 1px solid #eee;
}

.category-token {
  color: #292f8d;
  font-size: 1rem;
}

.title-token {
  font-weight: bold;
  color: black;
}

.company-token {
  font-size: 1rem;
  color: #858585;
}

.box-kinerja {
  border: 1px solid #eee;
  padding: 0;
  margin-bottom: 2rem;
}

.title-kinerja {
  padding: 0.7rem 0;
  background-color: #bf2d30 !important;
  color: #fff !important;
  border-color: #bf2d30;
  font-weight: bold;
  text-align: center;
  font-size: 1.2rem;
}

.value-kinerja {
  padding: 1rem 0;
  font-size: 1.5rem;
  text-align: center;
  font-weight: bold;
  color: black;
}

.empty-report {
  text-align: center;
}

.empty-report > img {
  max-width: 40%;
  margin-bottom: 3rem;
  margin-top: 3rem;
}

.card-home-title {
  padding: 1rem 4.5rem;
}

.card-home-title > .title-left > h2 {
  font-size: 2.3rem;
  font-weight: 600;
  color: #000;
  margin-right: 1em;
}

.card-home-title > .flex-div {
  display: flex;
}

.card-home-title > .flex-div > .button-group > label {
  border: 1px solid #bf2d30;
  padding: 6px 12px;
  cursor: pointer;
  color: #bf2d30;
  background-color: #fff;
  transition: all 0.2s;
  border-radius: 15px;
  font-size: 1.1em;
  margin-right: 0.5em;
}

.card-home-title > .flex-div > .button-group > input[name="market"] {
  display: none;
}

.card-home-title
  > .flex-div
  > .button-group
  > input[name="market"]:checked
  + label {
  background-color: #bf2d30;
  color: #fff;
}

.item-portofolio-sukuk {
  border: 1px solid #dadada;
  border-radius: 5px;
  padding: 0.8em;
}

.flex-head {
  display: flex;
}

.company-sukuks {
  width: 70%;
  margin: 0;
  font-size: 0.9em;
}

.label-item-portofolio-sukuk {
  background: #c7971e;
  color: #fff;
  font-weight: 600;
  width: 30%;
  text-align: center;
  height: 21px;
}

.title-sukuk-card {
  margin-top: 0.4em;
  font-weight: 400;
  font-size: 1.1em;
  margin-bottom: 0.2em;
}

.sukuk-id {
  color: #000;
  font-weight: 600;
  margin-bottom: 1.7em;
}

.sukuk-info > h4 {
  margin: 1.2em 0;
}

.title-sukuk-in-table {
  width: 60%;
}

.title-sukuk-in-table > p {
  margin-bottom: 0.4em;
  color: #000;
}

.value-sukuk-in-table {
  width: 40%;
}

.value-sukuk-in-table > p {
  margin-bottom: 0.4em;
  text-align: right;
  color: #000;
}

.item-portofolio {
  border: 1px solid #d4d4d4;
  border-radius: 5px;
}

.head-item-portofolio,
.info-fund-portofolio {
  padding: 0.8em;
  border-bottom: 2px solid #f4f4f4;
}

.head-item-portofolio > .flex-head > p {
  margin: 0;
  color: #292f8d;
  font-size: 0.9em;
  width: 70%;
}

.label-item-portoflio-saham {
  background: #bf2d30;
  color: #fff;
  font-weight: 600;
  width: 30%;
  text-align: center;
  height: 21px;
}

.head-item-portofolio > h4 {
  font-size: 1.4em;
  font-weight: 600;
}

.head-item-portofolio > p {
  font-size: 0.9em;
  color: #858585;
  margin: 0;
}

.title-intable-saham {
  width: 70%;
  color: #000;
}

.value-intable-saham {
  width: 30%;
  color: #000;
  font-weight: 600;
}

.image-item-portofolio {
  padding: 0.8em;
}

.image-item-portofolio > img {
  width: 100%;
  height: 200px;
}

.card-content-sukuk {
  padding: 2em;
}

.sukuk-company {
  margin-top: 2em;
}

.trademark-sukuk {
  margin: 0;
  font-size: 1.1em;
  color: #000;
  font-weight: 400;
}

.code-sukuk {
  margin: 0;
  color: #000;
  font-size: 1.1em;
  font-weight: 600;
}

.info-split-sukuk {
  margin: 2em 0;
}

.item-info-sukuk > p {
  color: #000;
  margin: 0;
  font-size: 0.9em;
}

.item-info-sukuk > h3 {
  font-weight: 600;
  font-size: 2.1em;
}

.sukuk-company > h3 {
  font-weight: 600;
  margin: 0;
}

.sukuk-periode-title {
  margin: 0;
  color: #000;
  font-size: 0.8em;
}

.sukuk-periode-date {
  font-size: 10px;
  padding: 7px;
  border-radius: 4px;
}

.sukuk-table {
  margin-top: 2em;
}

.head-sukuk {
  background: #ededed;
  border-radius: 4px;
  color: #000;
}

@media screen and (max-width: 600px) {
      .title-intable-saham{
        width: 50%;
        color: #000;
      }
      .value-intable-saham {
          width: 50%;
          color: #000;
          font-weight: 600;
      }
    }

</style>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<header class="app-header navbar" style="background-color: #1c1c28">
    <button class="navbar-toggler sidebar-toggler d-lg-none me-auto" type="button" data-toggle="sidebar-show">
        <i class="fa fa-angle-right header-arrow-small" aria-hidden="true"></i>
        <i class="fa fa-chevron-right header-arrow" aria-hidden="true"></i>
    </button>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <i class="fa fa-angle-right header-arrow-small" aria-hidden="true"></i>
        <i class="fa fa-chevron-right header-arrow" aria-hidden="true"></i>
    </button>

    <ul class="nav navbar-nav ms-auto">
        {{--<li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a>
        </li>--}}
        <li class="nav-item dropdown notification">
            <a class="nav-link notification__icon" data-bs-toggle="dropdown" href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
                <span class="totalNotificationCount" data-total_count="0"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right notification__popup">
                <div class="dropdown-header text-center">
                    <div class="header-heading">
                        <strong>{{__('messages.notifications')}}</strong>
                        <span class="totalNotificationCount" data-total_count="0" style="display: none"></span>
                    </div>
                    <div class="header-button">
                        <a href="#" class="read-all-notification">{{__('messages.read_all')}}</a>
                    </div>
                </div>
                <a class="dropdown-item read" id="noNewNotification">
                    {{__('messages.no_notification_yet')}}
                </a>
            </div>
        </li>
        {{-- <li class="dropdown language-menu no-hover me-3">
            <a href="#" class="dropdown-toggle text-success text-decoration-none"
               data-bs-toggle="dropdown" role="button">
                {{ strtoupper(\App\Helper\Internationalization::getCurrentLanguageName()) }}&nbsp;
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-right" role="menu">
                @foreach(getUserLanguages() as $key => $value)
                    <span class="language-item"><a href="javascript:void(0)"  class="changeLanguage dropdown-item"
                                                   data-prefix-value="{{ $key }}">{{ $value }}</a></span>
                @endforeach
            </div>
        </li> --}}
        <li class="nav-item dropdown">
            <a class="nav-link avatar-name" style="margin-right: 10px" data-bs-toggle="dropdown" href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
                <span class="profile-name">{{ (htmlspecialchars_decode(\App\Helper\Auth::user()->name))??'' }}</span>
                <img class="img-avatar" src="{{\App\Helper\Auth::user()->photo_url}}" alt="InfyOm">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center dropdown-text">
                    <strong>{{ __('messages.account') }}</strong>
                </div>
                {{-- <a class="dropdown-item" href="{{ url('/profile') }}">
                    <i class="fa fa-user"></i>{{ __('messages.edit_profile') }}</a>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal"><i
                            class="fa fa-lock"></i>{{ __('messages.change_password') }}</a> --}}
                @if(session('impersonated_by'))
                    <a class="dropdown-item" href="{{ route('impersonate.userLogout') }}">
                        <i class="fa fa-external-link"></i>{{ __('messages.back_to_admin') }}</a>
                @endif
                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#setCustomStatusModal">
                    <i class="fa fa-smile-o"></i>{{ __('messages.set_custom_status') }}</a>
                {{-- <a class="dropdown-item" class="btn btn-default btn-flat"
                   onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>{{ __('messages.logout') }}
                </a> --}}
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    </ul>
</header>
<div class="app-body">
    @include('layouts.sidebar')
    @include('layouts.change_password')
    <main class="main">
        <audio id="notificationSound">
            <source src="{{ getNotificationSound() ? getNotificationSound() : ''}}" type="audio/mp3">
        </audio>
        @yield('content')
        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="portofolio" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id='namaHeader'></h5>
                        <button type="button" class="close" onclick="$('#portofolio').modal('hide');" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-content">
                            <div class="row justify-content-end">
                                <h3 class="mr-1"><i class="icon-wallet success"></i> <span id="totalSaldo"></span>
                                </h3>
                            </div>
                            <div class="row mb-1" id="totalPortofolio">
                            </div>
                            <div class="row" id="emitenPortofolio">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </main>
</div>
@include('chat.templates.notification')
@include('partials.file-upload')
@include('partials.set_custom_status_modal')
<footer style="
background-color: #1c1c28;color:white
" class="app-footer">
    <div class="d-flex justify-content-between w-100">
        <div>
            <a href="https://santara.co.id/">Santara</a>
            <span>Website Ver 5.8.8 - Business Ver 3.6.2 | Copyright &copy; {{date('Y')}} Santara, All rights reserved.</span>
        </div>
        {{-- <span class="text-right">{{ version() }}</span> --}}
    </div>
</footer>
</body>
<!-- jQuery 3.1.1 -->
{{--<script src="{{ mix('assets/js/popper.min.js') }}"></script>--}}
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ mix('assets/js/coreui.min.js') }}"></script>
<script src="{{ mix('assets/js/jquery.toast.min.js') }}"></script>
<script src="{{ mix('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('assets/icheck/icheck.min.js') }}"></script>
<script src="https://www.jsviews.com/download/jsviews.min.js"></script>
<script src="{{ asset('js/emojionearea.js') }}"></script>
<script src="{{ mix('assets/js/emojione.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datetime-picker.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
@yield('page_js')
<script>
    {{--let setLastSeenURL = '{{url('update-last-seen')}}';--}}
    let pusherKey = '{{ config('broadcasting.connections.pusher.key') }}';
    let pusherCluster = '{{ config('broadcasting.connections.pusher.options.cluster') }}';
    let messageDeleteTime = '{{ config('configurable.delete_message_time') }}';
    {{--let changePasswordURL = '{{ url('change-password') }}';--}}
    let baseURL = '{{ url('/') }}';
    let conversationsURL = '{{ route('conversations') }}';
    let notifications = JSON.parse(JSON.stringify({!! json_encode(getNotifications()) !!}));
    let loggedInUserId = '{{\App\Helper\Auth::ID()}}';
    let loggedInUserStatus = '{!! \App\Helper\Auth::user()->userStatus !!}';
    let loggedInUserAdmin = '{!! \App\Helper\Auth::user()->isAdmin() ? "Admin" : "Member" !!}';
    if (loggedInUserStatus != '') {
        loggedInUserStatus = JSON.parse(JSON.stringify({!! \App\Helper\Auth::user()->userStatus !!}));
    }
    {{--let setUserCustomStatusUrl = '{{ route('set-user-status') }}';--}}
    {{--let clearUserCustomStatusUrl = '{{ route('clear-user-status') }}';--}}
    {{--let updateLanguageURL = "{{ url('update-language')}}";--}}
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));
    $(document).ready(function () {
        $('.alert').delay(4000).slideUp(300);
    });
</script>
<script src="{{ mix('assets/js/app.js') }}"></script>
<script src="{{ mix('assets/js/custom.js') }}"></script>
<script src="{{ mix('assets/js/notification.js') }}"></script>
<script src="{{ mix('assets/js/set_user_status.js') }}"></script>
<script src="{{ mix('assets/js/set-user-on-off.js') }}"></script>
<script src="{{mix('assets/js/profile.js')}}"></script>
@livewireScripts
@stack('scripts')
@yield('scripts')

</html>
