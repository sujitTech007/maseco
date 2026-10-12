<!DOCTYPE php>

<php lang="en">

  <head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @php
    $metaTitle = 'Maseco | Sustainable Fashion Sourcing & Manufacturing in Canada';
    $metaDescription = 'Maseco empowers Canadian designers to build sustainable fashion businesses with ethical materials, trusted manufacturers and AI-powered design insights.';

    switch (Route::currentRouteName()) {

        case 'home':
            $metaTitle = 'Maseco | Sustainable Fashion Sourcing & Manufacturing in Canada';
            $metaDescription = 'Maseco empowers Canadian designers to build sustainable fashion businesses with ethical materials, trusted manufacturers and AI-powered design insights.';
            break;

        case 'about.us':
            $metaTitle = 'About Maseco | Sustainability-Driven Fashion Solutions';
            $metaDescription = 'Learn how Maseco helps designers with responsible sourcing, ethical manufacturing, recycling innovation and hassle-free logistics from our Markham, Ontario base.';
            break;

        case 'raw.material.supplier':
            $metaTitle = 'Sustainable Raw Material Suppliers | Maseco';
            $metaDescription = 'Browse a database of verified suppliers for ethical, eco-friendly fabrics and raw materials. Reduce your environmental footprint and source smarter with Maseco.';
            break;

        case 'reducing.textiles':
            $metaTitle = 'Reduce Textile Waste in Fashion Production | Maseco';
            $metaDescription = 'Cut textile waste with smarter planning, recycling and R&D innovation. Maseco helps fashion brands lower material waste and build a circular business.';
            break;

        case 'ai.driven.suggestion':
            $metaTitle = 'AI-Driven Fashion Design Suggestions | Maseco';
            $metaDescription = 'Use generative AI to get smart design, material and supplier recommendations. Maseco helps designers make faster, more sustainable decisions.';
            break;

        case 'manufacturer':
            $metaTitle = 'Trusted Apparel & Textile Manufacturers | Maseco';
            $metaDescription = 'Connect with vetted manufacturing partners for seamless production support. Maseco matches designers with reliable, ethical manufacturers across Canada.';
            break;

        case 'post.production.services':
            $metaTitle = 'Post-Production Services for Fashion Brands | Maseco';
            $metaDescription = 'Simplify logistics, admin and fulfillment after production. Maseco\'s post-production services help fashion brands deliver on time and scale with confidence.';
            break;

        case 'subscription.plan':
            $metaTitle = 'Maseco Pricing & Subscription Plans | Free, Premium, Pro';
            $metaDescription = 'Compare Maseco plans: start free, go Premium at $69/month for AI and supplier matchmaking, or choose Pro at $299/month for post-production tools.';
            break;

        case 'listing':
            $metaTitle = 'Sustainable Material Listings | Fabrics & Textiles | Maseco';
            $metaDescription = 'Explore Maseco\'s material listings of sustainable fabrics and textiles. Compare options and find the right supplier for your next fashion collection.';
            break;

        case 'category':
            $metaTitle = 'Textile & Fabric Categories | Maseco';
            $metaDescription = 'Browse fabrics and materials by category, from natural fibers to synthetics and recycled textiles, and find the right match for your design.';
            break;

        case 'contact.us':
            $metaTitle = 'Contact Maseco | Sustainable Fashion Support in Markham, ON';
            $metaDescription = 'Have questions about sourcing, manufacturing or plans? Reach the Maseco team at 8920 Woodbine Ave, Markham, Ontario, or email connect@maseco.ca.';
            break;

        case 'login':
            $metaTitle = 'Login | Maseco';
            $metaDescription = 'Log in to your Maseco account to manage suppliers, materials, subscriptions and your sustainable fashion projects.';
            break;

        case 'sign.up':
            $metaTitle = 'Sign Up Free | Maseco Sustainable Fashion Platform';
            $metaDescription = 'Create your free Maseco account to access supplier listings, sustainable materials and tools built for Canadian fashion designers.';
            break;

        case 'privacy.policy':
            $metaTitle = 'Privacy Policy | Maseco';
            $metaDescription = 'Read how Maseco collects, uses and protects your personal information when you use our sustainable fashion sourcing platform.';
            break;

        case 'terms.condition':
            $metaTitle = 'Terms & Conditions | Maseco';
            $metaDescription = 'Review the terms and conditions for using Maseco\'s website, subscription plans and services.';
            break;

        default:
            break;
    }
@endphp

<title>{!! $metaTitle !!}</title>
<meta name="description" content="{{ $metaDescription }}">
<link rel="canonical" href="{{ url()->current() }}">
<meta name="robots" content="index, follow">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="Maseco">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
 <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
<link rel="stylesheet" href="{{ asset('assets/css/global.css') }}?v={{ time() }}">


    <style>
      /* small styling to mimic your .theme-btn */

      .theme-btn {

        padding: .45rem .9rem;

        border-radius: .35rem;

        border: 1px solid transparent;

        text-decoration: none;

        display: inline-block;

      }



      .theme-btn.bg-transparent {

        background: transparent;

        color: #333;

        border-color: #ccc;

      }



      .theme-btn:not(.bg-transparent) {

        background: #0d6efd;

        color: white;

      }



      /* ensure dropdown is visible above other elements */

      .dropdown-menu {

        z-index: 2000;

      }



      .dropdown-item:hover {

        color: #ffffff;

        background-color: #53b69b;

      }



      .toast-container {

        position: fixed;

        top: 1rem;

        right: 1rem;

        z-index: 9999;

      }
    </style>

  </head>



  <body>

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

    <header class="header-sticky">

      <div class="top-header">

        <div class="container">

          <div class="row d-flex align-items-center justify-content-between">

            <div class="col-md-6">

              <div class="header-contact">

                <ul class="d-flex align-items-center justify-content-start">

                  <li class="pe-5">

                    <a href="tel:+18000016555">

                      <i class="fas fa-phone"></i>

                      <span>+1800-001-6555</span>

                    </a>

                  </li>

                  <li>

                    <a href="mailto:info@peacefulqode.com">

                      <i class="fas fa-envelope"></i>

                      <span>connect@maseco.ca</span>

                    </a>

                  </li>

                </ul>

              </div>

            </div>

            <div class="col-md-6">

              <div class="header-social">

                <ul class="d-flex align-items-center justify-content-end">
                  <li><a href="https://www.facebook.com/masecotech"><i class="fab fa-facebook-f"></i></a></li>

                  <li><a href="https://www.instagram.com/masecotech/"><i class="fab fa-instagram"></i></a></li>

                  <li><a href="https://www.linkedin.com/company/masecotech/"><i class="fab fa-linkedin-in"></i></a></li>



                </ul>

              </div>

            </div>

          </div>

        </div>

      </div>

      <div class="headerNav">

        <div class="container">

          <div class="row">

            <div class="col-lg-12">

              <nav class="navbar navbar-expand">

                <a class="navbar-brand" href="{{ route('home') }}">

                  <img class="logo" src="{{ asset('assets/images/logo.png') }}" alt="Maseco">

                </a>

                <div class="collapse navbar-collapse navigation">

                  <div class="mobile-nav-toggle mobileClose">

                    <i class="fa-solid fa-xmark"></i>

                  </div>

                  <div class="menu-contain">

                    <ul class="navbar-nav">

                      <li class="menu-item {{ request()->routeIs('home') ? 'current-menu-item' : '' }}"
                        data-aos="fade-in">

                        <a href="{{ route('home') }}">Home</a>

                      </li>

                      <li class="menu-item {{ request()->routeIs('about.us') ? 'current-menu-item' : '' }}"
                        data-aos="fade-in">

                        <a href="{{ route('about.us') }}">About Us</a>

                      </li>

                      <li class="menu-item" data-aos="fade-in">

                        <a href="#">Our Services <i class="fa fa-chevron-down submenu-icon"></i></a>

                        <ul class="sub-menu">

                          <li
                            class="menu-item {{ request()->routeIs('raw.material.supplier') ? 'current-menu-item' : '' }}"
                            data-aos="fade-in">

                            <a href="{{ route('raw.material.supplier') }}">Raw material suppliers</a>

                          </li>

                          <li class="menu-item {{ request()->routeIs('reducing.textiles') ? 'current-menu-item' : '' }}"
                            data-aos="fade-in">

                            <a href="{{ route('reducing.textiles') }}">Reducing textiles</a>

                          </li>

                          <li
                            class="menu-item {{ request()->routeIs('ai.driven.suggestion') ? 'current-menu-item' : '' }}"
                            data-aos="fade-in">

                            <a href="{{ route('ai.driven.suggestion') }}">AI Driven suggestions</a>

                          </li>

                          <li class="menu-item {{ request()->routeIs('manufacturer') ? 'current-menu-item' : '' }}"
                            data-aos="fade-in">

                            <a href="{{ route('manufacturer') }}">Manufacturers</a>

                          </li>

                          <li
                            class="menu-item {{ request()->routeIs('post.production.services') ? 'current-menu-item' : '' }}"
                            data-aos="fade-in">

                            <a href="{{ route('post.production.services') }}">post production services</a>

                          </li>



                        </ul>

                      </li>

                      <li class="menu-item {{ request()->routeIs('subscription.plan') ? 'current-menu-item' : '' }}"
                        data-aos="fade-in">

                        <a href="{{ route('subscription.plan') }}">Subscription </a>

                      </li>

                      <li class="menu-item {{ request()->routeIs('listing') ? 'current-menu-item' : '' }}"
                        data-aos="fade-in">

                        <a href="{{ route('listing') }}">Material List</a>

                      </li>



                      <li class="menu-item {{ request()->routeIs('category') ? 'current-menu-item' : '' }}"
                        data-aos="fade-in">

                        <a href="{{ route('category') }}">Category</a>

                      </li>

                      <li class="menu-item {{ request()->routeIs('contact.us') ? 'current-menu-item' : '' }}"
                        data-aos="fade-in">

                        <a href="{{ route('contact.us') }}">Contact</a>

                      </li>

                    </ul>

                  </div>

                </div>

                <div class="toggle-btn d-flex align-items-center">

                  <div class="dropdown">

                    @if(Auth::guard('supplier')->check())

                    <a href="{{ route('seller.dashboard') }}" class="theme-btn bg-transparent">Dashboard</a>

                    @elseif(Auth::guard('manufacturer')->check())

                    <a href="{{ route('manufacturer.dashboard') }}" class="theme-btn bg-transparent">Dashboard</a>

                    @elseif(Auth::check())

                    <a href="{{ route('user.dashboard') }}" class="theme-btn bg-transparent">Dashboard</a>

                    @else

                    <a href="{{ route('login') }}" class="theme-btn bg-transparent">Login</a>
                    <a href="{{ route('sign.up') }}" class="theme-btn bg-transparent">SignUp</a>

                    @endif

                    <div class="mobile-nav-toggle">

                      <span>

                        <i></i>

                        <i></i>

                        <i></i>

                      </span>

                    </div>

                  </div>


              </nav>

            </div>

          </div>

        </div>

      </div>

    </header>