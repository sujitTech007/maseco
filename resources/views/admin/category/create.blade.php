@include('admin.Include.header')
<div class="page-content maseco-category-create">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="category-create-header">
            <div>
                <!-- <div class="category-breadcrumb">
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="ri-home-4-line"></i>
                        Dashboard
                    </a>
                    <i class="ri-arrow-right-s-line"></i>
                    <a href="{{ route('admin.category.create') }}">
                        Categories
                    </a>
                    <i class="ri-arrow-right-s-line"></i>
                    <span>Add Category</span>
                </div> -->

                <h2>Add Category</h2>
                <p>Create a category to help organize materials in the MASECO marketplace.</p>
            </div>

            <a href="{{ url('/admin/category') }}" class="category-back-btn">
                <i class="ri-arrow-left-line"></i>
                Back to Categories
            </a>
        </div>

        <!-- Form Card -->
        <div class="category-create-card">

            <div class="category-card-heading">
                <div class="category-heading-icon">
                    <i class="ri-folder-add-line"></i>
                </div>

                <div>
                    <h4>Category Information</h4>
                    <p>Enter the category details below.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="category-error-alert">
                    <i class="ri-error-warning-line"></i>
                    <div>
                        <strong>Please check the following fields:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.category.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <!-- Category Name -->
                <div class="category-form-section">
                    <label for="category_name" class="category-field-label">
                        Category Name <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="category_name"
                        name="name"
                        class="form-control category-input"
                        value="{{ old('name') }}"
                        placeholder="e.g. Sustainable Fabrics"
                        required
                    >

                    @error('name')
                        <small class="category-field-error">{{ $message }}</small>
                    @enderror

                    <small class="category-field-hint">
                        Use a clear name that helps buyers find relevant materials.
                    </small>
                </div>

                <!-- Category Image -->
                <div class="category-form-section">
                    <label for="category_image" class="category-field-label">
                        Category Image
                    </label>

                    <label for="category_image" class="category-upload-area">
                        <div class="category-upload-icon">
                            <i class="ri-upload-cloud-2-line"></i>
                        </div>

                        <div class="category-upload-text">
                            <strong>Choose an image to upload</strong>
                            <span>Click here to select an image from your device.</span>
                        </div>

                        <span class="category-browse-btn">Browse Files</span>
                    </label>

                    <input
                        type="file"
                        id="category_image"
                        name="image"
                        class="category-file-input"
                        accept="image/*"
                    >

                    <div class="category-image-preview" id="categoryImagePreview">
                        <img id="categoryPreviewImg" src="" alt="Category preview">
                        <div class="category-preview-info">
                            <strong id="categoryFileName">Selected image</strong>
                            <span>Image preview</span>
                        </div>
                        <button type="button"
                                class="category-remove-image"
                                id="removeCategoryImage"
                                aria-label="Remove selected image">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>

                    @error('image')
                        <small class="category-field-error">{{ $message }}</small>
                    @enderror

                    <small class="category-field-hint">
                        Use a clear image representing this material category.
                    </small>
                </div>

                <!-- Status -->
                <div class="category-form-section category-status-section">
                    <div class="category-status-copy">
                        <div class="category-status-icon">
                            <i class="ri-toggle-line"></i>
                        </div>

                        <div>
                            <h5>Category Status</h5>
                            <p>Choose whether this category should be active or inactive.</p>
                        </div>
                    </div>

                    <div class="category-status-select">
                        <label for="category_status" class="category-field-label">
                            Status
                        </label>

                        <select
                            name="status"
                            id="category_status"
                            class="form-select category-input"
                        >
                            <option value="active"
                                {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive"
                                {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Actions -->
                <div class="category-form-actions">
                    <a href="{{ url('/admin/category') }}" class="category-cancel-btn">
                        Cancel
                    </a>

                    <button type="submit" class="category-submit-btn">
                        <i class="ri-add-line"></i>
                        Add Category
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('category_image');
    const preview = document.getElementById('categoryImagePreview');
    const previewImg = document.getElementById('categoryPreviewImg');
    const fileName = document.getElementById('categoryFileName');
    const removeButton = document.getElementById('removeCategoryImage');

    if (!imageInput || !preview || !previewImg || !fileName || !removeButton) {
        return;
    }

    let previewUrl = null;

    imageInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file) {
            preview.style.display = 'none';
            previewImg.removeAttribute('src');
            return;
        }

        if (!file.type.startsWith('image/')) {
            this.value = '';
            preview.style.display = 'none';
            alert('Please select a valid image file.');
            return;
        }

        previewUrl = URL.createObjectURL(file);
        previewImg.src = previewUrl;
        fileName.textContent = file.name;
        preview.style.display = 'flex';
    });

    removeButton.addEventListener('click', function () {
        imageInput.value = '';
        preview.style.display = 'none';
        previewImg.removeAttribute('src');

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }
    });
});
</script>
@include('admin.Include.footer')