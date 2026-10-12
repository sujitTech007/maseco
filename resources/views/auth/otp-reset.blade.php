@include('Include.header')
<main>
  <div class="container py-5" style="max-width:520px;">
    <h3 class="mb-3">Verify OTP</h3>
    <form method="POST" action="{{ route('password.otp.verify') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Enter 6-digit OTP</label>
        <input type="text" name="otp" class="form-control" maxlength="6" pattern="\d{6}" required>
        @error('otp')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        @if(session('error'))<div class="text-danger small mt-1">{{ session('error') }}</div>@endif
      </div>
      <button class="btn btn-primary w-100" type="submit">Verify</button>
    </form>
  </div>
</main>
@include('Include.footer')

