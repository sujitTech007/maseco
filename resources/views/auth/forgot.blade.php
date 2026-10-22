
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
                              action="{{ route('password.forgot.send') }}">

                            @csrf

                           

                            <!-- Phone number -->
                            <div class="form-group">
                                <fieldset>
                                    <legend>User Type</legend>
                                    <div class="d-flex">

                                    <select name="user_type" class="form-control" required>
                                      <option value="user">User</option>
                                      <option value="supplier">Supplier</option>
                                      <option value="manufacturer">Manufacturer</option>
                                    </select>
                                    @error('user_type')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <fieldset>
                                    <legend>Phone Number</legend>
                                    <div class="mobileNumber-border-0">

                                    @include('auth.partials.phone-input', [
                                      'phoneInputId' => 'forgot_phone',
                                      'phoneInputClass' => 'form-control',
                                      'countryCode' => old('country_code', '+1'),
                                      'phonePlaceholder' => 'Enter phone number',
                                    ])
                                    @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                </fieldset>
                            </div>

                           

                            <!-- Submit -->
                            <div class="form-group mt-4 mb-0">
                                <button class="theme-btn w-100" type="submit">
                                    Send OTP
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


    


