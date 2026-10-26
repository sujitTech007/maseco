
@include('admin.Include.header')

<div class="page-content manufacturer-page">
    <div class="container-fluid py-4 px-3 px-lg-4">

        @php
            $manufacturerTotal = $manufacturers->count();
            $manufacturerActive = $manufacturers->where('status', '1')->count();
            $manufacturerInactive = $manufacturerTotal - $manufacturerActive;
        @endphp

        {{-- Summary Cards --}}
        <div class="row g-3 mb-4">

            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 bg-danger bg-opacity-10">
                    <div class="card-body d-flex align-items-center gap-3 p-4">
                        <div class="bg-danger bg-opacity-10 rounded-3 p-3">
                            <i class="fa-solid fa-building text-danger fs-4"></i>
                        </div>
                        <div>
                            <p class="text-secondary mb-1">Total Manufacturers</p>
                            <h3 class="fw-bold mb-0">{{ $manufacturerTotal }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 bg-warning bg-opacity-10">
                    <div class="card-body d-flex align-items-center gap-3 p-4">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="fa-solid fa-circle-check text-warning fs-4"></i>
                        </div>
                        <div>
                            <p class="text-secondary mb-1">Active Manufacturers</p>
                            <h3 class="fw-bold mb-0">{{ $manufacturerActive }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 bg-success bg-opacity-10">
                    <div class="card-body d-flex align-items-center gap-3 p-4">
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="fa-solid fa-user-slash text-success fs-4"></i>
                        </div>
                        <div>
                            <p class="text-secondary mb-1">Inactive Manufacturers</p>
                            <h3 class="fw-bold mb-0">{{ $manufacturerInactive }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Manufacturer Directory and Filters --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3 p-lg-4">

                <div class="row g-3 align-items-end">

                    <div class="col-12 col-xl-3">
                        <h5 class="fw-bold mb-2">Manufacturer Directory</h5>
                        <p class="text-secondary mb-0">
                            View manufacturer details and manage account status.
                        </p>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <label for="manufacturer-search" class="form-label small fw-semibold">
                            Search
                        </label>
                        <input
                            type="search"
                            class="form-control"
                            id="manufacturer-search"
                            placeholder="Search manufacturers..."
                        >
                    </div>

                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="manufacturer-status" class="form-label small fw-semibold">
                            Status
                        </label>
                        <select class="form-select" id="manufacturer-status">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="manufacturer-start-date" class="form-label small fw-semibold">
                            From Date
                        </label>
                        <input type="date" class="form-control" id="manufacturer-start-date">
                    </div>

                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="manufacturer-end-date" class="form-label small fw-semibold">
                            To Date
                        </label>
                        <input type="date" class="form-control" id="manufacturer-end-date">
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary" id="manufacturer-reset-btn">
                            Reset
                        </button>
                        <button type="button" class="btn btn-success" id="manufacturer-filter-btn">
                            <i class="fa-solid fa-filter me-1"></i> Apply Filters
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- Manufacturer Table --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3 px-3 px-lg-4 rounded-top-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="fw-bold mb-0">All Manufacturers</h5>
                    <span class="badge text-bg-light border" id="manufacturer-record-count">
                        {{ $manufacturerTotal }} records
                    </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="manufacturer-directory-table">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">S No.</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Mobile No.</th>
                            <th class="py-3">Company Name</th>
                            <th class="py-3">Status</th>
                            <th class="text-center py-3">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($manufacturers as $manufacturer)
                            <tr
                                data-status="{{ $manufacturer->status == '1' ? 'active' : 'inactive' }}"
                                data-type="{{ strtolower((string) ($manufacturer->business_type ?? '')) }}"
                                data-date="{{ $manufacturer->created_at?->format('Y-m-d') }}"
                            >
                                <td class="px-4">{{ $loop->iteration }}</td>

                                <td>
                                    <span class="fw-semibold text-dark">
                                        {{ $manufacturer->name ?: 'N/A' }}
                                    </span>
                                </td>

                                <td>{{ $manufacturer->email ?: 'N/A' }}</td>

                                <td>
                                    {{ trim(($manufacturer->country_code ?? '') . ' ' . ($manufacturer->phone ?? '')) ?: 'N/A' }}
                                </td>

                                <td>{{ $manufacturer->company_name ?: 'N/A' }}</td>

                                <td>
                                    @if($manufacturer->status == '1')
                                        <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-2">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-success rounded-3 viewManufacturerBtn"
                                        data-manufacturer='@json($manufacturer)'
                                        title="View manufacturer details"
                                        aria-label="View {{ $manufacturer->name }}"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-secondary py-5">
                                    <i class="fa-solid fa-building fs-2 d-block mb-2"></i>
                                    No manufacturers found.
                                </td>
                            </tr>
                        @endforelse

                        <tr id="manufacturer-no-results" class="d-none">
                            <td colspan="7" class="text-center text-secondary py-4">
                                No manufacturers match your filters.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

{{-- Manufacturer Details Modal --}}
<div class="modal fade" id="manufacturerViewModal" tabindex="-1"
     aria-labelledby="manufacturerViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow rounded-4">

            <div class="modal-header bg-success bg-opacity-10 px-4 py-3">
                <div>
                    <h5 class="modal-title fw-bold" id="manufacturerViewModalLabel">
                        Manufacturer Details
                    </h5>
                    <p class="text-secondary small mb-0">
                        View the registered manufacturer's information.
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success
                                d-flex align-items-center justify-content-center"
                         style="width:64px;height:64px;">
                        <i class="fa-solid fa-building fs-3"></i>
                    </div>

                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-1" id="view-manufacturer-name">—</h5>
                        <p class="text-secondary mb-0" id="view-manufacturer-company">—</p>
                    </div>

                    <span id="view-manufacturer-status"
                          class="badge rounded-pill px-3 py-2">—</span>
                </div>

                <h6 class="fw-bold mb-3">Contact Information</h6>

                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-secondary d-block mb-1">Email Address</small>
                            <span class="fw-semibold text-break" id="view-manufacturer-email">—</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-secondary d-block mb-1">Mobile Number</small>
                            <span class="fw-semibold" id="view-manufacturer-phone">—</span>
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold mb-3">Business Information</h6>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-secondary d-block mb-1">Company Name</small>
                            <span class="fw-semibold" id="view-manufacturer-company-detail">—</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-secondary d-block mb-1">Business Type</small>
                            <span class="fw-semibold" id="view-manufacturer-type">—</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-secondary d-block mb-1">Registered On</small>
                            <span class="fw-semibold" id="view-manufacturer-created">—</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-secondary d-block mb-1">Manufacturer ID</small>
                            <span class="fw-semibold" id="view-manufacturer-id">—</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light border-0 px-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

{{-- Search, Filters and View Details --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('manufacturer-directory-table');

    if (!table) return;

    const searchInput = document.getElementById('manufacturer-search');
    const statusFilter = document.getElementById('manufacturer-status');
    const startDateInput = document.getElementById('manufacturer-start-date');
    const endDateInput = document.getElementById('manufacturer-end-date');
    const filterButton = document.getElementById('manufacturer-filter-btn');
    const resetButton = document.getElementById('manufacturer-reset-btn');
    const countLabel = document.getElementById('manufacturer-record-count');
    const noResultsRow = document.getElementById('manufacturer-no-results');

    const rows = Array.from(table.querySelectorAll('tbody tr[data-status]'));

    function applyFilters() {
        const search = searchInput.value.trim().toLowerCase();
        const status = statusFilter.value;
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;

        let visibleCount = 0;

        rows.forEach(function (row) {
            const rowText = row.innerText.toLowerCase();
            const rowStatus = row.dataset.status || '';
            const rowDate = row.dataset.date || '';

            const matchesSearch = !search || rowText.includes(search);
            const matchesStatus = !status || rowStatus === status;
            const matchesStartDate = !startDate || (rowDate && rowDate >= startDate);
            const matchesEndDate = !endDate || (rowDate && rowDate <= endDate);

            const visible = matchesSearch && matchesStatus &&
                            matchesStartDate && matchesEndDate;

            row.classList.toggle('d-none', !visible);

            if (visible) visibleCount++;
        });

        noResultsRow.classList.toggle('d-none', visibleCount !== 0);

        countLabel.textContent = visibleCount +
            (visibleCount === 1 ? ' record' : ' records');
    }

    searchInput.addEventListener('input', applyFilters);
    filterButton.addEventListener('click', applyFilters);

    resetButton.addEventListener('click', function () {
        searchInput.value = '';
        statusFilter.value = '';
        startDateInput.value = '';
        endDateInput.value = '';
        applyFilters();
    });

    // Open the manufacturer details modal
    document.querySelectorAll('.viewManufacturerBtn').forEach(function (button) {
        button.addEventListener('click', function () {
            let manufacturer;

            try {
                manufacturer = JSON.parse(this.dataset.manufacturer);
            } catch (error) {
                console.error('Unable to read manufacturer details.', error);
                return;
            }

            const setText = function (id, value) {
                document.getElementById(id).textContent =
                    value === null || value === undefined || value === ''
                        ? 'N/A'
                        : String(value);
            };

            const isActive = String(manufacturer.status) === '1';

            setText('view-manufacturer-name', manufacturer.name);
            setText('view-manufacturer-company', manufacturer.company_name);
            setText('view-manufacturer-email', manufacturer.email);

            setText(
                'view-manufacturer-phone',
                [manufacturer.country_code, manufacturer.phone]
                    .filter(Boolean)
                    .join(' ')
            );

            setText('view-manufacturer-company-detail', manufacturer.company_name);
            setText('view-manufacturer-type', manufacturer.business_type);
            setText('view-manufacturer-id', manufacturer.id);

            let registeredDate = 'N/A';

            if (manufacturer.created_at) {
                const date = new Date(manufacturer.created_at);

                if (!Number.isNaN(date.getTime())) {
                    registeredDate = date.toLocaleDateString(undefined, {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric'
                    });
                }
            }

            setText('view-manufacturer-created', registeredDate);

            const statusBadge = document.getElementById('view-manufacturer-status');
            statusBadge.textContent = isActive ? 'Active' : 'Inactive';
            statusBadge.className = isActive
                ? 'badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-2'
                : 'badge rounded-pill bg-secondary bg-opacity-10 text-secondary px-3 py-2';

            const modalElement = document.getElementById('manufacturerViewModal');

            if (window.bootstrap && window.bootstrap.Modal) {
                window.bootstrap.Modal.getOrCreateInstance(modalElement).show();
            } else {
                console.error('Bootstrap JavaScript is required for the details modal.');
            }
        });
    });

    applyFilters();
});
</script>

@include('admin.Include.footer')
