@include('user.Include.header')

<style>
    .ud-scroll {
        overflow-x: auto;
    }

    .ud-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        border: 0 !important;
        background: transparent;
    }

    .ud-table th,
    .ud-table td {
        border: 0 !important;
        border-bottom: 1px solid #eef0f3 !important;
        padding: .9rem 1rem !important;
        text-align: left;
        vertical-align: middle;
        background: transparent;
        box-shadow: none !important;
    }

    .ud-table thead {
        background-color: rgb(76 76 92);
    }

    .ud-table th {
        color: #fff;
        font-weight: 700;
        font-size: .85rem;
    }

    .ud-table tbody tr:last-child td {
        border-bottom: 0 !important;
    }

    .ud-table tbody tr:hover td {
        background: #f3faf8 !important;
    }

    .ud-table td.text-center {
        text-align: center !important;
    }

    .ud-st {
        font-size: .8rem;
        font-weight: 600;
        padding: .3rem .7rem;
    }

    .ud-st::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        margin-right: .4rem;
        display: inline-block;
        vertical-align: middle;
    }

    .ud-st-success {
        background: #e6f4ec;
        color: #198754;
    }

    .ud-st-warning {
        background: #fff4d6;
        color: #a06a00;
    }

    .ud-st-danger {
        background: #fde8e8;
        color: #c0392b;
    }

    .ud-st-secondary {
        background: #eceff3;
        color: #5f6b7a;
    }
</style>

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

        <h4 class="mb-1 fs-bold main-heading"> Subscription</h4>
        <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">

            <a href="{{ route('user.dashboard') }}" style="color:#454545; text-decoration:none;">
                Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:10px;">
                ▶
            </span>

            <span style="color:#2DAC92;">
                Subscription
            </span>

        </div>

        <p class="text-muted mb-3">Your plan purchases and their payment status.</p>

        <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden">

            <div class="ud-scroll">

                <table class="ud-table">

                    <thead>

                        <tr>

                            <th>#</th>

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
                                    {{ $purchase->plan_name ?? data_get($purchase->details, 'plan_name', 'N/A') }}</td>

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