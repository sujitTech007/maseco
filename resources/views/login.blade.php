
@include('Include.header')

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css">


<main>
    <section class="login-page">
        <div class="login-wrapper">
            <div class="row g-0">

                <!-- Left: MASECO branding -->
                <div class="col-md-6">
                    <div class="login-brand" data-aos="fade-right">

                        <span class="login-eyebrow">WELCOME BACK TO MASECO</span>

                        <h2 class="section-title-h2 mb-2 text-white">
                            Source Better.
                            <span>Build Smarter.</span>
                            Grow Together.
                        </h2>

                        <p class="login-intro">
                            Log in to your MASECO account and connect with
                            suppliers and manufacturers for quality raw
                            materials and smarter sourcing.
                        </p>

                        <div class="login-benefits">

                            <div class="login-benefit">
                                <div class="login-benefit-icon">
                                    <i class="fa fa-cubes" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6>Quality Raw Materials</h6>
                                    <p>Discover materials for your business needs.</p>
                                </div>
                            </div>

                            <div class="login-benefit">
                                <div class="login-benefit-icon">
                                    <i class="fa fa-handshake" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6>Trusted Connections</h6>
                                    <p>Connect with suppliers and manufacturers.</p>
                                </div>
                            </div>

                            <div class="login-benefit">
                                <div class="login-benefit-icon">
                                    <i class="fa fa-leaf" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6>Smarter Sourcing</h6>
                                    <p>Make your sourcing process simpler.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right: Login form -->
                <div class="col-md-6">
                    <div class="login-form-panel" data-aos="fade-left">

                        <div class="login-form-heading">
                            <h1>Login</h1>
                            <p>Log in to access your MASECO account.</p>
                        </div>

                        <form class="verify-gcaptcha login-form"
                              method="POST"
                              action="{{ route('login.submit') }}"
                              id="masecoLoginForm">

                            @csrf

                            <!-- Account type -->
                            <div class="form-group">
                                <label class="login-role-label">Login as:</label>

                                <div class="d-flex login-radio">

                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="user_type"
                                               id="userTypeUser"
                                               value="user"
                                               checked>
                                        <label class="form-check-label"
                                               for="userTypeUser">User</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="user_type"
                                               id="userTypeSupplier"
                                               value="supplier">
                                        <label class="form-check-label"
                                               for="userTypeSupplier">Supplier</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="user_type"
                                               id="userTypeManufacturer"
                                               value="manufacturer">
                                        <label class="form-check-label"
                                               for="userTypeManufacturer">Manufacturer</label>
                                    </div>

                                </div>
                            </div>

                            <!-- Phone number -->
                            <div class="form-group">
                                <fieldset>
                                    <legend>Phone Number</legend>

                                    <input
                                        class="form-control"
                                        id="login_phone"
                                        name="phone"
                                        type="tel"
                                        autocomplete="tel-national"
                                        placeholder="Enter phone number"
                                        required>

                                    <input type="hidden"
                                           name="country_code"
                                           id="login_country_code"
                                           value="+91">
                                </fieldset>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <fieldset>
                                    <legend>Password</legend>

                                    <div class="login-password-wrap">
                                        <input
                                            class="form-control"
                                            id="login-password"
                                            name="password"
                                            type="password"
                                            autocomplete="current-password"
                                            placeholder="Enter your password"
                                            required>

                                        <span
                                            class="fa fa-eye login-password-toggle"
                                            id="loginPasswordToggle"
                                            role="button"
                                            tabindex="0"
                                            aria-label="Show password"
                                            aria-controls="login-password">
                                        </span>
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Forgot password -->
                            <div class="d-flex align-items-center justify-content-end">
                                <a class="login-forgot"
                                   href="{{ route('password.forgot') }}">
                                    Forgot password?
                                </a>
                            </div>

                            <!-- Submit -->
                            <div class="form-group mt-4 mb-0">
                                <button class="login-submit" type="submit">
                                    Login
                                </button>
                            </div>

                            <p class="login-signup">
                                Don't have an account?
                                <a href="{{ route('sign.up') }}">Sign up</a>
                            </p>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

@include('Include.footer')

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // International phone input
    const phoneInput = document.querySelector('#login_phone');
    const countryCodeInput = document.querySelector('#login_country_code');
    const loginForm = document.querySelector('#masecoLoginForm');

    if (phoneInput && countryCodeInput && typeof intlTelInput !== 'undefined') {
        const iti = intlTelInput(phoneInput, {
            initialCountry: 'in',
            separateDialCode: true,
            nationalMode: true,
            countrySearch: true,
            autoPlaceholder: 'polite',
            loadUtils: () => import(
                'https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js'
            )
        });

        function updateCountryCode() {
            const country = iti.getSelectedCountryData();
            countryCodeInput.value = country && country.dialCode
                ? '+' + country.dialCode
                : '+91';
        }

        updateCountryCode();
        phoneInput.addEventListener('countrychange', updateCountryCode);

        loginForm.addEventListener('submit', function () {
            updateCountryCode();
        });
    }

    // Password visibility toggle
    const toggle = document.querySelector('#loginPasswordToggle');
    const password = document.querySelector('#login-password');

    function togglePassword() {
        const isPassword = password.type === 'password';

        password.type = isPassword ? 'text' : 'password';
        toggle.classList.toggle('fa-eye', !isPassword);
        toggle.classList.toggle('fa-eye-slash', isPassword);
        toggle.setAttribute(
            'aria-label',
            isPassword ? 'Hide password' : 'Show password'
        );
    }

    if (toggle && password) {
        toggle.addEventListener('click', togglePassword);

        toggle.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                togglePassword();
            }
        });
    }

    // Initialize AOS only if it has not already been initialized.
    if (typeof AOS !== 'undefined') {
        AOS.init({ duration: 800, once: true });
    }
});
</script>
