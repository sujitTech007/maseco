<!DOCTYPE html>

<html lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light" data-topbar-color="brand">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/assets/admin/images/favicon.ico') }}">

        <!-- Vendor css -->
        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        
        <link href="{{ asset('public/assets/css/admin-login.css') }}" rel="stylesheet" type="text/css">

       
    </head>

    <body>

        
<div class="myaccountPage pt-5 login-page">
    <div class="dashboardForms py-4">
        <form id="login-form" method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="login-form-container customLoginFormBox">
                <div class="login-brand mb-4">
                    <img src="{{ asset('public/assets/images/logo.png') }}" alt="MASECO" class="login-logo">
                    <span class="login-badge">ADMIN PORTAL</span>
                </div>

                <h1 class="text-center mb-2 log">
                    Welcome <span class="login">Back</span>
                </h1>

                <p class="login-subtitle text-center mb-4">
                    Sign in to manage your MASECO workspace.
                </p>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Enter your email"
                        class="form-control"
                        autocomplete="username"
                        required
                    >
                </div>

                <div class="form-group position-relative mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        class="form-control"
                        autocomplete="current-password"
                        required
                    >

                    <span class="toggle-password" onclick="togglePassword()">
                        <i class="ri-eye-line" id="eyeIcon"></i>
                    </span>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember-me">
                        <label class="form-check-label" for="remember-me">
                            Remember Me
                        </label>
                    </div>
                </div>

                <button type="submit" id="submit" class="lab-btn w-100">
                    Submit <i class="ri-arrow-right-line ms-1"></i>
                </button>

                <div class="login-footer text-center mt-4">
                    <span>Powered by</span>
                    <strong>MASECO</strong>
                    <span class="login-footer-dot">•</span>
                    <span>Sustainable Business Solutions</span>
                </div>
            </div>
        </form>
    </div>
</div>




        <script>
            function togglePassword() {
                const passwordInput = document.getElementById("password");
                const eyeIcon = document.getElementById("eyeIcon");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    eyeIcon.classList.remove("ri-eye-line");
                    eyeIcon.classList.add("ri-eye-off-line");
                } else {
                    passwordInput.type = "password";
                    eyeIcon.classList.remove("ri-eye-off-line");
                    eyeIcon.classList.add("ri-eye-line");
                }
            }
        </script>
    </body>
</html>