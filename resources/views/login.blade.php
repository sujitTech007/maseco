
@include('Include.header')

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css">

<style>
    :root {
        --maseco-green: #183d35;
        --maseco-accent: #2DAC92;
        --maseco-light: #f5f8f6;
        --maseco-text: #263b35;
        --maseco-muted: #78857f;
    }

    .login-page {
        padding: 45px 15px;
        background: var(--maseco-light);
        min-height: 85vh;
        display: flex;
        align-items: center;
    }

    .login-wrapper {
        max-width: 1120px;
        width: 100%;
        margin: auto;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 12px 45px rgba(24, 61, 53, .09);
    }

    /* Left branding panel - same style as signup */
    .login-brand {
        height: 100%;
        min-height: 620px;
        padding: 55px 45px;
        background: rgba(45, 172, 146, 1);
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .login-brand::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        right: -150px;
        top: -100px;
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 50%;
        box-shadow: 0 0 0 35px rgba(255,255,255,.025),
                    0 0 0 70px rgba(255,255,255,.02);
    }

    .login-eyebrow {
        display: inline-block;
        color: var(--maseco-accent);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 18px;
    }

    .login-brand h2 {
        color: #fff;
        font-size: clamp(30px, 3vw, 43px);
        line-height: 1.25;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
    }

    .login-brand h2 span {
        color: #fff;
    }

    .login-intro {
        color: rgba(255,255,255,.76);
        font-size: 15px;
        line-height: 1.8;
        max-width: 400px;
        margin-bottom: 32px;
    }

    .login-benefits {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .login-benefit {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        border: 1px solid rgba(255,255,255,.11);
        border-radius: 12px;
        background: rgba(255,255,255,.045);
        transition: .25s ease;
    }

    .login-benefit:hover {
        background: rgba(255,255,255,.09);
        transform: translateX(4px);
    }

    .login-benefit-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(45,172,146,.15);
        color: #fff;
        font-size: 20px;
    }

    .login-benefit h6 {
        color: #fff;
        margin: 0 0 4px;
        font-size: 14px;
        font-weight: 600;
    }

    .login-benefit p {
        color: rgba(255,255,255,.65);
        margin: 0;
        font-size: 12px;
        line-height: 1.5;
    }

    /* Right login form */
    .login-form-panel {
        padding: 55px 48px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-form-heading {
        margin-bottom: 28px;
    }

    .login-form-heading h1 {
        font-size: 32px;
        font-weight: 700;
        color: var(--maseco-green);
        margin-bottom: 8px;
    }

    .login-form-heading p {
        font-size: 14px;
        color: var(--maseco-muted);
        margin: 0;
    }

    .login-form .form-group {
        margin-bottom: 21px;
    }

    .login-form fieldset {
        min-width: 0;
        border: 1px solid #dce5df;
        border-radius: 10px;
        padding: 0 14px 8px;
        margin: 0;
        transition: border-color .2s ease;
    }

    .login-form fieldset:focus-within {
        border-color: var(--maseco-accent);
        box-shadow: 0 0 0 3px rgba(45,172,146,.08);
    }

    .login-form legend {
        float: none;
        width: auto;
        padding: 0 5px;
        margin: 0 0 2px -5px;
        font-size: 12px;
        font-weight: 600;
        color: #52645b;
    }

    .login-form .form-control {
        border: 0 !important;
        box-shadow: none !important;
        background: transparent !important;
        padding: 5px 0;
        color: var(--maseco-text);
        font-size: 14px;
        min-height: 30px;
    }

    .login-form .form-control::placeholder {
        color: #a0aaa4;
    }

    .login-form .form-check-input {
        cursor: pointer;
        accent-color: var(--maseco-accent);
    }

    .login-form .form-check-input:checked {
        background-color: var(--maseco-accent);
        border-color: var(--maseco-accent);
    }

    .login-role-label {
        display: block;
        color: #52645b;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 11px;
    }

    .login-radio {
        flex-wrap: wrap;
        gap: 10px 20px !important;
    }

    .login-radio .form-check {
        padding-left: 1.5em;
        margin: 0;
    }

    .login-radio .form-check-label {
        color: #46584f;
        font-size: 13px;
        cursor: pointer;
    }

    .login-password-wrap {
        position: relative;
    }

    .login-password-wrap .form-control {
        padding-right: 35px;
    }

    .login-password-toggle {
        position: absolute;
        right: 2px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #7c8982;
        padding: 5px;
    }

    .login-password-toggle:hover {
        color: var(--maseco-accent);
    }

    .login-forgot {
        font-size: 13px;
        color: var(--maseco-green);
        text-decoration: none;
        font-weight: 600;
    }

    .login-forgot:hover,
    .login-signup a:hover {
        color: var(--maseco-accent);
    }

    .login-submit {
        background: var(--primary-color);
        border: 1px solid var(--primary-color);
        color: #fff;
        width: 100%;
        padding: 13px 18px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 600;
        transition: .25s ease;
    }

    .login-submit:hover {
        background: var(--maseco-accent);
        border-color: var(--maseco-accent);
        color: #fff;
        transform: translateY(-1px);
    }

    .login-signup {
        color: var(--maseco-muted);
        font-size: 13px;
        text-align: center;
        margin: 22px 0 0;
    }

    .login-signup a {
        color: var(--maseco-green);
        font-weight: 700;
        text-decoration: none;
    }

    /* International phone input */
    .login-form .iti {
        width: 100%;
        display: block;
    }

    .login-form .iti input {
        width: 100%;
    }

    .login-form .iti__country-container {
        padding-bottom: 2px;
    }

    .login-form .iti__selected-country {
        border-radius: 5px;
    }

    .login-form .iti__dropdown-content {
        z-index: 20;
    }

    @media (max-width: 767px) {
        .login-page {
            padding: 25px 12px;
        }

        .login-wrapper {
            border-radius: 15px;
        }

        .login-brand {
            min-height: auto;
            padding: 35px 25px;
        }

        .login-brand h2 {
            font-size: 30px;
        }

        .login-intro {
            margin-bottom: 22px;
        }

        .login-benefits {
            gap: 10px;
        }

        .login-benefit {
            padding: 11px;
        }

        .login-form-panel {
            padding: 35px 24px;
        }

        .login-form-heading h1 {
            font-size: 28px;
        }
    }
    /* Remove blue background from phone input */
.iti input,
.iti input[type="tel"],
.iti input[type="text"] {
    background-color: transparent !important;
    box-shadow: none !important;
}

/* Remove blue background from password input */
input[type="password"],
input[type="password"]:focus {
    background-color: transparent !important;
    box-shadow: none !important;
}

/* Remove browser autofill blue background */
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
    box-shadow: 0 0 0 1000px #ffffff inset !important;
    -webkit-text-fill-color: #183d35 !important;
    transition: background-color 9999s ease-in-out 0s;
}
</style>

<main>
    <section class="login-page">
        <div class="login-wrapper">
            <div class="row g-0">

                <!-- Left: MASECO branding -->
                <div class="col-md-6">
                    <div class="login-brand" data-aos="fade-right">

                        <span class="login-eyebrow">WELCOME BACK TO MASECO</span>

                        <h2>
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
