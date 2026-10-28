<!DOCTYPE html>
<html lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light" data-topbar-color="brand">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <meta name="description" content="Maseco Admin Dashboard">
    <meta name="author" content="Maseco">
    <!-- App CSS -->
    <link href="{{ asset('public/assets/admin/css/app.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('public/assets/admin/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/admin/css/admin.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet">

    <!-- Profile Page CSS -->
    @if (Request::is('admin/profile'))
        <link href="{{ asset('public/assets/css/bootstrap-select.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/assets/css/phone-country-code.css') }}" rel="stylesheet">
    @endif

    <!-- Theme Configuration -->
    <script src="{{ asset('public/assets/admin/js/config.js.download') }}"></script>
</head>

<body>

<div class="wrapper active">
    <!-- Sidenav Menu Start -->
    <div class="sidenav-menu show">
        <!-- Brand Logo -->

        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('public/assets/images/maseco-logo.png') }}" alt="" style="width: 150px; height: auto;">
        </a>

        <!-- Full Sidebar Menu Close Button -->

        <button class="button-close-fullsidebar">

            <i class="fa-solid fa-xmark align-middle"></i>

        </button>
        
                                <ul class="side-nav">
                                    <li class="side-nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">

                                        <a href="{{ route('admin.dashboard') }}"
                                            class="side-nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-house"></i></span>

                                            <span class="menu-text"> Dashboard </span>

                                            <span class="badge bg-danger rounded"></span>

                                        </a>

                                    </li>



                                    <li class="side-nav-item {{ Route::is('admin.buyer') ? 'active' : '' }}">

                                        <a href="{{ route('admin.buyer') }}"
                                            class="side-nav-link {{ Route::is('admin.buyer') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-user"></i>
                                            </span>

                                            <span class="menu-text">Buyer</span>

                                        </a>

                                    </li>



                                    <li class="side-nav-item {{ Route::is('admin.seller') ? 'active' : '' }}">

                                        <a href="{{ route('admin.seller') }}"
                                            class="side-nav-link {{ Route::is('admin.seller') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-users"></i>
                                            </span>

                                            <span class="menu-text"> Supplier

                                            </span>

                                        </a>

                                    </li>

                                    <li class="side-nav-item {{ Route::is('admin.manufacturer') ? 'active' : '' }}">

                                        <a href="{{ route('admin.manufacturer') }}"
                                            class="side-nav-link {{ Route::is('admin.manufacturer') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-industry"></i>
                                            </span>

                                            <span class="menu-text"> Manufaturer

                                            </span>

                                        </a>

                                    </li>

                                    <li class="side-nav-item {{ Route::is('admin.kyc.*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.kyc.index') }}" class="side-nav-link {{ Route::is('admin.kyc.*') ? 'active' : '' }}">
                                            <span class="menu-icon"><i class="fa-solid fa-id-card"></i></span>
                                            <span class="menu-text">KYC Review</span>
                                        </a>
                                    </li>



                                    <li class="side-nav-item {{ Route::is('admin.category.*') ? 'active' : '' }}">

                                        <a href="{{ route('admin.category.index') }}"
                                            class="side-nav-link {{ Route::is('admin.category.*') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-table-cells-large"></i>
                                            </span>

                                            <span class="menu-text"> Category

                                            </span>

                                        </a>

                                    </li>



                                    <li class="side-nav-item {{ Route::is('admin.material') ? 'active' : '' }}">

                                        <a href="{{ route('admin.material') }}"
                                            class="side-nav-link {{ Route::is('admin.material') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-cubes"></i>
                                            </span>

                                            <span class="menu-text"> Materials

                                            </span>

                                        </a>

                                    </li>
                                    <li class="side-nav-item {{ Route::is('admin.enquiry') ? 'active' : '' }}">

                                        <a href="{{ route('admin.enquiry') }}"
                                            class="side-nav-link {{ Route::is('admin.enquiry') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-message"></i>
                                            </span>

                                            <span class="menu-text"> Enquiry

                                            </span>

                                        </a>

                                    </li>

                                    <li class="side-nav-item {{ Route::is('admin.orders') ? 'active' : '' }}">

                                        <a href="{{ route('admin.orders') }}"
                                            class="side-nav-link {{ Route::is('admin.orders') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-layer-group"></i></span>

                                            <span class="menu-text"> Orders

                                            </span>

                                        </a>

                                    </li>

                                    <li class="side-nav-item {{ Route::is('admin.samples.*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.samples.index') }}" class="side-nav-link {{ Route::is('admin.samples.*') ? 'active' : '' }}">
                                            <span class="menu-icon"><i class="fa-solid fa-flask"></i></span>
                                            <span class="menu-text">Sample Purchases</span>
                                        </a>
                                    </li>

                                    <li class="side-nav-item {{ Route::is('admin.tracking') ? 'active' : '' }}">
                                        <a href="{{ route('admin.tracking') }}"
                                            class="side-nav-link {{ Route::is('admin.tracking') ? 'active' : '' }}">
                                            <span class="menu-icon"><i class="fa-solid fa-truck-fast"></i></span>
                                            <span class="menu-text">Order Tracking</span>
                                        </a>
                                    </li>

                                    <li
                                        class="side-nav-item {{ Route::is('admin.subscription.index') ? 'active' : '' }}">

                                        <a href="{{ route('admin.subscription.index') }}"
                                            class="side-nav-link {{ Route::is('admin.subscription.index') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-rectangle-list"></i>
                                            </span>

                                            <span class="menu-text"> Subscription

                                            </span>

                                        </a>

                                    </li>



                                    <li class="side-nav-item {{ Route::is('admin.payment') ? 'active' : '' }}">

                                        <a href="{{ route('admin.payment') }}"
                                            class="side-nav-link {{ Route::is('admin.payment') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-credit-card"></i>

                                            </span>

                                            <span class="menu-text"> Payment

                                            </span>

                                        </a>

                                    </li>

                                    <li class="side-nav-item {{ Route::is('admin.contact.list') ? 'active' : '' }}">

                                        <a href="{{ route('admin.contact.list') }}"
                                            class="side-nav-link {{ Route::is('admin.contact.list') ? 'active' : '' }}">

                                            <span class="menu-icon">
                                                <i class="fa-solid fa-comment-dots"></i>

                                            </span>

                                            <span class="menu-text"> Contact Us

                                            </span>

                                        </a>

                                    </li>

                                    <li class="side-nav-item {{ Route::is('admin.newsletter.list') ? 'active' : '' }}">

                                        <a href="{{ route('admin.newsletter.list') }}"
                                            class="side-nav-link {{ Route::is('admin.newsletter.list') ? 'active' : '' }}">

                                            <span class="menu-icon"><i class="fa-solid fa-envelope"></i>


                                            </span>

                                            <span class="menu-text"> Newsletter

                                            </span>

                                        </a>

                                    </li>

                                    <li class="side-nav-item">

                                        <a href="{{ route('admin.logout') }}" class="side-nav-link">
                                            <span class="menu-icon"> <i
                                                    class="fa-solid fa-arrow-right-from-bracket"></i></span>

                                            <span class="menu-text"> Log Out </span>

                                        </a>

                                    </li>

                                </ul>



        </div>

    


    <header class="app-topbar">

        <div class=" topbar-menu">

            <div class="d-flex align-items-center gap-2">

                <!-- Sidebar Menu Toggle Button -->

                <button type="button" class="sidenav-toggle-button px-2" aria-label="Toggle sidebar">
                    <i class="fa-solid fa-bars fs-24"></i>
                </button>
            </div>
            <div class="d-flex align-items-center gap-2">

                @if(session('success'))
                <div class="toast-container position-fixed top-0 end-0 p-3">
                    <div class="toast align-items-center text-bg-success border-0 show" role="alert"
                        aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Error Notification -->
                @if($errors->any())
                <div class="toast-container position-fixed top-0 end-0 p-3">
                    <div class="toast align-items-center text-bg-danger border-0 show" role="alert"
                        aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
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
                </div>
                @endif





                <!-- User Dropdown -->

                <div class="topbar-item nav-user">

                    <div class="dropdown">

                        <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                            data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">

                            <img src="{{ asset('public/assets/images/profile-icon.png') }}" width="32"
                                class="rounded-circle me-lg-2 d-flex userImage" alt="user-image">

                            <span class="d-lg-flex flex-column gap-1 d-none">

                                <span class="fw-semibold">{{ auth()->user('admin')->name ?? 'Admin'}}</span>

                            </span>

                            <i class="fa-solid fa-chevron-down d-none d-lg-block align-middle ms-2"></i>

                        </a>

                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->

                            <div class="dropdown-header noti-title">

                                <h6 class="text-overflow m-0">Welcome !</h6>

                            </div>



                            <!-- item-->


                            <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                <i class="fa-solid fa-envelope me-1 fs-16 align-middle"></i>
                                <span class="align-middle">Profile</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="{{ route('admin.logout') }}" class="dropdown-item fw-semibold text-danger">
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
                var toastElList = [].slice.call(document.querySelectorAll('.toast'));
                toastElList.forEach(function(toastEl) {
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                });
            });
        </script>


         <script>
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
</script> 
