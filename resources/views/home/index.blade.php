<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{getAppName()}}</title>
    <meta name="description"
          content="Provide the power to your co-workers to connect with your community with a modern & powerful chat system with enriching features like real-time messages, media uploads, read receipt, user presence and much more.">
    <meta name="keyword" content="CoreUI,Bootstrap,Admin,Template,InfyOm,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <!-- PWA  -->
    <meta name="theme-color" content="#009ef7"/>
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo-30x30.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{getFaviconUrl()}}">
    <link rel="stylesheet" href="{{ mix('assets/css/bootstrap.min.css') }}">
    <!-- google font -->
    <link href="//fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" rel="stylesheet">
    <!-- font awesome version 4.7 -->
    <link rel="stylesheet" href="{{ mix('assets/css/font-awesome.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ mix('assets/css/landing-page-style.css') }}">
</head>
<body>
<!--header start-->
<header class="header">
    <div class="header__container container d-flex align-items-center">
        <div class="header__logo-brand">
            <img src="{{ getLogoUrl() }}" alt="logo-image" class="header__logo">
            <span class="header__brand-name">{{getAppName()}}</span>
        </div>
        <div class="header__bar">
            <i class="fa fa-bars" aria-hidden="true" id="barIcon"></i>
        </div>
        <div class="header__collapsible ms-auto align-items-center" id="collapsedNav">
            <nav>
                @auth
                    @if (\Auth::check() && \Auth::user()->hasPermissionTo('manage_conversations'))
                        <a href="{{ url('/conversations') }}" class="header__link">{{ __('messages.chat') }}</a>
                    @elseif (\Auth::check())
                        @if(\Auth::user()->getAllPermissions()->count() > 0)
                            @php
                                $url = getPermissionWiseRedirectTo(\Auth::user()->getAllPermissions()->first())
                            @endphp
                            <a href="{{ url($url) }}" class="header__link">{{ __('messages.chat') }}</a>
                        @else
                            <a href="{{ url('/conversations') }}" class="header__link">{{ __('messages.chat') }}</a>
                        @endif
                    @endif
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="header__link">{{ __('messages.login') }}</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="header__link">{{ __('messages.register') }}</a>
                    @endif
                @endauth
            </nav>
        </div>
    </div>
</header>
<!--header over-->
<!--landing section-->
<section class="landing d-flex align-items-center">
    <div class="landing__illustration">
        <img src="{{asset('assets/images/chat-illustrator.png')}}" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <h1 class="landing__heading fw-bolder mb-3">{{ getAppName() }}</h1>
                <div class="landing__sub-heading">{{ __('messages.landing__sub-heading') }}</div>
                <p class="landing__description mt-3">
                    {{ __('messages.landing__description') }}
                </p>
                <a href="/grant-access" class="landing__get-start-btn primary-btn btn text-white">
                    GRANT ACCESS
                </a>
            </div>
            <div class="col-12 landing__responsive-col">
                <img src="{{asset('assets/images/chat-illustrator.png')}}" alt="landing image" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<!--feature section-->
<section class="feature section-spacing-bottom">
    <div class="container">
        <div class="row">
            <div class="feature__box-col col-12 col-sm-6 col-lg-3">
                <div class="feature__box text-center">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <div class="feature__box-title">{{ __('messages.beautiful_design') }}</div>
                    <p class="mt-3">{{ __('messages.beautiful_design_desc') }}</p>
                </div>
            </div>
            <div class="feature__box-col col-12 col-sm-6 col-lg-3">
                <div class="feature__box text-center">
                    <i class="fa fa-comments" aria-hidden="true"></i>
                    <div class="feature__box-title">{{ __('messages.realtime_conversations') }}</div>
                    <p class="mt-3">{{ __('messages.realtime_conversations_desc') }}</p>
                </div>
            </div>
            <div class="feature__box-col  col-sm-6 col-lg-3">
                <div class="feature__box text-center">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <div class="feature__box-title">{{ __('messages.privacy') }}</div>
                    <p class="mt-3">{{ __('messages.privacy_desc') }}</p>
                </div>
            </div>
            <div class="feature__box-col col-12 col-sm-6 col-lg-3">
                <div class="feature__box text-center">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <div class="feature__box-title">{{ __('messages.easy_installation') }}</div>
                    <p class="mt-3">{{ __('messages.easy_installation_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--feature section-->
<!--feature-brief-->
<section class="feature-brief section-spacing-bottom section-spacing-top">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="text-uppercase feature-brief__semi-heading">
                    <i class="fa fa-certificate" aria-hidden="true"></i>{{ __('messages.features') }}
                </div>
                <div class="feature-brief__heading">
                    {{ __('messages.infy_chat_features') }}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.admin_panel_manage_members')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.real_time_massaging')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.1-1_chat')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.group_chat')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.conversation_unread_msg_count')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.private_public_groups')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.open_vs_closed_groups')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.manage_group_members')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.upload_img_doc_aud_vid')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.block_unblock_delete_conversation_msg')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.emoji_abuse_world_filter')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.read_receipt_online_offline')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.last_seen_status_user')}}
                </div>
                <div class="feature-brief__list-item">
                    <i class="fa fa-circle-thin" aria-hidden="true"></i> {{__('messages.home.notification_with_onesignal')}}
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex feature-brief__img-wrapper">
                <img src="{{asset('assets/images/chat-landing2.png')}}" alt="{{ __('messages.infy_chat_features') }}"
                     class="img-fluid mt-auto">
            </div>
        </div>
    </div>
</section>
<!--/feature-brief-->
<!--testimonials-->
<section class="testimonials section-spacing-bottom section-spacing-top">
    <div class="text-center text-uppercase testimonials__section-title">{{ __('messages.testimonials') }}</div>
    <div class="container">
        <div class="testimonials__heading text-center">{{ __('messages.what_customers_say') }}</div>
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="testimonials__box">
                    <div class="testimonials__user-img">
                        <img src="{{asset('assets/images/team-3.jpg')}}" alt="">
                    </div>
                    <div class="testimonials__user-name text-uppercase">
                        {{ __('messages.customer_1') }}
                    </div>
                    <div class="testimonials__user-ratings">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="testimonials__user-comment">
                        {{ __('messages.customer_1_review') }}
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="testimonials__box">
                    <div class="testimonials__user-img">
                        <img src="{{asset('assets/images/team-3.jpg')}}" alt="">
                    </div>
                    <div class="testimonials__user-name text-uppercase">
                        {{ __('messages.customer_2') }}
                    </div>
                    <div class="testimonials__user-ratings">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="testimonials__user-comment">
                        {{ __('messages.customer_2_review') }}
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="testimonials__box">
                    <div class="testimonials__user-img">
                        <img src="{{asset('assets/images/team-3.jpg')}}" alt="">
                    </div>
                    <div class="testimonials__user-name text-uppercase">
                        {{ __('messages.customer_3') }}
                    </div>
                    <div class="testimonials__user-ratings">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="testimonials__user-comment">
                        {{ __('messages.customer_3_review') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/testimonials-->
<!--start-using -->
<section class="start-using-now section-spacing-top section-spacing-bottom">
    <div class="start-using-now__inner section-spacing-top section-spacing-bottom">
        <div class="start-using-now__content">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <h1 class="start-using-now__heading">{{ __('messages.start_using_infychat_now') }}</h1>
                        <p>{{ __('messages.start_using_infychat_now_desc') }}</p>
                        <button class="start-using-now__get-start-btn primary-btn btn text-white">
                            {{ __('messages.get_started') }}
                        </button>
                    </div>
                    <div class="col-12 col-lg-6 d-flex start-using-now__img-wrapper">
                        <img src="{{asset('assets/images/chat-landing1.png')}}" alt="chat image" class="img-fluid mt-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ start-using -->
<!--footer-->
<footer class="footer">
    <div class="footer__container container mt-3">
        <div class="row">
            <div class="col-md-6">
                <h4>{{ __('messages.follow_us') }}</h4>
                <ul>
                    <li>
                        <a href="//twitter.com/infyom" target="_blank">{{ __('messages.twitter') }}</a>
                    </li>
                    <li>
                        <a href="//www.facebook.com/infyom" target="_blank">{{ __('messages.facebook') }}</a>
                    </li>
                    <li>
                        <a href="//in.linkedin.com/company/infyom-technologies"
                           target="_blank">{{ __('messages.linkedin') }}</a>
                    </li>
                    <li>
                        <a href="//github.com/InfyOmLabs" target="_blank">{{ __('messages.github') }}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div>
                    <h4>{{ __('messages.made_with') }} <i class="fa fa-heart"
                                                          data-v-77d216a1=""></i> {{ __('messages.by_infyom_technologies') }}
                    </h4>
                    <p> {{ __('messages.by_infyom_technologies_desc') }} </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyright text-center">
                    <p>Copyright © 2019. <a href="http://www.infyom.com/" target="_blank"><b>{{ getCompanyName() }}</b></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
<!-- script for custom mobile navigation -->
@routes
<script src="{{ asset('sw.js') }}"></script>
<script>
    let barIcon = document.getElementById('barIcon')
    let headerCollapsible = document.getElementById('collapsedNav');

    barIcon.onclick = function () {
        if (headerCollapsible.classList.contains('open')) {
            headerCollapsible.classList.remove('open')
        } else {
            headerCollapsible.className += ' open'
        }
    }
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
</body>
</html>
