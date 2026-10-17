@include('admin.Include.header')

<div class="page-content category-page">
    <div class="container mt-0">

        <!-- <div class="mb-3">
            <h3 class="category-heading">Category</h3>

            <div class="category-breadcrumb">
                <a href="https://maseco.ca/UAT/admin/dashboard">Dashboard</a>
                <span class="separator">›</span>
                <span class="current">Category</span>
            </div>
        </div> -->

        @php
            $categoryTotal = $categories->count();
        @endphp

        <div class="category-topbar">
            <p>Manage the categories used to organize marketplace materials.</p>

            <a href="{{ route('admin.category.create') }}" class="category-add-btn">
                <i class="ri-add-line"></i>
                Add Category
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success category-alert">
                <i class="ri-checkbox-circle-line me-1"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="category-summary">
            <div class="category-summary-icon">
                <i class="ri-folders-line"></i>
            </div>

            <div>
                <p class="category-summary-label">Total Categories</p>
                <h4 class="category-summary-value">{{ $categoryTotal }}</h4>
            </div>
        </div>

        <div class="category-table-card">

            <div class="category-table-header">
                <div>
                    <h4 class="category-table-title">Category Directory</h4>
                    <p class="category-table-subtitle">
                        View, edit, or remove marketplace categories.
                    </p>
                </div>

                <div class="category-search">
                    <i class="ri-search-line"></i>
                    <input
                        type="search"
                        id="category-search-input"
                        placeholder="Search categories..."
                        aria-label="Search categories"
                    >
                </div>
            </div>

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
                                            <i class="ri-image-line"></i>
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