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

        <link href="{{ asset('public/assets/seller/css/vendor.min.css') }}" rel="stylesheet" type="text/css">



        <!-- App css -->

        <link href="{{ asset('public/assets/seller/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">



        <!-- Icons css -->

        <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('public/assets/seller/css/custom.css') }}" rel="stylesheet" type="text/css">
        @if (Request::is('seller/profile'))
            <link href="{{ asset('public/assets/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
            <link href="{{ asset('public/assets/css/phone-country-code.css') }}" rel="stylesheet" type="text/css">
        @endif



        <!-- Theme Config Js -->

        <script src="{{ asset('public/assets/js/config.js.download') }}"></script>




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
                                                        <i data-lucide="home"></i>
                                                    </span>

                                                    <span class="menu-text"> Dashboard </span>

                                                    <span class="badge bg-danger rounded"></span>

                                                </a>

                                            </li>









                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.material') ? 'active' : '' }}">

                                                <a href="{{ route('seller.material') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.material') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            height="48" width="48" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                                                            <path d="M16 3v4M8 3v4M2 11h20" />
                                                            <line x1="12" y1="11" x2="12" y2="21" />
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> Material Management

                                                    </span>

                                                </a>

                                            </li>



                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.orders') ? 'active' : '' }}">

                                                <a href="{{ route('seller.orders') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.orders') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">

                                                            <!-- Cart -->
                                                            <circle cx="9" cy="21" r="1"></circle>
                                                            <circle cx="20" cy="21" r="1"></circle>
                                                            <path
                                                                d="M1 1h4l2.6 12.4A2 2 0 0 0 9.6 15h9.8a2 2 0 0 0 1.9-1.4L23 6H6">
                                                            </path>

                                                            <!-- Centered Tick -->
                                                            <path d="M10.5 10.5l2 2l3 -3"></path>
                                                        </svg>
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

                                                    <span class="menu-icon"><svg width="64" height="64"
                                                            viewBox="0 0 24 24" fill="none" stroke="#888888"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                                            <!-- Document shape -->
                                                            <path
                                                                d="M4 2h12l4 4v14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" />
                                                            <!-- Lines on the document -->
                                                            <line x1="8" y1="10" x2="16" y2="10" />
                                                            <line x1="8" y1="14" x2="14" y2="14" />
                                                            <line x1="8" y1="18" x2="12" y2="18" />
                                                            <!-- Magnifying glass handle -->
                                                            <circle cx="18" cy="18" r="3" />
                                                            <line x1="20.5" y1="20.5" x2="22" y2="22" />
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> RFQ

                                                    </span>

                                                </a>

                                            </li>

                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.payment') ? 'active' : '' }}">

                                                <a href="{{ route('seller.payment') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.payment') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 24 24" width="48"
                                                            height="48">

                                                            <path
                                                                d="M2 5C2 3.89543 2.89543 3 4 3H20C21.1046 3 22 3.89543 22 5V19C22 20.1046 21.1046 21 20 21H4C2.89543 21 2 20.1046 2 19V5ZM20 5H4V7H20V5ZM4 19H20V10H4V19ZM6 12H8V14H6V12ZM10 12H12V14H10V12Z" />

                                                        </svg>

                                                    </span>

                                                    <span class="menu-text"> Payment

                                                    </span>

                                                </a>

                                            </li>



                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.plans') ? 'active' : '' }}">

                                                <a href="{{ route('seller.plans') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.plans') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 24 24" width="48"
                                                            height="48">

                                                            <path
                                                                d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z">
                                                            </path>

                                                        </svg>

                                                    </span>

                                                    <span class="menu-text"> Plans

                                                    </span>

                                                </a>

                                            </li>



                                            <li
                                                class="side-nav-item {{ request()->routeIs('seller.profile') ? 'active' : '' }}">

                                                <a href="{{ route('seller.profile') }}"
                                                    class="side-nav-link {{ request()->routeIs('seller.profile') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="64" height="64"
                                                            viewBox="0 0 24 24" fill="none" stroke="#888888"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                                            <!-- Head -->
                                                            <circle cx="12" cy="7" r="5" />
                                                            <!-- Shoulders -->
                                                            <path d="M4 21c0-4 8-4 8-4s8 0 8 4" />
                                                        </svg>


                                                    </span>

                                                    <span class="menu-text"> Profile

                                                    </span>

                                                </a>

                                            </li>







                                            <li class="side-nav-item">

                                                <a href="{{ route('seller.logout') }}" class="side-nav-link">

                                                    <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            data-lucide="share" class="lucide lucide-share">
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
