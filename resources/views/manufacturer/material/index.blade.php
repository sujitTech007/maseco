@include('manufacturer.Include.header')


@php
// TEMP DEMO DATA: only shows when the list is empty, APP_DEBUG is true and the URL has ?demo=1. Delete before launch.
$rows = $materials;
if ($rows->isEmpty() && config('app.debug') && request()->boolean('demo')) {
$rows = collect([
(object) ['id' => 1, 'image' => null, 'name' => 'Organic Cotton Fabric', 'description' => 'GOTS-certified, mid-weight woven cotton', 'unit' => 'Meter', 'price' => '12.50', 'status' => 'active'],
(object) ['id' => 2, 'image' => null, 'name' => 'Linen Blend', 'description' => 'Breathable linen and cotton blend', 'unit' => 'Meter', 'price' => '18.00', 'status' => 'active'],
(object) ['id' => 3, 'image' => null, 'name' => 'Recycled Polyester Yarn', 'description' => 'Post-consumer recycled yarn, 150D', 'unit' => 'Kg', 'price' => '6.75', 'status' => 'inactive'],
(object) ['id' => 4, 'image' => null, 'name' => 'Hemp Blend Denim', 'description' => 'Durable 10oz denim with hemp fibre', 'unit' => 'Meter', 'price' => '21.40', 'status' => 'active'],
]);
}
@endphp

<div class="page-content p-4">

  <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-1">

    <div class="breadcrumb-wrapper mb-3">
      <h3 class="mb-1">Materials</h3>
    </div>
    <div class="d-flex gap-2"><a href="{{ route('manufacturer.material.create') }}" class="btn theme-btn btn-sm px-3">+ Add Material</a><button type="button" class="btn btn-outline-success btn-sm px-3" data-bs-toggle="modal" data-bs-target="#createSampleModal">+ Add Sample</button></div>

  </div>

  <p class="text-muted mb-3">Manage the materials you offer to buyers, including pricing and availability.</p>


  {{-- Material Filters --}}
  <div class="card border-0 shadow-sm rounded-4 mb-3">
    <div class="card-body p-3">
      <div class="row g-3 align-items-end">

        {{-- Search --}}
        <div class="col-lg-4 col-md-6">
          <label for="material-search" class="form-label fw-semibold small">
            Search Materials
          </label>
          <input
            type="text"
            id="material-search"
            class="form-control"
            placeholder="Material name..."
            value="{{ request('search') }}">
        </div>

        {{-- Material Status --}}
        <div class="col-lg-2 col-md-6">
          <label for="material-status" class="form-label fw-semibold small">
            Material Status
          </label>
          <select id="material-status" class="form-select">
            <option value="">All Statuses</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>

        {{-- From Date --}}
        <div class="col-lg-2 col-md-6">
          <label for="material-start-date" class="form-label fw-semibold small">
            From Date
          </label>
          <input
            type="date"
            id="material-start-date"
            class="form-control"
            value="{{ request('start_date') }}">
        </div>

        {{-- To Date --}}
        <div class="col-lg-2 col-md-6">
          <label for="material-end-date" class="form-label fw-semibold small">
            To Date
          </label>
          <input
            type="date"
            id="material-end-date"
            class="form-control"
            value="{{ request('end_date') }}">
        </div>

        {{-- Filter & Reset --}}
        <div class="col-lg-2 col-md-12 d-flex gap-2">
          <button type="button" id="material-filter-btn"
            class="btn theme-btn text-nowrap px-2" style="height: 46px;">
            <i class="fa-solid fa-filter me-1"></i> Filter
          </button>

          <a href="{{ route('manufacturer.material') }}"
            class="btn btn-outline-danger" title="Reset Filters">
            <i class="fa-solid fa-rotate-left"></i>
          </a>
        </div>

      </div>
    </div>
  </div>




  <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden">

    <div class="ud-scroll">

      <table class="ud-table">

        <thead>

          <tr>

            <th>Sr. No.</th>

            <th>Image</th>

            <th>Name</th>

            <!-- <th>Description</th> -->

            <th>Unit</th>

            <th>Price</th>

            <th>Status</th>

            <th>Certification</th>

            <th class="text-center">Actions</th>

          </tr>

        </thead>

        <tbody>

          @forelse($rows as $i => $material)

          <tr>

            <td class="text-muted">{{ $i + 1 }}</td>

            <td>

              @if($material->image)

              <img src="{{ asset('public/' . $material->image) }}" alt="Material Image" class="rounded-3"
                style="width: 60px; height: 50px; object-fit: cover;">

              @else

              <span class="text-muted">No Image</span>

              @endif

            </td>

            <td class="fw-semibold">{{ $material->name }}</td>

            <!-- <td>{{ $material->description }}</td> -->

            <td>{{ $material->unit }}</td>

            <td class="fw-semibold text-nowrap">{{ $material->price }}</td>

            <td>
              @if($material->status == 'active')
              <span class="ud-st ud-st-success rounded-pill d-inline-block text-nowrap">Active</span>
              @else
              <span class="ud-st ud-st-danger rounded-pill d-inline-block text-nowrap">Inactive</span>
              @endif
            </td>

            <td>
              @if(!empty($material->is_certified))
              <img src="{{ asset('public/assets/images/certified-badge.png') }}" alt="Certified Listing" style="height:25px;width:auto;max-width:100%;">
              @else
              <span class="text-muted">—</span>
              @endif
            </td>

            <td class="text-nowrap">

            <div class="d-flex gap-1 align-items-center justify-content-center td_actions_btns">

              <a href="{{ route('manufacturer.material.show', $material->id) }}" class="btn btn-sm btn-outline-success"
                title="View"><i class="fa-solid fa-eye"></i></a>

              <a href="{{ route('manufacturer.material.edit', $material->id) }}" class="btn btn-sm btn-outline-warning"
                title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>

              <form action="{{ route('manufacturer.material.destroy', $material->id) }}" method="POST" class="d-inline p-0 m-0"
                onsubmit="return confirm('Delete this material?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete"><i
                    class="fa-solid fa-trash"></i></button>
              </form>
              </div>

            </td>

          </tr>

          @empty

          <tr>
            <td colspan="9" class="text-center text-muted">
              <div>No materials found.</div>
              <div class="small">Materials you add will appear here.</div>
            </td>
          </tr>

          @endforelse

        </tbody>

      </table>

    </div>

  </div>

</div>

@include('samples.inline-list', ['samples' => $samples, 'materials' => $sampleMaterials, 'rolePrefix' => 'manufacturer'])

<script>
  document.querySelectorAll('.toggle-status-btn').forEach(btn => {

    btn.addEventListener('click', function() {

      const id = this.dataset.id;

      fetch(`{{ url('manufacturer/material') }}/${id}/toggle`, {

          method: 'POST',

          headers: {

            'X-CSRF-TOKEN': '{{ csrf_token() }}',

            'Accept': 'application/json',

          },

        })

        .then(res => res.json())

        .then(data => {

          if (data.status !== undefined) {

            this.classList.toggle('btn-success', data.status);

            this.classList.toggle('btn-secondary', !data.status);

            this.textContent = data.status ? 'Active' : 'Inactive';

          }

        });

    });

  });
</script>

@include('manufacturer.Include.footer')