
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
                      @php
                        $otpUser = session('otp_user');
                        $fullPhone = $otpUser['phone'] ?? '';
                        $countryCode = $otpUser['country_code'] ?? '';
                        $last4 = substr($fullPhone, -4);
                        $maskedPhone = $countryCode . ' •••• ' . $last4;
                        @endphp

                        <div class="login-form-heading text-center">
                            <h1>{{ __('Enter OTP') }}</h1>
                            <p>We sent a 6-digit code to {{ $maskedPhone }}</p>
                            @if (app()->environment(['local', 'testing']) && config('services.twilio.test_otp_enabled'))
                                <p class="small text-muted mb-0">Local testing OTP: {{ config('services.twilio.test_otp', '112233') }}</p>
                            @endif
                        </div>

                        <form class="login-form"
                              method="POST"
                              action="{{ route('otp.verify') }}" autocomplete="one-time-code"
                              id="otpForm">

                            @csrf

                            
                            <!-- Phone number -->
                            <div class="form-group">
                                <div class="d-flex justify-content-center gap-2 mb-3">



                                  <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp1" placeholder="*" required>



                                  <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp2" placeholder="*" required>



                                  <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp3" placeholder="*" required>



                                  <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp4" placeholder="*" required>



                                  <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp5" placeholder="*" required>



                                  <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp6" placeholder="*" required>



                                </div>
                                
                            </div>
                            <div class="form-group">
                              <input type="hidden" name="otp" id="otpFull">
                                <div id="otpMessage" class="mt-2">
                                  @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                  @endif

                                  @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                  @endif

                                  @if($errors->any())
                                    <div class="alert alert-danger">
                                      @foreach($errors->all() as $error)
                                        {{ $error }}<br>
                                      @endforeach
                                    </div>

                                  @endif
                                </div>
                            </div>

                          
                            <!-- Forgot password -->
                            <div class="d-flex align-items-center justify-content-center">
                              <a href="" class="btn btn-link">Didn't receive code? <span class="resend-otp-text">Resend OTP</span></a>
                               
                            </div>

                            <!-- Submit -->
                            <div class="form-group mt-4 mb-0">
                                <button class="theme-btn w-100" id="verifyOtpBtn" type="submit">
                                    Verify OTP
                                </button>
                            </div>

                            

                        </form>
                        <div id="otpLoader" class="mt-4 text-center" style="display:none;">
                            <div class="spinner-border text-primary" role="status">
                              <span class="visually-hidden">Verifying...</span>
                            </div> 
                            <p class="mt-2">Verifying OTP...</p>
                          </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<script>
const otpInputs = document.querySelectorAll('.otp-input');
const otpFull = document.getElementById('otpFull');
const form = document.getElementById('otpForm');
const loader = document.getElementById('otpLoader');
const verifyBtn = document.getElementById('verifyOtpBtn');
const otpMessage = document.getElementById('otpMessage');
otpInputs[0].focus();
otpInputs.forEach((input, index) => {
  input.addEventListener('input', () => {
    input.value = input.value.replace(/[^0-9]/g, '');
    if (input.value.length === 1 && index < otpInputs.length - 1) {
      otpInputs[index + 1].focus();
    }
    otpFull.value = Array.from(otpInputs).map(i => i.value).join('');
  });



  input.addEventListener('keydown', (e) => {
    if (e.key === 'Backspace' && input.value === '' && index > 0) {
      otpInputs[index - 1].focus();
    }
  });
});

form.addEventListener('submit', function(e) {
  otpFull.value = Array.from(otpInputs).map(i => i.value).join('');
  if (otpFull.value.length < 6) {
    e.preventDefault();
    otpMessage.innerHTML = '<div class="text-danger">Please enter the full OTP.</div>';
    return false;
  }

  loader.style.display = 'block';
  verifyBtn.disabled = true;
});
</script>



@include('Include.footer')
<script>
  $('.otp-input').on('input', function () {
    if ($(this).val().trim() !== '') {
        $(this).addClass('active');
    } else {
        $(this).removeClass('active');
    }
});
</script>


    


