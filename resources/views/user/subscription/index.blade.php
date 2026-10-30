@include('user.Include.header')



@php
// TEMP DEMO DATA: only shows when the list is empty, APP_DEBUG is true and the URL has ?demo=1. Delete before launch.
$rows = $purchases;
if ($rows->isEmpty() && config('app.debug') && request()->boolean('demo')) {
$rows = collect([
(object) ['id' => 14, 'plan_name' => 'Pro Subscription', 'amount' => 299, 'payment_status' => 'paid', 'created_at' => now()->subDays(3)],
(object) ['id' => 13, 'plan_name' => 'Premium Subscription', 'amount' => 69, 'payment_status' => 'paid', 'created_at' => now()->subDays(35)],
(object) ['id' => 12, 'plan_name' => 'Premium Subscription', 'amount' => 69, 'payment_status' => 'failed', 'created_at' => now()->subDays(66)],
(object) ['id' => 11, 'plan_name' => 'Basic Subscription', 'amount' => 0, 'payment_status' => 'paid', 'created_at' => now()->subDays(97)],
]);
}
@endphp

<div class="page-content">

    <div class="container py-1">

        <h1 class="fw-bold mb-1 dashboard_title">Subscription</h1>

       

        <div class="breadcrumb-wrapper">
            <a href="{{ route('user.dashboard') }}" class="breadcrumb-link">
                Dashboard
            </a>

            <span class="breadcrumb-separator">▶</span>

            <span class="breadcrumb-current">
                Subscription
            </span>

            @if($activeSubscription)
                <a href="{{ route('subscription.plan') }}" class="buy-plan-btn">Upgrade Plan</a>
            @else
                <a href="{{ route('subscription.plan') }}" class="buy-plan-btn"><span>+</span>Buy a Plan</a>
            @endif
        </div>

        @if($activeSubscription)
            <div class="alert alert-success mb-3">Your {{ $activeSubscription->plan_name }} subscription is active until {{ $activeSubscription->end_date->format('d M Y') }}. You can upgrade to a higher plan while it is active.</div>
        @endif


        <p class="text-muted mb-3">Your plan purchases and their payment status.</p>


        <!-- Subscription Filter Card -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3">

                <div class="row g-2 align-items-end">

                    <!-- Search Subscriptions -->
                    <div class="col-12 col-md-6 col-xl-3">
                        <label for="subscription-search"
                            class="form-label small fw-semibold">
                            Search Subscriptions
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fa-solid fa-magnifying-glass text-muted"></i>
                            </span>

                            <input type="search"
                                class="form-control"
                                id="subscription-search"
                                placeholder="Subscription ID or plan...">
                        </div>
                    </div>

                    <!-- Subscription Status -->
                    <div class="col-6 col-md-3 col-xl-2">
                        <label for="subscription-status"
                            class="form-label small fw-semibold">
                            Subscription Status
                        </label>

                        <select class="form-select" id="subscription-status">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="expired">Expired</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>

                    <!-- Subscription Plan -->
                    <div class="col-6 col-md-3 col-xl-2">
                        <label for="subscription-plan"
                            class="form-label small fw-semibold">
                            Subscription Plan
                        </label>

                        <select class="form-select" id="subscription-plan">
                            <option value="">All Plans</option>
                            <option value="free">Free</option>
                            <option value="basic">Basic</option>
                            <option value="standard">Standard</option>
                            <option value="premium">Premium</option>
                            <option value="enterprise">Enterprise</option>
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div class="col-6 col-md-4 col-xl-2">
                        <label for="subscription-start-date"
                            class="form-label small fw-semibold">
                            From Date
                        </label>

                        <input type="date"
                            class="form-control"
                            id="subscription-start-date">
                    </div>

                    <!-- End Date -->
                    <div class="col-6 col-md-4 col-xl-2">
                        <label for="subscription-end-date"
                            class="form-label small fw-semibold">
                            To Date
                        </label>

                        <input type="date"
                            class="form-control"
                            id="subscription-end-date">
                    </div>

                    <!-- Filter Button -->
                    <div class="col-6 col-md-2 col-xl-1">
                        <button type="button"
                            class="btn btn-success w-100 text-nowrap"
                            id="subscription-filter-btn"
                            title="Apply Filters">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                    </div>

                </div>



            </div>
        </div>


        <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden">

            <div class="ud-scroll">

                <table class="ud-table">

                    <thead>

                        <tr>

                            <th>S.No</th>

                            <th>Plan</th>

                            <th>Amount</th>

                            <th>Status</th>

                            <th>Purchased At</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($rows as $purchase)

                        @php
                        $st = [
                        'paid' => 'success',
                        'succeeded' => 'success',
                        'completed' => 'success',
                        'active' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'cancelled' => 'danger',
                        ][strtolower($purchase->payment_status ?? '')] ?? 'secondary';
                        @endphp

                        <tr>

                            <td class="text-muted">{{ $purchase->id }}</td>

                            <td class="fw-semibold">
                                {{ $purchase->plan_name ?? data_get($purchase->details, 'plan_name', 'N/A') }}
                            </td>

                            <td class="fw-semibold text-nowrap">
                                ${{ number_format($purchase->amount ?? $purchase->price ?? 0, 2) }}</td>

                            <td><span
                                    class="ud-st ud-st-{{ $st }} rounded-pill d-inline-block text-nowrap">{{ ucfirst($purchase->payment_status) }}</span>
                            </td>

                            <td class="text-nowrap text-muted">{{ $purchase->created_at->format('d M Y') }}</td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center text-muted">
                                <div>No subscriptions found. <a href="{{ route('subscription.plan') }}">Buy a plan</a>
                                </div>
                                <div class="small">Plans you purchase will appear here.</div>
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div
            class="bg-white shadow-sm rounded-4 p-3 mt-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h6 class="fw-bold mb-1">Need help?</h6>
                <p class="text-muted small mb-0">Have a question about your plan or billing? Email connect@maseco.ca.
                </p>
            </div>
            <a href="{{ url('contact-us') }}" class="btn btn-outline-success btn-sm px-3">Contact us</a>
        </div>

    </div>

</div>

@include('user.Include.footer')
