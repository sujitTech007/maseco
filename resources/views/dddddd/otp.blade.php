@include('Include.header')



<div class="container py-5">



  <div class="row justify-content-center">



    <div class="col-md-5">


@php
$otpUser = session('otp_user');
$fullPhone = $otpUser['phone'] ?? '';
$countryCode = $otpUser['country_code'] ?? '';
$last4 = substr($fullPhone, -4);
$maskedPhone = $countryCode . ' •••• ' . $last4;
@endphp

      <div class="card shadow-sm p-4">



        <div class="title text-center">



          <h4 class="mb-20">{{ __('Enter OTP') }}</h4>

          <p>We sent a 6-digit code to {{ $maskedPhone }}</p>

        </div>



        <form id="otpForm" method="POST" action="{{ route('otp.verify') }}" autocomplete="one-time-code">



          @csrf



          <div class="d-flex justify-content-center gap-2 mb-3">



            <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp1" placeholder="*" style="width:50px; border:1px solid #2dac92; font-size:1.5rem;" required>



            <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp2" placeholder="*" style="width:50px; border:1px solid #2dac92; font-size:1.5rem;" required>



            <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp3" placeholder="*" style="width:50px; border:1px solid #2dac92; font-size:1.5rem;" required>



            <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp4" placeholder="*" style="width:50px; border:1px solid #2dac92; font-size:1.5rem;" required>



            <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp5" placeholder="*" style="width:50px; border:1px solid #2dac92; font-size:1.5rem;" required>



            <input type="text" maxlength="1" class="form-control text-center otp-input" name="otp6" placeholder="*" style="width:50px; border:1px solid #2dac92; font-size:1.5rem;" required>



          </div>



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

           <div class="text-center mt-3">



          <a href="" class="btn btn-link">Didn't receive code?<span class="resend-otp-text">Resend OTP</span></a>



        </div>





          <button type="submit" id="verifyOtpBtn" class="btn btn-lg btn-primary radius-md w-100 mt-3">Verify OTP</button>



        </form>



        <div id="otpLoader" style="display:none; text-align:center; margin-top:10px;">



          <div class="spinner-border text-primary" role="status">



            <span class="visually-hidden">Verifying...</span>



          </div>

          



          <p class="mt-2">Verifying OTP...</p>



        </div>



       

      </div>



    </div>



  </div>



</div>



<script>



// OTP Input Auto Focus



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