@include('admin.Include.header')


<div class="page-content seller-page">

    <!-- <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <div class="seller-heading">
                <div class="seller-breadcrumb">
                    <a href="https://maseco.ca/UAT/admin/dashboard">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="current">Seller Management</span>
                </div>

                <h3>Seller Management</h3>
                <p class="seller-subtitle">
                    Manage seller accounts and monitor supplier activity.
                </p>
            </div>
        </div>
    </div> -->

    <div class="page-container p-3">

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
        <div class="seller-panel-header d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3 mb-4 card">
            <div>
                <h5 class="mb-1">Registered Sellers</h5>
                <p class="text-muted mb-0">Review seller details and manage account status.</p>
            </div>

            <div class="row g-3 align-items-center flex-grow-1 ms-xl-3">

                <!-- Search Sellers -->
                <div class="col-12 col-md-6 col-xl-3">
                    <input
                        type="search"
                        class="form-control"
                        id="seller-search"
                        placeholder="Search sellers..."
                        aria-label="Search sellers"
                        aria-controls="complex-header-datatable">
                </div>

                <!-- Status Filter -->
                <div class="col-12 col-md-6 col-xl-2">
                    <select class="form-select" id="seller-status">
                        <option value="">(Status)</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Seller Type Filter -->
                <div class="col-12 col-md-6 col-xl-2">
                    <select class="form-select" id="seller-type">
                        <option value="">Seller Type</option>
                        <option value="manufacturer">Manufacturer</option>
                        <option value="supplier">Supplier</option>
                        <option value="wholesaler">Wholesaler</option>
                        <option value="distributor">Distributor</option>
                    </select>
                </div>

                <!-- Start Date -->
                <div class="col-12 col-md-6 col-xl-2">
                    <input
                        type="date"
                        class="form-control"
                        id="seller-start-date"
                        aria-label="Start date">
                </div>

                <!-- End Date -->
                <div class="col-12 col-md-6 col-xl-2">
                    <input
                        type="date"
                        class="form-control"
                        id="seller-end-date"
                        aria-label="End date">
                </div>

                <!-- Filter Button -->
                <div class="col-12 col-md-6 col-xl-1">
                    <button
                        type="button"
                        class="btn btn-outline-success w-100"
                        id="seller-filter-btn">
                        Filter
                    </button>
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
                        $kycBadgeMap = ['approved'=>'success','pending'=>'warning','rejected'=>'danger','not_submitted'=>'secondary','incomplete'=>'secondary'];
                        $kycBadge = $kycBadgeMap[$kycStatus] ?? 'secondary';
                        $kycText = ['approved'=>'Approved','pending'=>'Pending','rejected'=>'Rejected','not_submitted'=>'Not submitted','incomplete'=>'Incomplete'][$kycStatus] ?? ucfirst($kycStatus);
                        @endphp
                        <tr data-status="{{ $supplier->status == '1' ? 'active' : 'inactive' }}" data-type="{{ strtolower((string) ($supplier->business_type ?? '')) }}" data-date="{{ $supplier->created_at?->format('Y-m-d') }}">
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
                                <span class="badge bg-{{ $kycBadge }}">{{ $kycText }}</span>
                            </td>

                            <td>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="form-check form-switch mb-0">
                                        <input
                                            class="form-check-input supplier-status-toggle"
                                            type="checkbox"
                                            data-id="{{ $supplier->id }}"
                                            {{ $supplier->status == '1' ? 'checked' : '' }}>
                                    </div>

                                    <span class="seller-status {{ $supplier->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $supplier->status == '1' ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <div class="actionBtn">
                                    <a
                                        href="{{ route('admin.seller.show', $supplier->id) }}"
                                        class="dropdown-item"
                                        aria-label="View seller {{ $supplier->name }}"
                                        title="View seller details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @php($__kycPending = \App\Models\KycSubmission::where('account_type', 'supplier')->where('account_id', $supplier->id)->where('status', 'pending')->exists())
                                    <a href="{{ route('admin.kyc.index', ['type' => 'supplier']) }}" class="kyc-row-action" aria-label="Review supplier KYC" title="Review supplier KYC">
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
