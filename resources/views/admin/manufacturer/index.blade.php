@include('admin.Include.header')



<div class="page-content manufacturer-page">


    <div class="page-container">
        <div class="container">
            <div class="mb-3">
                <h1 class="mb-1 dashboard_title">Manufacturer Directory</h1>
                <p class="text-muted mb-0">View manufacturer details and manage account status.</p>
            </div>
        

        @php
        $manufacturerTotal = $manufacturers->count();
        $manufacturerActive = $manufacturers->where('status', '1')->count();
        $manufacturerInactive = $manufacturerTotal - $manufacturerActive;
        $kycMap = $kycMap ?? collect();
        @endphp

        <div class="manufacturer-summary">

            <div class="summary-card bg-danger bg-opacity-10">
                <div class="summary-icon bg-danger bg-opacity-10">
                    <i class="fa-solid fa-building text-danger"></i>
                </div>
                <div>
                    <p class="summary-label">Total Manufacturers</p>
                    <h4 class="summary-number">{{ $manufacturerTotal }}</h4>
                </div>
            </div>

            <div class="summary-card bg-warning bg-opacity-10">
                <div class="summary-icon bg-warning bg-opacity-10">
                    <i class="fa-solid fa-circle-check text-warning"></i>
                </div>
                <div>
                    <p class="summary-label">Active Manufacturers</p>
                    <h4 class="summary-number">{{ $manufacturerActive }}</h4>
                </div>
            </div>

            <div class="summary-card bg-success bg-opacity-10">
                <div class="summary-icon bg-success bg-opacity-10">
                    <i class="fa-solid fa-user-slash text-success"></i>
                </div>
                <div>
                    <p class="summary-label">Inactive Manufacturers</p>
                    <h4 class="summary-number">{{ $manufacturerInactive }}</h4>
                </div>
            </div>

        </div>
    <!-- Manufacturer Directory Header & Filters -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end card_filters_form">

            <!-- Search -->
            <div class="col">
                <label class="form-label" for="manufacturer-search">Search Manufacturer</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search"
                           class="form-control"
                           id="manufacturer-search"
                           placeholder="Name, email, mobile, company...">
                </div>
            </div>

            <!-- Status -->
            <div class="col">
                <label class="form-label" for="manufacturer-status">Status</label>
                <select class="form-select" id="manufacturer-status">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <!-- Manufacturer Type -->
            <div class="col">
                <label class="form-label" for="manufacturer-type">Manufacturer Type</label>
                <select class="form-select" id="manufacturer-type">
                    <option value="">All Types</option>
                    <option value="textile">Textile Manufacturer</option>
                    <option value="garment">Garment Manufacturer</option>
                    <option value="fabric">Fabric Manufacturer</option>
                    <option value="recycled">Recycled Textile Manufacturer</option>
                </select>
            </div>

            <!-- Start Date -->
            <div class="col">
                <label class="form-label" for="manufacturer-start-date">Start Date</label>
                <input type="date"
                       class="form-control"
                       id="manufacturer-start-date">
            </div>

            <!-- End Date -->
            <div class="col">
                <label class="form-label" for="manufacturer-end-date">End Date</label>
                <input type="date"
                       class="form-control"
                       id="manufacturer-end-date">
            </div>

            <!-- Buttons -->
            <div class="col-auto d-flex align-items-end gap-1">
                <label class="form-label d-none d-xl-block">&nbsp;</label>
                <div class="d-flex gap-1">
                    <button type="button"
                            class="btn btn-success flex-fill"
                            id="manufacturer-filter-btn"
                            title="Apply Filter">
                        <i class="fa-solid fa-filter"></i>
                    </button>

                    <button type="button"
                            class="btn btn-outline-secondary flex-fill"
                            id="manufacturer-reset-btn"
                            title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

        <div class="manufacturer-table-card">



            <div class="table-responsive">
                <table class="table manufacturer-table table-hover mb-0"
                    id="manufacturer-directory-table"
                    style="width:100%;">

                    <thead>
                        <tr>
                            <th>S No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Company Name</th>
                            <th>KYC</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($manufacturers as $manufacturer)
                        @php
                        $mfrKyc = $kycMap->get($manufacturer->id);
                        $kycStatus = $mfrKyc->status ?? 'not_submitted';
                        $kycBadgeMap = ['approved'=>'success','pending'=>'warning','rejected'=>'danger','not_submitted'=>'danger','incomplete'=>'secondary'];
                        $kycBadge = $kycBadgeMap[$kycStatus] ?? 'secondary';
                        $kycText = ['approved'=>'Approved','pending'=>'Pending','rejected'=>'Rejected','not_submitted'=>'Not submitted','incomplete'=>'Incomplete'][$kycStatus] ?? ucfirst($kycStatus);
                        @endphp
                        <tr
    data-status="{{ $manufacturer->status == '1' ? 'active' : 'inactive' }}"
    data-type="{{ strtolower(trim((string) ($manufacturer->business_type ?? ''))) }}"
    data-date="{{ $manufacturer->created_at?->format('Y-m-d') }}"
    data-search="{{ strtolower($manufacturer->name . ' ' . $manufacturer->email . ' ' . ($manufacturer->phone ?? '') . ' ' . ($manufacturer->country_code ?? '') . ' ' . ($manufacturer->company_name ?? '')) }}">
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <h5 class="manufacturer-name">
                                    {{ $manufacturer->name }}
                                </h5>
                            </td>

                            <td>
                                <span class="manufacturer-email">
                                    {{ $manufacturer->email }}
                                </span>
                            </td>

                            <td>{{ trim(($manufacturer->country_code ?? '') . ' ' . $manufacturer->phone) }}</td>

                            <td>
                                <span class="manufacturer-company">
                                    {{ $manufacturer->company_name }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-{{ $kycBadge }} p-1">{{ $kycText }}</span>
                            </td>

                            <td>
                                <div class="manufacturer-status">
                                    <div class="form-check form-switch form-check-status-toggle">
                                        <input
                                            class="form-check-input manufacturer-status-toggle"
                                            type="checkbox"
                                            data-id="{{ $manufacturer->id }}"
                                            aria-label="Toggle status for {{ $manufacturer->name }}"
                                            {{ $manufacturer->status == '1' ? 'checked' : '' }}>
                                    </div>

                                    <!-- <span class="status-label {{ $manufacturer->status == '1' ? 'active' : 'inactive' }}">
                                        {{ $manufacturer->status == '1' ? 'Active' : 'Inactive' }}
                                    </span> -->
                                </div>
                            </td>

                            <td>
                                <div class="actionBtn d-flex align-items-center justify-content gap-1 td_actions_btns">
                                    <a
                                        href="{{ route('admin.manufacturer.show', $manufacturer->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="View manufacturer"
                                        aria-label="View {{ $manufacturer->name }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @php($__kycPending = \App\Models\KycSubmission::where('account_type', 'manufacturer')->where('account_id', $manufacturer->id)->where('status', 'pending')->exists())
                                    <a href="{{ route('admin.kyc.index', ['type' => 'manufacturer']) }}" class="kyc-row-action btn btn btn-outline-info" aria-label="Review manufacturer KYC" title="Review manufacturer KYC">
                                        <i class="fa-solid fa-id-card"></i>
                                        @if($__kycPending)<span class="kyc-pending-badge">1</span>@endif
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="manufacturer-empty">
                                No manufacturers found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('manufacturer-search');
    const statusFilter = document.getElementById('manufacturer-status');
    const typeFilter = document.getElementById('manufacturer-type');
    const startDate = document.getElementById('manufacturer-start-date');
    const endDate = document.getElementById('manufacturer-end-date');

    const filterBtn = document.getElementById('manufacturer-filter-btn');
    const resetBtn = document.getElementById('manufacturer-reset-btn');

    const table = document.getElementById('manufacturer-directory-table');

    if (!table) return;

    const rows = Array.from(table.querySelectorAll('tbody tr'))
        .filter(row => row.hasAttribute('data-status'));

    // Check DataTable initialization
    const useDataTable = window.jQuery &&
        $.fn.DataTable &&
        $.fn.DataTable.isDataTable(table);

    const dataTableApi = useDataTable
        ? $(table).DataTable()
        : null;

    function checkManufacturerFilters(row) {

        const search = searchInput.value.trim().toLowerCase();
        const status = statusFilter.value.toLowerCase();
        const type = typeFilter.value.toLowerCase();

        const fromDate = startDate.value;
        const toDate = endDate.value;

        const rowSearch = (row.dataset.search || '').toLowerCase();
        const rowStatus = (row.dataset.status || '').toLowerCase();
        const rowType = (row.dataset.type || '').toLowerCase();
        const rowDate = row.dataset.date || '';

        const matchesSearch =
            !search || rowSearch.includes(search);

        const matchesStatus =
            !status || rowStatus === status;

        // Supports both exact values and business type labels
        const matchesType =
            !type || rowType === type ||
            rowType.includes(type);

        const matchesStartDate =
            !fromDate || (rowDate && rowDate >= fromDate);

        const matchesEndDate =
            !toDate || (rowDate && rowDate <= toDate);

        return (
            matchesSearch &&
            matchesStatus &&
            matchesType &&
            matchesStartDate &&
            matchesEndDate
        );
    }

    function filterManufacturers() {

        if (useDataTable) {
            dataTableApi.draw();
        } else {
            rows.forEach(function (row) {
                row.style.display =
                    checkManufacturerFilters(row) ? '' : 'none';
            });
        }
    }

    // DataTables custom filter
    if (useDataTable) {

        $.fn.dataTable.ext.search.push(function (
            settings,
            data,
            dataIndex
        ) {

            if (settings.nTable !== table) {
                return true;
            }

            const row = settings.aoData[dataIndex].nTr;

            return row ? checkManufacturerFilters(row) : true;
        });

    }

    // Apply Filter
    filterBtn.addEventListener('click', filterManufacturers);

    // Live Search
    searchInput.addEventListener('input', filterManufacturers);

    // Dropdown Filters
    statusFilter.addEventListener('change', filterManufacturers);
    typeFilter.addEventListener('change', filterManufacturers);

    // Date Filters
    startDate.addEventListener('change', filterManufacturers);
    endDate.addEventListener('change', filterManufacturers);

    // Reset Filters
    resetBtn.addEventListener('click', function () {

        searchInput.value = '';
        statusFilter.value = '';
        typeFilter.value = '';
        startDate.value = '';
        endDate.value = '';

        startDate.removeAttribute('max');
        endDate.removeAttribute('min');

        filterManufacturers();
    });

    // Date validation
    startDate.addEventListener('change', function () {

        endDate.min = startDate.value || '';

        if (endDate.value && startDate.value > endDate.value) {
            endDate.value = '';
        }

        filterManufacturers();
    });

    endDate.addEventListener('change', function () {

        startDate.max = endDate.value || '';

        if (startDate.value && endDate.value < startDate.value) {
            startDate.value = '';
        }

        filterManufacturers();
    });

});
</script>
<script>
    document.querySelectorAll('.manufacturer-status-toggle').forEach(function(toggle) {
        toggle.addEventListener('change', async function() {
            const checkbox = this;
            const previousStatus = !checkbox.checked;
            const status = checkbox.checked ? 1 : 0;

            try {
                const response = await fetch("{{ url('admin/manufacturer/status') }}/" + encodeURIComponent(checkbox.dataset.id), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                });
                if (!response.ok) throw new Error('Request failed');
                const result = await response.json();
                if (!result.success) throw new Error('Status was not updated');

                const row = checkbox.closest('tr');
                const badge = row && row.querySelector('.status-label');
                if (row) row.dataset.status = status ? 'active' : 'inactive';
                if (badge) {
                    badge.classList.toggle('active', Boolean(status));
                    badge.classList.toggle('inactive', !status);
                    badge.textContent = status ? 'Active' : 'Inactive';
                }
            } catch (error) {
                checkbox.checked = previousStatus;
                window.alert('Could not update account status. Please try again.');
            }
        });
    });
</script>

@include('admin.Include.footer')
