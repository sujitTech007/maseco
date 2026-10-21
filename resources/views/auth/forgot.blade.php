@include('Include.header')
<main>
  <div class="container py-5" style="max-width:520px;">
    <h3 class="mb-3">Forgot Password</h3>
    <form method="POST" action="{{ route('password.forgot.send') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">User Type</label>
        <select name="user_type" class="form-control" required>
          <option value="user">User</option>
          <option value="supplier">Supplier</option>
          <option value="manufacturer">Manufacturer</option>
        </select>
        @error('user_type')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label">Phone Number</label>
        @include('auth.partials.phone-input', [
          'phoneInputId' => 'forgot_phone',
          'phoneInputClass' => 'form-control',
          'countryCode' => old('country_code', '+1'),
          'phonePlaceholder' => 'Enter phone number',
        ])
        @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <button class="btn btn-primary w-100" type="submit">Send OTP</button>
    </form>
  </div>
</main>
@include('Include.footer')

