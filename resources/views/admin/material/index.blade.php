@include('admin.Include.header')



<div class="page-content materials-page">

    <!-- Page Header -->
    <div class="materials-page-header container">
        <div class="breadcrumb-wrapper">
            <h3>Materials</h3>
            <div class="breadcrumb-links">
                <a href="https://maseco.ca/UAT/admin/dashboard">Dashboard</a>
                <span>›</span>
                <span class="current">Materials</span>
            </div>
        </div>
    </div>

    <div class="page-container p-3">
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

            <div class="filter-actions">
                <button type="submit" class="material-filter-btn">
                    <i class="ri-equalizer-line"></i>
                    Filter
                </button>

                <a href="{{ route('admin.material') }}" class="material-reset-btn">
                    Reset
                </a>
            </div>

        </form>
    </div>

    <!-- Materials Table -->
    <div class="materials-table-card">

        <div class="materials-table-header">
            <div>
                <h4>Material Inventory</h4>
                <p>Manage your available raw materials and pricing.</p>
            </div>

            <div class="materials-count">
                {{ $materials->count() }} Materials
            </div>
        </div>

        <div class="table-responsive">
            <table class="table materials-table align-middle mb-0">

                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Status</th>
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
                                    <i class="ri-image-line"></i>
                                </div>
                            @endif
                        </td>

                        <td>
                            <span class="material-name">
                                {{ $material->name }}
                            </span>
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
                            <div class="material-action-group">

                                <a
                                    href="{{ route('admin.material.show', $material->id) }}"
                                    class="material-action-btn view"
                                    title="View Material"
                                    aria-label="View Material"
                                >
                                    <i class="ri-eye-line"></i>
                                </a>

                                <a
                                    href="{{ route('admin.material.edit', $material->id) }}"
                                    class="material-action-btn edit"
                                    title="Edit Material"
                                    aria-label="Edit Material"
                                >
                                    <i class="ri-edit-line"></i>
                                </a>

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
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="materials-empty-state">
                                <i class="ri-inbox-2-line"></i>
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