<!DOCTYPE html>

<html lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light" data-topbar-color="brand">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.png') }}">
    <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('public/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">
    <link href="{{ asset('public/assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    @if (Request::is('user/profile'))
    <link href="{{ asset('public/assets/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
    @endif
    <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/chart.js') }}"></script>
     <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.10.5/build/css/intlTelInput.css">

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

        <div class="sidenav-menu">



            <!-- Brand Logo -->

            <a href="{{ route('home') }}" class="logo">

                <img src="{{ asset('public/assets/images/logo.png') }}" alt="logo" class="sidebar-collapsed-none">

                <img src="{{ asset('public/assets/images/favicon.png') }}" alt="logo" class="sidebar-collapsed-block">

            </a>



            <!-- Full Sidebar Menu Close Button -->

            <button class="button-close-fullsidebar">

                <i class="fa-solid fa-xmark align-middle"></i>

            </button>




            <ul class="side-nav">

                <li class="side-nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">

                    <a href="{{ route('user.dashboard') }}" class="side-nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">

                        <span class="menu-icon">
                            <script src="https://unpkg.com/lucide@latest"></script>
                           <i class="fa-solid fa-gauge-high"></i>
                        </span>

                        <span class="menu-text"> Dashboard </span>

                        <span class="badge bg-danger rounded"></span>

                    </a>

                </li>

                <!-- <li class="side-nav-item {{ request()->routeIs('user.enquiries') ? 'active' : '' }}">
                <a href="{{ route('user.enquiries') }}" class="side-nav-link {{ request()->routeIs('user.enquiries') ? 'active' : '' }}" data-chat-notifications>
                    <span class="menu-icon"><i class="fa-regular fa-comments"></i></span>
                    <span class="menu-text">Chat <span class="badge bg-danger rounded-pill ms-1" data-chat-unread-count hidden></span><small class="d-block text-danger" data-chat-unread-sender hidden></small></span>
                </a>
            </li> -->

                <li class="side-nav-item {{ request()->routeIs('user.enquiries') ? 'active' : '' }}">

                    <a href="{{ route('user.enquiries') }}" class="side-nav-link {{ request()->routeIs('user.enquiries') ? 'active' : '' }}">

                        <span class="menu-icon"><i class="fa-solid fa-file-lines"></i>
                        </span>

                        <span class="menu-text"> RFQs

                        </span>

                    </a>

                </li>
                <li class="side-nav-item {{ request()->routeIs('user.orders') ? 'active' : '' }}">

                    <a href="{{ route('user.orders') }}" class="side-nav-link {{ request()->routeIs('user.orders') ? 'active' : '' }}">

                        <span class="menu-icon"> <i class="fa-solid fa-cart-shopping"></i>

                        </span>

                        <span class="menu-text"> Orders

                        </span>

                    </a>

                </li>

                <li class="side-nav-item {{ request()->routeIs('user.samples.*') ? 'active' : '' }}">
                    <a href="{{ route('user.samples.orders') }}" class="side-nav-link {{ request()->routeIs('user.samples.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="fa-solid fa-flask"></i></span>
                        <span class="menu-text">Sample Purchases</span>
                    </a>
                </li>




                <!-- <li class="side-nav-item {{ request()->routeIs('user.tracking') ? 'active' : '' }}">

                    <a href="{{ route('user.tracking') }}" class="side-nav-link {{ request()->routeIs('user.tracking') ? 'active' : '' }}">

                        <span class="menu-icon"> <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                                <circle cx="8" cy="21" r="1"></circle>
                                <circle cx="19" cy="21" r="1"></circle>

                                <path d="M1 4h4l2.5 10.5A2 2 0 0 0 9.5 16h9.5a2 2 0 0 0 1.9-1.4L23 7H6"></path>

                                <path d="M11 11.5l1.5 1.5l3 -3"></path>

                            </svg>

                        </span>

                        <span class="menu-text">Order Tracking

                        </span>

                    </a>

                </li> -->


                <li class="side-nav-item {{ request()->routeIs('user.payments') ? 'active' : '' }}">

                    <a href="{{ route('user.payments') }}" class="side-nav-link {{ request()->routeIs('user.payments') ? 'active' : '' }}">

                        <span class="menu-icon"><i class="fa-solid fa-money-check-dollar"></i>
                        </span>

                        <span class="menu-text">Payment

                        </span>

                    </a>

                </li>

                <li class="side-nav-item {{ request()->routeIs('user.subscriptions') ? 'active' : '' }}">

                    <a href="{{ route('user.subscriptions') }}" class="side-nav-link {{ request()->routeIs('user.subscriptions') ? 'active' : '' }}">

                        <span class="menu-icon"><i class="fa-solid fa-clipboard-list"></i>
                        </span>

                        <span class="menu-text"> Purchase Plan

                        </span>

                    </a>

                </li>

                <li class="side-nav-item {{ request()->routeIs('subscription.plan') ? 'active' : '' }}">
                    <a href="{{ route('subscription.plan') }}" class="side-nav-link {{ request()->routeIs('subscription.plan') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="fa-solid fa-credit-card"></i></span>
                        <span class="menu-text">Choose Subscription Plan</span>
                    </a>
                </li>

                <!-- <h5 style="padding-left: 20px;font-size: 14px;font-weight: 300;padding-top: 50px;color: #727272;"> Tools </h5> -->

                <li class="side-nav-item {{ request()->routeIs('user.wishlist') ? 'active' : '' }}">
                    <a href="{{ route('user.wishlist') }}" class="side-nav-link {{ request()->routeIs('user.wishlist') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="fa-solid fa-heart"></i></span><span class="menu-text"> Wishlist </span>
                    </a>
                </li>


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
                <li class="side-nav-item {{ request()->routeIs('user.report') ? 'active' : '' }}">

                    <a href="{{ route('user.report') }}" class="side-nav-link {{ request()->routeIs('user.report') ? 'active' : '' }}">

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

                        <span class="menu-text">Reports

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

        </div>




        <header class="app-topbar">

            <div class="page-container topbar-menu">



                <div class="d-flex align-items-center gap-2">







                    <!-- Sidebar Menu Toggle Button -->

                    <button class="sidenav-toggle-button px-2">

                        <i class="fa-solid fa-bars fs-24"></i>

                    </button>



                    <!-- Horizontal Menu Toggle Button -->

                    <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">

                        <i class="fa-solid fa-bars fs-24"></i>

                    </button>



                    <!-- Search for small devices -->

                    <div class="topbar-item d-flex d-xl-none">

                        <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">

                            <i class="fa-solid fa-magnifying-glass fs-22"></i>

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

                                <a href="{{ route('user.dashboard') }}" class="dropdown-item">
                                    <i class="fa-solid fa-gauge me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Dashboard</span>
                                </a>

                                <a href="{{ route('user.enquiries') }}" class="dropdown-item">
                                    <i class="fa-solid fa-list me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">RFQs</span>
                                </a>

                                <a href="{{ route('user.orders') }}" class="dropdown-item">
                                    <i class="fa-solid fa-cart-shopping me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Orders</span>
                                </a>

                                <a href="{{ route('user.tracking') }}" class="dropdown-item">
                                    <i class="fa-solid fa-truck-fast me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Order Tracking</span>
                                </a>

                                <a href="{{ route('user.payments') }}" class="dropdown-item">
                                    <i class="fa-solid fa-file-invoice-dollar me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Order Payment</span>
                                </a>

                                <a href="{{ route('user.subscriptions') }}" class="dropdown-item">
                                    <i class="fa-solid fa-crown me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Purchase Plan</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <a href="{{ route('user.profile') }}" class="dropdown-item">
                                    <i class="fa-solid fa-circle-user me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Account & Settings</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <a href="{{ route('user.logout') }}" class="dropdown-item fw-semibold text-danger">
                                    <i class="fa-solid fa-right-from-bracket me-1 fs-16 align-middle"></i>
                                    <span class="align-middle">Log Out</span>
                                </a>


                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </header>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggleButtons = document.querySelectorAll('.sidenav-toggle-button');

                toggleButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();

                        document.documentElement.classList.toggle('sidebar-collapsed');

                        const isCollapsed = document.documentElement.classList.contains('sidebar-collapsed');

                        toggleButtons.forEach(function(btn) {
                            btn.setAttribute('aria-expanded', String(!isCollapsed));
                        });

                        console.log('Sidebar collapsed:', isCollapsed);
                    });
                });
            });
        </script>
        @include('chat.partials.notifications')
