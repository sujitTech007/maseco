@include('seller.Include.header')

<div class="page-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div>
                <div class="text-muted small mb-1">Supplier onboarding · Step 2 of 2</div>
                <h3 class="mb-1">Business verification</h3>
                <p class="text-muted mb-0">Submit your business registration document to complete supplier setup.</p>
            </div>
            <a href="{{ route('seller.profile') }}" class="btn btn-outline-secondary">Back to profile</a>
        </div>

        @if(session('success'))<div class="alert alert-success" role="status">{{ session('success') }}</div>@endif
        @if(session('kyc_required'))<div class="alert alert-info" role="status">{{ session('kyc_required') }}</div>@endif
        @if($errors->any())<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>@endif

        @php
        $kycStatus = $user->kyc_status ?? 'not_submitted';
        $statusClasses = ['approved' => 'success', 'pending' => 'warning', 'rejected' => 'danger', 'not_submitted' => 'secondary'];
        $statusText = ucfirst(str_replace('_', ' ', $kycStatus));
        @endphp

        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-7 col-xl-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 p-xl-5">
                        <div class="d-flex align-items-start gap-3 mb-4">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width:48px;height:48px;background:#eaf7f4;color:#2DAC92;font-size:22px;" aria-hidden="true">
                                <i class="ri-shield-check-line"></i>
                            </span>
                            <div>
                                <h4 class="mb-1">Verify your business</h4>
                                <p class="text-muted mb-0">Upload one clear document. Our team will review it and update your status.</p>
                            </div>
                        </div>

                        @if($kycStatus === 'approved')
                        <div class="alert alert-success mb-0">
                            <strong>Your business is verified.</strong><br>
                            You have completed supplier verification.
                        </div>
                        @elseif($kycStatus === 'pending')
                        <div class="alert alert-warning mb-0">
                            <strong>Your document is under review.</strong><br>
                            We’ll update your verification status after the review is complete.
                        </div>
                        @else
                        @if($kycStatus === 'rejected')
                        <div class="alert alert-danger">Your previous document was not approved. Please upload a new document to resubmit.</div>
                        @endif
                        <form method="POST" action="{{ route('seller.profile.kyc') }}" enctype="multipart/form-data">
                            @csrf
                            <label for="kyc_document" class="form-label fw-semibold">Business registration document <span class="text-danger">*</span></label>
                            <input id="kyc_document" type="file" name="kyc_document" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" class="form-control" required aria-describedby="kyc-help">
                            <div id="kyc-help" class="form-text mb-4">Accepted formats: PDF, JPG, or PNG. Maximum file size: 10 MB.</div>
                            <button type="submit" class="btn text-white px-4" style="background:#2DAC92;">{{ $kycStatus === 'rejected' ? 'Resubmit for review' : 'Submit for review' }}</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5 col-xl-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Verification status</h5>
                            <span class="badge bg-{{ $statusClasses[$kycStatus] ?? 'secondary' }}">{{ $statusText }}</span>
                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width:30px;height:30px;background:#eaf7f4;color:#2DAC92;">1</span>
                            <div><strong>Registration complete</strong>
                                <div class="small text-muted">Your supplier account is ready.</div>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width:30px;height:30px;background:{{ $kycStatus === 'approved' ? '#eaf7f4' : '#f2f4f7' }};color:{{ $kycStatus === 'approved' ? '#2DAC92' : '#667085' }};">2</span>
                            <div><strong>Business verification</strong>
                                <div class="small text-muted">{{ $kycStatus === 'approved' ? 'Your verification is complete.' : ($kycStatus === 'pending' ? 'Your document is with our review team.' : 'Submit a document to complete setup.') }}</div>
                            </div>
                        </div>
                        <hr>
                        <p class="small text-muted mb-0">Need to update your company information? <a href="{{ route('seller.profile') }}" style="color:#228d78;">Go to your profile</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('seller.Include.footer')