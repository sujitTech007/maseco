@include('admin.Include.header')

<div class="page-content category-edit-page">

    <div class="category-edit-header">
        <h3>Edit Category</h3>

        <div class="category-breadcrumb">
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
            <span>›</span>
            <span class="active">Edit Category</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="category-edit-card">

        <div class="category-card-header">
            <div class="category-header-icon">
                <i class="fa-solid fa-tag"></i>
            </div>

            <div>
                <h5>Category Information</h5>
                <p>Update your category details below.</p>
            </div>
        </div>

        <div class="category-card-body">

            <form
                action="{{ route('admin.category.update', $category->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="form-label">
                        Category Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $category->name) }}"
                        placeholder="Enter category name"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Category Image</label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="form-control"
                        accept="image/*"
                    >

                    <small class="field-help">
                        Upload a new image to replace the existing one.
                    </small>

                    @if($category->image)
                        <div class="current-category-image">
                            <img
                                src="{{ asset('public/' . $category->image) }}"
                                alt="{{ $category->name }}"
                            >

                            <div>
                                <strong>Current Image</strong>
                                <span>{{ $category->name }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label">
                        Status <span class="required">*</span>
                    </label>

                    <select name="status" id="status" class="form-control" required>
                        <option value="active"
                            {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                <div class="category-form-actions">
                    <a href="{{ url('/admin/category') }}" class="category-btn category-btn-back">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to Categories
                    </a>

                    <button type="submit" class="category-btn category-btn-update">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Update Category
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


@include('admin.Include.footer')