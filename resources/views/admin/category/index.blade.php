@include('admin.Include.header')

<div class="page-content category-page">
    <div class="page-container p-3">

    

        @php
            $categoryTotal = $categories->count();
        @endphp

        <div class="category-topbar">
            <h4>Manage the categories used to organize marketplace materials.</h4>

            <a href="{{ route('admin.category.create') }}" class="category-add-btn">
                <i class="fa-solid fa-plus"></i>
                Add Category
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success category-alert">
                <i class="fa-solid fa-circle-check me-1"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="category-summary">
            <div class="category-summary-icon">
                <i class="fa-solid fa-folder-open"></i>
            </div>

            <div>
                <p class="category-summary-label">Total Categories</p>
                <h4 class="category-summary-value">{{ $categoryTotal }}</h4>
            </div>
        </div>
              <!-- Category Directory Header & Filters -->
<div class="category-table-header d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3 mb-4 card">

    <div>
        <h4 class="category-table-title mb-1">Category Directory</h4>
        <p class="category-table-subtitle text-muted mb-0">
            View, edit, or remove marketplace categories.
        </p>
    </div>

    <div class="row g-3 align-items-center flex-grow-1 ms-xl-3">

        <!-- Search Categories -->
        <div class="col-12 col-md-6 col-xl-3">
            <input
                type="search"
                class="form-control"
                id="category-search-input"
                placeholder="Search categories..."
                aria-label="Search categories"
            >
        </div>

        <!-- Status Filter -->
        <div class="col-12 col-md-6 col-xl-2">
            <select class="form-select" id="category-status">
                <option value="">(Status)</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <!-- Category Type -->
        <div class="col-12 col-md-6 col-xl-2">
            <select class="form-select" id="category-type">
                <option value="">Category Type</option>
                <option value="fabric">Fabric</option>
                <option value="garment">Garment</option>
                <option value="accessories">Accessories</option>
                <option value="recycled">Recycled Textiles</option>
            </select>
        </div>

        <!-- Start Date -->
        <div class="col-12 col-md-6 col-xl-2">
            <input
                type="date"
                class="form-control"
                id="category-start-date"
                aria-label="Start date"
            >
        </div>

        <!-- End Date -->
        <div class="col-12 col-md-6 col-xl-2">
            <input
                type="date"
                class="form-control"
                id="category-end-date"
                aria-label="End date"
            >
        </div>

        <!-- Filter Button -->
        <div class="col-12 col-md-6 col-xl-1">
            <button
                type="button"
                class="btn btn-outline-success w-100"
                id="category-filter-btn"
            >
                Filter
            </button>
        </div>

    </div>
</div>

        <div class="category-table-card">

     
            <div class="table-responsive">
                <table class="table category-table table-hover mb-0"
                       id="category-directory-table"
                       style="width:100%;">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="category-id">{{ $category->id }}</td>

                                <td>
                                    <h5 class="category-name">
                                        {{ $category->name }}
                                    </h5>
                                </td>

                                <td>
                                    @if($category->image)
                                        <img
                                            src="{{ asset('public/' . $category->image) }}"
                                            class="category-image"
                                            alt="{{ $category->name }}"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="category-no-image" title="No image">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $categoryStatus = strtolower((string) $category->status);
                                        $categoryStatusClass = $categoryStatus === 'active'
                                            ? 'active'
                                            : ($categoryStatus === 'inactive' ? 'inactive' : 'other');
                                    @endphp

                                    <span class="category-status {{ $categoryStatusClass }}">
                                        {{ ucfirst($category->status) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="category-actions">
                                        <a
                                            href="{{ route('admin.category.edit', $category->id) }}"
                                            class="category-action-btn category-edit-btn"
                                            title="Edit category"
                                            aria-label="Edit {{ $category->name }}"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form
                                            action="{{ route('admin.category.destroy', $category->id) }}"
                                            method="POST"
                                            class="d-inline mb-0"
                                            onsubmit="return confirm('Delete this category?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="category-action-btn category-delete-btn"
                                                title="Delete category"
                                                aria-label="Delete {{ $category->name }}"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="category-empty">
                                    No categories have been added yet.
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
        const searchInput = document.getElementById('category-search-input');
        const table = document.getElementById('category-directory-table');

        if (!searchInput || !table) {
            return;
        }

        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase().trim();

            table.querySelectorAll('tbody tr').forEach(function (row) {
                if (row.querySelector('.category-empty')) {
                    return;
                }

                row.style.display = row.textContent.toLowerCase().includes(searchTerm)
                    ? ''
                    : 'none';
            });
        });
    });
</script>
@include('admin.Include.footer')