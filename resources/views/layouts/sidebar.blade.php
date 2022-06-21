<div class="sidebar" style="background-color: #1c1c28">
    <nav class="sidebar-nav">
        <div class="d-flex align-items-center justify-content-between mb-3 overflow-hidden sidebar-inner-header">
            <a class="navbar-brand d-flex align-items-center" href="https://santara.co.id/">
                <img class="navbar-brand-minimized me-4" src="https://santara.co.id/public/assets/images/logo-newsantara-ai-putih-merah-l-1-27@2x.png" width="auto" alt="Santara Logo"
                     height="30" alt="{{config('app.name')}}">
                <span class="d-flex">
                    <span class="brand-text" style="font-family: sans-serif;color:white;font-weight: 600;
                    font-size: 24px;">santara</span>
                </span>
            </a>
            <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
                <i class="fa fa-chevron-left toggle-arrow" aria-hidden="true"></i>
                <i class="fa fa-angle-left toggle-arrow-small" aria-hidden="true"></i>
            </button>
        </div>
        <ul class="nav">
            @include('layouts.menu')
        </ul>
    </nav>
{{--    <button class="sidebar-minimizer brand-minimizer" type="button"></button>--}}
</div>
