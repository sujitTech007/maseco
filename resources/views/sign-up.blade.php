
@include('Include.header')
<style>
  
/* ================================
   MASECO SIGNUP PAGE
================================ */

.maseco-signup-page {
    background: #f4f7f5;
    padding: 55px 0;
    min-height: 100vh;
}

.signup-card {
    max-width: 1120px;
    margin: 0 auto;
    background: #fff;
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 18px 65px rgba(20, 55, 38, 0.09);
}

/* Left panel */

.signup-left {
    background: #123d2b;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.signup-left-content {
    min-height: 100%;
    padding: 48px 38px 35px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    position: relative;
    z-index: 1;
}

.signup-left::before {
    content: "";
    position: absolute;
    width: 300px;
    height: 300px;
    right: -150px;
    top: -110px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 50%;
    box-shadow:
        0 0 0 35px rgba(255, 255, 255, 0.025),
        0 0 0 70px rgba(255, 255, 255, 0.025);
}

.signup-brand {
    display: inline-flex;
    align-items: center;
    gap: 11px;
    color: #fff;
    text-decoration: none;
    font-size: 23px;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 55px;
}

.signup-brand:hover {
    color: #fff;
}

.brand-mark {
    width: 40px;
    height: 40px;
    background: #d5edac;
    color: #123d2b;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    font-size: 25px;
    font-weight: 800;
}

.signup-eyebrow,
.form-step-label {
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
}

.signup-eyebrow {
    color: #c6e7a4;
    margin-bottom: 16px;
}

.signup-left h2 {
    color: #fff;
    font-size: clamp(30px, 3vw, 39px);
    line-height: 1.25;
    font-weight: 750;
    margin-bottom: 18px;
    letter-spacing: -0.8px;
}

.signup-left h2 span {
    display: block;
    color: #c6e7a4;
}

.signup-intro {
    color: rgba(255, 255, 255, 0.77);
    font-size: 14px;
    line-height: 1.9;
    margin-bottom: 35px;
    max-width: 360px;
}

.signup-feature {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    margin-bottom: 24px;
    width: 100%;
}

.signup-feature-icon {
    width: 43px;
    height: 43px;
    min-width: 43px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #d5edac;
    background: rgba(255, 255, 255, 0.09);
    border: 1px solid rgba(255, 255, 255, 0.10);
    border-radius: 12px;
    font-size: 17px;
}

.signup-feature h6 {
    font-size: 14px;
    color: #fff;
    font-weight: 700;
    margin: 2px 0 5px;
}

.signup-feature p {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.68);
    line-height: 1.6;
    margin: 0;
}

.signup-left-footer {
    margin-top: auto;
    padding-top: 28px;
    color: rgba(255, 255, 255, 0.7);
    font-size: 11px;
}

.signup-left-footer i {
    color: #c6e7a4;
    margin-right: 7px;
}

/* Right panel */

.signup-right {
    background: #fff;
}

.signup-form-content {
    padding: 44px 50px 35px;
}

.signup-form-heading {
    margin-bottom: 27px;
}

.form-step-label {
    color: #5c8a69;
    display: block;
    margin-bottom: 9px;
    font-size: 10px;
}

.signup-form-heading h1 {
    color: #1b3025;
    font-size: 29px;
    font-weight: 750;
    letter-spacing: -0.7px;
    margin: 0 0 8px;
}

.signup-form-heading p {
    color: #7d8981;
    font-size: 13px;
    line-height: 1.7;
    margin: 0;
}

.signup-alert {
    font-size: 13px;
    border-radius: 10px;
    margin-bottom: 20px;
}

/* Account type */

.account-type-group {
    margin-bottom: 23px !important;
}

.signup-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #33483b;
    margin-bottom: 9px;
}

.account-type-options {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 9px;
}

.account-type-option {
    margin: 0;
    cursor: pointer;
    position: relative;
}

.account-type-option input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.account-type-text {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 7px;
    min-height: 44px;
    padding: 10px 6px;
    border: 1px solid #e1e9e3;
    border-radius: 9px;
    background: #fff;
    color: #526258;
    font-size: 11px;
    font-weight: 650;
    transition: all 0.2s ease;
}

.account-type-text i {
    font-size: 13px;
}

.account-type-option input:checked + .account-type-text {
    border-color: #236b45;
    color: #205a39;
    background: #f0f7f1;
    box-shadow: inset 0 0 0 1px #236b45;
}

.account-type-option input:focus-visible + .account-type-text {
    outline: 2px solid #6ba881;
    outline-offset: 3px;
}

/* Inputs */

.signup-form .form-group {
    margin-bottom: 17px;
    width: 100%;
}

.signup-input-wrap {
    position: relative;
    width: 100%;
}

.signup-input-icon {
    position: absolute;
    top: 50%;
    left: 14px;
    transform: translateY(-50%);
    color: #829187;
    font-size: 14px;
    z-index: 2;
    pointer-events: none;
}

.signup-input,
.signup-phone-input {
    height: 47px;
    width: 100%;
    border: 1px solid #e0e8e2;
    border-radius: 9px;
    background-color: #fbfcfb;
    color: #24382b;
    font-size: 13px;
    padding: 11px 14px;
    box-shadow: none !important;
    transition: border-color 0.2s, background-color 0.2s;
}
form .signup-input,
.signup-input {
    padding-left: 41px;
    padding-right: 43px;
}

.signup-input::placeholder,
.signup-phone-input::placeholder {
    color: #a2aca5;
    opacity: 1;
}

.signup-input:focus,
.signup-phone-input:focus {
    border-color: #43825b;
    background-color: #fff;
    outline: none;
}

.signup-input-wrap:focus-within .signup-input-icon {
    color: #286640;
}

.signup-password {
    padding-right: 43px;
}

.password-toggle {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    background: transparent;
    border: 0;
    padding: 6px;
    color: #89968d;
    cursor: pointer;
    font-size: 14px;
    line-height: 1;
}

.password-toggle:hover {
    color: #236b45;
}

/* International telephone input */

.signup-form .iti {
    display: block;
    width: 100%;
}

.signup-form .iti input.signup-phone-input {
    width: 100%;
    height: 47px;
    padding-left: 100px;
}

.signup-form .iti__country-container {
    border-radius: 9px 0 0 9px;
}

.signup-form .iti__selected-country {
    padding: 0 9px 0 12px;
    border-radius: 9px 0 0 9px;
}

.signup-form .iti__selected-country-primary {
    height: 45px;
}

.signup-form .iti__selected-dial-code {
    font-size: 13px;
    color: #33483b;
}

.signup-form .iti__dropdown-content {
    border: 1px solid #e0e8e2;
    border-radius: 10px;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    z-index: 1000;
}

.signup-form .iti__search-input {
    padding: 10px;
    border: 1px solid #e0e8e2;
    border-radius: 7px;
    margin: 8px;
    width: calc(100% - 16px);
}

.signup-form .iti__country {
    padding-top: 9px;
    padding-bottom: 9px;
    font-size: 13px;
}

/* Terms and submit */

.signup-terms-row {
    margin: 4px 0 20px;
}

.signup-terms {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    color: #69776e;
    font-size: 11px;
    line-height: 1.8;
    cursor: pointer;
}

.signup-terms input {
    accent-color: #236b45;
    width: 15px;
    height: 15px;
    flex-shrink: 0;
    margin-top: 3px;
    cursor: pointer;
}

.signup-terms a {
    color: #236b45;
    font-weight: 700;
    text-decoration: none;
}

.signup-terms a:hover,
.signup-login-link a:hover {
    text-decoration: underline;
}

.signup-submit {
    width: 100%;
    min-height: 49px;
    padding: 12px 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    border: 0;
    border-radius: 9px;
    background: #1d603b;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
}

.signup-submit:hover {
    background: #164b2e;
    color: #fff;
}

.signup-submit:active {
    transform: translateY(1px);
}

.signup-submit i {
    font-size: 12px;
}

.signup-login-link {
    text-align: center;
    margin: 20px 0 0;
    color: #7b877e;
    font-size: 12px;
}

.signup-login-link a {
    color: #236b45;
    font-weight: 750;
    text-decoration: none;
    margin-left: 3px;
}

/* Responsive */

@media (min-width: 992px) {
    .signup-left-content {
        padding: 45px 35px 32px;
    }

    .signup-form-content {
        padding: 40px 45px 32px;
    }
}

@media (max-width: 991px) {
    .maseco-signup-page {
        padding: 30px 0;
    }

    .signup-left-content {
        padding: 35px 30px;
    }

    .signup-brand {
        margin-bottom: 30px;
    }

    .signup-left h2 {
        font-size: 34px;
    }

    .signup-left-footer {
        margin-top: 8px;
    }

    .signup-form-content {
        padding: 35px 30px;
    }
}

@media (max-width: 575px) {
    .maseco-signup-page {
        padding: 15px 0;
    }

    .maseco-signup-page > .container {
        padding-left: 12px;
        padding-right: 12px;
    }

    .signup-card {
        border-radius: 15px;
    }

    .signup-left-content {
        padding: 28px 23px;
    }

    .signup-brand {
        font-size: 20px;
        margin-bottom: 25px;
    }

    .signup-left h2 {
        font-size: 30px;
    }

    .signup-intro {
        margin-bottom: 25px;
    }

    .signup-feature {
        margin-bottom: 17px;
    }

    .signup-form-content {
        padding: 29px 20px;
    }

    .signup-form-heading h1 {
        font-size: 25px;
    }

    .account-type-options {
        gap: 6px;
    }

    .account-type-text {
        flex-direction: column;
        gap: 5px;
        font-size: 10px;
        padding: 9px 3px;
    }
}

</style>
<main class="maseco-signup-page">
    <section class="signup-section">
        <div class="container">
            <div class="signup-card">
                <div class="row g-0">

                    {{-- LEFT BRAND PANEL --}}
                    <div class="col-lg-5 signup-left">
                        <div class="signup-left-content">

                            <a href="{{ url('/') }}" class="signup-brand">
                                <span class="brand-mark">M</span>
                                <span>MASECO</span>
                            </a>

                            <span class="signup-eyebrow">
                                YOUR SOURCING PARTNER
                            </span>

                            <h2>
                                Source Better.
                                <span>Build Smarter.</span>
                                Grow Together.
                            </h2>

                            <p class="signup-intro">
                                One platform to discover quality raw materials
                                and build trusted business connections.
                            </p>

                            <div class="signup-feature">
                                <div class="signup-feature-icon">
                                    <i class="fas fa-boxes-stacked"></i>
                                </div>
                                <div>
                                    <h6>Quality Raw Materials</h6>
                                    <p>Find materials that fit your business.</p>
                                </div>
                            </div>

                            <div class="signup-feature">
                                <div class="signup-feature-icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div>
                                    <h6>Trusted Connections</h6>
                                    <p>Connect with suppliers and manufacturers.</p>
                                </div>
                            </div>

                            <div class="signup-feature">
                                <div class="signup-feature-icon">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <div>
                                    <h6>Smarter Sourcing</h6>
                                    <p>Discover opportunities for your business.</p>
                                </div>
                            </div>

                            <div class="signup-left-footer">
                                <i class="fas fa-shield-halved"></i>
                                Built for better business connections
                            </div>

                        </div>
                    </div>

                    {{-- RIGHT SIGNUP FORM --}}
                    <div class="col-lg-7 signup-right">
                        <div class="signup-form-content">

                            <div class="signup-form-heading">
                                <span class="form-step-label">
                                    GET STARTED FOR FREE
                                </span>

                                <h1>Create your account</h1>

                                <p>
                                    Enter your details to join the MASECO
                                    sourcing network.
                                </p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger signup-alert">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form
                                class="verify-gcaptcha login-form signup-form"
                                method="POST"
                                action="{{ route('register.submit') }}"
                            >
                                @csrf

                                {{-- ACCOUNT TYPE --}}
                                <div class="form-group account-type-group">
                                    <label class="signup-label">
                                        I want to register as
                                    </label>

                                    <div class="account-type-options">

                                        <label class="account-type-option"
                                               for="registerTypeUser">
                                            <input
                                                type="radio"
                                                name="user_type"
                                                id="registerTypeUser"
                                                value="user"
                                                {{ old('user_type', 'user') == 'user' ? 'checked' : '' }}
                                            >
                                            <span class="account-type-text">
                                                <i class="fas fa-user"></i>
                                                User
                                            </span>
                                        </label>

                                        <label class="account-type-option"
                                               for="registerTypeSupplier">
                                            <input
                                                type="radio"
                                                name="user_type"
                                                id="registerTypeSupplier"
                                                value="supplier"
                                                {{ old('user_type') == 'supplier' ? 'checked' : '' }}
                                            >
                                            <span class="account-type-text">
                                                <i class="fas fa-truck"></i>
                                                Supplier
                                            </span>
                                        </label>

                                        <label class="account-type-option"
                                               for="registerTypeManufacturer">
                                            <input
                                                type="radio"
                                                name="user_type"
                                                id="registerTypeManufacturer"
                                                value="manufacturer"
                                                {{ old('user_type') == 'manufacturer' ? 'checked' : '' }}
                                            >
                                            <span class="account-type-text">
                                                <i class="fas fa-industry"></i>
                                                Manufacturer
                                            </span>
                                        </label>

                                    </div>
                                </div>

                                {{-- FULL NAME --}}
                                <div class="form-group">
                                    <label for="signup-name" class="signup-label">
                                        Full name
                                    </label>
                                    <div class="signup-input-wrap">
                                        <i class="far fa-user signup-input-icon"></i>
                                        <input
                                            id="signup-name"
                                            class="form-control signup-input"
                                            name="name"
                                            type="text"
                                            placeholder="Enter your full name"
                                            value="{{ old('name') }}"
                                            autocomplete="name"
                                            required
                                        >
                                    </div>
                                </div>

                                {{-- EMAIL --}}
                                <div class="form-group">
                                    <label for="signup-email" class="signup-label">
                                        Email address
                                    </label>
                                    <div class="signup-input-wrap">
                                        <i class="far fa-envelope signup-input-icon"></i>
                                        <input
                                            id="signup-email"
                                            class="form-control signup-input"
                                            name="email"
                                            type="email"
                                            placeholder="you@company.com"
                                            value="{{ old('email') }}"
                                            autocomplete="email"
                                            required
                                        >
                                    </div>
                                </div>

                                {{-- PHONE WITH INTL-TEL-INPUT --}}
                                <div class="form-group">
                                    <label for="signup-phone" class="signup-label">
                                        Phone number
                                    </label>

                                    <input
                                        id="signup-phone"
                                        class="form-control signup-phone-input"
                                        name="phone"
                                        type="tel"
                                        placeholder="Enter phone number"
                                        value="{{ old('phone') }}"
                                        autocomplete="tel-national"
                                        required
                                    >

                                    {{-- Backend still receives country_code --}}
                                    <input
                                        type="hidden"
                                        name="country_code"
                                        id="signup-country-code"
                                        value="{{ old('country_code', '+91') }}"
                                    >
                                </div>

                                {{-- PASSWORD --}}
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="password-field" class="signup-label">
                                        Password
                                    </label>

                                    <div class="signup-input-wrap">
                                        <i class="fas fa-lock signup-input-icon"></i>
                                        <input
                                            class="form-control signup-input signup-password"
                                            id="password-field"
                                            name="password"
                                            type="password"
                                            placeholder="Create a password"
                                            autocomplete="new-password"
                                            required
                                        >
                                        <button
                                            type="button"
                                            class="password-toggle toggle-password"
                                            data-target="password-field"
                                            aria-label="Show password"
                                        >
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- CONFIRM PASSWORD --}}
                                
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="confirm-password-field"
                                           class="signup-label">
                                        Confirm password
                                    </label>

                                    
                                    <div class="signup-input-wrap">
                                        <i class="fas fa-lock signup-input-icon"></i>
                                        <input
                                            class="form-control signup-input signup-password"
                                            id="confirm-password-field"
                                            name="password_confirmation"
                                            type="password"
                                            placeholder="Confirm your password"
                                            autocomplete="new-password"
                                            required
                                        >
                                        <button
                                            type="button"
                                            class="password-toggle toggle-password"
                                            data-target="confirm-password-field"
                                            aria-label="Show password"
                                        >
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                  </div>
                                </div>

                                {{-- TERMS --}}
                                <div class="signup-terms-row">
                                    <label class="signup-terms">
                                        <input
                                            id="agree"
                                            name="agree"
                                            type="checkbox"
                                            value="1"
                                            required
                                            {{ old('agree') ? 'checked' : '' }}
                                        >
                                        <span>
                                            I agree to the
                                            <a href="{{ route('terms.condition') }}">
                                                Terms
                                            </a>
                                            and
                                            <a href="{{ route('privacy.policy') }}">
                                                Privacy Policy
                                            </a>
                                        </span>
                                    </label>
                                </div>

                                {{-- SUBMIT --}}
                                <button type="submit" class="signup-submit">
                                    Create account
                                    <i class="fas fa-arrow-right"></i>
                                </button>

                                <p class="signup-login-link">
                                    Already have an account?
                                    <a href="{{ route('login') }}">Log in</a>
                                </p>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>


<!-- International Telephone Input CSS -->
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css"
>

<!-- International Telephone Input JS -->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.querySelector('#signup-phone');
    const countryCodeInput = document.querySelector('#signup-country-code');
    const signupForm = document.querySelector('.signup-form');

    if (phoneInput && countryCodeInput && window.intlTelInput) {
        const iti = window.intlTelInput(phoneInput, {
            initialCountry: 'in',
            preferredCountries: ['in', 'us', 'gb', 'ae', 'ca'],
            separateDialCode: true,
            nationalMode: true,
            countrySearch: true,
            utilsScript:
                'https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js'
        });

        // Restore the previous country selection after validation errors.
        const previousCode = countryCodeInput.value.replace(/\D/g, '');

        if (previousCode) {
            const countries = iti.getCountryData();
            const matchingCountry = countries.find(function (country) {
                return country.dialCode === previousCode;
            });

            if (matchingCountry) {
                iti.setCountry(matchingCountry.iso2);
            }
        }

        // Keep the existing Laravel country_code field updated.
        function updateCountryCode() {
            const selectedCountry = iti.getSelectedCountryData();

            if (selectedCountry && selectedCountry.dialCode) {
                countryCodeInput.value = '+' + selectedCountry.dialCode;
            }
        }

        updateCountryCode();

        phoneInput.addEventListener('countrychange', updateCountryCode);

        signupForm.addEventListener('submit', function () {
            updateCountryCode();
        });
    }

    // Password visibility toggle
    document.querySelectorAll('.toggle-password').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(
                button.getAttribute('data-target')
            );

            if (!input) return;

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            const icon = button.querySelector('i');

            if (icon) {
                icon.classList.toggle('fa-eye', !isPassword);
                icon.classList.toggle('fa-eye-slash', isPassword);
            }

            button.setAttribute(
                'aria-label',
                isPassword ? 'Hide password' : 'Show password'
            );
        });
    });
});
</script>

@include('Include.footer')
