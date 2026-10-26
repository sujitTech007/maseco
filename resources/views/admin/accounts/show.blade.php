@include('admin.Include.header')

@php
    $statusIsActive = (string) ($account->status ?? '0') === '1';
    $phone = trim(implode(' ', array_filter([
        $account->country_code ?? null,
        $account->phone ?? null,
    ], fn ($value) => filled($value))));

    $details = [
        'Email address' => $account->email ?? null,
        'Phone number' => $phone ?: null,
    ];

    if ($accountType === 'Buyer') {
        $details += [
            'Gender' => $account->gender ?? null,
            'Date of birth' => $account->dob ?? null,
        ];
    } else {
        $details += [
            'Company name' => $account->company_name ?? null,
            'Business name' => $account->business_name ?? null,
            'Business type' => $account->business_type ?? null,
            'GST / Tax number' => $account->gst ?? null,
        ];
    }

    $details += [
        'Country' => $account->country ?? null,
        'State / Province' => $account->state ?? null,
        'Address' => $account->address ?? null,
        'Registered on' => optional($account->created_at)->format('M j, Y g:i A'),
    ];
@endphp

<main class="page-content">
    <div class="container-fluid py-4">
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

        <section class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap align-items-center gap-3 pb-4 mb-4 border-bottom">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center"
                         style="width:64px;height:64px;font-size:1.5rem" aria-hidden="true">
                        <i class="fa-solid {{ $icon }}"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h2 class="h4 mb-1">{{ $account->name ?: 'Unnamed account' }}</h2>
                        <span class="badge {{ $statusIsActive ? 'bg-success' : 'bg-secondary' }}">
                            {{ $statusIsActive ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    @if(!empty($account->company_name))
                        <div class="text-muted">{{ $account->company_name }}</div>
                    @endif
                </div>

                <h3 class="h6 mb-3">Account information</h3>
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
</main>

@include('admin.Include.footer')
