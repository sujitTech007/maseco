@include('user.Include.header')

<style>
    .ud-hero {
        background: #3f4a1c;
    }

    .ud-chip {
        width: 44px;
        height: 44px;
    }

    .ud-accent {
        border-top: 4px solid var(--bs-success) !important;
    }

    .ud-chip svg {
        width: fit-content !important;
        height: fit-content !important;
    }
</style>

<div class="page-content">

    <div class="container py-1">

        {{-- Welcome banner --}}
        <div class="ud-hero text-white rounded-4 shadow-sm position-relative overflow-hidden p-4 mb-4">
            {{-- <svg class="position-absolute end-0 top-0 me-3 opacity-25 d-none d-md-block" width="190" height="190"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                stroke-linejoin="round" aria-hidden="true">
                <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z" />
                <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12" />
            </svg> --}}
            <div class="position-relative">
                <h3 class="fw-bold text-white mb-2 fs-bold">My Dashboard</h3>
                <p class="fs-5 mb-1">Welcome back, {{ $user->name }}.</p>
                <p class="mb-0 opacity-75">Source sustainable materials, connect with manufacturers and manage your
                    Maseco account in one place.</p>
            </div>
        </div>

        <div class="row g-3">

            {{-- Profile --}}
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 ud-accent">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span
                                class="ud-chip bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-bold fs-5"
                                aria-hidden="true">{{ strtoupper(mb_substr($user->name ?? '', 0, 1)) }}</span>
                            <h4 class="card-title fw-bold mb-0">Profile</h4>
                        </div>
                        <p class="mb-1"><strong>Name:</strong> {{ $user->name }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="mb-4"><strong>Phone:</strong> {{ $user->phone ?? '-' }}</p>
                        <a href="{{ route('user.profile') }}" class="btn btn-success btn-sm px-3">Edit Profile</a>
                    </div>
                </div>
            </div>

            {{-- Enquiries --}}
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 ud-accent">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span
                                class="ud-chip bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15a2 2 0 0 1-2 2H8l-5 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                </svg>
                            </span>
                            <h4 class="card-title fw-bold mb-0">Enquiries</h4>
                        </div>
                        <p class="display-6 fw-bold mb-1">{{ $enquiriesCount }}</p>
                        <p class="text-muted small mb-3">Requests sent to suppliers and manufacturers.</p>
                        <a href="{{ route('user.enquiries') }}" class="btn btn-outline-success btn-sm px-3">View
                            enquiries</a>
                    </div>
                </div>
            </div>

            {{-- Orders --}}
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 ud-accent">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span
                                class="ud-chip bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                    <path d="M3 6h18" />
                                    <path d="M16 10a4 4 0 0 1-8 0" />
                                </svg>
                            </span>
                            <h4 class="card-title fw-bold mb-0">Orders</h4>
                        </div>
                        <p class="display-6 fw-bold mb-1">{{ $ordersCount }}</p>
                        <p class="text-muted small mb-3">Track your material and production orders.</p>
                        <a href="{{ route('user.orders') }}" class="btn btn-outline-success btn-sm px-3">View orders</a>
                    </div>
                </div>
            </div>

            {{-- Payments --}}
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 ud-accent">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span
                                class="ud-chip bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="5" width="20" height="14" rx="2" />
                                    <path d="M2 10h20" />
                                </svg>
                            </span>
                            <h4 class="card-title fw-bold mb-0">Payments</h4>
                        </div>
                        <p class="display-6 fw-bold mb-1">${{ number_format($paymentsTotal, 2) }}</p>
                        <p class="text-muted small mb-3">Total paid across orders and subscriptions.</p>
                        <a href="{{ route('user.payments') }}" class="btn btn-outline-success btn-sm px-3">View
                            payments</a>
                    </div>
                </div>
            </div>

            {{-- Active Subscription --}}
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span
                                class="ud-chip bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="m12 3 2.6 5.6 6.1.7-4.5 4.2 1.2 6L12 16.5 6.6 19.5l1.2-6L3.3 9.3l6.1-.7z" />
                                </svg>
                            </span>
                            <h4 class="card-title fw-bold mb-0">Active Subscription</h4>
                        </div>
                        @if($activeSubscription)
                            <div>
                                <p class="mb-1"><strong>Plan:</strong> {{ $activeSubscription->plan_name ?? 'N/A' }}</p>
                                <p class="mb-1"><strong>Amount:</strong>
                                    ${{ number_format($activeSubscription->amount ?? $activeSubscription->price ?? 0, 2) }}
                                </p>
                                <p class="mb-0"><strong>Status:</strong> {{ ucfirst($activeSubscription->payment_status) }}
                                </p>
                            </div>
                        @else
                            <p class="mb-1">No active subscription. <a href="{{ route('subscription.plan') }}">Browse
                                    plans</a></p>
                            <p class="text-muted small mb-0">Upgrade to Premium for generative AI and supplier + vendor
                                match-making, or to Pro for post-production features.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Help --}}
            <div class="col-12">
                <div class="card border-0 bg-white shadow-sm rounded-4">
                    <div
                        class="card-body p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h6 class="fw-bold mb-1">Need help?</h6>
                            <p class="text-muted small mb-0">Our team can help with sourcing, orders or your
                                subscription. Email connect@maseco.ca.</p>
                        </div>
                        <a href="{{ url('contact-us') }}" class="btn btn-outline-success btn-sm px-3">Contact us</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


@include('user.Include.footer')