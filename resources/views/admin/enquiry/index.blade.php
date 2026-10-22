@include('admin.Include.header')

<!-- Begin page -->


<div class="page-content enquiry-page">

    {{-- Page Heading --}}
    <!-- <div class="enquiry-page-header">
        <div>
            <h3>Enquiries</h3>
            <div class="enquiry-breadcrumb">
                <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                <span>›</span>
                <span class="current">Enquiries</span>
            </div>
        </div>
    </div> -->

    @php
        $enquiryCollection = collect($enquiries ?? []);

        $pendingCount = $enquiryCollection->filter(function ($item) {
            return strtolower((string) ($item->status ?? 'pending')) === 'pending';
        })->count();

        $inProgressCount = $enquiryCollection->filter(function ($item) {
            return in_array(
                strtolower((string) ($item->status ?? '')),
                ['in progress', 'processing', 'reviewing']
            );
        })->count();

        $completedCount = $enquiryCollection->filter(function ($item) {
            return in_array(
                strtolower((string) ($item->status ?? '')),
                ['completed', 'approved', 'resolved', 'closed']
            );
        })->count();
    @endphp

    <div class="enquiry-container page-container">

        {{-- Summary --}}
        <div class="row g-3 enquiry-summary">

            <div class="col-12 col-sm-6 col-xl-4">
                <div class="enquiry-stat bg-danger bg-opacity-10">
                    <div class="enquiry-stat-icon total bg-danger bg-opacity-10">
                        <i class="fa-solid fa-list text-danger"></i>
                    </div>
                    <div>
                        <p>Total Enquiries</p>
                        <h4>{{ $enquiryCollection->count() }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4">
                <div class="enquiry-stat bg-warning bg-opacity-10">
                    <div class="enquiry-stat-icon pending bg-warning bg-opacity-10">
                        <i class="fa-solid fa-clock text-warning"></i>
                    </div>
                    <div>
                        <p>Pending</p>
                        <h4>{{ $pendingCount }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4">
                <div class="enquiry-stat bg-success bg-opacity-10">
                    <div class="enquiry-stat-icon completed bg-success bg-opacity-10">
                        <i class="fa-solid fa-circle-check text-success"></i>
                    </div>
                    <div>
                        <p>Completed</p>
                        <h4>{{ $completedCount }}</h4>
                    </div>
                </div>
            </div>

        </div>

        {{-- Enquiry Table Card --}}
        <div class="enquiry-card">

           <div class="enquiry-card-heading d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3">
    <div>
        <h5>All Enquiries</h5>
        <p>Review buyer requests, materials and expected prices.</p>
    </div>

    <div class="d-flex flex-wrap align-items-center gap-2">
        <select class="form-select" id="enquiry-status-filter" aria-label="Filter by status" style="width: 160px;">
            <option value="">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="in-progress">In Progress</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
            <option value="completed">Completed</option>
        </select>

        <input type="date"
               class="form-control"
               id="enquiry-start-date"
               aria-label="Start date"
               style="width: 155px;">

        <input type="date"
               class="form-control"
               id="enquiry-end-date"
               aria-label="End date"
               style="width: 155px;">

        <button type="button"
                class="btn btn-outline-success"
                id="enquiry-filter-btn">
            <i class="ri-filter-3-line me-1"></i> Filter
        </button>

        <span class="enquiry-total-label">
            {{ $enquiryCollection->count() }}
            {{ $enquiryCollection->count() === 1 ? 'record' : 'records' }}
        </span>
    </div>
</div>

            {{-- Table Controls --}}
            <div class="enquiry-table-controls">

                <div class="enquiry-length">
                    <label for="enquiry-page-size">Show</label>

                    <select class="enquiry-control"
                            id="enquiry-page-size">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="all">All</option>
                    </select>

                    <span>entries</span>
                </div>

                <div class="enquiry-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search"
                           class="enquiry-control"
                           id="enquiry-search-input"
                           placeholder="Search enquiries..."
                           aria-label="Search enquiries">
                </div>

            </div>

            {{-- Table --}}
            <div class="table-responsive enquiry-table-wrapper">

                <table class="table enquiry-table align-middle mb-0"
                       id="textile-enquiry-table">

                    <thead>
                        <tr>
                            <th>Enquiry ID</th>
                            <th>Buyer</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Expected Price</th>
                            <th>Status</th>
                            <th>Date Submitted</th>
                        </tr>
                    </thead>

                    <tbody id="enquiry-table-body">
                        @forelse(($enquiries ?? []) as $e)
                            @php
                                $enquiryStatus = strtolower(trim((string) ($e->status ?? 'pending')));

                                $statusClass = match ($enquiryStatus) {
                                    'pending' => 'pending',
                                    'in progress', 'processing', 'reviewing' => 'progress',
                                    'completed', 'approved', 'resolved', 'closed' => 'completed',
                                    'rejected', 'cancelled', 'declined' => 'rejected',
                                    default => 'other',
                                };

                                $materialName = optional(
                                    \App\Models\Material::find($e->material_id)
                                )->name ?? '-';

                                $buyerName = optional($e->user)->name
                                    ?? 'User #'.$e->user_id;

                                $submittedDate = $e->created_at?->format('d M Y') ?? '-';
                            @endphp

                            <tr class="enquiry-data-row">
                                <td data-label="Enquiry ID">
                                    <span class="enquiry-id">#{{ $e->id }}</span>
                                </td>

                                <td data-label="Buyer">
                                    <div class="enquiry-buyer">
                                        <span class="enquiry-avatar">
                                            {{ strtoupper(substr($buyerName, 0, 1)) }}
                                        </span>
                                        <span class="enquiry-user">{{ $buyerName }}</span>
                                    </div>
                                </td>

                                <td data-label="Material">
                                    <span class="enquiry-material">{{ $materialName }}</span>
                                </td>

                                <td data-label="Quantity">
                                    {{ $e->quantity ?? '-' }}
                                </td>

                                <td data-label="Expected Price">
                                    <span class="enquiry-price">
                                        ${{ number_format((float) ($e->expected_price ?? 0), 2) }}
                                    </span>
                                </td>

                                <td data-label="Status">
                                    <span class="enquiry-status status-{{ $statusClass }}">
                                        <span class="status-dot"></span>
                                        {{ ucfirst($enquiryStatus) }}
                                    </span>
                                </td>

                                <td data-label="Date Submitted">
                                    <span class="enquiry-date">{{ $submittedDate }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr class="enquiry-empty-row">
                                <td colspan="7">
                                    <div class="enquiry-empty">
                                        <i class="fa-solid fa-inbox"></i>
                                        <h5>No enquiries yet</h5>
                                        <p>Buyer enquiries will appear here when submitted.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

                <div class="enquiry-no-results" id="enquiry-no-results" hidden>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p>No enquiries match your search.</p>
                </div>

            </div>

            {{-- Table Footer --}}
            <div class="enquiry-table-footer">
                <span id="enquiry-table-info">Showing 0 entries</span>

                <div class="enquiry-pagination" id="enquiry-pagination"></div>
            </div>

        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const page = document.querySelector('.enquiry-page');
    if (!page) return;

    const tableBody = page.querySelector('#enquiry-table-body');
    const searchInput = page.querySelector('#enquiry-search-input');
    const pageSizeSelect = page.querySelector('#enquiry-page-size');
    const info = page.querySelector('#enquiry-table-info');
    const pagination = page.querySelector('#enquiry-pagination');
    const noResults = page.querySelector('#enquiry-no-results');

    if (!tableBody || !searchInput || !pageSizeSelect || !info || !pagination) {
        return;
    }

    const rows = Array.from(
        tableBody.querySelectorAll('tr.enquiry-data-row')
    );

    let currentPage = 1;

    function renderTable() {
        const query = searchInput.value.trim().toLowerCase();

        const filteredRows = rows.filter(function (row) {
            return row.textContent.toLowerCase().includes(query);
        });

        const pageSize = pageSizeSelect.value === 'all'
            ? Math.max(filteredRows.length, 1)
            : parseInt(pageSizeSelect.value, 10);

        const total = filteredRows.length;
        const totalPages = Math.max(1, Math.ceil(total / pageSize));

        currentPage = Math.min(currentPage, totalPages);

        const startIndex = (currentPage - 1) * pageSize;
        const endIndex = Math.min(startIndex + pageSize, total);

        rows.forEach(function (row) {
            row.hidden = true;
        });

        filteredRows.slice(startIndex, endIndex).forEach(function (row) {
            row.hidden = false;
        });

        if (noResults) {
            noResults.hidden = total !== 0 || rows.length === 0;
        }

        if (total === 0) {
            info.textContent = 'Showing 0 entries';
        } else {
            info.textContent =
                'Showing ' + (startIndex + 1) +
                ' to ' + endIndex +
                ' of ' + total + ' entries';
        }

        pagination.replaceChildren();

        function addButton(label, pageNumber, disabled, active) {
            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = label;
            button.disabled = disabled;

            if (active) button.classList.add('active');

            button.addEventListener('click', function () {
                currentPage = pageNumber;
                renderTable();
            });

            pagination.appendChild(button);
        }

        addButton('‹', Math.max(1, currentPage - 1), currentPage === 1, false);

        for (let number = 1; number <= totalPages; number++) {
            addButton(
                String(number),
                number,
                false,
                number === currentPage
            );
        }

        addButton(
            '›',
            Math.min(totalPages, currentPage + 1),
            currentPage === totalPages || total === 0,
            false
        );
    }

    searchInput.addEventListener('input', function () {
        currentPage = 1;
        renderTable();
    });

    pageSizeSelect.addEventListener('change', function () {
        currentPage = 1;
        renderTable();
    });

    renderTable();
});
</script>
@include('admin.Include.footer')