
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

                        <form class="verify-gcaptcha login-form" method="POST" action="{{ route('register.submit') }}">

                            @csrf

                            <!-- Account type -->
                            <div class="form-group">
                                <label class="login-role-label">Register as:</label>

                                    <div class="d-flex login-radio">

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="user_type"
                                                id="registerTypeUser"
                                                value="user"
                                                {{ old('user_type', 'user') == 'user' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="registerTypeUser">
                                                User
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="user_type"
                                                id="registerTypeSupplier"
                                                value="supplier"
                                                {{ old('user_type') == 'supplier' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="registerTypeSupplier">
                                                Supplier
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="user_type"
                                                id="registerTypeManufacturer"
                                                value="manufacturer"
                                                {{ old('user_type') == 'manufacturer' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="registerTypeManufacturer">
                                                Manufacturer
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                {{-- FULL NAME --}}
                                <div class="form-group">
                                    <fieldset>
                                        <legend>Full Name</legend>

                                        <input id="signup-name"
                                            class="form-control"
                                            name="name"
                                            type="text"
                                            placeholder="Enter your full name"
                                            value="{{ old('name') }}"
                                            autocomplete="name"
                                            required>
                                    </fieldset>
                                </div>

                                {{-- EMAIL --}}
                                <div class="form-group">
                                    <fieldset>
                                        <legend>Email Address</legend>

                                        <input id="signup-email"
                                            class="form-control"
                                            name="email"
                                            type="email"
                                            placeholder="you@company.com"
                                            value="{{ old('email') }}"
                                            autocomplete="email"
                                            required>
                                    </fieldset>
                                </div>

                            <!-- Phone number -->
                            <div class="form-group">
                                <fieldset>
                                    <legend>Phone Number</legend>

                                    <div class="d-flex mobileNumber">
                                          <select id="login_country_code" name="country_code" data-live-search="true" class="selectpicker" data-country-code-select data-selected-country-code="{{ old('country_code', '+1') }}">
                                        @include('auth.partials.country-code-options', ['selectedCountryCode' => old('country_code', '+1')])
                                    </select>
                                    <input class="form-control form--control bg-white" name="phone" type="tel" placeholder="Enter phone number" autocomplete="tel-national" inputmode="tel" value="{{ old('phone') }}" required>
                                    
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Password -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <fieldset>
                                            <legend>Password</legend>

                                            <div class="login-password-wrap">
                                                <input class="form-control"
                                                    id="password-field"
                                                    name="password"
                                                    type="password"
                                                    placeholder="Create a password"
                                                    autocomplete="new-password"
                                                    required>

                                                <button type="button"
                                                        class="password-toggle toggle-password"
                                                        data-target="password-field"
                                                        aria-label="Show password">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <fieldset>
                                            <legend>Confirm Password</legend>

                                            <div class="login-password-wrap">
                                                <input class="form-control"
                                                    id="confirm-password-field"
                                                    name="password_confirmation"
                                                    type="password"
                                                    placeholder="Confirm your password"
                                                    autocomplete="new-password"
                                                    required>

                                                <button type="button"
                                                        class="password-toggle toggle-password"
                                                        data-target="confirm-password-field"
                                                        aria-label="Show password">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            {{-- TERMS AND CONDITIONS --}}
                            <div class="form-group d-flex align-items">
                                <label class="d-flex align-items-start gap-2">
                                    <input id="agree"
                                        name="agree"
                                        type="checkbox"
                                        value="1"
                                        class="agree-input-checked"
                                        required
                                        {{ old('agree') ? 'checked' : '' }}>

                                    <span class="fs-12">
                                        I agree to the
                                        <a href="{{ route('terms.condition') }}">Terms</a>
                                        and
                                        <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
                                    </span>
                                </label>
                            </div>

                            {{-- SUBMIT --}}
                            <div class="form-group mt-4 mb-0">
                                <button class="btn theme-btn w-100" type="submit">
                                    Create Account
                                </button>
                            </div>

                            {{-- LOGIN LINK --}}
                            <p class="login-signup">
                                Already have an account?
                                <a href="{{ route('login') }}">Log in</a>
                            </p>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

@include('Include.footer')


    


