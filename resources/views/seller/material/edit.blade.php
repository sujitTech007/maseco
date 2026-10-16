@include('seller.Include.header')

<div class="page-content p-4">

  <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
    <h3 class="mb-1">Edit Materials</h3>

    <a href="https://maseco.ca/UAT/user/dashboard" style="color:#555; text-decoration:none;">
      Dashboard
    </a>

    <span style="padding:0 6px; color:#999; font-size:14px;">
      ▶
    </span>

    <span style="color:#2DAC92;">
      Edit Materials
    </span>

  </div>

  <div class="bg-white shadow-sm rounded-4 p-4">

    <form method="POST" action="{{ route('seller.material.update', $material->id) }}" enctype="multipart/form-data">

      @csrf

      @method('PUT')

      <div class="row">

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Material Name</label>

            <input type="text" class="form-control" name="name" required value="{{ old('name', $material->name) }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Material Code / SKU</label>

            <input type="text" class="form-control" name="sku" required value="{{ old('sku', $material->sku) }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Category / Type</label>

            <select class="form-select" name="category" required>

              <option disabled>Select Category</option>

              <option value="Fabric" @if(old('category', $material->category) === 'Fabric') selected @endif>Fabric
              </option>

              <option value="Metal" @if(old('category', $material->category) === 'Metal') selected @endif>Metal</option>

              <option value="Plastic" @if(old('category', $material->category) === 'Plastic') selected @endif>Plastic
              </option>

              <option value="Wood" @if(old('category', $material->category) === 'Wood') selected @endif>Wood</option>

              <option value="Chemicals" @if(old('category', $material->category) === 'Chemicals') selected @endif>
                Chemicals</option>

            </select>

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Sub-Category (Optional)</label>

            <select class="form-select" name="subCategory">

              <option disabled>Select Sub-Category</option>

              <option value="Organic" @if(old('subCategory', $material->sub_category) === 'Organic') selected @endif>
                Organic</option>

              <option value="Blended" @if(old('subCategory', $material->sub_category) === 'Blended') selected @endif>
                Blended</option>

              <option value="HR Steel" @if(old('subCategory', $material->sub_category) === 'HR Steel') selected @endif>HR
                Steel</option>

              <option value="Polished Stone" @if(old('subCategory', $material->sub_category) === 'Polished Stone')
              selected @endif>Polished Stone</option>

            </select>

          </div>

        </div>

        <div class="col-12">
          <hr class="mt-0 mb-3 text-muted">
        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Material Grade / Quality</label>

            <input type="text" class="form-control" name="grade" value="{{ old('grade', $material->grade) }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Strength / Durability</label>

            <input type="text" class="form-control" name="strength" value="{{ old('strength', $material->strength) }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Size / Dimensions</label>

            <input type="text" class="form-control" name="size" value="{{ old('size', $material->size) }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Weight / Unit</label>

            <div class="input-group">

              <input type="number" class="form-control" name="weight" value="{{ old('weight', $material->weight) }}">

              <select class="form-select" name="unit">

                <option value="Kg" @if(old('unit', $material->unit) === 'Kg') selected @endif>Kg</option>

                <option value="Meter" @if(old('unit', $material->unit) === 'Meter') selected @endif>Meter</option>

                <option value="Piece" @if(old('unit', $material->unit) === 'Piece') selected @endif>Piece</option>

                <option value="Litre" @if(old('unit', $material->unit) === 'Litre') selected @endif>Litre</option>

              </select>

            </div>

          </div>

        </div>

        <div class="col-12">
          <hr class="mt-0 mb-3 text-muted">
        </div>

        <div class="col-md-4">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Price per Unit</label>

            <input type="number" class="form-control" name="price" value="{{ old('price', $material->price) }}">

          </div>

        </div>

        <div class="col-md-4">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Minimum Order Qty (MOQ)</label>

            <input type="number" class="form-control" name="moq" value="{{ old('moq', $material->moq) }}">

          </div>

        </div>

        <div class="col-md-4">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Available Stock / Capacity</label>

            <input type="number" class="form-control" name="stock" value="{{ old('stock', $material->stock) }}">

          </div>

        </div>

        <div class="col-12">
          <hr class="mt-0 mb-3 text-muted">
        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Supplier Name</label>

            <input type="text" class="form-control" name="supplier" value="{{ old('supplier', $material->supplier) }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Location</label>

            <input type="text" class="form-control" name="location" value="{{ old('location', $material->location) }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Lead Time / Delivery Days</label>

            <input type="number" class="form-control" name="leadTime"
              value="{{ old('leadTime', $material->lead_time) }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Certification / Standard (Optional)</label>

            <input type="text" class="form-control" name="certification"
              value="{{ old('certification', $material->certification) }}">

          </div>

        </div>

        <div class="col-12">
          <hr class="mt-0 mb-3 text-muted">
        </div>

        <div class="col-md-12">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Safety / Handling Instructions (Optional)</label>

            <textarea class="form-control" name="safety" rows="3">{{ old('safety', $material->safety) }}</textarea>

          </div>

        </div>

        <div class="col-md-12">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Description</label>

            <textarea class="form-control" name="description"
              rows="3">{{ old('description', $material->description) }}</textarea>

          </div>

        </div>

        <div class="col-12">
          <hr class="mt-0 mb-3 text-muted">
        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Upload Material Image</label>

            <input type="file" class="form-control" name="image" accept="image">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Status</label>

            <select class="form-select" name="status">

              <option value="active" @if(old('status', $material->status) === 'active') selected @endif>Active</option>

              <option value="inactive" @if(old('status', $material->status) === 'inactive') selected @endif>Inactive
              </option>

            </select>

          </div>

        </div>

      </div>

      <div class="d-flex flex-wrap gap-2 border-top pt-3 mt-2">

        <button type="submit" class="btn btn-success px-4">Update Material</button>

        <a href="{{ route('seller.material') }}" class="btn btn-outline-secondary px-4">Cancel</a>

      </div>

    </form>

  </div>

</div>

@include('seller.Include.footer')