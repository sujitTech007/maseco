@include('seller.Include.header')

<div class="page-content p-4">

  <h3 class="mb-4">Add Material</h3>

  <div class="bg-white shadow-sm rounded-4 p-4">

    <form method="POST" action="{{ route('seller.material.store') }}" enctype="multipart/form-data">

      @csrf

      <div class="row">

        <!-- Basic Info -->

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Material Name</label>

            <input type="text" class="form-control" name="name" placeholder="Enter material name" required
              value="{{ old('name') }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Material Code / SKU</label>

            <input type="text" class="form-control" name="sku" placeholder="Auto or enter SKU" required>

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Category / Type</label>

            <select class="form-select" name="category" required>

              <option disabled selected>Select Category</option>

              <option>Fabric</option>

              <option>Metal</option>

              <option>Plastic</option>

              <option>Wood</option>

              <option>Chemicals</option>

            </select>

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Sub-Category (Optional)</label>

            <select class="form-select" name="subCategory">

              <option disabled selected>Select Sub-Category</option>

              <option>Organic</option>

              <option>Blended</option>

              <option>HR Steel</option>

              <option>Polished Stone</option>

            </select>

          </div>

        </div>

        <div class="col-12">
          <hr class="mt-0 mb-3 text-muted">
        </div>

        <!-- Specifications -->

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Material Grade / Quality</label>

            <input type="text" class="form-control" name="grade" placeholder="High / Premium etc."
              value="{{ old('grade') }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Strength / Durability</label>

            <input type="text" class="form-control" name="strength" placeholder="e.g., 120 GSM, 500 MPa"
              value="{{ old('strength') }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Size / Dimensions</label>

            <input type="text" class="form-control" name="size" placeholder="Length x Width x Height"
              value="{{ old('size') }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Weight / Unit</label>

            <div class="input-group">

              <input type="number" class="form-control" name="weight" placeholder="Enter weight"
                value="{{ old('weight') }}">

              <select class="form-select" name="unit"
                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">

                <option>Kg</option>

                <option>Meter</option>

                <option>Piece</option>

                <option>Litre</option>

              </select>

            </div>

          </div>

        </div>

        <div class="col-12">
          <hr class="mt-0 mb-3 text-muted">
        </div>

        <!-- Pricing & Quantity -->

        <div class="col-md-4">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Price per Unit</label>

            <input type="number" class="form-control" name="price" placeholder="Enter price" value="{{ old('price') }}">

          </div>

        </div>

        <div class="col-md-4">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Minimum Order Qty (MOQ)</label>

            <input type="number" class="form-control" name="moq" placeholder="Enter MOQ" value="{{ old('moq') }}">

          </div>

        </div>

        <div class="col-md-4">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Available Stock / Capacity</label>

            <input type="number" class="form-control" name="stock" placeholder="Enter stock" value="{{ old('stock') }}">

          </div>

        </div>

        <div class="col-12">
          <hr class="mt-0 mb-3 text-muted">
        </div>

        <!-- Supplier Details -->

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Supplier Name</label>

            <input type="text" class="form-control" name="supplier" placeholder="Auto if logged in"
              value="{{ old('supplier') }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Location</label>

            <input type="text" class="form-control" name="location" placeholder="City / State / Country"
              value="{{ old('location') }}">

          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Lead Time / Delivery Days</label>

            <input type="number" class="form-control" name="leadTime" placeholder="Enter delivery days"
              value="{{ old('leadTime') }}">

          </div>

        </div>

        <!-- Compliance / Standards -->

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Certification / Standard (Optional)</label>

            <input type="text" class="form-control" name="certification" placeholder="ISO / BIS / GOTS etc."
              value="{{ old('certification') }}">

          </div>

        </div>

        <div class="col-12">
          <hr class="mt-0 mb-3 text-muted">
        </div>

        <div class="col-md-12">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Safety / Handling Instructions (Optional)</label>

            <textarea class="form-control" name="safety" rows="3"
              placeholder="Enter instructions">{{ old('safety') }}</textarea>

          </div>

        </div>

        <div class="col-md-12">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Description</label>

            <textarea class="form-control" name="description" rows="3"
              placeholder="Enter description">{{ old('description') }}</textarea>

          </div>

        </div>

        <div class="col-12">
          <hr class="mt-0 mb-3 text-muted">
        </div>

        <!-- Media -->

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Upload Material Image</label>

            <input type="file" class="form-control" name="image" accept="image">

          </div>

        </div>

        <!-- Status -->

        <div class="col-md-6">

          <div class="form-group mb-3">

            <label class="form-label fw-semibold small">Status</label>

            <select class="form-select" name="status">

              <option value="active" selected>Active</option>

              <option value="inactive">Inactive</option>

            </select>

          </div>

        </div>

      </div>

      <!-- Action Buttons -->

      <div class="d-flex flex-wrap gap-2 border-top pt-3 mt-2">

        <button type="submit" class="btn btn-success px-4">Save Material</button>

        <a href="{{ route('seller.material') }}" class="btn btn-outline-secondary px-4">Cancel</a>

      </div>

    </form>

  </div>

</div>

@include('seller.Include.footer')