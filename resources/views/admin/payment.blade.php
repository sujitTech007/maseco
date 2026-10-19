@include('admin.Include.header')


<div class="page-content payments-page">

    {{-- Page Heading --}}
    <!-- <div class="payments-heading">
        <div>
            <h3>Payments</h3>
            <div class="payments-breadcrumb">
                <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                <span>›</span>
                <span class="current">Payments</span>
            </div>
        </div>
    </div> -->

    @php
        $paymentCollection = collect($payments ?? []);

        $paidPayments = $paymentCollection->filter(function ($payment) {
            return strtolower((string) $payment->status) === 'paid';
        });

        $pendingPayments = $paymentCollection->filter(function ($payment) {
            return strtolower((string) $payment->status) === 'pending';
        });

        $failedPayments = $paymentCollection->filter(function ($payment) {
            return in_array(
                strtolower((string) $payment->status),
                ['failed', 'cancelled', 'rejected']
            );
        });

        $paidAmount = $paidPayments->sum(function ($payment) {
            return (float) ($payment->amount ?? 0);
        });
    @endphp

    <div class="payments-container">

        {{-- Summary Cards --}}
        <div class="row g-3 payments-summary">

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="payment-stat bg-danger bg-opacity-10">
                    <div class="payment-stat-icon total bg-danger bg-opacity-10">
                        <i class="ri-wallet-3-line text-danger"></i>
                    </div>
                    <div>
                        <p>Total Payments</p>
                        <h4>{{ $paymentCollection->count() }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="payment-stat bg-warning bg-opacity-10">
                    <div class="payment-stat-icon paid bg-warning bg-opacity-10">
                        <i class="ri-checkbox-circle-line text-warning"></i>
                    </div>
                    <div>
                        <p>Paid Transactions</p>
                        <h4>{{ $paidPayments->count() }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="payment-stat bg-success bg-opacity-10">
                    <div class="payment-stat-icon pending bg-success bg-opacity-10">
                        <i class="ri-time-line text-success"></i>
                    </div>
                    <div>
                        <p>Pending Payments</p>
                        <h4>{{ $pendingPayments->count() }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="payment-stat bg-primary bg-opacity-10">
                    <div class="payment-stat-icon failed bg-primary bg-opacity-10">
                        <i class="ri-error-warning-line text-primary"></i>
                    </div>
                    <div>
                        <p>Failed Payments</p>
                        <h4>{{ $failedPayments->count() }}</h4>
                    </div>
                </div>
            </div>

        </div>

        {{-- Payments Table --}}
        <div class="payments-card">

            <div class="payments-card-heading">
                <div>
                    <h5>Payment Transactions</h5>
                    <p>Review payment status, amounts and transaction references.</p>
                </div>

                <span class="payments-record-count">
                    {{ $paymentCollection->count() }}
                    {{ $paymentCollection->count() === 1 ? 'record' : 'records' }}
                </span>
            </div>

            {{-- Table Controls --}}
            <div class="payments-controls">

                <div class="payments-page-size">
                    <label for="payments-page-size">Show</label>

                    <select id="payments-page-size" class="payments-input">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="all">All</option>
                    </select>

                    <span>entries</span>
                </div>

                <div class="payments-search">
                    <i class="ri-search-line"></i>
                    <input type="search"
                           id="payments-search-input"
                           class="payments-input"
                           placeholder="Search payments..."
                           aria-label="Search payments">
                </div>

            </div>

            {{-- Table --}}
            <div class="table-responsive payments-table-wrapper">

                <table class="table payments-table align-middle mb-0"
                       id="payment-table">

                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Provider</th>
                            <th>Transaction ID</th>
                            <th>Date &amp; Time</th>
                        </tr>
                    </thead>

                    <tbody id="payments-table-body">

                        @forelse(($payments ?? []) as $p)

                            @php
                                $paymentStatus = strtolower(
                                    trim((string) ($p->status ?? 'pending'))
                                );

                                $paymentStatusClass = match ($paymentStatus) {
                                    'paid', 'completed', 'success', 'successful' => 'paid',
                                    'pending', 'processing' => 'pending',
                                    'failed', 'cancelled', 'rejected' => 'failed',
                                    'refunded' => 'refunded',
                                    default => 'other',
                                };

                                $order = $p->order;
                                $customerName = optional($order?->user)->name
                                    ?? 'User #'.($order?->user_id ?? '—');

                                $providerName = strtoupper(
                                    (string) ($p->provider ?? '—')
                                );

                                $transactionId = $p->transaction_id ?? '—';
                            @endphp

                            <tr class="payment-data-row">

                                <td data-label="Payment ID">
                                    <span class="payment-id">
                                        #{{ $p->id }}
                                    </span>
                                </td>

                                <td data-label="Order">
                                    <span class="payment-order">
                                        #{{ $p->order_id ?? '—' }}
                                    </span>
                                </td>

                                <td data-label="Customer">
                                    <div class="payment-customer">
                                        <span class="payment-avatar">
                                            {{ strtoupper(substr($customerName, 0, 1)) }}
                                        </span>
                                        <span class="payment-customer-name">
                                            {{ $customerName }}
                                        </span>
                                    </div>
                                </td>

                                <td data-label="Status">
                                    <span class="payment-status status-{{ $paymentStatusClass }}">
                                        <span class="payment-status-dot"></span>
                                        {{ ucfirst($paymentStatus) }}
                                    </span>
                                </td>

                                <td data-label="Amount">
                                    <span class="payment-amount">
                                        ${{ number_format((float) ($p->amount ?? 0), 2) }}
                                    </span>
                                </td>

                                <td data-label="Provider">
                                    <span class="payment-provider">
                                        {{ $providerName }}
                                    </span>
                                </td>

                                <td data-label="Transaction ID">
                                    <code class="payment-transaction">
                                        {{ $transactionId }}
                                    </code>
                                </td>

                                <td data-label="Date &amp; Time">
                                    <span class="payment-date">
                                        {{ $p->created_at?->format('d M Y, H:i') ?? '—' }}
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr class="payment-empty-row">
                                <td colspan="8">
                                    <div class="payments-empty">
                                        <i class="ri-wallet-3-line"></i>
                                        <h5>No payment records yet</h5>
                                        <p>Payment transactions will appear here when available.</p>
                                    </div>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>

                <div class="payments-no-results" id="payments-no-results" hidden>
                    <i class="ri-search-line"></i>
                    <p>No payments match your search.</p>
                </div>

            </div>

            {{-- Table Footer --}}
            <div class="payments-table-footer">
                <span id="payments-table-info">Showing 0 entries</span>
                <div class="payments-pagination" id="payments-pagination"></div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const page = document.querySelector('.payments-page');
    if (!page) return;

    const tbody = page.querySelector('#payments-table-body');
    const search = page.querySelector('#payments-search-input');
    const sizeSelect = page.querySelector('#payments-page-size');
    const info = page.querySelector('#payments-table-info');
    const pagination = page.querySelector('#payments-pagination');
    const noResults = page.querySelector('#payments-no-results');

    if (!tbody || !search || !sizeSelect || !info || !pagination) return;

    const rows = Array.from(tbody.querySelectorAll('.payment-data-row'));
    let currentPage = 1;

    function renderTable() {
        const query = search.value.trim().toLowerCase();

        const filtered = rows.filter(function (row) {
            return row.textContent.toLowerCase().includes(query);
        });

        const pageSize = sizeSelect.value === 'all'
            ? Math.max(filtered.length, 1)
            : parseInt(sizeSelect.value, 10);

        const total = filtered.length;
        const totalPages = Math.max(1, Math.ceil(total / pageSize));

        currentPage = Math.min(currentPage, totalPages);

        const start = (currentPage - 1) * pageSize;
        const end = Math.min(start + pageSize, total);

        rows.forEach(function (row) {
            row.hidden = true;
        });

        filtered.slice(start, end).forEach(function (row) {
            row.hidden = false;
        });

        if (noResults) {
            noResults.hidden = total !== 0 || rows.length === 0;
        }

        info.textContent = total === 0
            ? 'Showing 0 entries'
            : 'Showing ' + (start + 1) + ' to ' + end + ' of ' + total + ' entries';

        pagination.replaceChildren();

        function addButton(label, targetPage, disabled, active) {
            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = label;
            button.disabled = disabled;

            if (active) button.classList.add('active');

            button.addEventListener('click', function () {
                currentPage = targetPage;
                renderTable();
            });

            pagination.appendChild(button);
        }

        addButton('‹', Math.max(1, currentPage - 1), currentPage === 1, false);

        for (let number = 1; number <= totalPages; number++) {
            addButton(String(number), number, false, number === currentPage);
        }

        addButton(
            '›',
            Math.min(totalPages, currentPage + 1),
            currentPage === totalPages || total === 0,
            false
        );
    }

    search.addEventListener('input', function () {
        currentPage = 1;
        renderTable();
    });

    sizeSelect.addEventListener('change', function () {
        currentPage = 1;
        renderTable();
    });

    renderTable();
});
</script>
@include('admin.Include.footer')