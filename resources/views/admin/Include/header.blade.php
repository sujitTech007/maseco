<!DOCTYPE php>



<php lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light" data-topbar-color="brand">

    <head>
        <meta http-equiv="Content-Type" content="text/php; charset=UTF-8">



        <title>Dashboard</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">

        <meta content="Coderthemes" name="author">



        <!-- App favicon -->

        <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">



        <!-- Vendor css -->

        <link href="{{ asset('assets/admin/css/vendor.min.css') }}" rel="stylesheet" type="text/css">



        <!-- App css -->

        <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">



        <!-- Icons css -->

        <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/admin/css/admin.css') }}" rel="stylesheet" type="text/css">



        <!-- Theme Config Js -->

        <script src="{{ asset('assets/admin/js/config.js.download') }}"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">



        <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script src="{{ asset('assets/admin/js/chart.js') }}"></script>

    </head>



    <body>





        <div class="wrapper active">



            <!-- Menu -->

            <!-- Sidenav Menu Start -->

            <div class="sidenav-menu show">



                <!-- Brand Logo -->

                <a href="{{ route('home') }}" class="logo">

                    <img src="{{ asset('assets/images/logo.png') }}" alt="" style="width: 150px; height: auto;">

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
                                            <li class="side-nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">

                                                <a href="{{ route('admin.dashboard') }}" class="side-nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="home" class="lucide lucide-home">
                                                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                                                            <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                        </svg></span>

                                                    <span class="menu-text"> Dashboard </span>

                                                    <span class="badge bg-danger rounded"></span>

                                                </a>

                                            </li>



                                            <li class="side-nav-item {{ Route::is('admin.buyer') ? 'active' : '' }}">

                                                <a href="{{ route('admin.buyer') }}" class="side-nav-link {{ Route::is('admin.buyer') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64" aria-hidden="true">
                                                            <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <circle cx="32" cy="32" r="18" />
                                                                <circle cx="32" cy="32" r="12" fill="none" />
                                                                <path d="M44 20l10-6" />
                                                                <path d="M20 44l-8 6" />
                                                                <path d="M38 26 L46 18" stroke-dasharray="3 3" />
                                                            </g>
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> Designer </span>

                                                </a>

                                            </li>



                                            <li class="side-nav-item {{ Route::is('admin.seller') ? 'active' : '' }}">

                                                <a href="{{ route('admin.seller') }}" class="side-nav-link {{ Route::is('admin.seller') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                            <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                                                            <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
                                                            <path d="M10 6h4"></path>
                                                            <path d="M6.5 10v4"></path>
                                                            <path d="M17.5 10v4"></path>
                                                            <path d="M10 17h4"></path>
                                                            <circle cx="12" cy="12" r="2.2"></circle>
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> Supplier

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.manufacturer') ? 'active' : '' }}">

                                                <a href="{{ route('admin.manufacturer') }}" class="side-nav-link {{ Route::is('admin.manufacturer') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="70" height="70" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">

                                                            <!-- Factory building -->
                                                            <path d="M3 21V10l4 3 4-3v11" />
                                                            <rect x="11" y="14" width="10" height="7" rx="1.5" />

                                                            <!-- Chimneys -->
                                                            <path d="M7 10V6" />
                                                            <path d="M11 10V5" />

                                                            <!-- Smoke -->
                                                            <path d="M7 6c0-1 .8-2 2-2 1.2 0 2 .8 2 1.6" />

                                                            <!-- Conveyor belt -->
                                                            <rect x="4" y="18" width="6" height="2" rx="1" />
                                                            <circle cx="6" cy="20" r="1" />
                                                            <circle cx="9" cy="20" r="1" />
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> Manufaturer

                                                    </span>

                                                </a>

                                            </li>



                                            <li class="side-nav-item {{ Route::is('admin.category.*') ? 'active' : '' }}">

                                                <a href="{{ route('admin.category.index') }}" class="side-nav-link {{ Route::is('admin.category.*') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="70" height="70" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                            <rect x="3" y="3" width="7" height="7" rx="2" />
                                                            <rect x="14" y="3" width="7" height="7" rx="2" />
                                                            <rect x="3" y="14" width="7" height="7" rx="2" />
                                                            <rect x="14" y="14" width="7" height="7" rx="2" />
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> Category

                                                    </span>

                                                </a>

                                            </li>



                                            <li class="side-nav-item {{ Route::is('admin.material') ? 'active' : '' }}">

                                                <a href="{{ route('admin.material') }}" class="side-nav-link {{ Route::is('admin.material') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="70" height="70" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">

                                                            <!-- Fabric roll -->
                                                            <circle cx="7" cy="12" r="3.5" />
                                                            <path d="M10.5 12h9.5" />

                                                            <!-- Roll texture lines -->
                                                            <path d="M6 9.5c1.5 0 2.5 1 2.5 2.5s-1 2.5-2.5 2.5" />
                                                            <path d="M3.5 12h0.1" />
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> Materials

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.orders') ? 'active' : '' }}">

                                                <a href="{{ route('admin.orders') }}" class="side-nav-link {{ Route::is('admin.orders') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                                                            <!-- Cart -->
                                                            <circle cx="9" cy="21" r="1"></circle>
                                                            <circle cx="20" cy="21" r="1"></circle>
                                                            <path d="M1 1h4l2.6 12.4A2 2 0 0 0 9.6 15h9.8a2 2 0 0 0 1.9-1.4L23 6H6"></path>

                                                            <!-- Centered Tick -->
                                                            <path d="M10.5 10.5l2 2l3 -3"></path>
                                                        </svg></span>

                                                    <span class="menu-text"> Orders

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.subscription.index') ? 'active' : '' }}">

                                                <a href="{{ route('admin.subscription.index') }}" class="side-nav-link {{ Route::is('admin.subscription.index') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="70" height="70" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                            <rect x="5" y="3" width="14" height="18" rx="2" />
                                                            <path d="M9 7h6" />
                                                            <path d="M9 11h6" />
                                                            <path d="M9 15h4" />
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> Subscription Plans

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.enquiry') ? 'active' : '' }}">

                                                <a href="{{ route('admin.enquiry') }}" class="side-nav-link {{ Route::is('admin.enquiry') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="70" height="70" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M3 5h18v10H8l-5 4V5z" />
                                                            <path d="M12 8.5c0-.8.6-1.5 1.4-1.5S15 7.7 15 8.5 14.4 10 13.4 10" />
                                                            <circle cx="13.4" cy="13" r="1" />
                                                        </svg>
                                                    </span>

                                                    <span class="menu-text"> Enquiry

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.payment') ? 'active' : '' }}">

                                                <a href="{{ route('admin.payment') }}" class="side-nav-link {{ Route::is('admin.payment') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="48" height="48">

                                                            <path d="M2 5C2 3.89543 2.89543 3 4 3H20C21.1046 3 22 3.89543 22 5V19C22 20.1046 21.1046 21 20 21H4C2.89543 21 2 20.1046 2 19V5ZM20 5H4V7H20V5ZM4 19H20V10H4V19ZM6 12H8V14H6V12ZM10 12H12V14H10V12Z" />

                                                        </svg>

                                                    </span>

                                                    <span class="menu-text"> Payment

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.contact.list') ? 'active' : '' }}">

                                                <a href="{{ route('admin.contact.list') }}" class="side-nav-link {{ Route::is('admin.contact.list') ? 'active' : '' }}">

                                                    <span class="menu-icon">
                                                        <svg width="70" height="70" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M4 3h16v14H7l-3 4V3z" />
                                                            <path d="M8 7h8" />
                                                            <path d="M8 11h5" />
                                                        </svg>

                                                    </span>

                                                    <span class="menu-text"> Contact Us

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.newsletter.list') ? 'active' : '' }}">

                                                <a href="{{ route('admin.newsletter.list') }}" class="side-nav-link {{ Route::is('admin.newsletter.list') ? 'active' : '' }}">

                                                    <span class="menu-icon"><svg width="70" height="70" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                            <rect x="3" y="5" width="18" height="14" rx="2" />
                                                            <path d="M3 8l9 6 9-6" />
                                                        </svg>


                                                    </span>

                                                    <span class="menu-text"> Newsletter

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item">

                                                <a href="{{ route('admin.logout') }}" class="side-nav-link">
                                                    <span class="menu-icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="share" class="lucide lucide-share">
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


            <header class="app-topbar">

                <div class=" topbar-menu">

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

                        @if(session('success'))
                        <div class="toast-container position-fixed top-0 end-0 p-3">
                            <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        {{ session('success') }}
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Error Notification -->
                        @if($errors->any())
                        <div class="toast-container position-fixed top-0 end-0 p-3">
                            <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        @foreach($errors->all() as $error)
                                        {{ $error }}<br>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        @endif





                        <!-- User Dropdown -->

                        <div class="topbar-item nav-user">

                            <div class="dropdown">

                                <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown" data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">

                                    <img src="{{ asset('assets/images/user-image.jfif') }}" width="32" class="rounded-circle me-lg-2 d-flex userImage" alt="user-image">

                                    <span class="d-lg-flex flex-column gap-1 d-none">

                                        <span class="fw-semibold">{{ auth()->user('admin')->name ?? 'Admin'}}</span>

                                    </span>

                                    <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-2"></i>

                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                    <!-- item-->

                                    <div class="dropdown-header noti-title">

                                        <h6 class="text-overflow m-0">Welcome !</h6>

                                    </div>



                                    <!-- item-->

                                   <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
    <i class="ri-dashboard-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Dashboard</span>
</a>

<a href="{{ route('admin.buyer') }}" class="dropdown-item">
    <i class="ri-user-search-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Designer</span>
</a>

<a href="{{ route('admin.seller') }}" class="dropdown-item">
    <i class="ri-store-2-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Supplier</span>
</a>

<a href="{{ route('admin.manufacturer') }}" class="dropdown-item">
    <i class="ri-building-4-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Manufacturer</span>
</a>

<a href="{{ route('admin.category.index') }}" class="dropdown-item">
    <i class="ri-grid-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Category</span>
</a>

<a href="{{ route('admin.material') }}" class="dropdown-item">
    <i class="ri-stack-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Materials</span>
</a>

<a href="{{ route('admin.orders') }}" class="dropdown-item">
    <i class="ri-shopping-cart-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Orders</span>
</a>

<a href="{{ route('admin.subscription.index') }}" class="dropdown-item">
    <i class="ri-vip-crown-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Subscription Plans</span>
</a>

<a href="{{ route('admin.enquiry') }}" class="dropdown-item">
    <i class="ri-question-answer-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Enquiry</span>
</a>

<a href="{{ route('admin.payment') }}" class="dropdown-item">
    <i class="ri-secure-payment-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Payment</span>
</a>

<a href="{{ route('admin.contact.list') }}" class="dropdown-item">
    <i class="ri-contacts-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Contact Us</span>
</a>

<a href="{{ route('admin.newsletter.list') }}" class="dropdown-item">
    <i class="ri-mail-line me-1 fs-16 align-middle"></i>
    <span class="align-middle">Newsletter</span>
</a>

<div class="dropdown-divider"></div>

<a href="{{ route('admin.logout') }}" class="dropdown-item fw-semibold text-danger">
    <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
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
                    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
                    toastElList.forEach(function(toastEl) {
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    });
                });
            </script>
          
      