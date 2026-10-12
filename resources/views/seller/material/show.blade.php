@include('seller.Include.header')

<div class="page-content p-4">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h3 class="mb-1">Material Details</h3>
      <small>
        <a href="{{ route('seller.dashboard') }}">Dashboard</a> ▶
        <span class="text-success">Material Details</span>
      </small>
    </div>

    <a href="{{ route('seller.material') }}" class="btn btn-secondary btn-sm">
      ← Back to List
    </a>
  </div>

  <!-- Card -->
  <div class="card shadow">
    <div class="card-body">
      <div class="row g-4">

        <!-- Image -->
        <div class="col-md-4">
          <img
            src="{{ $material->image ? asset('public/' . $material->image) : asset('public/no-image.png') }}"
            class="img-fluid rounded shadow-sm"
            alt="Material Image"
          >
        </div>

        <!-- Details -->
        <div class="col-md-8">

          <h4>{{ $material->name }}</h4>
          <p class="text-muted">{{ $material->description }}</p>

          <div class="row mb-2">
            <div class="col-6"><strong>SKU:</strong> {{ $material->sku }}</div>
            <div class="col-6"><strong>Category:</strong> {{ $material->category }}</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Sub Category:</strong> {{ $material->sub_category }}</div>
            <div class="col-6"><strong>Grade:</strong> {{ $material->grade }}</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Strength:</strong> {{ $material->strength }}</div>
            <div class="col-6"><strong>Size:</strong> {{ $material->size }}</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Weight:</strong> {{ $material->weight }}</div>
            <div class="col-6"><strong>Unit:</strong> {{ $material->unit }}</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Price:</strong> ₹{{ number_format($material->price, 2) }}</div>
            <div class="col-6"><strong>MOQ:</strong> {{ $material->moq }}</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Stock:</strong> {{ $material->stock }}</div>
            <div class="col-6"><strong>Supplier:</strong> {{ $material->supplier }}</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Location:</strong> {{ $material->location }}</div>
            <div class="col-6"><strong>Lead Time:</strong> {{ $material->lead_time }}</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Certification:</strong> {{ $material->certification }}</div>
            <div class="col-6"><strong>Status:</strong>
              <span class="badge {{ $material->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                {{ $material->status == 'active' ? 'Active' : 'Inactive' }}
              </span>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-12">
              <strong>Safety / Handling:</strong> {{ $material->safety }}
            </div>
          </div>

          <!-- Datasheet -->
          @if($material->datasheet)
          <div class="mt-3">
            <a href="{{ asset('public/' . $material->datasheet) }}" target="_blank"
               class="btn btn-outline-primary btn-sm">
              📄 View Datasheet
            </a>
          </div>
          @endif

          <!-- Actions -->
          <div class="mt-3 d-flex gap-2">
            <a href="{{ route('seller.material.edit', $material->id) }}"
               class="btn btn-primary btn-sm">
              ✏️ Edit Material
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>

@include('seller.Include.footer')
