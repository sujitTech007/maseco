
@include('Include.header')
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
                                    <i class="fa-solid fa-cubes" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6>Quality Raw Materials</h6>
                                    <p>Discover materials for your business needs.</p>
                                </div>
                            </div>

                            <div class="login-benefit">
                                <div class="login-benefit-icon">
                                    <i class="fa-solid fa-handshake" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6>Trusted Connections</h6>
                                    <p>Connect with suppliers and manufacturers.</p>
                                </div>
                            </div>

                            <div class="login-benefit">
                                <div class="login-benefit-icon">
                                    <i class="fa-solid fa-leaf" aria-hidden="true"></i>
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

                                    <div class="d-flex mobileNumber">
                                          <select id="login_country_code" name="country_code" data-live-search="true" class="selectpicker" data-country-code-select data-selected-country-code="{{ old('country_code', '+1') }}">
                                        @include('auth.partials.country-code-options', ['selectedCountryCode' => old('country_code', '+1')])
                                    </select>
                                    <input class="form-control form--control bg-white" name="phone" type="tel" value="{{ old('phone') }}" placeholder="Enter phone number" autocomplete="tel-national" inputmode="tel" required>
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <fieldset>
                                    <legend>Password</legend>

                                    <div class="login-password-wrap">
                                        <input
                                            class="form-control"
                                            id="password-field"
                                            name="password"
                                            type="password"
                                            autocomplete="current-password"
                                            placeholder="Enter your password"
                                            required>


                                        <span
                                            class="fa-solid fa-eye login-password-toggle"
                                            id="password-field"
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
                                <button class="theme-btn w-100" type="submit">
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


    


