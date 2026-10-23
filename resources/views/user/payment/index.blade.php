@include('user.Include.header')

<style>
    .ud-scroll { overflow-x: auto; }

    .ud-table { width: 100%; border-collapse: collapse; margin: 0; border: 0 !important; background: transparent; }

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

    .ud-table thead { background-color: rgb(76 76 92); }
    .ud-table th { color: #fff; font-weight: 700; font-size: .85rem; }
    .ud-table tbody tr:last-child td { border-bottom: 0 !important; }
    .ud-table tbody tr:hover td { background: #f3faf8 !important; }
    .ud-table td.text-center { text-align: center !important; }

    .ud-st { font-size: .8rem; font-weight: 600; padding: .3rem .7rem; }
    .ud-st::before { content: ""; width: 6px; height: 6px; border-radius: 50%; background: currentColor; margin-right: .4rem; display: inline-block; vertical-align: middle; }
    .ud-st-success { background: #e6f4ec; color: #198754; }
    .ud-st-warning { background: #fff4d6; color: #a06a00; }
    .ud-st-danger { background: #fde8e8; color: #c0392b; }
    .ud-st-secondary { background: #eceff3; color: #5f6b7a; }
</style>

@php
    // TEMP DEMO DATA: only shows when the list is empty, APP_DEBUG is true and the URL has ?demo=1. Delete before launch.
    $rows = $payments;
    if ($rows->isEmpty() && config('app.debug') && request()->boolean('demo')) {
        $rows = collect([
            (object) ['id' => 31, 'order_id' => 1048, 'amount' => 2500, 'status' => 'pending', 'provider' => 'stripe', 'transaction_id' => null, 'created_at' => now()->subDays(1)],
            (object) ['id' => 30, 'order_id' => 1047, 'amount' => 1800, 'status' => 'paid', 'provider' => 'stripe', 'transaction_id' => 'pi_3Q8demo001', 'created_at' => now()->subDays(6)],
            (object) ['id' => 29, 'order_id' => 1046, 'amount' => 950, 'status' => 'paid', 'provider' => 'stripe', 'transaction_id' => 'pi_3Q7demo002', 'created_at' => now()->subDays(18)],
            (object) ['id' => 28, 'order_id' => 1045, 'amount' => 6400, 'status' => 'refunded', 'provider' => 'stripe', 'transaction_id' => 'pi_3Q6demo003', 'created_at' => now()->subDays(27)],
            (object) ['id' => 27, 'order_id' => 1044, 'amount' => 420, 'status' => 'failed', 'provider' => 'stripe', 'transaction_id' => null, 'created_at' => now()->subDays(43)],
        ]);
    }
@endphp

<div class="page-content">

    <div class="container py-1">

        <h4 class="mb-1 fs-bold main-heading"> Payments</h4>
        <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">

            <a href="{{ route('user.dashboard') }}" style="color:#454545; text-decoration:none;">
                Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:10px;">
                ▶
            </span>

            <span style="color:#2DAC92;">
                Payments
            </span>

        </div>

        <p class="text-muted mb-3">A record of the payments you have made across your orders and subscriptions.</p>


        
<!-- Order Payment Filter Card -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">

        <div class="row g-2 align-items-end">

            <!-- Search Payments -->
            <div class="col-12 col-md-6 col-xl-3">
                <label for="payment-search" class="form-label small fw-semibold">
                    Search Payments
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="fa-solid fa-magnifying-glass text-muted"></i>
                    </span>
                    <input type="search"
                           class="form-control"
                           id="payment-search"
                           placeholder="Payment ID or Order ID...">
                </div>
            </div>

            <!-- Payment Status -->
            <div class="col-6 col-md-3 col-xl-2">
                <label for="payment-status" class="form-label small fw-semibold">
                    Payment Status
                </label>
                <select class="form-select" id="payment-status">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="paid">Paid</option>
                    <option value="failed">Failed</option>
                    <option value="refunded">Refunded</option>
                </select>
            </div>

            <!-- Payment Method -->
            <div class="col-6 col-md-3 col-xl-2">
                <label for="payment-method" class="form-label small fw-semibold">
                    Payment Method
                </label>
                <select class="form-select" id="payment-method">
                    <option value="">All Methods</option>
                    <option value="upi">UPI</option>
                    <option value="card">Credit/Debit Card</option>
                    <option value="netbanking">Net Banking</option>
                    <option value="wallet">Wallet</option>
                    <option value="cod">Cash on Delivery</option>
                </select>
            </div>

            <!-- From Date -->
            <div class="col-6 col-md-4 col-xl-2">
                <label for="payment-start-date" class="form-label small fw-semibold">
                    From Date
                </label>
                <input type="date"
                       class="form-control"
                       id="payment-start-date">
            </div>

            <!-- To Date -->
            <div class="col-6 col-md-4 col-xl-2">
                <label for="payment-end-date" class="form-label small fw-semibold">
                    To Date
                </label>
                <input type="date"
                       class="form-control"
                       id="payment-end-date">
            </div>

            <!-- Apply Filter -->
            <div class="col-6 col-md-2 col-xl-1">
                <button type="button"
                        class="btn btn-success w-100 text-nowrap"
                        id="payment-filter-btn"
                        title="Apply Filters">
                    <i class="fa-solid fa-filter"></i>
                </button>
            </div>

        </div>

        <!-- Reset -->
       
    </div>
</div>


        <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden">

            <div class="ud-scroll">

                <table class="ud-table">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Order</th>

                            <th>Amount</th>

                            <th>Status</th>

                            <th>Provider</th>

                            <th>Transaction</th>

                            <th>Date</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($rows as $p)

                            @php
                                $st = [
                                    'paid' => 'success',
                                    'succeeded' => 'success',
                                    'completed' => 'success',
                                    'pending' => 'warning',
                                    'failed' => 'danger',
                                    'cancelled' => 'danger',
                                ][strtolower($p->status)] ?? 'secondary';
                            @endphp

                            <tr>

                                <td class="text-muted">{{ $p->id }}</td>

                                <td class="fw-semibold">#{{ $p->order_id }}</td>

                                <td class="fw-semibold text-nowrap">${{ number_format($p->amount, 2) }}</td>

                                <td><span
                                        class="ud-st ud-st-{{ $st }} rounded-pill d-inline-block text-nowrap">{{ ucfirst($p->status) }}</span>
                                </td>

                                <td class="text-nowrap">{{ strtoupper($p->provider ?? '-') }}</td>

                                <td><code>{{ $p->transaction_id ?? '-' }}</code></td>

                                <td class="text-nowrap text-muted">{{ $p->created_at->format('d M Y H:i') }}</td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center text-muted">
                                    <div>No payments found.</div>
                                    <div class="small">Payments for your orders and subscriptions will appear here.</div>
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
                <p class="text-muted small mb-0">Have a question about a payment? Email connect@maseco.ca.</p>
            </div>
            <a href="{{ url('contact-us') }}" class="btn btn-outline-success btn-sm px-3">Contact us</a>
        </div>

    </div>

</div>

@include('user.Include.footer')