@include('seller.Include.header')

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

    <div class="breadcrumb-wrapper mb-2" style="font-size: 15px; font-weight: 500;">
      <h3 class="mb-1">Materials</h3>

      <a href="{{ route('user.dashboard') }}" style="color:#555; text-decoration:none;">
        Dashboard
      </a>

      <span style="padding:0 6px; color:#999; font-size:14px;">
        ▶
      </span>

      <span style="color:#2DAC92;">
        Material
      </span>

    </div>
    <a href="{{ route('seller.material.create') }}" class="btn btn-success btn-sm px-3 addbtn"> Add Material +</a>

  </div>

  <p class="text-muted mb-3">Manage the materials you offer to buyers, including pricing and availability.</p>


{{-- Material Filters --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">

        <div class="row g-2 align-items-end">

            {{-- Search Materials --}}
            <div class="col-12 col-md-6 col-xl-4">
                <label for="material-search" class="form-label small fw-semibold">
                    Search Materials
                </label>

                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="fa-solid fa-magnifying-glass text-muted"></i>
                    </span>

                    <input type="search"
                           class="form-control"
                           id="material-search"
                           placeholder="Material name..."
                           value="{{ request('search') }}">
                </div>
            </div>

            {{-- Material Status --}}
            <div class="col-6 col-md-3 col-xl-2">
                <label for="material-status" class="form-label small fw-semibold">
                    Material Status
                </label>

                <select class="form-select" id="material-status">
                    <option value="">All Statuses</option>
                    <option value="active" @selected(request('status') === 'active')>Active</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                </select>
            </div>

            {{-- From Date --}}
            <div class="col-6 col-md-3 col-xl-2">
                <label for="material-start-date" class="form-label small fw-semibold">
                    From Date
                </label>

                <input type="date"
                       class="form-control"
                       id="material-start-date"
                       value="{{ request('start_date') }}">
            </div>

            {{-- To Date --}}
            <div class="col-6 col-md-4 col-xl-2">
                <label for="material-end-date" class="form-label small fw-semibold">
                    To Date
                </label>

                <input type="date"
                       class="form-control"
                       id="material-end-date"
                       value="{{ request('end_date') }}">
            </div>

            {{-- Filter Button --}}
            <div class="col-6 col-md-2 col-xl-1">
                <button type="button"
                        class="btn btn-success w-100 text-nowrap"
                        id="material-filter-btn"
                        title="Apply Filters">
                    <i class="fa-solid fa-filter"></i>
                </button>
            </div>

            {{-- Reset Button --}}
            <div class="col-6 col-md-2 col-xl-1">
                <a href="{{ route('seller.material') }}"
                   class="btn btn-outline-secondary w-100 text-nowrap"
                   title="Reset Filters">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('material-filter-btn');

    filterButton.addEventListener('click', function () {
        const search = document.getElementById('material-search').value.trim();
        const status = document.getElementById('material-status').value;
        const startDate = document.getElementById('material-start-date').value;
        const endDate = document.getElementById('material-end-date').value;

        if (startDate && endDate && startDate > endDate) {
            alert('From Date cannot be later than To Date.');
            return;
        }

        const url = new URL(window.location.href);
        const filters = {
            search: search,
            status: status,
            start_date: startDate,
            end_date: endDate
        };

        Object.entries(filters).forEach(([key, value]) => {
            if (value) {
                url.searchParams.set(key, value);
            } else {
                url.searchParams.delete(key);
            }
        });

        url.searchParams.delete('page');

        window.location.href = url.toString();
    });
});
</script>


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

                <a href="{{ route('seller.material.show', $material->id) }}" class="btn btn-sm btn-outline-success"
                  title="View"><i class="fa-solid fa-eye"></i></a>

                <a href="{{ route('seller.material.edit', $material->id) }}" class="btn btn-sm btn-outline-warning"
                  title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>

                <form action="{{ route('seller.material.destroy', $material->id) }}" method="POST"
                  class="d-inline delete-material-form">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.delete-material-form');

    forms.forEach(function (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault(); // prevent default form submission

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#198754',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit(); // submit the form if confirmed
          }
        });
      });
    });
  });
</script>

<script>
  document.querySelectorAll('.toggle-status-btn').forEach(btn => {

    btn.addEventListener('click', function () {

      const id = this.dataset.id;

      fetch(`{{ url('seller/material') }}/${id}/toggle`, {

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

@include('seller.Include.footer')