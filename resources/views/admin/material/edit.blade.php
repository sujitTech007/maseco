@include('admin.Include.header')

<div class="page-content p-4">

  <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
      <h3 class="mb-1">Edit Materials</h3>

      <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
        Dashboard
      </a>

      <span style="padding:0 6px; color:#999; font-size:14px;">
        ▶
      </span>

      <span style="color:#2DAC92;">
       Edit Materials
      </span>

    </div>
  <form method="POST" action="{{ route('admin.material.update', $material->id) }}" enctype="multipart/form-data">

    @csrf

    @method('PUT')

    <div class="row">

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Material Name</label>

          <input type="text" class="form-control" name="name" required value="{{ old('name', $material->name) }}">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Material Code / SKU</label>

          <input type="text" class="form-control" name="sku" required value="{{ old('sku', $material->sku) }}">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Category / Type</label>

          <select class="form-control" name="category" required>

            <option disabled>Select Category</option>

            <option value="Fabric" @if(old('category', $material->category)==='Fabric') selected @endif>Fabric</option>

            <option value="Metal" @if(old('category', $material->category)==='Metal') selected @endif>Metal</option>

            <option value="Plastic" @if(old('category', $material->category)==='Plastic') selected @endif>Plastic</option>

            <option value="Wood" @if(old('category', $material->category)==='Wood') selected @endif>Wood</option>

            <option value="Chemicals" @if(old('category', $material->category)==='Chemicals') selected @endif>Chemicals</option>

          </select>

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Sub-Category (Optional)</label>

          <select class="form-control" name="subCategory">

            <option disabled>Select Sub-Category</option>

            <option value="Organic" @if(old('subCategory', $material->sub_category)==='Organic') selected @endif>Organic</option>

            <option value="Blended" @if(old('subCategory', $material->sub_category)==='Blended') selected @endif>Blended</option>

            <option value="HR Steel" @if(old('subCategory', $material->sub_category)==='HR Steel') selected @endif>HR Steel</option>

            <option value="Polished Stone" @if(old('subCategory', $material->sub_category)==='Polished Stone') selected @endif>Polished Stone</option>

          </select>

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Material Grade / Quality</label>

          <input type="text" class="form-control" name="grade" value="{{ old('grade', $material->grade) }}">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Strength / Durability</label>

          <input type="text" class="form-control" name="strength" value="{{ old('strength', $material->strength) }}">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Size / Dimensions</label>

          <input type="text" class="form-control" name="size" value="{{ old('size', $material->size) }}">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Weight / Unit</label>

          <div class="input-group">

            <input type="number" class="form-control" name="weight" value="{{ old('weight', $material->weight) }}">

            <select class="form-control" name="unit">

              <option value="Kg" @if(old('unit', $material->unit)==='Kg') selected @endif>Kg</option>

              <option value="Meter" @if(old('unit', $material->unit)==='Meter') selected @endif>Meter</option>

              <option value="Piece" @if(old('unit', $material->unit)==='Piece') selected @endif>Piece</option>

              <option value="Litre" @if(old('unit', $material->unit)==='Litre') selected @endif>Litre</option>

            </select>

          </div>

        </div>

      </div>

      <div class="col-md-4">

        <div class="form-group mb-3">

          <label>Price per Unit</label>

          <input type="number" class="form-control" name="price" value="{{ old('price', $material->price) }}">

        </div>

      </div>

      <div class="col-md-4">

        <div class="form-group mb-3">

          <label>Minimum Order Qty (MOQ)</label>

          <input type="number" class="form-control" name="moq" value="{{ old('moq', $material->moq) }}">

        </div>

      </div>

      <div class="col-md-4">

        <div class="form-group mb-3">

          <label>Available Stock / Capacity</label>

          <input type="number" class="form-control" name="stock" value="{{ old('stock', $material->stock) }}">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Supplier Name</label>

          <input type="text" class="form-control" name="supplier" value="{{ old('supplier', $material->supplier) }}">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Location</label>

          <input type="text" class="form-control" name="location" value="{{ old('location', $material->location) }}">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Lead Time / Delivery Days</label>

          <input type="number" class="form-control" name="leadTime" value="{{ old('leadTime', $material->lead_time) }}">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Certification / Standard (Optional)</label>

          <input type="text" class="form-control" name="certification" value="{{ old('certification', $material->certification) }}">

        </div>

      </div>

      <div class="col-md-12">

        <div class="form-group mb-3">

          <label>Safety / Handling Instructions (Optional)</label>

          <textarea class="form-control" name="safety" rows="3">{{ old('safety', $material->safety) }}</textarea>

        </div>

      </div>

      <div class="col-md-12">

        <div class="form-group mb-3">

          <label>Description</label>

          <textarea class="form-control" name="description" rows="3">{{ old('description', $material->description) }}</textarea>

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Upload Material Image(s)</label>

          <input type="file" class="form-control" name="image" accept="image/*">

          @if($material->image)

            <div class="mt-2">

              <img src="{{ asset('public/' . $material->image) }}" alt="Material Image"  style="width: 60px; height: 50px; object-fit: cover;">

            </div>

          @endif

        </div>

      </div>

      

      <div class="col-md-6">

        <div class="form-group mb-3">

          <label>Status</label>

          <select class="form-control" name="status">

            <option value="active" @if(old('status', $material->status)==='active') selected @endif>Active</option>

            <option value="inactive" @if(old('status', $material->status)==='inactive') selected @endif>Inactive</option>

          </select>

        </div>

      </div>

    </div>

    <div class="row mt-4">

      <div class="col-md-6">

        <button type="submit" class="btn btn-success mtrlbtn">Update Material</button>

        <a href="{{ route('admin.material') }}" class="btn btn-secondary mtrlbtn">Cancel</a>

      </div>

    </div>

  </form>

</div>

@include('admin.Include.footer')

