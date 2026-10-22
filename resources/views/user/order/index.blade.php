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
    $rows = $orders;
    if ($rows->isEmpty() && config('app.debug') && request()->boolean('demo')) {
        $rows = collect([
            (object) ['id' => 1048, 'amount' => 2500, 'status' => 'processing', 'payment_status' => 'pending', 'payment' => null, 'created_at' => now()->subDays(1)],
            (object) ['id' => 1047, 'amount' => 1800, 'status' => 'completed', 'payment_status' => 'paid', 'payment' => (object) ['provider' => 'stripe', 'transaction_id' => 'pi_3Q8demo001'], 'created_at' => now()->subDays(6)],
            (object) ['id' => 1046, 'amount' => 950, 'status' => 'completed', 'payment_status' => 'paid', 'payment' => (object) ['provider' => 'stripe', 'transaction_id' => 'pi_3Q7demo002'], 'created_at' => now()->subDays(18)],
            (object) ['id' => 1045, 'amount' => 6400, 'status' => 'pending', 'payment_status' => 'pending', 'payment' => null, 'created_at' => now()->subDays(27)],
            (object) ['id' => 1044, 'amount' => 420, 'status' => 'cancelled', 'payment_status' => 'failed', 'payment' => null, 'created_at' => now()->subDays(43)],
        ]);
    }
@endphp

<div class="page-content">

    <div class="container py-1">

        <h4 class="mb-1 fs-bold main-heading"> Orders</h4>
        <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">

            <a href="{{ route('user.dashboard') }}" style="color:#454545; text-decoration:none;">
                Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:10px;">
                ▶
            </span>

            <span style="color:#2DAC92;">
                Orders
            </span>

        </div>

        <p class="text-muted mb-3">Track your material and production orders, and complete payment for any that are
            still pending.</p>

        <!-- Search + Buttons Row -->
        <div class="d-flex justify-content-between align-items-center mb-3">

            <!-- Search Box -->
            <div class="flex-grow-1" style="max-width: 500px;">
                <div class="position-relative">
                    <input type="text" id="orderSearch" class="form-control"
                        placeholder="Search for id, order, status..." style="padding-right:45px;">

                    <!-- Search Icon inside input -->
                    <i class="fa-solid fa-magnifying-glass" style="
                position:absolute;
                right:12px;
                top:50%;
                transform:translateY(-50%);
                font-size:18px;
                color: #4545455c;
                cursor:pointer;
                "></i>
                </div>
            </div>

            <!-- Right Buttons -->
            <div class="d-flex align-items-center gap-2">

                <button class="btn btn-outline-secondary d-flex align-items-center gap-1 filterbtn">
                    Filter
                    <span class="custom-filter-bars-icon" aria-hidden="true">
                        <span class="bar bar1"></span>
                        <span class="bar bar2"></span>
                        <span class="bar bar3"></span>
                    </span>
                </button>

                <!-- Export Button -->
                <button class="btn btn-outline-secondary d-flex align-items-center gap-1 filterbtn"
                    onclick="window.location='{{ route('user.orders.export') }}'">
                    Export
                    <i class="fa-solid fa-download"></i>
                </button>

            </div>

        </div>

        <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden">

            <div class="ud-scroll">

                <table class="ud-table">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Amount</th>

                            <th>Status</th>

                            <th>Payment</th>

                            <th>Date</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($rows as $order)

                            @php
                                $st = [
                                    'pending' => 'warning',
                                    'processing' => 'warning',
                                    'approved' => 'success',
                                    'accepted' => 'success',
                                    'completed' => 'success',
                                    'delivered' => 'success',
                                    'rejected' => 'danger',
                                    'cancelled' => 'danger',
                                ][strtolower($order->status)] ?? 'secondary';

                                $pst = [
                                    'pending' => 'warning',
                                    'paid' => 'success',
                                    'failed' => 'danger',
                                ][strtolower($order->payment_status ?? 'pending')] ?? 'secondary';
                            @endphp

                            <tr>

                                <td class="text-muted">{{ $order->id }}</td>

                                <td class="fw-semibold text-nowrap">${{ number_format($order->amount, 2) }}</td>

                                <td><span
                                        class="ud-st ud-st-{{ $st }} rounded-pill d-inline-block text-nowrap">{{ ucfirst($order->status) }}</span>
                                </td>

                                <td>

                                    <span
                                        class="ud-st ud-st-{{ $pst }} rounded-pill d-inline-block text-nowrap">{{ ucfirst($order->payment_status ?? 'pending') }}</span>

                                    @php($payment = optional($order->payment))

                                    @if(($order->payment_status ?? 'pending') === 'paid' && $payment)

                                        <div class="small text-muted mt-1">

                                            {{ strtoupper($payment->provider ?? '-') }} • <code>{{ $payment->transaction_id ?? '-' }}</code>

                                        </div>

                                    @endif

                                </td>

                                <td class="text-nowrap text-muted">{{ $order->created_at->format('d M Y') }}</td>

                                <td>

                                    @if(($order->payment_status ?? 'pending') !== 'paid')

                                        <form method="POST" action="{{ route('user.orders.pay', $order->id) }}"
                                            onsubmit="return startStripeCheckout(event, this)" class="m-0">

                                            @csrf

                                            <input type="hidden" name="order_id" value="{{ $order->id }}">

                                            <button class="btn btn-sm btn-success px-3 text-nowrap" type="submit">Pay with Card</button>

                                        </form>

                                    @else

                                        <a href="#" class="btn btn-sm btn-outline-success px-3 disabled" aria-disabled="true">Paid</a>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center text-muted">
                                    <div>No orders found.</div>
                                    <div class="small">Orders you place with suppliers and manufacturers will appear here.</div>
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
                <p class="text-muted small mb-0">Have a question about an order or a payment? Email connect@maseco.ca.</p>
            </div>
            <a href="{{ url('contact-us') }}" class="btn btn-outline-success btn-sm px-3">Contact us</a>
        </div>

    </div>

</div>

@include('user.Include.footer')





<script>
    function startStripeCheckout(e, form) {

        e.preventDefault();

        fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
                    'Accept': 'application/json'
                },
                body: new FormData(form)
            })

            .then(r => r.json())

            .then(d => {

                if (d.redirect) {
                    window.location.href = d.redirect;
                    return;
                }

                if (d.stripe_url) {
                    window.location.href = d.stripe_url;
                    return;
                }

                if (d.status === 'already_paid') {
                    window.location.reload();
                    return;
                }

                alert(d.error || 'Unable to start checkout');

            })

            .catch(() => alert('Network error'))

        return false;

    }
</script>


<script>
// === SEARCH FUNCTIONALITY ===
document.getElementById('orderSearch').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        if(text.includes(filter)){
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// === EXPORT FUNCTIONALITY ===
document.getElementById('exportBtn').addEventListener('click', function() {
    let rows = document.querySelectorAll('table tbody tr');
    let csvContent = "ID,Amount,Status,Payment,Date\n";

    rows.forEach(row => {
        if(row.style.display !== 'none'){ // only visible rows
            let cols = row.querySelectorAll('td');
            let rowData = [];
            cols.forEach(col => {
                let text = col.innerText.replace(/(\r\n|\n|\r)/gm, "").trim();
                rowData.push('"' + text + '"');
            });
            csvContent += rowData.join(",") + "\n";
        }
    });

    // Download CSV
    let blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    let link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = 'orders_export.csv';
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
</script>