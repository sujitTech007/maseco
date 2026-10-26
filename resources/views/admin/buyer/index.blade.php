@include('admin.Include.header')

<!-- Begin page -->


<div class="page-content buyer-page">
    <!-- <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <div class="buyer-heading">
                <div>
                    <div class="buyer-breadcrumb">
                        <a href="https://maseco.ca/UAT/admin/dashboard">Dashboard</a>
                        <span class="mx-2">/</span>
                        <span class="current">Buyer Management</span>
                    </div>
                    <h3>Buyer Management</h3>
                    <p class="buyer-subtitle">
                        Manage buyer accounts and monitor account activity.
                    </p>
                </div>
            </div>
        </div>
    </div> -->

    <div class="page-container p-3">
        @php
        $buyerTotal = $users->count();
        $buyerActive = $users->where('status', '1')->count();
        $buyerInactive = $buyerTotal - $buyerActive;
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
            <div class="buyer-panel-header d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3 mb-4 card">
                <div>
                    <h5 class="mb-1">Registered Buyers</h5>
                    <p class="text-muted mb-0">View buyer details and manage account status.</p>
                </div>

                <div class="row g-3 align-items-center flex-grow-1 ms-xl-3">

                    <!-- Search Buyers -->
                    <div class="col-12 col-md-6 col-xl-3">
                        <input
                            type="search"
                            class="form-control"
                            id="buyer-search"
                            placeholder="Search buyers..."
                            aria-label="Search buyers">
                    </div>

                    <!-- Status Filter -->
                    <div class="col-12 col-md-6 col-xl-2">
                        <select class="form-select" id="buyer-status">
                            <option value="">(Status)</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Buyer Gender Filter -->
                    <div class="col-12 col-md-6 col-xl-2">
                        <select class="form-select" id="buyer-type">
                            <option value="">All genders</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div class="col-12 col-md-6 col-xl-2">
                        <input
                            type="date"
                            class="form-control"
                            id="buyer-start-date"
                            aria-label="Start date">
                    </div>

                    <!-- End Date -->
                    <div class="col-12 col-md-6 col-xl-2">
                        <input
                            type="date"
                            class="form-control"
                            id="buyer-end-date"
                            aria-label="End date">
                    </div>

                    <!-- Filter Button -->
                    <div class="col-12 col-md-6 col-xl-1">
                        <button
                            type="button"
                            class="btn btn-outline-success w-100"
                            id="buyer-filter-btn">
                            Filter
                        </button>
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
                            <th>S No.</th>
                            <th>Buyer</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                        <tr data-status="{{ $user->status == '1' ? 'active' : 'inactive' }}" data-type="{{ strtolower((string) ($user->gender ?? '')) }}" data-date="{{ $user->created_at?->format('Y-m-d') }}">
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
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="form-check form-switch mb-0">
                                        <input
                                            class="form-check-input user-status-toggle"
                                            type="checkbox"
                                            data-id="{{ $user->id }}"
                                            {{ $user->status == '1' ? 'checked' : '' }}>
                                    </div>

                                    <span class="buyer-status {{ $user->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->status == '1' ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <div class="actionBtn">
                                    <a href="{{ route('admin.buyer.show', $user->id) }}"
                                        class="dropdown-item"
                                        aria-label="View buyer {{ $user->name }}"
                                        title="View buyer details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="buyer-empty">
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

<script>
document.querySelectorAll('.user-status-toggle').forEach(function (toggle) {
    toggle.addEventListener('change', async function () {
        const checkbox = this;
        const previousStatus = !checkbox.checked;
        const status = checkbox.checked ? 1 : 0;

        try {
            const response = await fetch('{{ url('admin/buyer/status') }}/' + encodeURIComponent(checkbox.dataset.id), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: status })
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

@include('admin.Include.footer')