@include('admin.Include.header')

<!-- Begin page -->


<div class="page-content buyer-page">  

    <div class="page-container">
        <div class="container">
                <div class="mb-2">
                    <h1 class="mb-1 dashboard_title">Registered Buyers</h1>
                    <p class="text-muted mb-0">View buyer details and manage account status.</p>
                </div>
            @php
            $buyerTotal = $users->count();
            $buyerActive = $users->where('status', '1')->count();
            $buyerInactive = $buyerTotal - $buyerActive;
            $kycMap = $kycMap ?? collect();
            @endphp

            <div class="buyer-overview">
                <div class="buyer-stat bg-danger bg-opacity-10">
                    <div class="buyer-stat-icon bg-danger bg-opacity-10">
                        <i class="fa-solid fa-users text-danger"></i>
                    </div>
                    <div>
                        <div class="buyer-stat-label">Total Buyers</div>
                        <h4 class="buyer-stat-value">{{ $buyerTotal }}</h4>
                    </div>
                </div>

                <div class="buyer-stat bg-warning bg-opacity-10">
                    <div class="buyer-stat-icon bg-warning bg-opacity-10">
                        <i class="fa-solid fa-user-plus text-warning"></i>
                    </div>
                    <div>
                        <div class="buyer-stat-label">Active Buyers</div>
                        <h4 class="buyer-stat-value">{{ $buyerActive }}</h4>
                    </div>
                </div>

                <div class="buyer-stat bg-success bg-opacity-10">
                    <div class="buyer-stat-icon bg-success bg-opacity-10">
                        <i class="fa-solid fa-user-slash text-success"></i>
                    </div>
                    <div>
                        <div class="buyer-stat-label">Inactive Buyers</div>
                        <h4 class="buyer-stat-value">{{ $buyerInactive }}</h4>
                    </div>
                </div>
            </div>

            
            <!-- Registered Buyers Header & Filters -->
            <!-- <div class="buyer-panel-header d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3 mb-4 card">
                
                <div class="row g-3 align-items-center flex-grow-1 ms-xl-3">

                    
                    <div class="col-12 col-md-6 col-xl-3">
                        <input
                            type="search"
                            class="form-control"
                            id="buyer-search"
                            placeholder="Search buyers..."
                            aria-label="Search buyers">
                    </div>

                    <div class="col-12 col-md-6 col-xl-2">
                        <select class="form-select" id="buyer-status">
                            <option value="">(Status)</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-2">
                        <select class="form-select" id="buyer-type">
                            <option value="">All genders</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-2">
                        <input
                            type="date"
                            class="form-control"
                            id="buyer-start-date"
                            aria-label="Start date">
                    </div>

                    <div class="col-12 col-md-6 col-xl-2">
                        <input
                            type="date"
                            class="form-control"
                            id="buyer-end-date"
                            aria-label="End date">
                    </div>

                    <div class="col-12 col-md-6 col-xl-1">
                        <button
                            type="button"
                            class="btn btn-outline-success w-100"
                            id="buyer-filter-btn">
                            Filter
                        </button>
                    </div>

                </div>
            </div> -->

            <!-- Registered Buyers Header & Filters -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end card_filters_form">

            <!-- Search Buyers -->
            <div class="col">
                <label for="buyer-search" class="form-label">
                    Search Buyer
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search"
                        class="form-control"
                        id="buyer-search"
                        placeholder="Name, email, mobile...">
                </div>
            </div>

            <!-- Status Filter -->
            <div class="col">
                <label for="buyer-status" class="form-label">Status</label>
                <select class="form-select" id="buyer-status">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <!-- Gender Filter -->
            <div class="col">
                <label for="buyer-type" class="form-label">Gender</label>
                <select class="form-select" id="buyer-type">
                    <option value="">All Genders</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Start Date -->
            <div class="col">
                <label for="buyer-start-date" class="form-label">
                    Start Date
                </label>
                <input type="date"
                    class="form-control"
                    id="buyer-start-date">
            </div>

            <!-- End Date -->
            <div class="col">
                <label for="buyer-end-date" class="form-label">
                    End Date
                </label>
                <input type="date"
                    class="form-control"
                    id="buyer-end-date">
            </div>

            <!-- Buttons -->
            <div class="col d-flex align-items-center gap-2">
                <button type="button"
                    class="btn btn-success"
                    id="buyer-filter-btn"
                    title="Apply Filters">
                    <i class="fa-solid fa-filter"></i>
                </button>

                <button type="button"
                    class="btn btn-outline-secondary"
                    id="buyer-reset-btn"
                    title="Reset Filters">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>
            </div>

        </div>
    </div>
</div>

            <div class="buyer-panel">


                <div class="buyer-table-wrap">
                    <table class="table table-custom table-centered table-sm table-hover mb-0 dataTable"
                        id="complex-header-datatable"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Buyer</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>KYC</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $user)
                            @php
                            $userKyc = $kycMap->get($user->id);
                            $kycStatus = $userKyc->status ?? 'not_submitted';
                            $kycBadgeMap = ['approved'=>'success','pending'=>'warning','rejected'=>'danger','not_submitted'=>'danger','incomplete'=>'secondary'];
                            $kycBadge = $kycBadgeMap[$kycStatus] ?? 'secondary';
                            $kycText = ['approved'=>'Approved','pending'=>'Pending','rejected'=>'Rejected','not_submitted'=>'Not submitted','incomplete'=>'Incomplete'][$kycStatus] ?? ucfirst($kycStatus);
                            @endphp
                            <tr
    data-status="{{ $user->status == '1' ? 'active' : 'inactive' }}"
    data-type="{{ strtolower(trim((string) ($user->gender ?? ''))) }}"
    data-date="{{ $user->created_at?->format('Y-m-d') }}"
    data-search="{{ strtolower($user->name . ' ' . $user->email . ' ' . ($user->phone ?? '') . ' ' . ($user->country_code ?? '')) }}">
                                <td>
                                    <p class="buyer-cell-text">{{ $loop->iteration }}</p>
                                </td>

                                <td>
                                    <p class="buyer-name">{{ $user->name }}</p>
                                </td>

                                <td>
                                    <p class="buyer-cell-text">{{ $user->email }}</p>
                                </td>

                                <td>
                                    <p class="buyer-cell-text">{{ trim(($user->country_code ?? '') . ' ' . $user->phone) }}</p>
                                </td>

                                <td>
                                    <span class="badge bg-{{ $kycBadge }} p-1">{{ $kycText }}</span>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="form-check form-switch mb-0 form-check-status-toggle">
                                            <input
                                                class="form-check-input user-status-toggle"
                                                type="checkbox"
                                                data-id="{{ $user->id }}"
                                                {{ $user->status == '1' ? 'checked' : '' }}>
                                        </div>

                                        <!-- <span class="buyer-status {{ $user->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $user->status == '1' ? 'Active' : 'Inactive' }}
                                        </span> -->
                                    </div>
                                </td>

                                <td>
                                    <div class="actionBtn d-flex align-items-center justify-content gap-1 td_actions_btns">
                                        <a href="{{ route('admin.buyer.show', $user->id) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            aria-label="View buyer {{ $user->name }}"
                                            title="View buyer details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @php($__kycPending = \App\Models\KycSubmission::where('account_type', 'user')->where('account_id', $user->id)->where('status', 'pending')->exists())
                                        <a href="{{ route('admin.kyc.index', ['type' => 'user']) }}" class="kyc-row-action btn btn btn-outline-info" aria-label="Review buyer KYC" title="Review buyer KYC">
                                            <i class="fa-solid fa-id-card"></i>
                                            @if($__kycPending)<span class="kyc-pending-badge">1</span>@endif
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="buyer-empty">
                                    No buyers found.
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
    document.querySelectorAll('.user-status-toggle').forEach(function(toggle) {
        toggle.addEventListener('change', async function() {
            const checkbox = this;
            const previousStatus = !checkbox.checked;
            const status = checkbox.checked ? 1 : 0;

            try {
                const response = await fetch('{{ url('admin / buyer / status ') }}/' + encodeURIComponent(checkbox.dataset.id), {
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
                const badge = row && row.querySelector('.buyer-status');
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('buyer-search');
    const statusFilter = document.getElementById('buyer-status');
    const genderFilter = document.getElementById('buyer-type');
    const startDate = document.getElementById('buyer-start-date');
    const endDate = document.getElementById('buyer-end-date');
    const filterBtn = document.getElementById('buyer-filter-btn');
    const resetBtn = document.getElementById('buyer-reset-btn');

    const table = document.getElementById('complex-header-datatable');

    if (!table) return;

    const rows = Array.from(table.querySelectorAll('tbody tr'))
        .filter(row => row.hasAttribute('data-status'));

    function filterBuyers() {

        const search = searchInput.value.trim().toLowerCase();
        const status = statusFilter.value.toLowerCase();
        const gender = genderFilter.value.toLowerCase();
        const fromDate = startDate.value;
        const toDate = endDate.value;

        rows.forEach(function (row) {

            const rowSearch = (row.dataset.search || '').toLowerCase();
            const rowStatus = (row.dataset.status || '').toLowerCase();
            const rowGender = (row.dataset.type || '').toLowerCase();
            const rowDate = row.dataset.date || '';

            const matchesSearch = !search || rowSearch.includes(search);

            const matchesStatus = !status || rowStatus === status;

            const matchesGender = !gender || rowGender === gender;

            const matchesStartDate = !fromDate || (
                rowDate && rowDate >= fromDate
            );

            const matchesEndDate = !toDate || (
                rowDate && rowDate <= toDate
            );

            const isVisible =
                matchesSearch &&
                matchesStatus &&
                matchesGender &&
                matchesStartDate &&
                matchesEndDate;

            row.style.display = isVisible ? '' : 'none';
        });
    }

    // Filter button
    filterBtn.addEventListener('click', filterBuyers);

    // Live search
    searchInput.addEventListener('input', filterBuyers);

    // Live dropdown filters
    statusFilter.addEventListener('change', filterBuyers);
    genderFilter.addEventListener('change', filterBuyers);

    // Date filters
    startDate.addEventListener('change', filterBuyers);
    endDate.addEventListener('change', filterBuyers);

    // Reset all filters
    resetBtn.addEventListener('click', function () {

        searchInput.value = '';
        statusFilter.value = '';
        genderFilter.value = '';
        startDate.value = '';
        endDate.value = '';

        filterBuyers();
    });

    // Prevent invalid date range
    startDate.addEventListener('change', function () {
        endDate.min = startDate.value || '';
    });

    endDate.addEventListener('change', function () {
        startDate.max = endDate.value || '';
    });

});
</script>

@include('admin.Include.footer')
