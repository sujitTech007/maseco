@include('admin.Include.header')

<div class="page-content category-page">
    <div class="page-container">
          <div class="container">
               <div class="mb-2 d-flex justify-content-between align-items-center">
                 <div>
                    <h1 class="mb-1 dashboard_title">Category Directory</h1>
                    <p class="text-muted mb-0">Manage the categories used to organize marketplace materials.</p>
                </div>
                 <a href="{{ route('admin.category.create') }}" class="category-add-btn">
                <i class="fa-solid fa-plus"></i>
                Add Category
            </a>

               </div>
    

        @php
            $categoryTotal = $categories->count();
        @endphp


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

            <!-- Category Header & Filters -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end card_filters_form">

            <!-- Search -->
            <div class="col">
                <label class="form-label" for="category-search-input">Search Category</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search"
                           class="form-control"
                           id="category-search-input"
                           placeholder="Search category...">
                </div>
            </div>

            <!-- Status -->
            <div class="col">
                <label class="form-label" for="category-status">Status</label>
                <select class="form-select" id="category-status">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <!-- Category Type -->
            <div class="col">
                <label class="form-label" for="category-type">Category Type</label>
                <select class="form-select" id="category-type">
                    <option value="">All Categories</option>
                    <option value="fabric">Fabric</option>
                    <option value="garment">Garment</option>
                    <option value="accessories">Accessories</option>
                    <option value="recycled">Recycled Textiles</option>
                </select>
            </div>

            <!-- Start Date -->
            <div class="col">
                <label class="form-label" for="category-start-date">Start Date</label>
                <input type="date"
                       class="form-control"
                       id="category-start-date">
            </div>

            <!-- End Date -->
            <div class="col">
                <label class="form-label" for="category-end-date">End Date</label>
                <input type="date"
                       class="form-control"
                       id="category-end-date">
            </div>

            <!-- Buttons -->
            <div class="col">
                <label class="form-label d-none d-xl-block">&nbsp;</label>
                <div class="d-flex gap-1">
                    <button type="button"
                            class="btn btn-success flex-fill"
                            id="category-filter-btn"
                            title="Apply Filter">
                        <i class="fa-solid fa-filter"></i>
                    </button>

                    <button type="button"
                            class="btn btn-outline-secondary flex-fill"
                            id="category-reset-btn"
                            title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </button>
                </div>
            </div>

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
                            <tr data-status="{{ strtolower((string) $category->status) }}" data-type="{{ strtolower((string) $category->name) }}" data-date="{{ $category->created_at?->format('Y-m-d') }}">
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
                                    <div class="category-actions d-flex align-items-center justify-content gap-1 td_actions_btns">
                                        <a
                                            href="{{ route('admin.category.edit', $category->id) }}"
                                            class="btn btn-outline-warning"
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
