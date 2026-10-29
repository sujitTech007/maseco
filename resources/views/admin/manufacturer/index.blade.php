@include('admin.Include.header')



<div class="page-content manufacturer-page">
<!-- 
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h3 class="manufacturer-heading">Manufacturer</h3>

            <div class="manufacturer-breadcrumb">
                <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                <span class="separator">›</span>
                <span class="current">Manufacturer</span>
            </div>
        </div>
    </div> -->

    <div class="page-container">

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
<div class="table-card-header d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3 mb-4 card">

    <div>
        <h4 class="table-card-title mb-1">Manufacturer Directory</h4>
        <p class="table-card-subtitle text-muted mb-0">
            View manufacturer details and manage account status.
        </p>
    </div>

    <div class="row g-3 align-items-center flex-grow-1 ms-xl-3">

        <!-- Search Manufacturers -->
        <div class="col-12 col-md-6 col-xl-3">
            <input
                type="search"
                class="form-control"
                id="manufacturer-search"
                placeholder="Search manufacturers..."
                aria-label="Search manufacturers"
            >
        </div>

        <!-- Status Filter -->
        <div class="col-12 col-md-6 col-xl-2">
            <select class="form-select" id="manufacturer-status">
                <option value="">(Status)</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <!-- Manufacturer Type -->
        <div class="col-12 col-md-6 col-xl-2">
            <select class="form-select" id="manufacturer-type">
                <option value="">Manufacturer Type</option>
                <option value="textile">Textile Manufacturer</option>
                <option value="garment">Garment Manufacturer</option>
                <option value="fabric">Fabric Manufacturer</option>
                <option value="recycled">Recycled Textile Manufacturer</option>
            </select>
        </div>

        <!-- Start Date -->
        <div class="col-12 col-md-6 col-xl-2">
            <input
                type="date"
                class="form-control"
                id="manufacturer-start-date"
                aria-label="Start date"
            >
        </div>

        <!-- End Date -->
        <div class="col-12 col-md-6 col-xl-2">
            <input
                type="date"
                class="form-control"
                id="manufacturer-end-date"
                aria-label="End date"
            >
        </div>

        <!-- Filter Button -->
        <div class="col-12 col-md-6 col-xl-1">
            <button
                type="button"
                class="btn btn-outline-success w-100"
                id="manufacturer-filter-btn"
            >
                Filter
            </button>
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
                            $mfrKyc      = $kycMap->get($manufacturer->id);
                            $kycStatus   = $mfrKyc->status ?? 'not_submitted';
                            $kycBadgeMap = ['approved'=>'success','pending'=>'warning','rejected'=>'danger','not_submitted'=>'secondary','incomplete'=>'secondary'];
                            $kycBadge    = $kycBadgeMap[$kycStatus] ?? 'secondary';
                            $kycText     = ['approved'=>'Approved','pending'=>'Pending','rejected'=>'Rejected','not_submitted'=>'Not submitted','incomplete'=>'Incomplete'][$kycStatus] ?? ucfirst($kycStatus);
                        @endphp
                            <tr data-status="{{ $manufacturer->status == '1' ? 'active' : 'inactive' }}" data-type="{{ strtolower((string) ($manufacturer->business_type ?? '')) }}" data-date="{{ $manufacturer->created_at?->format('Y-m-d') }}">
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
                                    <span class="badge bg-{{ $kycBadge }}">{{ $kycText }}</span>
                                </td>

                                <td>
                                    <div class="manufacturer-status">
                                        <div class="form-check form-switch">
                                            <input
                                                class="form-check-input manufacturer-status-toggle"
                                                type="checkbox"
                                                data-id="{{ $manufacturer->id }}"
                                                aria-label="Toggle status for {{ $manufacturer->name }}"
                                                {{ $manufacturer->status == '1' ? 'checked' : '' }}
                                            >
                                        </div>

                                        <span class="status-label {{ $manufacturer->status == '1' ? 'active' : 'inactive' }}">
                                            {{ $manufacturer->status == '1' ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="actionBtn">
                                        <a
                                            href="{{ route('admin.manufacturer.show', $manufacturer->id) }}"
                                            class="manufacturer-view-btn"
                                            title="View manufacturer"
                                            aria-label="View {{ $manufacturer->name }}"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="manufacturer-empty">
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
document.querySelectorAll('.manufacturer-status-toggle').forEach(function (toggle) {
    toggle.addEventListener('change', async function () {
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
                body: JSON.stringify({ status: status })
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