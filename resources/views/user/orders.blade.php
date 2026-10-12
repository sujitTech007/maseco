@include('user.Include.header')





<div class="page-content">



    <div class="container py-1">

        <h4 class="mb-1 fs-bold main-heading"> Orders</h2>
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
            <!-- Search + Filter Row -->
            <!-- Search + Buttons Row -->
            <div class="d-flex justify-content-between align-items-center mb-3">

                <!-- Search Box -->
                <div class="flex-grow-1" style="max-width: 500px;">
                    <div class="position-relative">
                         <input type="text" id="orderSearch" class="form-control"
               placeholder="Search for id, order, status..."
               style="padding-right:45px;">

                        <!-- Search Icon inside input -->
                        <i class="bi bi-search"
                            style="
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
    <i class="bi bi-download"></i>
</button>

                    

                </div>

            </div>


            <div class="table-responsive">

                <table class="table table-striped align-middle">

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

                        @forelse($orders as $order)

                        <tr>

                            <td>{{ $order->id }}</td>

                            <td>${{ number_format($order->amount, 2) }}</td>

                            <td>{{ ucfirst($order->status) }}</td>

                            <td>

                                {{ ucfirst($order->payment_status ?? 'pending') }}

                                @php($payment = optional($order->payment))

                                @if(($order->payment_status ?? 'pending') === 'paid' && $payment)

                                <div class="small text-muted mt-1">

                                    {{ strtoupper($payment->provider ?? '-') }} • <code>{{ $payment->transaction_id ?? '-' }}</code>

                                </div>

                                @endif

                            </td>

                            <td>{{ $order->created_at->format('d M Y') }}</td>

                            <td>

                                @if(($order->payment_status ?? 'pending') !== 'paid')

                                <form method="POST" action="{{ route('user.orders.pay', $order->id) }}" onsubmit="return startStripeCheckout(event, this)">

                                    @csrf

                                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                                    <button class="btn btn-sm btn-primary" type="submit">Pay with Card</button>

                                </form>

                                @else

                                <a href="#" class="btn btn-sm btn-success" disabled>Paid</a>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="text-center">No orders found.</td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

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