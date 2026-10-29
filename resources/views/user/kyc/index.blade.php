@include('user.Include.header')

<div class="page-content">
  <div class="container-fluid px-3 px-lg-4 py-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
      <div>
        <div class="text-muted small mb-1">Buyer onboarding · Step 2 of 2</div>
        <h3 class="mb-1">Identity verification</h3>
        <p class="text-muted mb-0">Submit your identity and address documents to complete your buyer setup.</p>
      </div>
      <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary">Back to profile</a>
    </div>

    @if(session('success'))<div class="alert alert-success" role="status">{{ session('success') }}</div>@endif
    @if(session('kyc_required'))<div class="alert alert-info" role="status">{{ session('kyc_required') }}</div>@endif
    @if(session('info'))<div class="alert alert-info" role="status">{{ session('info') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>@endif

    @php
      $kycStatus    = $user->kyc_status ?? 'not_submitted';
      $statusClasses = ['approved' => 'success', 'pending' => 'warning', 'rejected' => 'danger', 'not_submitted' => 'secondary'];
      $statusText   = ucfirst(str_replace('_', ' ', $kycStatus));
    @endphp

    <div class="row g-4 align-items-start">
      {{-- Left: upload / status card --}}
      <div class="col-12 col-lg-7 col-xl-8">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body p-4 p-xl-5">
            <div class="d-flex align-items-start gap-3 mb-4">
              <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                    style="width:48px;height:48px;background:#eaf7f4;color:#2DAC92;font-size:22px;" aria-hidden="true">
                <i class="ri-shield-check-line"></i>
              </span>
              <div>
                <h4 class="mb-1">Verify your identity</h4>
                <p class="text-muted mb-0">Upload clear documents (PDF, JPG, or PNG, max 10 MB each). Our team will review them and update your status.</p>
              </div>
            </div>

            @if($kycStatus === 'approved')
              <div class="alert alert-success mb-0">
                <strong>Your identity is verified.</strong><br>
                You have completed buyer verification and can access all features.
              </div>

            @elseif($kycStatus === 'pending')
              <div class="alert alert-warning mb-0">
                <strong>Your documents are under review.</strong><br>
                We'll update your verification status after the review is complete.
              </div>

            @else
              @if($kycStatus === 'rejected')
                <div class="alert alert-danger">
                  <strong>Documents not approved.</strong>
                  @if($kyc && $kyc->admin_note)
                    <div class="mt-1">Admin note: {{ $kyc->admin_note }}</div>
                  @endif
                  Please upload new documents to resubmit.
                </div>
              @endif

              <form method="POST" action="{{ route('user.kyc.submit') }}" enctype="multipart/form-data">
                @csrf
                @include('kyc.fields', ['user' => $user, 'kyc' => $kyc, 'type' => 'user'])

                {{-- Identity document --}}
                <div class="mb-3">
                  <label for="identity_document" class="form-label fw-semibold">
                    Document front side <span class="text-danger">*</span>
                  </label>
                  <input id="identity_document" type="file" name="identity_document"
                         accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png"
                         class="form-control @error('identity_document') is-invalid @enderror" required>
                  @error('identity_document')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  <div class="form-text">e.g. Passport, Driver's Licence, or National ID</div>
                </div>

                {{-- Address document --}}
                <div class="mb-3">
                  <label for="address_document" class="form-label fw-semibold">
                    Proof of address (optional)
                  </label>
                  <input id="address_document" type="file" name="address_document"
                         accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png"
                         class="form-control @error('address_document') is-invalid @enderror">
                  @error('address_document')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  <div class="form-text mb-4">e.g. Utility bill or bank statement (issued within 3 months). Accepted formats: PDF, JPG, or PNG. Maximum file size: 10 MB each.</div>
                </div>

                <button type="submit" class="btn text-white px-4" style="background:#2DAC92;">
                  {{ $kycStatus === 'rejected' ? 'Resubmit for review' : 'Submit for review' }}
                </button>
              </form>
            @endif
          </div>
        </div>
      </div>

      {{-- Right: status panel --}}
      <div class="col-12 col-lg-5 col-xl-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="mb-0">Verification status</h5>
              <span class="badge bg-{{ $statusClasses[$kycStatus] ?? 'secondary' }}">{{ $statusText }}</span>
            </div>

            <div class="d-flex gap-3 mb-3">
              <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                    style="width:30px;height:30px;background:#eaf7f4;color:#2DAC92;">1</span>
              <div>
                <strong>Registration complete</strong>
                <div class="small text-muted">Your buyer account is ready.</div>
              </div>
            </div>

            <div class="d-flex gap-3">
              <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                    style="width:30px;height:30px;
                           background:{{ $kycStatus === 'approved' ? '#eaf7f4' : '#f2f4f7' }};
                           color:{{ $kycStatus === 'approved' ? '#2DAC92' : '#667085' }};">2</span>
              <div>
                <strong>Identity verification</strong>
                <div class="small text-muted">
                  @if($kycStatus === 'approved') Your verification is complete.
                  @elseif($kycStatus === 'pending') Your documents are with our review team.
                  @else Submit your documents to complete setup.
                  @endif
                </div>
              </div>
            </div>

            <hr>
            <p class="small text-muted mb-0">
              Need to update your information?
              <a href="{{ route('user.profile') }}" style="color:#228d78;">Go to your profile</a>.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('user.Include.footer')
