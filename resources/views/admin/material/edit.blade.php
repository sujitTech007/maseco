@include('admin.Include.header')


<div class="page-content material-edit-page">

    {{-- Page Header --}}
    <div class="material-edit-header">
        <h3>Edit Material</h3>
        <div class="material-breadcrumb">
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
            <span>›</span>
            <span class="active">Edit Material</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.material.update', $material->id) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- Basic Information --}}
        <div class="material-form-card">
            <div class="material-section-heading">
                <div class="material-section-icon">
                    <i class="fa-solid fa-list"></i>
                </div>
                <div>
                    <h5>Basic Information</h5>
                    <p>Enter the material name and classification details.</p>
                </div>
            </div>

            <div class="material-section-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Material Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="name"
                               value="{{ old('name', $material->name) }}"
                               placeholder="Enter material name" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Material Code / SKU <span class="required">*</span></label>
                        <input type="text" class="form-control" name="sku"
                               value="{{ old('sku', $material->sku) }}"
                               placeholder="Enter material SKU" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category / Type <span class="required">*</span></label>
                        <select class="form-control" name="category" required>
                            <option value="" disabled>Select Category</option>
                            <option value="Fabric" {{ old('category', $material->category) === 'Fabric' ? 'selected' : '' }}>Fabric</option>
                            <option value="Metal" {{ old('category', $material->category) === 'Metal' ? 'selected' : '' }}>Metal</option>
                            <option value="Plastic" {{ old('category', $material->category) === 'Plastic' ? 'selected' : '' }}>Plastic</option>
                            <option value="Wood" {{ old('category', $material->category) === 'Wood' ? 'selected' : '' }}>Wood</option>
                            <option value="Chemicals" {{ old('category', $material->category) === 'Chemicals' ? 'selected' : '' }}>Chemicals</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub-Category</label>
                        <select class="form-control" name="subCategory">
                            <option value="" disabled>Select Sub-Category</option>
                            <option value="Organic" {{ old('subCategory', $material->sub_category) === 'Organic' ? 'selected' : '' }}>Organic</option>
                            <option value="Blended" {{ old('subCategory', $material->sub_category) === 'Blended' ? 'selected' : '' }}>Blended</option>
                            <option value="HR Steel" {{ old('subCategory', $material->sub_category) === 'HR Steel' ? 'selected' : '' }}>HR Steel</option>
                            <option value="Polished Stone" {{ old('subCategory', $material->sub_category) === 'Polished Stone' ? 'selected' : '' }}>Polished Stone</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Material Grade / Quality</label>
                        <input type="text" class="form-control" name="grade"
                               value="{{ old('grade', $material->grade) }}"
                               placeholder="e.g. Premium">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Strength / Durability</label>
                        <input type="text" class="form-control" name="strength"
                               value="{{ old('strength', $material->strength) }}"
                               placeholder="Enter strength or durability">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Size / Dimensions</label>
                        <input type="text" class="form-control" name="size"
                               value="{{ old('size', $material->size) }}"
                               placeholder="e.g. 10 x 10 x 10">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Weight / Unit</label>
                        <div class="input-group">
                            <input type="number" step="any" class="form-control" name="weight"
                                   value="{{ old('weight', $material->weight) }}"
                                   placeholder="Weight">

                            <select class="form-control" name="unit">
                                <option value="Kg" {{ old('unit', $material->unit) === 'Kg' ? 'selected' : '' }}>Kg</option>
                                <option value="Meter" {{ old('unit', $material->unit) === 'Meter' ? 'selected' : '' }}>Meter</option>
                                <option value="Piece" {{ old('unit', $material->unit) === 'Piece' ? 'selected' : '' }}>Piece</option>
                                <option value="Litre" {{ old('unit', $material->unit) === 'Litre' ? 'selected' : '' }}>Litre</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pricing and Availability --}}
        <div class="material-form-card">
            <div class="material-section-heading">
                <div class="material-section-icon">
                    <i class="fa-solid fa-circle-dollar-to-slot"></i>
                </div>
                <div>
                    <h5>Pricing & Availability</h5>
                    <p>Manage material pricing, minimum order quantity and stock.</p>
                </div>
            </div>

            <div class="material-section-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Price per Unit</label>
                        <input type="number" step="any" class="form-control" name="price"
                               value="{{ old('price', $material->price) }}"
                               placeholder="Enter price">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Minimum Order Qty (MOQ)</label>
                        <input type="number" step="any" class="form-control" name="moq"
                               value="{{ old('moq', $material->moq) }}"
                               placeholder="Enter MOQ">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Available Stock / Capacity</label>
                        <input type="number" step="any" class="form-control" name="stock"
                               value="{{ old('stock', $material->stock) }}"
                               placeholder="Enter stock">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" name="supplier"
                               value="{{ old('supplier', $material->supplier) }}"
                               placeholder="Enter supplier name">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" name="location"
                               value="{{ old('location', $material->location) }}"
                               placeholder="Enter material location">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lead Time / Delivery Days</label>
                        <input type="number" class="form-control" name="leadTime"
                               value="{{ old('leadTime', $material->lead_time) }}"
                               placeholder="Delivery days">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status">
                            <option value="active" {{ old('status', $material->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $material->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sustainability and Documentation --}}
        <div class="material-form-card">
            <div class="material-section-heading">
                <div class="material-section-icon">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <div>
                    <h5>Sustainability & Documentation</h5>
                    <p>Add certification and material handling information.</p>
                </div>
            </div>

            <div class="material-section-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Certification / Standard</label>
                        <input type="text" class="form-control" name="certification"
                               value="{{ old('certification', $material->certification) }}"
                               placeholder="e.g. ISO">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Safety / Handling Instructions</label>
                        <textarea class="form-control" name="safety" rows="3"
                                  placeholder="Enter safety or handling instructions">{{ old('safety', $material->safety) }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4"
                                  placeholder="Describe the material">{{ old('description', $material->description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Material Image --}}
        <div class="material-form-card">
            <div class="material-section-heading">
                <div class="material-section-icon">
                    <i class="fa-solid fa-image"></i>
                </div>
                <div>
                    <h5>Material Image</h5>
                    <p>Manage the image displayed for this material.</p>
                </div>
            </div>

            <div class="material-section-body">
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label class="form-label">Upload Material Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*">

                        <small class="material-help">
                            Select an image only if you want to replace the current one.
                        </small>

                        @if($material->image)
                            <div class="material-current-image">
                                <img src="{{ asset('public/' . $material->image) }}"
                                     alt="Material Image">
                                <div>
                                    <strong>Current Material Image</strong>
                                    <span>Existing image</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="material-form-actions">
            <a href="{{ route('admin.material') }}" class="material-btn material-btn-cancel">
                <i class="fa-solid fa-arrow-left"></i>
                Cancel
            </a>

            <button type="submit" class="material-btn material-btn-update">
                <i class="fa-solid fa-floppy-disk"></i>
                Update Material
            </button>
        </div>

    </form>
</div>

@include('admin.Include.footer')

