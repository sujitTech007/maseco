@include('seller.Include.header')



<div class="page-content p-4">

  <div class="d-flex justify-content-between align-items-center mb-3">


    <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
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
    <a href="{{ route('seller.material.create') }}" class="btn btn-primary btn-sm addbtn"> Add Material +</a>

  </div>



  <form method="GET" class="mb-3 d-flex gap-2 align-items-end">

    <div>

      <label>Search</label>

      <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Material name">

    </div>

    <button class="btn btn-outline-primary fltrbtn">Filter</button>

    <a href="{{ route('seller.material') }}" class="btn btn-outline-secondary fltrbtn">Reset</a>

  </form>



  <div class="card">

    <div class="card-body table-responsive">

      <table class="table table-striped table-hover align-middle">

        <thead class="table-light">

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
                @if($material->status == 'active')
                    <span class="badge bg-success p-2">Active</span>
                @else
                    <span class="badge bg-danger p-2">Inactive</span>
                @endif
            </td>

            <td>

              <a href="{{ route('seller.material.show', $material->id) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="ri-eye-line"></i></a>

              <a href="{{ route('seller.material.edit', $material->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="ri-edit-line"></i></a>

              <form action="{{ route('seller.material.destroy', $material->id) }}" method="POST" class="d-inline delete-material-form">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"><i class="ri-delete-bin-line"></i></button>
              </form>

              <!-- <form action="{{ route('seller.material.destroy', $material->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this material?')"> -->

                <!-- @csrf

                @method('DELETE')

                <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="ri-delete-bin-line"></i></button>

              </form> -->

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.delete-material-form');

        forms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // prevent default form submission

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
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

    btn.addEventListener('click', function() {

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