
<!DOCTYPE php>

<php lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light" data-topbar-color="brand"><head><meta http-equiv="Content-Type" content="text/php; charset=UTF-8">
    
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

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/admin/js/config.js.download') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/admin/js/chart.js') }}"></script>
</head>

<body>

            <div class="myaccountPage pt-5 login-page">
                <div class="dashboardForms py-3"> 
                    <form id="login-form" method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="login-form-container customLoginFormBox">
                            <h1 class="text-center mb-3 log">Log<span class="login">In</span></h1>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control" required>
                                </div>
                                <div class="form-group position-relative">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" required>
                                    <span class="toggle-password" onclick="togglePassword()">
                                        <i class="ri-eye-line" id="eyeIcon"></i>
                                    </span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember-me">
                                            <label class="form-check-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left pt-3">
                                        <button type="submit" id="submit" class="lab-btn">Submit</button>
                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
               </div>


    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js.download"></script>

    <!-- App js -->
    <script src="assets/js/app.js.download"></script>

    <!-- Apex Chart js -->
    <script src="assets/js/apexcharts.min.js.download"></script>

    <!-- Projects Analytics Dashboard App js -->
    <script src="assets/js/dashboard.js.download"></script>

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
        </body></php>