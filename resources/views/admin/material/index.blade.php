@include('admin.Include.header')



<div class="page-content materials-page">

    <!-- Page Header -->
    <!-- <div class="materials-page-header container">
        <div class="breadcrumb-wrapper">
            <h3>Materials</h3>
            <div class="breadcrumb-links">
                <a href="https://maseco.ca/UAT/admin/dashboard">Dashboard</a>
                <span>›</span>
                <span class="current">Materials</span>
            </div>
        </div>
    </div> -->

    <div class="page-container p-3">
    @if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>@endif
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <!-- Search and Filter -->
    <div class="materials-filter-card">
        <form method="GET" class="materials-filter-form">

            <div class="filter-field">
                <label for="material-search">Search Materials</label>
                <input
                    type="text"
                    id="material-search"
                    name="search"
                    class="form-control"
                    value="{{ request('search') }}"
                    placeholder="Enter material name..."
                >
            </div>

            <div class="filter-field filter-status">
                <label for="material-status">Status</label>
                <select name="status" id="material-status" class="form-control">
                    <option value="">All Status</option>
                    <option value="1" @if(request('status')==='1') selected @endif>
                        Active
                    </option>
                    <option value="0" @if(request('status')==='0') selected @endif>
                        Inactive
                    </option>
                </select>
            </div>

            <div class="filter-field filter-status">
                <label for="certification-status">Certification</label>
                <select name="certification_status" id="certification-status" class="form-control">
                    <option value="">All Certifications</option>
                    <option value="certified" @selected(request('certification_status') === 'certified')>Certified</option>
                    <option value="not_certified" @selected(request('certification_status') === 'not_certified')>Not Certified</option>
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="material-filter-btn">
                    <i class="fa-solid fa-sliders"></i>
                    Filter
                </button>

                <a href="{{ route('admin.material') }}" class="material-reset-btn">
                    Reset
                </a>
            </div>

        </form>
    </div>
        <!-- Material Inventory Header & Filters -->
<div class="materials-table-header d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3 card">

    <div>
        <h4>Material Inventory</h4>
        <p>Manage your available raw materials and pricing.</p>
    </div>

    <div class="d-flex flex-wrap align-items-center gap-2">

        <!-- Material Status -->
        <select class="form-select"
                id="materials-status-filter"
                aria-label="Filter by material status"
                style="width: 155px;">
            <option value="">All Statuses</option>
            <option value="available">Available</option>
            <option value="low-stock">Low Stock</option>
            <option value="out-of-stock">Out of Stock</option>
        </select>

        <!-- Material Type -->
        <select class="form-select"
                id="materials-type-filter"
                aria-label="Filter by material type"
                style="width: 165px;">
            <option value="">All Material Types</option>
            <option value="cotton">Cotton</option>
            <option value="polyester">Polyester</option>
            <option value="wool">Wool</option>
            <option value="silk">Silk</option>
            <option value="recycled">Recycled Materials</option>
        </select>

        <!-- Start Date -->
        <input type="date"
               class="form-control"
               id="materials-start-date"
               aria-label="Start date"
               style="width: 155px;">

        <!-- End Date -->
        <input type="date"
               class="form-control"
               id="materials-end-date"
               aria-label="End date"
               style="width: 155px;">

        <!-- Filter Button -->
        <button type="button"
                class="btn btn-outline-success"
                id="materials-filter-btn">
            <i class="ri-filter-3-line me-1"></i> Filter
        </button>

        <!-- Materials Count -->
        <!-- <div class="materials-count">
            {{ $materials->count() }} Materials
        </div> -->

    </div>
</div>

    <!-- Materials Table -->
    <div class="materials-table-card">

   
        <div class="table-responsive">
            <table class="table materials-table align-middle mb-0">

                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Certification</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($materials as $i => $material)

                    <tr>
                        <td>
                            <span class="material-serial">
                                {{ $i + 1 }}
                            </span>
                        </td>

                        <td>
                            @if($material->image)
                                <img
                                    src="{{ asset('public/' . $material->image) }}"
                                    alt="{{ $material->name }}"
                                    class="material-thumbnail"
                                >
                            @else
                                <div class="material-no-image">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </td>

                        <td>
                            <span class="material-name">
                                {{ $material->name }}
                            </span>
                        </td>

                        <td>
                            @if($material->supplier_id)
                                {{ optional($material->getRelation('supplier'))->company_name ?: (optional($material->getRelation('supplier'))->business_name ?: (optional($material->getRelation('supplier'))->name ?: 'Supplier')) }}
                                <span class="d-block small text-muted">Supplier</span>
                            @elseif($material->manufacturer_id)
                                {{ optional($material->getRelation('manufacturer'))->company_name ?: (optional($material->getRelation('manufacturer'))->name ?: 'Manufacturer') }}
                                <span class="d-block small text-muted">Manufacturer</span>
                            @else
                                Maseco
                                <span class="d-block small text-muted">Platform listing</span>
                            @endif
                        </td>

                        <td>
                            <span class="material-description">
                                {{ $material->description ?: '—' }}
                            </span>
                        </td>

                        <td>
                            <span class="material-unit">
                                {{ $material->unit }}
                            </span>
                        </td>

                        <td>
                            <span class="material-price">
                                {{ $material->price }}
                            </span>
                        </td>

                        <td>
                            <form
                                method="POST"
                                action="{{ route('admin.material.toggle', $material->id) }}"
                                class="d-inline toggle-status-form"
                            >
                                @csrf

                                <button
                                    type="button"
                                    class="material-status-btn toggle-status-btn {{ $material->status === 'active' ? 'is-active' : 'is-inactive' }}"
                                    data-id="{{ $material->id }}"
                                >
                                    <span class="status-dot"></span>
                                    {{ $material->status === 'active' ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>

                        <td>
                            @if($material->is_certified)
                                <span class="badge bg-success-subtle text-success mb-1">Certified</span>
                            @else
                                <span class="badge bg-light text-muted border mb-1">Not Certified</span>
                            @endif
                            <form method="POST" action="{{ route('admin.material.certification', $material->id) }}" class="d-inline">
                                @csrf
                                @foreach(request()->only(['search', 'status', 'certification_status']) as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <input type="hidden" name="is_certified" value="{{ $material->is_certified ? 0 : 1 }}">
                                @if($material->is_certified)
                                    <button type="submit" class="btn btn-sm btn-outline-danger text-nowrap">Remove Certification</button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-outline-success text-nowrap">Mark as Certified</button>
                                @endif
                            </form>
                        </td>

                        <td>
                            <div class="material-action-group">

                                <a
                                    href="{{ route('admin.material.show', $material->id) }}"
                                    class="material-action-btn view"
                                    title="View Material"
                                    aria-label="View Material"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a
                                    href="{{ route('admin.material.edit', $material->id) }}"
                                    class="material-action-btn edit"
                                    title="Edit Material"
                                    aria-label="Edit Material"
                                >
<i class="fa-solid fa-pen-to-square"></i>                                </a>

                                <form
                                    action="{{ route('admin.material.destroy', $material->id) }}"
                                    method="POST"
                                    class="d-inline mb-0"
                                    onsubmit="return confirm('Delete this material?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="material-action-btn delete"
                                        title="Delete Material"
                                        aria-label="Delete Material"
                                    >
                                       <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="10">
                            <div class="materials-empty-state">
                                <i class="fa-solid fa-inbox"></i>
                                <h5>No materials found</h5>
                                <p>Try changing your search or status filter.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

    </div>
</div>




@include('admin.Include.footer')
