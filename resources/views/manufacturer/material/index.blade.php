@include('manufacturer.Include.header')

<style>
  .ud-scroll {
    overflow-x: auto;
  }

  .ud-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
    border: 0 !important;
    background: transparent;
  }

  .ud-table th,
  .ud-table td {
    border: 0 !important;
    border-bottom: 1px solid #eef0f3 !important;
    padding: .9rem 1rem !important;
    text-align: left;
    vertical-align: middle;
    background: transparent;
    box-shadow: none !important;
  }

  .ud-table thead {
    background-color: rgb(76 76 92);
  }

  .ud-table th {
    color: #fff;
    font-weight: 700;
    font-size: .85rem;
  }

  .ud-table tbody tr:last-child td {
    border-bottom: 0 !important;
  }

  .ud-table tbody tr:hover td {
    background: #f3faf8 !important;
  }

  .ud-table td.text-center {
    text-align: center !important;
  }

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
</style>

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

    <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
      <h3 class="mb-1">Materials</h3>

      <a href="https://maseco.ca/UAT/manufacturer/dashboard" style="color:#555; text-decoration:none;">
        Dashboard
      </a>

      <span style="padding:0 6px; color:#999; font-size:14px;">
        ▶
      </span>

      <span style="color:#2DAC92;">
        Materials
      </span>

    </div>
    <a href="{{ route('manufacturer.material.create') }}" class="btn btn-success btn-sm px-3">+ Add Material</a>

  </div>

  <p class="text-muted mb-3">Manage the materials you offer to buyers, including pricing and availability.</p>

  <form method="GET" class="bg-white shadow-sm rounded-4 p-3 mb-3 d-flex flex-wrap gap-2 align-items-end">

    <div>

      <label class="form-label fw-semibold small">Search</label>

      <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Material name">

    </div>

    <button class="btn btn-outline-success">Filter</button>

    <a href="{{ route('manufacturer.material') }}" class="btn btn-outline-secondary">Reset</a>

  </form>

  <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden">

    <div class="ud-scroll">

      <table class="ud-table">

        <thead>

          <tr>

            <th>Sr. No.</th>

            <th>Image</th>

            <th>Name</th>

            <th>Description</th>

            <th>Unit</th>

            <th>Price</th>

            <th>Status</th>

            <th>Actions</th>

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

              <td>{{ $material->description }}</td>

              <td>{{ $material->unit }}</td>

              <td class="fw-semibold text-nowrap">{{ $material->price }}</td>

              <td>
                @if($material->status == 'active')
                  <span class="ud-st ud-st-success rounded-pill d-inline-block text-nowrap">Active</span>
                @else
                  <span class="ud-st ud-st-danger rounded-pill d-inline-block text-nowrap">Inactive</span>
                @endif
              </td>

              <td class="text-nowrap">

                <a href="{{ route('manufacturer.material.show', $material->id) }}" class="btn btn-sm btn-outline-success"
                  title="View"><i class="fa-solid fa-eye"></i></a>

                <a href="{{ route('manufacturer.material.edit', $material->id) }}" class="btn btn-sm btn-outline-warning"
                  title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>

                <form action="{{ route('manufacturer.material.destroy', $material->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Delete this material?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete"><i
                      class="fa-solid fa-trash"></i></button>
                </form>

              </td>

            </tr>

          @empty

            <tr>
              <td colspan="8" class="text-center text-muted">
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

<script>
  document.querySelectorAll('.toggle-status-btn').forEach(btn => {

    btn.addEventListener('click', function () {

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