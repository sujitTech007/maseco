@include('seller.Include.header')

<style>
  .ud-st {
    font-size: .8rem;
    font-weight: 600;
    padding: .3rem .7rem;
  }

  .ud-st::before {
    content: "";
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
    margin-right: .4rem;
    display: inline-block;
    vertical-align: middle;
  }

  .ud-st-success {
    background: #e6f4ec;
    color: #198754;
  }

  .ud-st-danger {
    background: #fde8e8;
    color: #c0392b;
  }

  .ud-accent {
    border-top: 4px solid var(--bs-success) !important;
  }
</style>

<div class="page-content p-4">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <div>
      <h3 class="mb-1">Material Details</h3>
      <small>
        <a href="{{ route('seller.dashboard') }}" class="text-decoration-none">Dashboard</a> ▶
        <span class="text-success">Material Details</span>
      </small>
    </div>

    <a href="{{ route('seller.material') }}" class="btn btn-outline-success btn-sm px-3">
      ← Back to List
    </a>
  </div>

  <!-- Card -->
  <div class="card border-0 shadow-sm rounded-4 ud-accent">
    <div class="card-body p-4">
      <div class="row g-4">

        <!-- Image -->
        <div class="col-md-4">
          <img src="{{ $material->image ? asset('public/' . $material->image) : asset('public/no-image.png') }}"
            class="img-fluid w-100 rounded-4 shadow-sm" alt="Material Image">
        </div>

        <!-- Details -->
        <div class="col-md-8">

          <h4 class="fw-bold mb-1">{{ $material->name }}</h4>
          @if($material->is_certified)<img src="{{ asset('public/assets/images/certified-badge.png') }}" alt="Certified Listing" style="height:25px;width:auto;max-width:100%;">@endif
          <p class="text-muted mb-4">{{ $material->description }}</p>

          <!-- Key figures -->
          <div class="row g-3 mb-4">
            <div class="col-sm-4">
              <div class="bg-light rounded-3 p-3 h-100">
                <div class="text-muted small">Price</div>
                <div class="fs-5 fw-bold text-success">₹{{ number_format($material->price, 2) }}</div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="bg-light rounded-3 p-3 h-100">
                <div class="text-muted small">MOQ</div>
                <div class="fs-5 fw-bold">{{ $material->moq }}</div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="bg-light rounded-3 p-3 h-100">
                <div class="text-muted small">Stock</div>
                <div class="fs-5 fw-bold">{{ $material->stock }}</div>
              </div>
            </div>
          </div>

          <!-- Specifications -->
          <div class="row g-3">

            <div class="col-sm-6">
              <div class="text-muted small">SKU</div>
              <div class="fw-semibold">{{ $material->sku }}</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Category</div>
              <div class="fw-semibold">{{ $material->category }}</div>
            </div>

            <div class="col-sm-6">
              <div class="text-muted small">Sub Category</div>
              <div class="fw-semibold">{{ $material->sub_category }}</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Grade</div>
              <div class="fw-semibold">{{ $material->grade }}</div>
            </div>

            <div class="col-sm-6">
              <div class="text-muted small">Strength</div>
              <div class="fw-semibold">{{ $material->strength }}</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Size</div>
              <div class="fw-semibold">{{ $material->size }}</div>
            </div>

            <div class="col-sm-6">
              <div class="text-muted small">Weight</div>
              <div class="fw-semibold">{{ $material->weight }}</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Unit</div>
              <div class="fw-semibold">{{ $material->unit }}</div>
            </div>

            <div class="col-sm-6">
              <div class="text-muted small">Supplier</div>
              <div class="fw-semibold">{{ $material->supplier }}</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Location</div>
              <div class="fw-semibold">{{ $material->location }}</div>
            </div>

            <div class="col-sm-6">
              <div class="text-muted small">Lead Time</div>
              <div class="fw-semibold">{{ $material->lead_time }}</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Certification</div>
              <div class="fw-semibold">{{ $material->certification }}</div>
            </div>

            <div class="col-sm-6">
              <div class="text-muted small mb-1">Status</div>
              <span
                class="ud-st {{ $material->status == 'active' ? 'ud-st-success' : 'ud-st-danger' }} rounded-pill d-inline-block text-nowrap">
                {{ $material->status == 'active' ? 'Active' : 'Inactive' }}
              </span>
            </div>

            <div class="col-12">
              <div class="text-muted small">Safety / Handling</div>
              <div class="fw-semibold">{{ $material->safety }}</div>
            </div>

          </div>

          <!-- Datasheet -->
          @if($material->datasheet)
            <div class="mt-4">
              <a href="{{ asset('public/' . $material->datasheet) }}" target="_blank"
                class="btn btn-outline-success btn-sm px-3">
                📄 View Datasheet
              </a>
            </div>
          @endif

          <!-- Actions -->
          <div class="mt-3 d-flex gap-2">
            <a href="{{ route('seller.material.edit', $material->id) }}" class="btn btn-success btn-sm px-3">
              ✏️ Edit Material
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>

@include('seller.Include.footer')
