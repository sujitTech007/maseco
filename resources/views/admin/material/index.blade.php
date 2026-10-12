@include('admin.Include.header')



<div class="page-content p-4">

  <div class="d-flex justify-content-between align-items-center mb-3">

    <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
      <h3 class="mb-1">Materials</h3>

      <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
        Dashboard
      </a>

      <span style="padding:0 6px; color:#999; font-size:14px;">
        ▶
      </span>

      <span style="color:#2DAC92;">
        Materials
      </span>

    </div>
    <!-- <a href="{{ route('admin.material.create') }}" class="btn btn-primary btn-sm">+ Add Material</a> -->

  </div>



  <form method="GET" class="mb-3 d-flex gap-2 align-items-end">

    <div>

      <label>Search</label>

      <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Material name">

    </div>

    <div>

      <label>Status</label>

      <select name="status" class="form-control">

        <option value="">All</option>

        <option value="1" @if(request('status')==='1' ) selected @endif>Active</option>

        <option value="0" @if(request('status')==='0' ) selected @endif>Inactive</option>

      </select>

    </div>

    <button class="btn btn-outline-primary fltrbtn">Filter</button>

    <a href="{{ route('admin.material') }}" class="btn btn-outline-secondary fltrbtn">Reset</a>

  </form>



  <div class="card" style="    box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
    padding: 0px;
    background: white;
    border-radius: 20px;">

    <div class="card-body table-responsive">

      <table class="table table-striped table-hover align-middle">

        <thead class="table">

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

          @forelse($materials as $i => $material)

          <tr>

            <td>{{ $i+1 }}</td>

            <td>

              @if($material->image)

              <img src="{{ asset('public/' . $material->image) }}" alt="Material Image" style="width: 60px; height: 50px; object-fit: cover;">

              @else

              <span class="text-muted">No Image</span>

              @endif

            </td>

            <td>{{ $material->name }}</td>

            <td>{{ $material->description }}</td>

            <td>{{ $material->unit }}</td>

            <td>{{ $material->price }}</td>

            <td>

              <form method="POST" action="{{ route('admin.material.toggle', $material->id) }}" class="d-inline toggle-status-form">

                @csrf

                <button type="button" class="btn btn-sm toggle-status-btn {{ $material->status === 'active' ? 'btn-success' : 'btn-danger' }}" data-id="{{ $material->id }}">

                  {{ $material->status === 'active' ? 'Active' : 'Inactive' }}

                </button>

              </form>

            </td>

            <td>

              <a href="{{ route('admin.material.show', $material->id) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="ri-eye-line"></i></a>

              <a href="{{ route('admin.material.edit', $material->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="ri-edit-line"></i></a>

              <form action="{{ route('admin.material.destroy', $material->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this material?')">

                @csrf

                @method('DELETE')

                <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="ri-delete-bin-line"></i></button>

              </form>

            </td>

          </tr>

          @empty

          <tr>
            <td colspan="8" class="text-center">No materials found.</td>
          </tr>

          @endforelse

        </tbody>

      </table>

    </div>

  </div>

</div>



<script>
  document.querySelectorAll('.toggle-status-btn').forEach(btn => {

    btn.addEventListener('click', function() {

      const id = this.dataset.id;

      fetch(`{{ url('admin/material') }}/${id}/toggle`, {

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



@include('admin.Include.footer')