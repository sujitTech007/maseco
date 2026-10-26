<!DOCTYPE html>



<html lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light"
    data-topbar-color="brand">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



        <title>Dashboard</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">

        <meta content="Coderthemes" name="author">



        <!-- App favicon -->

        <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}">



        <!-- Vendor css -->

        <link href="{{ asset('public/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css">



        <!-- App css -->

        <link href="{{ asset('public/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">



        <!-- Icons css -->

        <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('public/assets/css/custom.css') }}" rel="stylesheet" type="text/css">
        @if (Request::is('seller/profile'))
            <link href="{{ asset('public/assets/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
            <link href="{{ asset('public/assets/css/phone-country-code.css') }}" rel="stylesheet" type="text/css">
        @endif



        <!-- Theme Config Js -->

        <script src="{{ asset('public/assets/js/config.js.download') }}"></script>
        <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/chart.js') }}"></script>

    </head>

    <style>
        .toast-container {

            position: fixed;

            top: 1rem;

            right: 1rem;

            z-index: 9999;

        }
    </style>



    <div class="toast-container">

        @if(session('success'))

            <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">

                <div class="d-flex">

                    <div class="toast-body">

                        {{ session('success') }}

                    </div>

                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>

                </div>

            </div>

        @endif

        @if($errors->any())

            <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">

                <div class="d-flex">

                    <div class="toast-body">

                        @foreach($errors->all() as $error)

                            {{ $error }}<br>

                        @endforeach

                    </div>

                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>

                </div>

            </div>

        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            toastElList.forEach(function (toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 3000 // 3000ms = 3 seconds
                });
                toast.show();
            });
        });
    </script>



    <body>





        <div class="wrapper active">



            <!-- Menu -->

            <!-- Sidenav Menu Start -->

            <div class="sidenav-menu show">



                <!-- Brand Logo -->

                <a href="{{ route('home')}}" class="logo">

                    <img src="{{ asset('public/assets/images/logo.png') }}" alt="" height="100">

                </a>



                <!-- Full Sidebar Menu Close Button -->

                <button class="button-close-fullsidebar">

                    <i class="fa-solid fa-xmark align-middle"></i>

                </button>



                <div data-simplebar="init" class="simplebar-scrollable-y">
                    <div class="simplebar-wrapper active" style="margin: 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask show">
                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                <div class="simplebar-content-wrapper active" tabindex="0" role="region"
                                    aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                    <div class="simplebar-content show" style="padding: 0px;">



                                        <!--- Sidenav Menu -->

                                        <ul class="side-nav">

                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">

                                                <a href="{{ route('seller.dashboard') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">

                                                    <span class="menu-icon">
                                                        <script src="https://unpkg.com/lucide@latest"></script>
                                                       <i class="fa-solid fa-gauge-high"></i>

                                                    </span>

                                                    <span class="menu-text"> Dashboard </span>

                                                    <span class="badge bg-danger rounded"></span>

                                                </a>

                                            </li>









                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.material') ? 'active' : '' }}">

                                                <a href="{{ route('seller.material') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.material') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-boxes-stacked"></i>

                                                    </span>

                                                    <span class="menu-text"> Material Management

                                                    </span>

                                                </a>

                                            </li>
                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.material') ? 'active' : '' }}">

                                                <a href="{{ route('seller.material') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.material') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-chart-line"></i>

                                                    </span>

                                                    <span class="menu-text">report

                                                    </span>

                                                </a>

                                            </li>
                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.material') ? 'active' : '' }}">

                                                <a href="{{ route('seller.material') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.material') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-route"></i>
                                                    </span>

                                                    <span class="menu-text">tracking

                                                    </span>

                                                </a>

                                            </li>
                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.material') ? 'active' : '' }}">

                                                <a href="{{ route('seller.material') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.material') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-truck-fast"></i>
                                                    </span>

                                                    <span class="menu-text">shipment

                                                    </span>

                                                </a>

                                            </li>



                                            <li class="side-nav-item {{ request()->routeIs('seller.samples.*') ? 'active' : '' }}"><a href="{{ route('seller.samples.index') }}" class="side-nav-link {{ request()->routeIs('seller.samples.*') ? 'active' : '' }}"><span class="menu-icon"><i class="fa-solid fa-flask"></i></span><span class="menu-text">Manage Samples</span></a></li>

                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.orders') ? 'active' : '' }}">

                                                <a href="{{ route('seller.orders') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.orders') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-cart-shopping"></i>

                                                    </span>

                                                    <span class="menu-text"> Orders

                                                    </span>

                                                </a>

                                            </li>

                                            <!-- <li class="side-nav-item {{ request()->routeIs('seller.plans') ? 'active' : '' }}">

                                                <a href="{{ route('seller.plans') }}" class="side-nav-link {{ request()->routeIs('seller.plans') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#888888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
  <path d="M4 2h12l4 4v16a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"/>
  <line x1="8" y1="10" x2="16" y2="10"/>
  <line x1="8" y1="14" x2="16" y2="14"/>
  <line x1="8" y1="18" x2="12" y2="18"/>
</svg>
</span>

                                                    <span class="menu-text"> Subscription Plans

                                                    </span>

                                                </a>

                                            </li> -->

                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.enquiry') ? 'active' : '' }}">

                                                <a href="{{ route('seller.enquiry') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.enquiry') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-file-lines"></i>

                                                    </span>

                                                    <span class="menu-text"> RFQ

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ request()->routeIs('seller.enquiry') ? 'active' : '' }}">
                                                <a href="{{ route('seller.enquiry') }}#rfqTable" class="side-nav-link {{ request()->routeIs('seller.enquiry') ? 'active' : '' }}" data-chat-notifications>
                                                    <span class="menu-icon"><i class="fa-solid fa-comments"></i>
</span>
                                                    <span class="menu-text">Chat <span class="badge bg-danger rounded-pill ms-1" data-chat-unread-count hidden></span><small class="d-block text-danger" data-chat-unread-sender hidden></small></span>
                                                </a>
                                            </li>

                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.payment') ? 'active' : '' }}">

                                                <a href="{{ route('seller.payment') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.payment') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-money-check-dollar"></i>

                                                    </span>

                                                    <span class="menu-text"> Payment

                                                    </span>

                                                </a>

                                            </li>



                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.plans') ? 'active' : '' }}">

                                                <a href="{{ route('seller.plans') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.plans') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-clipboard-list"></i>

                                                    </span>

                                                    <span class="menu-text"> Plans

                                                    </span>

                                                </a>

                                            </li>



                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.profile') ? 'active' : '' }}">

                                                <a href="{{ route('seller.profile') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.profile') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-circle-user"></i>



                                                    </span>

                                                    <span class="menu-text"> Profile

                                                    </span>

                                                </a>

                                            </li>







                                            <li class="side-nav-item">

                                                <a href="{{ route('seller.logout') }}" class="side-nav-link">

                                                    <span class="menu-icon"><i class="fa-solid fa-right-from-bracket"></i></span>

                                                    <span class="menu-text"> Log Out </span>

                                                </a>

                                            </li>
                                        </ul>





                                        <div class="clearfix"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: 240px; height: 826px;"></div>
                    </div>
                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                    </div>
                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                        <div class="simplebar-scrollbar"
                            style="height: 527px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                    </div>
                </div>

            </div>

            <!-- Sidenav Menu End -->



            <!-- Topbar Start -->



            <header class="app-topbar">

                <div class="page-container topbar-menu">



                    <div class="d-flex align-items-center gap-2">







                        <!-- Sidebar Menu Toggle Button -->

                        <button class="sidenav-toggle-button px-2">

                            <i class="fa-solid fa-bars fs-24"></i>

                        </button>



                        <!-- Horizontal Menu Toggle Button -->

                        <button class="topnav-toggle-button px-2" data-bs-toggle="collapse"
                            data-bs-target="#topnav-menu-content">

                            <i class="fa-solid fa-bars fs-24"></i>

                        </button>



                        <!-- Search for small devices -->

                        <div class="topbar-item d-flex d-xl-none">

                            <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal"
                                type="button">

                                <i class="fa-solid fa-magnifying-glass fs-22"></i>

                            </button>

                        </div>



                        <!-- Button Trigger Search Modal -->



                    </div>







                    <div class="d-flex align-items-center gap-2">

















                        @php

                            $user = Auth::guard('supplier')->user();

                        @endphp



                        <!-- User Dropdown -->

                        <div class="topbar-item nav-user">

                            <div class="dropdown">

                                <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                                    data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">

                                    <i class="fa-solid fa-circle-user me-1 fs-20 align-middle"></i>

                                    <!-- <img src="assets/images/user.png" width="32" class="rounded-circle me-lg-2 d-flex userImage" alt="user-image"> -->

                                    <span class="d-lg-flex flex-column gap-1 d-none">

                                        <span class="fw-semibold">{{ $user->name }}</span>

                                    </span>

                                    <i class="fa-solid fa-chevron-down d-none d-lg-block align-middle ms-2"></i>

                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                    <!-- item-->

                                    <div class="dropdown-header noti-title">

                                        <h6 class="text-overflow m-0">Welcome !</h6>

                                    </div>



                                    <!-- item-->

                                    <a href="{{ route('seller.dashboard') }}" class="dropdown-item">
                                        <i class="fa-solid fa-gauge me-1 fs-16 align-middle"></i>
                                        <span class="align-middle">Dashboard</span>
                                    </a>

                                    <a href="{{ route('seller.material') }}" class="dropdown-item">
                                        <i class="fa-solid fa-box-archive me-1 fs-16 align-middle"></i>
                                        <span class="align-middle">Material Management</span>
                                    </a>

                                    <a href="{{ route('seller.orders') }}" class="dropdown-item">
                                        <i class="fa-solid fa-cart-shopping me-1 fs-16 align-middle"></i>
                                        <span class="align-middle">Orders</span>
                                    </a>

                                    <a href="{{ route('seller.enquiry') }}" class="dropdown-item">
                                        <i class="fa-solid fa-file-circle-question me-1 fs-16 align-middle"></i>
                                        <span class="align-middle">RFQ</span>
                                    </a>

                                    <a href="{{ route('seller.payment') }}" class="dropdown-item">
                                        <i class="fa-solid fa-wallet me-1 fs-16 align-middle"></i>
                                        <span class="align-middle">Payment</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a href="{{ route('seller.profile') }}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user me-1 fs-16 align-middle"></i>
                                        <span class="align-middle">Profile</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a href="{{ route('seller.logout') }}"
                                        class="dropdown-item fw-semibold text-danger">
                                        <i class="fa-solid fa-right-from-bracket me-1 fs-16 align-middle"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>


                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </header>
            @include('chat.partials.notifications')
