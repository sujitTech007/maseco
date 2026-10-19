<!DOCTYPE html>



<html lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light" data-topbar-color="brand">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



        <title>Dashboard</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">

        <meta content="Coderthemes" name="author">



        <!-- App favicon -->

        <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}">



        <!-- Vendor css -->

        <link href="{{ asset('public/assets/seller/css/vendor.min.css') }}" rel="stylesheet" type="text/css">



        <!-- App css -->

        <link href="{{ asset('public/assets/seller/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">



        <!-- Icons css -->

        <link href="{{ asset('public/assets/seller/css/icons.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('public/assets/seller/css/custom.css') }}" rel="stylesheet" type="text/css">



        <!-- Theme Config Js -->

        <script src="{{ asset('public/assets/js/config.js.download') }}"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">



        <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



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

        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">

            <div class="d-flex">

                <div class="toast-body">

                    {{ session('success') }}

                </div>

                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>

            </div>

        </div>

        @endif

        @if($errors->any())

        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">

            <div class="d-flex">

                <div class="toast-body">

                    @foreach($errors->all() as $error)

                    {{ $error }}<br>

                    @endforeach

                </div>

                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>

            </div>

        </div>

        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            toastElList.forEach(function(toastEl) {
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

                <a href="{{ route('home') }}" class="logo">

                    <img src="{{ asset('public/assets/images/logo.png') }}" alt="" height="100">

                </a>



                <!-- Full Sidebar Menu Close Button -->

                <button class="button-close-fullsidebar">

                    <i class="ri-close-line align-middle"></i>

                </button>



                <div data-simplebar="init" class="simplebar-scrollable-y">
                    <div class="simplebar-wrapper active" style="margin: 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask show">
                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                <div class="simplebar-content-wrapper active" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                    <div class="simplebar-content show" style="padding: 0px;">



                                        <!--- Sidenav Menu -->

                                        <ul class="side-nav">

                                            <li class="side-nav-item {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">

                                                <a href="{{ route('user.dashboard') }}" class="side-nav-link {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">

                                                    <span class="menu-icon">
                                                        <script src="https://unpkg.com/lucide@latest"></script>
                                                        <i data-lucide="home"></i>
                                                    </span>

                                                    <span class="menu-text"> Dashboard </span>

                                                    <span class="badge bg-danger rounded"></span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ request()->routeIs('user.enquiries') ? 'active' : '' }}">

                                                <a href="{{ route('user.enquiries') }}" class="side-nav-link {{ request()->routeIs('user.enquiries') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="48" height="48">
                                                            <path d="M6 2H14L20 8V22C20 23.1 19.1 24 18 24H6C4.9 24 4 23.1 4 22V2ZM14 3.5V8H18.5L14 3.5ZM6 4V22H18V10H14V4H6ZM8 12H16V14H8V12ZM8 16H14V18H8V16Z" />
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> RFQs

                                                    </span>

                                                </a>

                                            </li>



                                            <li class="side-nav-item {{ request()->routeIs('user.orders') ? 'active' : '' }}">

                                                <a href="{{ route('user.orders') }}" class="side-nav-link {{ request()->routeIs('user.orders') ? 'active' : '' }}">

                                                    <span class="menu-icon"> <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                                                            <!-- Wheels -->
                                                            <circle cx="8" cy="21" r="1"></circle>
                                                            <circle cx="19" cy="21" r="1"></circle>

                                                            <!-- Cart -->
                                                            <path d="M1 4h4l2.5 10.5A2 2 0 0 0 9.5 16h9.5a2 2 0 0 0 1.9-1.4L23 7H6"></path>

                                                            <!-- CENTERED TICK (finally correct) -->
                                                            <path d="M11 11.5l1.5 1.5l3 -3"></path>

                                                        </svg>

                                                    </span>

                                                    <span class="menu-text"> Orders

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ request()->routeIs('user.payments') ? 'active' : '' }}">

                                                <a href="{{ route('user.payments') }}" class="side-nav-link {{ request()->routeIs('user.payments') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">

                                                            <!-- Paper with curved / zigzag bottom -->
                                                            <path d="M6 2h9l4 4v12l-1 1l-1 -1l-1 1l-1 -1l-1 1l-1 -1l-1 1l-1 -1l-1 1l-1 -1l-1 1l-1 -1l-1 1V4a2 2 0 0 1 2-2z"></path>

                                                            <!-- Fold corner -->
                                                            <path d="M15 2v4h4"></path>

                                                            <!-- Lines -->
                                                            <line x1="8" y1="9" x2="16" y2="9"></line>
                                                            <line x1="8" y1="13" x2="16" y2="13"></line>
                                                            <line x1="8" y1="17" x2="14" y2="17"></line>

                                                        </svg>

                                                    </span>

                                                    <span class="menu-text"> Order Payment

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ request()->routeIs('user.subscriptions') ? 'active' : '' }}">

                                                <a href="{{ route('user.subscriptions') }}" class="side-nav-link {{ request()->routeIs('user.subscriptions') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="48" height="48">
                                                            <path d="M6 2L4 6V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V6L18 2H6ZM12 4C13.1 4 14 4.9 14 6H16C16 3.79 14.21 2 12 2C9.79 2 8 3.79 8 6H10C10 4.9 10.9 4 12 4ZM6 8H18V20H6V8Z" />
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> Purchase Plan

                                                    </span>

                                                </a>

                                            </li>

                                            <h5 style="padding-left: 20px;font-size: 14px;font-weight: 300;padding-top: 50px;color: #727272;"> Tools </h5>


                                            <li class="side-nav-item {{ request()->routeIs('user.profile') ? 'active' : '' }}">

                                                <a href="{{ route('user.profile') }}" class="side-nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}">

                                                    <span class="menu-icon"> <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="48" height="48">
                                                            <path d="M19.14,12.94a7.77,7.77,0,0,0,.06-1,7.77,7.77,0,0,0-.06-1l2.11-1.65a.5.5,0,0,0,.12-.63l-2-3.46a.5.5,0,0,0-.6-.22l-2.49,1a7.14,7.14,0,0,0-1.73-1L14.7,2.46a.5.5,0,0,0-.5-.46H9.8a.5.5,0,0,0-.5.46L9,5.05a7.14,7.14,0,0,0-1.73,1l-2.49-1a.5.5,0,0,0-.6.22l-2,3.46a.5.5,0,0,0,.12.63L4.41,10a7.77,7.77,0,0,0-.06,1,7.77,7.77,0,0,0,.06,1L2.3,13.65a.5.5,0,0,0-.12.63l2,3.46a.5.5,0,0,0,.6.22l2.49-1a7.14,7.14,0,0,0,1.73,1l.34,2.59a.5.5,0,0,0,.5.46h4.4a.5.5,0,0,0,.5-.46l.34-2.59a7.14,7.14,0,0,0,1.73-1l2.49,1a.5.5,0,0,0,.6-.22l2-3.46a.5.5,0,0,0-.12-.63ZM12,15.5A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
                                                        </svg>

                                                    </span>

                                                    <span class="menu-text"> Account & Settings

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item">

                                                <a href="{{ route('user.logout') }}" class="side-nav-link">

                                                    <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="share" class="lucide lucide-share">
                                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                                            <polyline points="16 6 12 2 8 6"></polyline>
                                                            <line x1="12" x2="12" y1="2" y2="15"></line>
                                                        </svg></span>

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
                        <div class="simplebar-scrollbar" style="height: 527px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
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

                            <i class="ri-menu-2-line fs-24"></i>

                        </button>



                        <!-- Horizontal Menu Toggle Button -->

                        <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">

                            <i class="ri-menu-2-line fs-24"></i>

                        </button>



                        <!-- Search for small devices -->

                        <div class="topbar-item d-flex d-xl-none">

                            <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">

                                <i class="ri-search-line fs-22"></i>

                            </button>

                        </div>



                        <!-- Button Trigger Search Modal -->



                    </div>

                    <div class="d-flex align-items-center gap-2">

                        @php

                        $user = Auth::user();

                        @endphp



                        <!-- User Dropdown -->

                        <div class="topbar-item nav-user">

                            <div class="dropdown">

                                <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown" data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">

                                    <i class="ri-account-circle-line me-1 fs-20 align-middle"></i>

                                    <!-- <img src="assets/images/user.png" width="32" class="rounded-circle me-lg-2 d-flex userImage" alt="user-image"> -->

                                    <span class="d-lg-flex flex-column gap-1 d-none">

                                        <span class="fw-semibold">{{ $user->name }}</span>

                                    </span>

                                    <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-2"></i>

                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                    <!-- item-->

                                    <div class="dropdown-header noti-title">

                                        <h6 class="text-overflow m-0">Welcome !</h6>

                                    </div>



                                    <!-- item-->

                                    <a href="{{ route('user.dashboard') }}" class="dropdown-item">
    <i class="ri-dashboard-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Dashboard</span>
</a>

<a href="{{ route('user.enquiries') }}" class="dropdown-item">
    <i class="ri-file-list-3-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">RFQs</span>
</a>

<a href="{{ route('user.orders') }}" class="dropdown-item">
    <i class="ri-shopping-cart-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Orders</span>
</a>

<a href="{{ route('user.payments') }}" class="dropdown-item">
    <i class="ri-bill-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Order Payment</span>
</a>

<a href="{{ route('user.subscriptions') }}" class="dropdown-item">
    <i class="ri-vip-crown-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Purchase Plan</span>
</a>

<div class="dropdown-divider"></div>

<a href="{{ route('user.profile') }}" class="dropdown-item">
    <i class="ri-account-circle-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Account & Settings</span>
</a>

<div class="dropdown-divider"></div>

<a href="{{ route('user.logout') }}" class="dropdown-item fw-semibold text-danger">
    <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Log Out</span>
</a>


                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </header>