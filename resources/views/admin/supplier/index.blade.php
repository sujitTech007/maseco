@include('admin.Include.header')


<div class="page-content seller-page">

  

    <div class="page-container p-3">
        <div class="container">
              <div class="mb-3">
                <h1 class="mb-1 dashboard_title">Registered Sellers</h1>
                <p class="text-muted mb-0">Review seller details and manage account status.</p>
            </div>
        

        @php
        $sellerTotal = $suppliers->count();
        $sellerActive = $suppliers->where('status', '1')->count();
        $sellerInactive = $sellerTotal - $sellerActive;
        $kycMap = $kycMap ?? collect();
        @endphp

        <div class="seller-overview">

            <div class="seller-stat bg-danger bg-opacity-10">
                <div class="seller-stat-icon bg-danger bg-opacity-10">
                    <i class="fa-solid fa-store text-danger"></i>
                </div>
                <div>
                    <div class="seller-stat-label">Total Sellers</div>
                    <h4 class="seller-stat-value">{{ $sellerTotal }}</h4>
                </div>
            </div>

            <div class="seller-stat bg-warning bg-opacity-10">
                <div class="seller-stat-icon bg-warning bg-opacity-10">
                    <i class="fa-solid fa-user-plus text-warning"></i>
                </div>
                <div>
                    <div class="seller-stat-label">Active Sellers</div>
                    <h4 class="seller-stat-value">{{ $sellerActive }}</h4>
                </div>
            </div>

            <div class="seller-stat bg-success bg-opacity-10">
                <div class="seller-stat-icon bg-success bg-opacity-10">
                    <i class="fa-solid fa-user-slash text-success"></i>
                </div>
                <div>
                    <div class="seller-stat-label">Inactive Sellers</div>
                    <h4 class="seller-stat-value">{{ $sellerInactive }}</h4>
                </div>
            </div>

        </div>
        <!-- Registered Sellers Header & Filters -->
       <!-- Registered Sellers Header & Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end  card_filters_form">

                    <!-- Search Sellers -->
                    <div class="col">
                        <label for="seller-search" class="form-label">Search Seller</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input type="search"
                                class="form-control"
                                id="seller-search"
                                placeholder="Name, email, mobile, company...">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="col">
                        <label for="seller-status" class="form-label">Status</label>
                        <select class="form-select" id="seller-status">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Seller Type Filter -->
                    <div class="col">
                        <label for="seller-type" class="form-label">Seller Type</label>
                        <select class="form-select" id="seller-type">
                            <option value="">All Types</option>
                            <option value="manufacturer">Manufacturer</option>
                            <option value="supplier">Supplier</option>
                            <option value="wholesaler">Wholesaler</option>
                            <option value="distributor">Distributor</option>
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div class="col">
                        <label for="seller-start-date" class="form-label">Start Date</label>
                        <input type="date"
                            class="form-control"
                            id="seller-start-date">
                    </div>

                    <!-- End Date -->
                    <div class="col">
                        <label for="seller-end-date" class="form-label">End Date</label>
                        <input type="date"
                            class="form-control"
                            id="seller-end-date">
                    </div>

                    <!-- Filter & Reset Buttons -->
                    <div class="col d-flex align-items-center gap-2">
                        <label class="form-label d-none d-xl-block">&nbsp;</label>
                        <div class="d-flex gap-1">
                            <button type="button"
                                    class="btn btn-success flex-fill"
                                    id="seller-filter-btn"
                                    title="Apply Filters">
                                <i class="fa-solid fa-filter"></i>
                            </button>

                            <button type="button"
                                    class="btn btn-outline-secondary flex-fill"
                                    id="seller-reset-btn"
                                    title="Reset Filters">
                                <i class="fa-solid fa-rotate-left"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="seller-panel">


            <div class="seller-table-wrap">
                <table
                    class="table table-custom table-centered table-sm table-hover mb-0 dataTable"
                    id="complex-header-datatable"
                    style="width: 100%;">
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
                        @forelse($suppliers as $supplier)
                        @php
                        $supplierKyc = $kycMap->get($supplier->id);
                        $kycStatus = $supplierKyc->status ?? 'not_submitted';
                        $kycBadgeMap = ['approved'=>'success','pending'=>'warning','rejected'=>'danger','not_submitted'=>'danger','incomplete'=>'secondary'];
                        $kycBadge = $kycBadgeMap[$kycStatus] ?? 'secondary';
                        $kycText = ['approved'=>'Approved','pending'=>'Pending','rejected'=>'Rejected','not_submitted'=>'Not submitted','incomplete'=>'Incomplete'][$kycStatus] ?? ucfirst($kycStatus);
                        @endphp
                        <tr
    data-status="{{ $supplier->status == '1' ? 'active' : 'inactive' }}"
    data-type="{{ strtolower(trim((string) ($supplier->business_type ?? ''))) }}"
    data-date="{{ $supplier->created_at?->format('Y-m-d') }}"
    data-search="{{ strtolower($supplier->name . ' ' . $supplier->email . ' ' . ($supplier->phone ?? '') . ' ' . ($supplier->country_code ?? '') . ' ' . ($supplier->company_name ?? '')) }}">
                            <td>
                                <p class="seller-cell-text">{{ $loop->iteration }}</p>
                            </td>

                            <td>
                                <p class="seller-name">{{ $supplier->name }}</p>
                            </td>

                            <td>
                                <p class="seller-cell-text">{{ $supplier->email }}</p>
                            </td>

                            <td>
                                <p class="seller-cell-text">{{ trim(($supplier->country_code ?? '') . ' ' . $supplier->phone) }}</p>
                            </td>

                            <td>
                                <p class="seller-cell-text">{{ $supplier->company_name }}</p>
                            </td>

                            <td>
                                <span class="badge bg-{{ $kycBadge }} p-1">{{ $kycText }}</span>
                            </td>

                            <td>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="form-check form-switch mb-0 form-check-status-toggle">
                                        <input
                                            class="form-check-input supplier-status-toggle"
                                            type="checkbox"
                                            data-id="{{ $supplier->id }}"
                                            {{ $supplier->status == '1' ? 'checked' : '' }}>
                                    </div>

                                    <!-- <span class="seller-status {{ $supplier->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $supplier->status == '1' ? 'Active' : 'Inactive' }}
                                    </span> -->
                                </div>
                            </td>

                            <td>
                                <div class="actionBtn d-flex align-items-center justify-content gap-1 td_actions_btns">
                                    <a
                                        href="{{ route('admin.seller.show', $supplier->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        aria-label="View seller {{ $supplier->name }}"
                                        title="View seller details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @php($__kycPending = \App\Models\KycSubmission::where('account_type', 'supplier')->where('account_id', $supplier->id)->where('status', 'pending')->exists())
                                    <a href="{{ route('admin.kyc.index', ['type' => 'supplier']) }}" class="kyc-row-action btn btn btn-outline-info" aria-label="Review supplier KYC" title="Review supplier KYC">
                                        <i class="fa-solid fa-id-card"></i>
                                        @if($__kycPending)<span class="kyc-pending-badge">1</span>@endif
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="seller-empty">
                                No sellers found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('seller-search');
    const statusFilter = document.getElementById('seller-status');
    const typeFilter = document.getElementById('seller-type');
    const startDate = document.getElementById('seller-start-date');
    const endDate = document.getElementById('seller-end-date');

    const filterBtn = document.getElementById('seller-filter-btn');
    const resetBtn = document.getElementById('seller-reset-btn');

    const table = document.getElementById('complex-header-datatable');

    if (!table) return;

    const rows = Array.from(table.querySelectorAll('tbody tr'))
        .filter(row => row.hasAttribute('data-status'));

    // Check DataTables initialization
    const useDataTable = window.jQuery &&
        $.fn.DataTable &&
        $.fn.DataTable.isDataTable(table);

    let dataTableApi = null;

    if (useDataTable) {
        dataTableApi = $(table).DataTable();
    }

    function checkFilters(row) {

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

        const matchesType =
            !type || rowType === type;

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

    function filterSellers() {

        if (useDataTable) {

            // DataTables filtering
            dataTableApi.draw();

        } else {

            // Normal table filtering
            rows.forEach(function (row) {
                row.style.display = checkFilters(row) ? '' : 'none';
            });

        }
    }

    // Custom DataTables filter
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

            return row ? checkFilters(row) : true;
        });

    }

    // Filter button
    filterBtn.addEventListener('click', filterSellers);

    // Live search
    searchInput.addEventListener('input', filterSellers);

    // Dropdown filters
    statusFilter.addEventListener('change', filterSellers);
    typeFilter.addEventListener('change', filterSellers);

    // Date filters
    startDate.addEventListener('change', filterSellers);
    endDate.addEventListener('change', filterSellers);

    // Reset all filters
    resetBtn.addEventListener('click', function () {

        searchInput.value = '';
        statusFilter.value = '';
        typeFilter.value = '';
        startDate.value = '';
        endDate.value = '';

        startDate.removeAttribute('max');
        endDate.removeAttribute('min');

        filterSellers();
    });

    // Date range validation
    startDate.addEventListener('change', function () {

        endDate.min = startDate.value || '';

        if (endDate.value && startDate.value > endDate.value) {
            endDate.value = '';
        }

        filterSellers();
    });

    endDate.addEventListener('change', function () {

        startDate.max = endDate.value || '';

        if (startDate.value && endDate.value < startDate.value) {
            startDate.value = '';
        }

        filterSellers();
    });

});
</script>


<script>
    document.querySelectorAll('.supplier-status-toggle').forEach(function(toggle) {
        toggle.addEventListener('change', async function() {
            const checkbox = this;
            const previousStatus = !checkbox.checked;
            const status = checkbox.checked ? 1 : 0;

            try {
                const response = await fetch('{{ url('
                    admin / seller / status ') }}/' + encodeURIComponent(checkbox.dataset.id), {
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
                const badge = row && row.querySelector('.seller-status');
                if (row) row.dataset.status = status ? 'active' : 'inactive';
                if (badge) {
                    badge.classList.toggle('bg-success', Boolean(status));
                    badge.classList.toggle('bg-danger', !status);
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
