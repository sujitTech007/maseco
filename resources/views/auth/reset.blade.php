@include('Include.header')
<main>
  <div class="container py-5" style="max-width:520px;">
    <h3 class="mb-3">Set New Password</h3>
    <form method="POST" action="{{ route('password.reset.submit') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">New Password</label>
        <input type="password" name="password" class="form-control" minlength="6" required>
        @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" minlength="6" required>
      </div>
      <button class="btn btn-primary w-100" type="submit">Update Password</button>
    </form>
  </div>
</main>
@include('Include.footer')

