@include('admin.Include.header')

@php
    $statusIsActive = (string) ($account->status ?? '0') === '1';
    $phone = trim(implode(' ', array_filter([
        $account->country_code ?? null,
        $account->phone ?? null,
    ], fn ($value) => filled($value))));
    $kycDetails = $kyc?->form_data ?? [];
    $kycValue = fn ($key, $fallback = null) => filled($kycDetails[$key] ?? null) ? $kycDetails[$key] : $fallback;
    $displayName = $kycValue('name', $account->name);

    $details = [
        'Full name'     => $displayName,
        'Email address' => $kycValue('email', $account->email),
        'Phone number'  => $kycValue('phone', $phone ?: null),
    ];

    if ($accountType === 'Buyer') {
        $details += [
            'Gender'       => $account->gender ?? null,
            'Date of birth'=> $account->dob ?? null,
        ];
    } else {
        $details += [
            'Company name'   => $kycValue('company_name', $account->company_name),
            'Business name'  => $kycValue('business_name', $account->business_name ?: ($account->company_name ?? null)),
            'Business type'  => $kycValue('business_type', $account->business_type),
            'Company registration number' => $kycValue('company_registration_number'),
            'Business tax ID' => $kycValue('business_tax_id', $account->gst),
            'GST number' => $kycValue('gst_number'),
        ];
    }

    $details += [
        'Country'          => $kycValue('country', $account->country),
        'State / Province' => $kycValue('state', $account->state),
        'City'             => $kycValue('city'),
        'Address'          => $kycValue('address', $account->address),
        'Business address' => $kycValue('business_address'),
        'Registered on'    => optional($account->created_at)->format('M j, Y g:i A'),
    ];

    // KYC helpers
    $kyc        = $kyc ?? null;
    $kycStatus  = $kyc->status ?? 'not_submitted';
    $kycBadge   = ['approved'=>'success','pending'=>'warning','rejected'=>'danger','not_submitted'=>'secondary','incomplete'=>'secondary'][$kycStatus] ?? 'secondary';
    $kycLabel   = ['approved'=>'Approved','pending'=>'Pending review','rejected'=>'Rejected','not_submitted'=>'Not submitted','incomplete'=>'Incomplete'][$kycStatus] ?? ucfirst($kycStatus);
@endphp

<main class="page-content">
    <div class="container-fluid py-4">

        {{-- Breadcrumb + back --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <div class="text-muted small mb-2">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route($backRoute) }}">{{ $accountType }}s</a>
                    <span class="mx-2">/</span>
                    <span>Account details</span>
                </div>
                <h1 class="h3 mb-1">{{ $accountType }} details</h1>
                <p class="text-muted mb-0">Account information for {{ $account->name ?: $accountType }}.</p>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route($backRoute) }}">
                <i class="fa-solid fa-arrow-left me-2" aria-hidden="true"></i>Back to {{ $accountType }}s
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="ri-checkbox-circle-line me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">

            {{-- ── Left: Account info ── --}}
            <div class="col-12 col-lg-7">
                <section class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">

                        {{-- Avatar + name --}}
                        <div class="d-flex flex-wrap align-items-center gap-3 pb-4 mb-4 border-bottom">
                            <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:64px;height:64px;font-size:1.5rem" aria-hidden="true">
                                <i class="fa-solid {{ $icon }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h2 class="h4 mb-1">{{ $displayName ?: 'Unnamed account' }}</h2>
                                <span class="badge {{ $statusIsActive ? 'bg-success' : 'bg-secondary' }} me-1">
                                    {{ $statusIsActive ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="badge bg-{{ $kycBadge }}">KYC: {{ $kycLabel }}</span>
                            </div>
                            @if($kycValue('company_name', $account->company_name))
                                <div class="text-muted">{{ $kycValue('company_name', $account->company_name) }}</div>
                            @endif
                        </div>

                        <h3 class="h6 mb-3 text-muted text-uppercase" style="letter-spacing:.05em">Account information</h3>
                        <div class="row g-3">
                            @foreach($details as $label => $value)
                                <div class="col-12 col-md-6">
                                    <div class="h-100 rounded border p-3">
                                        <div class="small text-muted mb-1">{{ $label }}</div>
                                        <div class="text-break">{{ filled($value) ? $value : '—' }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </section>
            </div>

            {{-- ── Right: KYC Panel ── --}}
            <div class="col-12 col-lg-5">
                <section class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-transparent border-bottom d-flex align-items-center justify-content-between py-3 px-4">
                        <h3 class="h5 mb-0"><i class="ri-shield-check-line me-2 text-primary"></i>KYC Verification</h3>
                        <span class="badge bg-{{ $kycBadge }}">{{ $kycLabel }}</span>
                    </div>
                    <div class="card-body p-4">

                        @if(!$kyc)
                            <div class="text-center text-muted py-4">
                                <i class="ri-file-upload-line" style="font-size:2rem;opacity:.4"></i>
                                <p class="mt-2 mb-0 small">This {{ strtolower($accountType) }} has not submitted any KYC documents yet.</p>
                            </div>

                        @else
                            {{-- Submission info --}}
                            <div class="mb-3 small text-muted">
                                <div>Submitted: <strong>{{ optional($kyc->submitted_at)->format('M j, Y g:i A') ?? '—' }}</strong></div>
                                @if($kyc->reviewed_at)
                                    <div>Reviewed: <strong>{{ $kyc->reviewed_at->format('M j, Y g:i A') }}</strong></div>
                                @endif
                            </div>

                            {{-- Admin note --}}
                            @if($kyc->admin_note)
                                <div class="alert alert-warning py-2 small mb-3">
                                    <strong>Admin note:</strong> {{ $kyc->admin_note }}
                                </div>
                            @endif

                            {{-- Document buttons --}}
                            <div class="mb-3">
                                <div class="small text-muted mb-2 fw-semibold">Uploaded documents</div>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach(['identity_document'=>['Identity front','ri-id-card-line'],'document_back'=>['Identity back','ri-id-card-line'],'selfie_document'=>['Selfie','ri-user-line'],'profile_photo'=>['Profile photo','ri-image-line'],'address_document'=>['Address proof','ri-map-pin-line'],'business_document'=>['Business certificate','ri-building-line'],'tax_document'=>['Tax document','ri-receipt-line']] as $field => [$label, $icon2])
                                        @if($kyc->$field)
                                            <a href="{{ route('admin.kyc.document', [$kyc, $field]) }}"
                                               class="btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="{{ $icon2 }} me-1"></i>{{ $label }}
                                            </a>
                                        @else
                                            <span class="btn btn-sm btn-outline-secondary disabled opacity-50">
                                                <i class="{{ $icon2 }} me-1"></i>{{ $label }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            {{-- Decision form --}}
                            <div class="border-top pt-3">
                                @if($kycStatus === 'approved')
                                    <div class="d-flex align-items-center gap-2 text-success small mb-3">
                                        <i class="ri-checkbox-circle-fill fs-5"></i>
                                        <span>KYC approved. Account is active.</span>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('admin.kyc.decision', $kyc) }}">
                                    @csrf
                                    <div class="mb-2">
                                        <label class="form-label small text-muted" for="kyc-note-{{ $kyc->id }}">
                                            Admin note <span class="text-muted">(required when rejecting)</span>
                                        </label>
                                        <textarea id="kyc-note-{{ $kyc->id }}" name="admin_note" rows="2"
                                                  class="form-control form-control-sm"
                                                  placeholder="Reason for rejection or any notes...">{{ old('admin_note', $kyc->admin_note) }}</textarea>
                                    </div>
                                    <div class="d-flex gap-2">
                                        @if($kycStatus !== 'approved')
                                            <button class="btn btn-success btn-sm px-3" name="decision" value="approved">
                                                <i class="ri-checkbox-circle-line me-1"></i>Approve
                                            </button>
                                        @endif
                                        <button class="btn btn-outline-danger btn-sm px-3" name="decision" value="rejected">
                                            <i class="ri-close-circle-line me-1"></i>{{ $kycStatus === 'approved' ? 'Revoke' : 'Reject' }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                    </div>
                </section>
            </div>

        </div>{{-- /row --}}
    </div>
</main>

@include('admin.Include.footer')

