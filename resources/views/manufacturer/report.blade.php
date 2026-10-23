
@include('manufacturer.Include.header')

<div class="page-content mt-3">
    <div class="page-container p-3">
        <div class="container-fluid">

            {{-- Page Heading --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Manufacturer Reports</h2>
                    <p class="text-muted mb-0">
                        Overview of your orders, payments and buyer enquiries with Maseco.
                    </p>
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

            {{-- Summary Cards --}}
            <div class="row g-3 mb-4">

                {{-- Total Orders --}}
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 rounded-4 shadow-sm border">
                        <div class="card-body p-3 p-xl-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-semibold">Total Orders</span>
                                <span class="rounded-3 p-2 text-white"
                                    style="background-color: var(--bs-orange, #fd7e14);">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </span>
                            </div>
                            <h3 class="fw-bold mb-1">{{ $ordersCount }}</h3>
                            <p class="text-muted small mb-0">All orders placed with you</p>
                        </div>
                    </div>
                </div>

                {{-- Completed Orders --}}
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 rounded-4 shadow-sm border border-success border-opacity-25">
                        <div class="card-body p-3 p-xl-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-semibold">Completed Orders</span>
                                <span class="rounded-3 bg-success p-2 text-white">
                                    <i class="fa-solid fa-circle-check"></i>
                                </span>
                            </div>
                            <h3 class="fw-bold mb-1">{{ $ordersCount }}</h3>
                            <p class="text-muted small mb-0">Orders reported as completed</p>
                        </div>
                    </div>
                </div>

                {{-- Payments Received --}}
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 rounded-4 shadow-sm border border-opacity-25"
                        style="border-color: rgba(var(--bs-purple-rgb, 111, 66, 193), .25) !important;">
                        <div class="card-body p-3 p-xl-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-semibold">Payments Received</span>
                                <span class="rounded-3 p-2 text-white"
                                    style="background-color: var(--bs-purple, #6f42c1);">
                                    <i class="fa-solid fa-credit-card"></i>
                                </span>
                            </div>
                            <h3 class="fw-bold mb-1 text-break">
                                ${{ number_format($paymentsTotal, 2) }}
                            </h3>
                            <p class="text-muted small mb-0">Total payments received</p>
                        </div>
                    </div>
                </div>

                {{-- Buyer Enquiries --}}
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 rounded-4 shadow-sm border border-primary border-opacity-25">
                        <div class="card-body p-3 p-xl-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-semibold">Buyer Enquiries</span>
                                <span class="rounded-3 bg-primary p-2 text-white">
                                    <i class="fa-solid fa-comments"></i>
                                </span>
                            </div>
                            <h3 class="fw-bold mb-1">{{ $enquiriesCount }}</h3>
                            <p class="text-muted small mb-0">Requests received from buyers</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Filters --}}
            <div class="card border-0 rounded-4 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fa-solid fa-filter text-success me-2"></i>
                        Filter Reports
                    </h5>
                </div>

                <div class="card-body p-3">
                    <div class="row g-3 align-items-end">

                        <div class="col-12 col-md-6 col-xl-3">
                            <label for="report-type" class="form-label fw-semibold">
                                Report Type
                            </label>
                            <select id="report-type" class="form-select">
                                <option value="all">All Reports</option>
                                <option value="orders">Orders Report</option>
                                <option value="completed-orders">Completed Orders Report</option>
                                <option value="payments">Payments Report</option>
                                <option value="enquiries">Enquiries Report</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 col-xl-3">
                            <label for="report-search" class="form-label fw-semibold">
                                Search
                            </label>
                            <input type="text" id="report-search" class="form-control"
                                placeholder="Search report details...">
                        </div>

                        <div class="col-12 col-md-6 col-xl-2">
                            <label for="report-from" class="form-label fw-semibold">
                                From Date
                            </label>
                            <input type="date" id="report-from" class="form-control">
                        </div>

                        <div class="col-12 col-md-6 col-xl-2">
                            <label for="report-to" class="form-label fw-semibold">
                                To Date
                            </label>
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

            {{-- Report Table --}}
            <div class="card border-0 rounded-4 shadow-sm mb-4">
                <div class="card-header bg-white py-3 d-flex flex-column flex-sm-row
                    justify-content-between align-items-sm-center gap-2">
                    <div>
                        <h5 class="fw-bold mb-1">Report Details</h5>
                        <p class="text-muted small mb-0">
                            Summary of your manufacturer account activity.
                        </p>
                    </div>

                    <span class="badge bg-success bg-opacity-10 text-success fs-6"
                        id="record-count">0 Records</span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="report-table">
                        <thead class="table-light">
                            <tr>
                                <th class="px-3">#</th>
                                <th>Report Category</th>
                                <th>Description</th>
                                <th>Value</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr data-category="orders">
                                <td class="px-3 report-number"></td>
                                <td>Orders</td>
                                <td>Total orders placed with you</td>
                                <td>{{ $ordersCount }}</td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        Summary
                                    </span>
                                </td>
                            </tr>

                            <tr data-category="completed-orders">
                                <td class="px-3 report-number"></td>
                                <td>Completed Orders</td>
                                <td>Orders reported as completed</td>
                                <td>{{ $ordersCount }}</td>
                                <td>
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        Summary
                                    </span>
                                </td>
                            </tr>

                            <tr data-category="payments">
                                <td class="px-3 report-number"></td>
                                <td>Payments</td>
                                <td>Total payments received</td>
                                <td>${{ number_format($paymentsTotal, 2) }}</td>
                                <td>
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        Summary
                                    </span>
                                </td>
                            </tr>

                            <tr data-category="enquiries">
                                <td class="px-3 report-number"></td>
                                <td>Buyer Enquiries</td>
                                <td>Total enquiries received from buyers</td>
                                <td>{{ $enquiriesCount }}</td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info">
                                        Summary
                                    </span>
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
                        Note: This report uses the summary variables supplied to your dashboard.
                        Individual order, payment and enquiry dates require the corresponding
                        records from your controller.
                    </p>
                </div>
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
        let visibleCount = 0;

        rows.forEach(function (row) {
            const category = row.dataset.category;
            const text = row.innerText.toLowerCase();

            const matchesType = type === 'all' || category === type;
            const matchesSearch = text.includes(search);
            const visible = matchesType && matchesSearch;

            row.classList.toggle('d-none', !visible);

            if (visible) {
                visibleCount++;
                row.querySelector('.report-number').textContent = visibleCount;
            }
        });

        noResults.classList.toggle('d-none', visibleCount > 0);
        countLabel.textContent =
            visibleCount + (visibleCount === 1 ? ' Record' : ' Records');
    }

    document.getElementById('apply-filters').addEventListener('click', function () {
        if (fromInput.value && toInput.value && fromInput.value > toInput.value) {
            alert('From Date cannot be later than To Date.');
            return;
        }

        if (fromInput.value || toInput.value) {
            alert('Date filtering requires individual dated records from the controller. The current dashboard provides summary values only.');
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
        const visibleRows = rows.filter(function (row) {
            return !row.classList.contains('d-none');
        });

        const headers = Array.from(table.querySelectorAll('thead th'))
            .map(function (th) {
                return th.innerText.trim();
            });

        function escapeCsv(value) {
            let text = String(value ?? '').replace(/\s+/g, ' ').trim();

            if (/^[=+\-@\t\r]/.test(text)) {
                text = "'" + text;
            }

            return '"' + text.replace(/"/g, '""') + '"';
        }

        const csvRows = [headers.map(escapeCsv).join(',')];

        visibleRows.forEach(function (row) {
            const cells = Array.from(row.querySelectorAll('td'))
                .map(function (cell) {
                    return cell.innerText.trim();
                });

            csvRows.push(cells.map(escapeCsv).join(','));
        });

        const blob = new Blob(['\uFEFF' + csvRows.join('\r\n')], {
            type: 'text/csv;charset=utf-8;'
        });

        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');

        link.href = url;
        link.download = 'manufacturer-dashboard-report.csv';
        document.body.appendChild(link);
        link.click();
        link.remove();
        URL.revokeObjectURL(url);
    });

    applyFilters();
});
</script>

@include('manufacturer.Include.footer')