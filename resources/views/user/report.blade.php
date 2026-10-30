
@include('user.Include.header')

<div class="page-content">
    <div class="container py-3">

        {{-- Page Heading --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="fw-bold mb-1 dashboard_title">My Reports</h1>
                <p class="text-muted mb-0">Review your account activity, enquiries, orders and payments.</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="button" class="btn btn-outline-success rounded-3"
                    onclick="window.print()">
                    <i class="fa-solid fa-print me-1"></i> Print Report
                </button>
                <button type="button" class="btn btn-success rounded-3" id="export-report">
                    <i class="fa-solid fa-file-csv me-1"></i> Export CSV
                </button>
            </div>
        </div>

        {{-- Report Summary --}}
        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card  border-success border-opacity-25 bg-success bg-opacity-10 rounded-4 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">Total Enquiries</span>
                            <span class="rounded-3 bg-success text-white p-2">
                                <i class="fa-solid fa-comments"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $enquiriesCount }}</h3>
                        <p class="text-muted small mb-0">Enquiries in your account</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card  border-primary border-opacity-25 bg-primary bg-opacity-10 rounded-4 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">Total Orders</span>
                            <span class="rounded-3 bg-primary text-white p-2">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $ordersCount }}</h3>
                        <p class="text-muted small mb-0">Orders in your account</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card  border-warning border-opacity-25 bg-warning bg-opacity-10 rounded-4 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">Total Payments</span>
                            <span class="rounded-3 bg-warning text-dark p-2">
                                <i class="fa-solid fa-credit-card"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1">${{ number_format($paymentsTotal, 2) }}</h3>
                        <p class="text-muted small mb-0">Reported payment total</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card  border-secondary border-opacity-25 bg-secondary bg-opacity-10 rounded-4 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">Subscription</span>
                            <span class="rounded-3 bg-secondary text-white p-2">
                                <i class="fa-solid fa-star"></i>
                            </span>
                        </div>
                        <h5 class="fw-bold mb-1">
                            {{ $activeSubscription ? ($activeSubscription->plan_name ?? 'Active Plan') : 'No Active Plan' }}
                        </h5>
                        <p class="text-muted small mb-0">
                            {{ $activeSubscription ? ucfirst($activeSubscription->payment_status ?? 'Active') : 'Subscription status' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Filters --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-bottom py-3 rounded-top-4">
                <h5 class="fw-bold mb-0">
                    <i class="fa-solid fa-filter me-2 text-success"></i>Filter Reports
                </h5>
            </div>

            <div class="card-body p-3">
                <div class="row g-3 align-items-end">

                    <div class="col-12 col-md-6 col-xl-3">
                        <label for="report-type" class="form-label fw-semibold">Report Type</label>
                        <select id="report-type" class="form-select">
                            <option value="all">Account Summary</option>
                            <option value="profile">Profile Report</option>
                            <option value="subscription">Subscription Report</option>
                            <option value="payments">Payment Summary</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <label for="report-search" class="form-label fw-semibold">Search</label>
                        <input type="text" id="report-search" class="form-control"
                            placeholder="Search report details...">
                    </div>

                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="report-from" class="form-label fw-semibold">From Date</label>
                        <input type="date" id="report-from" class="form-control">
                    </div>

                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="report-to" class="form-label fw-semibold">To Date</label>
                        <input type="date" id="report-to" class="form-control">
                    </div>

                    <div class="col-12 col-xl-2 d-flex gap-2">
                        <button type="button" id="apply-filters"
                            class="btn btn-success flex-fill">Apply</button>
                        <button type="button" id="reset-filters"
                            class="btn btn-outline-secondary flex-fill">Reset</button>
                    </div>

                </div>
            </div>
        </div>

        {{-- Report Details --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white py-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                <div>
                    <h5 class="fw-bold mb-1">Report Details</h5>
                    <p class="text-muted small mb-0">Account information currently available in your dashboard.</p>
                </div>
                <span class="badge bg-success bg-opacity-10 text-success fs-6" id="record-count">0 Records</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="report-table">
                    <thead class="table-light">
                        <tr>
                            <th class="px-3">#</th>
                            <th>Report Category</th>
                            <th>Details</th>
                            <th>Value</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-category="profile" data-date="{{ $user->created_at?->format('Y-m-d') ?? '' }}">
                            <td class="px-3 report-number"></td>
                            <td>Profile</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-success bg-opacity-10 text-success">Available</span></td>
                        </tr>

                        <tr data-category="profile" data-date="{{ $user->created_at?->format('Y-m-d') ?? '' }}">
                            <td class="px-3 report-number"></td>
                            <td>Contact Information</td>
                            <td>{{ $user->phone ? trim(($user->country_code ?? '') . ' ' . $user->phone) : 'Not provided' }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-success bg-opacity-10 text-success">Available</span></td>
                        </tr>

                        <tr data-category="all" data-date="">
                            <td class="px-3 report-number"></td>
                            <td>Enquiries</td>
                            <td>Total enquiries</td>
                            <td>{{ $enquiriesCount }}</td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">Summary</span></td>
                        </tr>

                        <tr data-category="all" data-date="">
                            <td class="px-3 report-number"></td>
                            <td>Orders</td>
                            <td>Total orders</td>
                            <td>{{ $ordersCount }}</td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">Summary</span></td>
                        </tr>

                        <tr data-category="payments" data-date="">
                            <td class="px-3 report-number"></td>
                            <td>Payments</td>
                            <td>Total payments amount</td>
                            <td>${{ number_format($paymentsTotal, 2) }}</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-dark">Summary</span></td>
                        </tr>

                        <tr data-category="subscription" data-date="{{ $activeSubscription?->created_at?->format('Y-m-d') ?? '' }}">
                            <td class="px-3 report-number"></td>
                            <td>Subscription</td>
                            <td>{{ $activeSubscription->plan_name ?? 'No active subscription' }}</td>
                            <td>
                                @if($activeSubscription)
                                    ${{ number_format($activeSubscription->amount ?? $activeSubscription->price ?? 0, 2) }}
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                @if($activeSubscription)
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        {{ ucfirst($activeSubscription->payment_status ?? 'Active') }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Inactive</span>
                                @endif
                            </td>
                        </tr>

                        <tr id="no-report-results" class="d-none">
                            <td colspan="5" class="text-center text-muted py-4">
                                No records match your filters.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-0 py-3">
                <p class="small text-muted mb-0">
                    Note: This report shows summary values supplied to the dashboard. Detailed order,
                    enquiry and payment history requires the corresponding records from your controller.
                </p>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeInput = document.getElementById('report-type');
    const searchInput = document.getElementById('report-search');
    const fromInput = document.getElementById('report-from');
    const toInput = document.getElementById('report-to');
    const table = document.getElementById('report-table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr[data-category]'));
    const noResults = document.getElementById('no-report-results');
    const countLabel = document.getElementById('record-count');

    function applyFilters() {
        const type = typeInput.value;
        const search = searchInput.value.trim().toLowerCase();
        const from = fromInput.value;
        const to = toInput.value;
        let count = 0;

        rows.forEach(function (row) {
            const category = row.dataset.category;
            const date = row.dataset.date || '';
            const matchesType = type === 'all' || category === type;
            const matchesSearch = row.innerText.toLowerCase().includes(search);

            // Summary rows without an individual date remain visible when a date
            // filter is applied because the dashboard provides totals, not dated records.
            const matchesFrom = !from || !date || date >= from;
            const matchesTo = !to || !date || date <= to;

            const visible = matchesType && matchesSearch && matchesFrom && matchesTo;
            row.classList.toggle('d-none', !visible);

            if (visible) {
                count++;
                row.querySelector('.report-number').textContent = count;
            }
        });

        noResults.classList.toggle('d-none', count !== 0);
        countLabel.textContent = count + (count === 1 ? ' Record' : ' Records');
    }

    document.getElementById('apply-filters').addEventListener('click', function () {
        if (fromInput.value && toInput.value && fromInput.value > toInput.value) {
            alert('From Date cannot be later than To Date.');
            return;
        }
        applyFilters();
    });

    typeInput.addEventListener('change', applyFilters);
    searchInput.addEventListener('input', applyFilters);

    document.getElementById('reset-filters').addEventListener('click', function () {
        typeInput.value = 'all';
        searchInput.value = '';
        fromInput.value = '';
        toInput.value = '';
        applyFilters();
    });

    document.getElementById('export-report').addEventListener('click', function () {
        const visibleRows = rows.filter(row => !row.classList.contains('d-none'));
        const headers = Array.from(table.querySelectorAll('thead th'))
            .map(th => th.innerText.trim());

        function escapeCsv(value) {
            let text = String(value ?? '').replace(/\s+/g, ' ').trim();
            if (/^[=+\-@\t\r]/.test(text)) text = "'" + text;
            return '"' + text.replace(/"/g, '""') + '"';
        }

        const csv = [headers.map(escapeCsv).join(',')];

        visibleRows.forEach(function (row) {
            const cells = Array.from(row.querySelectorAll('td'))
                .map(cell => cell.innerText.trim());
            csv.push(cells.map(escapeCsv).join(','));
        });

        const blob = new Blob(['\uFEFF' + csv.join('\r\n')], {
            type: 'text/csv;charset=utf-8;'
        });

        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'my-dashboard-report.csv';
        document.body.appendChild(link);
        link.click();
        link.remove();
        URL.revokeObjectURL(url);
    });

    applyFilters();
});
</script>

@include('user.Include.footer')
