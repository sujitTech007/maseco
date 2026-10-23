
@include('admin.Include.header')

<!-- Admin Reports Page -->
<div class="page-content">
    <div class="container-fluid p-3">

        <!-- Page Heading -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active" aria-current="page">Reports</li>
                    </ol>
                </nav>

                <h3 class="fw-semibold mb-1">Reports & Analytics</h3>
                <p class="text-muted mb-0">
                    Monitor business performance and generate reports.
                </p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="button"
                        class="btn btn-outline-success"
                        onclick="window.print()">
                    <i class="fa-solid fa-print me-2"></i>Print Report
                </button>

                <button type="button"
                        class="btn btn-success"
                        id="export-report-btn">
                    <i class="fa-solid fa-file-csv me-2"></i>Export CSV
                </button>
            </div>
        </div>

        <!-- Report Summary Cards -->
        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small">Total Buyers</span>
                            <span class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                                <i class="fa-solid fa-users"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $users->count() }}</h3>
                        <span class="text-muted small">Registered accounts</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small">Active Buyers</span>
                            <span class="bg-success bg-opacity-10 text-success rounded-3 p-2">
                                <i class="fa-solid fa-user-check"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1">
                            {{ $users->where('status', '1')->count() }}
                        </h3>
                        <span class="text-muted small">Currently active</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small">Inactive Buyers</span>
                            <span class="bg-warning bg-opacity-10 text-warning rounded-3 p-2">
                                <i class="fa-solid fa-user-clock"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1">
                            {{ $users->count() - $users->where('status', '1')->count() }}
                        </h3>
                        <span class="text-muted small">Inactive accounts</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small">Report Records</span>
                            <span class="bg-info bg-opacity-10 text-info rounded-3 p-2">
                                <i class="fa-solid fa-chart-column"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1" id="report-record-count">
                            {{ $users->count() }}
                        </h3>
                        <span class="text-muted small">Records in this report</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Report Filters -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3 p-lg-4">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="bg-success bg-opacity-10 text-success rounded-3 p-2">
                        <i class="fa-solid fa-sliders"></i>
                    </span>
                    <div>
                        <h5 class="mb-0 fw-semibold">Report Filters</h5>
                        <small class="text-muted">Select criteria to filter report records.</small>
                    </div>
                </div>

                <hr class="text-muted opacity-25">

                <div class="row g-3 align-items-end">

                    <!-- Search -->
                    <div class="col-12 col-md-6 col-xl-3">
                        <label for="report-search" class="form-label small fw-semibold">
                            Search Records
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fa-solid fa-magnifying-glass text-muted"></i>
                            </span>
                            <input type="search"
                                   class="form-control"
                                   id="report-search"
                                   placeholder="Search name, email, phone...">
                        </div>
                    </div>

                    <!-- Report Type -->
                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="report-type" class="form-label small fw-semibold">
                            Report Type
                        </label>
                        <select class="form-select" id="report-type">
                            <option value="buyers">Buyer Report</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="report-status" class="form-label small fw-semibold">
                            Account Status
                        </label>
                        <select class="form-select" id="report-status">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="report-start-date" class="form-label small fw-semibold">
                            From Date
                        </label>
                        <input type="date"
                               class="form-control"
                               id="report-start-date">
                    </div>

                    <!-- End Date -->
                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="report-end-date" class="form-label small fw-semibold">
                            To Date
                        </label>
                        <input type="date"
                               class="form-control"
                               id="report-end-date">
                    </div>

                    <!-- Apply -->
                    <div class="col-6 col-md-3 col-xl-1 d-grid">
                        <button type="button"
                                class="btn btn-success"
                                id="apply-report-filters"
                                title="Apply Filters">
                            <i class="fa-solid fa-filter"></i>
                            <span class="d-xl-none ms-1">Filter</span>
                        </button>
                    </div>

                    <!-- Reset -->
                    <div class="col-6 col-md-3 col-xl-2 d-grid">
                        <button type="button"
                                class="btn btn-outline-secondary"
                                id="reset-report-filters">
                            <i class="fa-solid fa-rotate-left me-1"></i>Reset
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Report Table -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 p-3 p-lg-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                    <div>
                        <h5 class="fw-semibold mb-1">Buyer Report</h5>
                        <p class="text-muted small mb-0">
                            Overview of registered buyer accounts.
                        </p>
                    </div>

                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2"
                          id="report-results-label">
                        {{ $users->count() }} Records
                    </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="report-table">
                    <thead class="table-light">
                        <tr>
                            <th class="px-3 py-3">S.No.</th>
                            <th class="py-3">Buyer Name</th>
                            <th class="py-3">Email Address</th>
                            <th class="py-3">Phone Number</th>
                            <th class="py-3">Account Status</th>
                            <th class="py-3">Registered Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                        <tr data-status="{{ $user->status == '1' ? 'active' : 'inactive' }}"
                            data-date="{{ $user->created_at ? $user->created_at->format('Y-m-d') : '' }}">

                            <td class="px-3 report-serial">{{ $loop->iteration }}</td>

                            <td>
                                <div class="fw-semibold">{{ $user->name }}</div>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>{{ trim(($user->country_code ?? '') . ' ' . ($user->phone ?? '')) ?: '—' }}</td>

                            <td>
                                @if($user->status == '1')
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $user->created_at ? $user->created_at->format('d M Y') : '—' }}
                            </td>
                        </tr>
                        @empty
                        <tr id="report-empty-row">
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-folder-open fs-3 d-block mb-2"></i>
                                No report records available.
                            </td>
                        </tr>
                        @endforelse

                        <tr id="report-no-results" class="d-none">
                            <td colspan="6" class="text-center py-5 text-muted">
                                No records match your filters.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-0 text-muted small p-3">
                Report generated from the buyer records currently loaded by the server.
            </div>
        </div>

    </div>
</div>

<!-- Report Filtering & CSV Export -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('report-search');
    const statusInput = document.getElementById('report-status');
    const startInput = document.getElementById('report-start-date');
    const endInput = document.getElementById('report-end-date');
    const applyButton = document.getElementById('apply-report-filters');
    const resetButton = document.getElementById('reset-report-filters');
    const exportButton = document.getElementById('export-report-btn');
    const table = document.getElementById('report-table');
    const tbody = table.querySelector('tbody');

    const originalRows = Array.from(tbody.querySelectorAll('tr[data-status]'));
    const noResults = document.getElementById('report-no-results');

    function filterReport() {
        const search = searchInput.value.trim().toLowerCase();
        const status = statusInput.value;
        const from = startInput.value;
        const to = endInput.value;

        let visibleCount = 0;

        originalRows.forEach(function (row) {
            const text = row.innerText.toLowerCase();
            const rowStatus = row.dataset.status;
            const rowDate = row.dataset.date;

            const matchesSearch = text.includes(search);
            const matchesStatus = !status || rowStatus === status;
            const matchesFrom = !from || (rowDate && rowDate >= from);
            const matchesTo = !to || (rowDate && rowDate <= to);

            const visible = matchesSearch && matchesStatus &&
                            matchesFrom && matchesTo;

            row.classList.toggle('d-none', !visible);

            if (visible) {
                visibleCount++;
                row.querySelector('.report-serial').textContent = visibleCount;
            }
        });

        noResults.classList.toggle('d-none', visibleCount > 0);

        document.getElementById('report-record-count').textContent = visibleCount;
        document.getElementById('report-results-label').textContent =
            visibleCount + (visibleCount === 1 ? ' Record' : ' Records');
    }

    applyButton.addEventListener('click', function () {
        if (startInput.value && endInput.value &&
            startInput.value > endInput.value) {
            alert('From Date cannot be later than To Date.');
            return;
        }

        filterReport();
    });

    searchInput.addEventListener('input', filterReport);
    statusInput.addEventListener('change', filterReport);

    resetButton.addEventListener('click', function () {
        searchInput.value = '';
        statusInput.value = '';
        startInput.value = '';
        endInput.value = '';
        filterReport();
    });

    exportButton.addEventListener('click', function () {
        const visibleRows = originalRows.filter(function (row) {
            return !row.classList.contains('d-none');
        });

        const headers = Array.from(table.querySelectorAll('thead th'))
            .map(function (th) {
                return th.innerText.trim();
            });

        const csvEscape = function (value) {
            let text = String(value ?? '').replace(/\s+/g, ' ').trim();

            // Prevent spreadsheet formula execution for untrusted cell values.
            if (/^[=+\-@\t\r]/.test(text)) {
                text = "'" + text;
            }

            return '"' + text.replace(/"/g, '""') + '"';
        };

        const csvRows = [headers.map(csvEscape).join(',')];

        visibleRows.forEach(function (row) {
            const cells = Array.from(row.querySelectorAll('td'))
                .map(function (cell) {
                    return cell.innerText.trim();
                });

            csvRows.push(cells.map(csvEscape).join(','));
        });

        const blob = new Blob(
            ['\uFEFF' + csvRows.join('\r\n')],
            { type: 'text/csv;charset=utf-8;' }
        );

        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');

        link.href = url;
        link.download = 'buyer-report.csv';
        link.click();

        URL.revokeObjectURL(url);
    });

    filterReport();
});
</script>

@include('admin.Include.footer')
