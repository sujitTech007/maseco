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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">



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

                                                    <span class="menu-icon"><i class="fa-solid fa-house"></i></span>

                                                    <span class="menu-text"> Dashboard </span>

                                                    <span class="badge bg-danger rounded"></span>

                                                </a>

                                            </li>



                                            <li class="side-nav-item {{ Route::is('admin.buyer') ? 'active' : '' }}">

                                                <a href="{{ route('admin.buyer') }}" class="side-nav-link {{ Route::is('admin.buyer') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-user"></i>
                                                    </span>

                                                    <span class="menu-text">Buyer</span>

                                                </a>

                                            </li>



                                            <li class="side-nav-item {{ Route::is('admin.seller') ? 'active' : '' }}">

                                                <a href="{{ route('admin.seller') }}" class="side-nav-link {{ Route::is('admin.seller') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-users"></i>
                                                    </span>

                                                    <span class="menu-text"> Supplier

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.manufacturer') ? 'active' : '' }}">

                                                <a href="{{ route('admin.manufacturer') }}" class="side-nav-link {{ Route::is('admin.manufacturer') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-industry"></i>
                                                    </span>

                                                    <span class="menu-text"> Manufaturer

                                                    </span>

                                                </a>

                                            </li>



                                            <li class="side-nav-item {{ Route::is('admin.category.*') ? 'active' : '' }}">

                                                <a href="{{ route('admin.category.index') }}" class="side-nav-link {{ Route::is('admin.category.*') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-table-cells-large"></i>
                                                    </span>

                                                    <span class="menu-text"> Category

                                                    </span>

                                                </a>

                                            </li>



                                            <li class="side-nav-item {{ Route::is('admin.material') ? 'active' : '' }}">

                                                <a href="{{ route('admin.material') }}" class="side-nav-link {{ Route::is('admin.material') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-layer-group"></i>
                                                    </span>

                                                    <span class="menu-text"> Materials

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.orders') ? 'active' : '' }}">

                                                <a href="{{ route('admin.orders') }}" class="side-nav-link {{ Route::is('admin.orders') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-layer-group"></i></span>

                                                    <span class="menu-text"> Orders

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.subscription.index') ? 'active' : '' }}">

                                                <a href="{{ route('admin.subscription.index') }}" class="side-nav-link {{ Route::is('admin.subscription.index') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-rectangle-list"></i>
                                                    </span>

                                                    <span class="menu-text"> Subscription

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.enquiry') ? 'active' : '' }}">

                                                <a href="{{ route('admin.enquiry') }}" class="side-nav-link {{ Route::is('admin.enquiry') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-message"></i>
                                                    </span>

                                                    <span class="menu-text"> Enquiry

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.payment') ? 'active' : '' }}">

                                                <a href="{{ route('admin.payment') }}" class="side-nav-link {{ Route::is('admin.payment') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-credit-card"></i>

                                                    </span>

                                                    <span class="menu-text"> Payment

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.contact.list') ? 'active' : '' }}">

                                                <a href="{{ route('admin.contact.list') }}" class="side-nav-link {{ Route::is('admin.contact.list') ? 'active' : '' }}">

                                                    <span class="menu-icon">
                                                        <i class="fa-solid fa-comment-dots"></i>

                                                    </span>

                                                    <span class="menu-text"> Contact Us

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item {{ Route::is('admin.newsletter.list') ? 'active' : '' }}">

                                                <a href="{{ route('admin.newsletter.list') }}" class="side-nav-link {{ Route::is('admin.newsletter.list') ? 'active' : '' }}">

                                                    <span class="menu-icon"><i class="fa-solid fa-envelope"></i>


                                                    </span>

                                                    <span class="menu-text"> Newsletter

                                                    </span>

                                                </a>

                                            </li>

                                            <li class="side-nav-item">

                                                <a href="{{ route('admin.logout') }}" class="side-nav-link">
                                                    <span class="menu-icon"> <i class="fa-solid fa-arrow-right-from-bracket"></i></span>

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

                        <!-- <button type="button" class="sidenav-toggle-button px-2"
                            aria-label="Toggle sidebar">
                            <i class="ri-menu-2-line fs-24"></i>
                        </button> -->



                        <!-- Horizontal Menu Toggle Button -->

                        <!-- <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">

                            <i class="ri-menu-2-line fs-24"></i>

                        </button> -->



                        <!-- Search for small devices -->

                        <!-- <div class="topbar-item d-flex d-xl-none">

                            <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">

                                <i class="ri-search-line fs-22"></i>

                            </button>

                        </div> -->



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

                                    <img src="{{ asset('assets/images/profile-icon.png') }}" width="32" class="rounded-circle me-lg-2 d-flex userImage" alt="user-image">

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


                                    <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                        <i class="ri-mail-line me-1 fs-16 align-middle"></i>
                                        <span class="align-middle">profile</span>
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


            <!-- <script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleButtons = document.querySelectorAll('.sidenav-toggle-button');

    toggleButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            document.documentElement.classList.toggle('sidebar-collapsed');

            const isCollapsed = document.documentElement.classList.contains('sidebar-collapsed');

            toggleButtons.forEach(function (btn) {
                btn.setAttribute('aria-expanded', String(!isCollapsed));
            });

            console.log('Sidebar collapsed:', isCollapsed);
        });
    });
});
</script> -->