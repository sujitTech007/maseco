@include('admin.Include.header')

<!-- Begin page -->



<div class="page-content">





  <div class="page-title-head d-flex align-items-center gap-2">

    <div class="flex-grow-1">

      <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
        <h3 class="mb-1">Buyer</h3>

        <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
          Dashboard
        </a>

        <span style="padding:0 6px; color:#999; font-size:14px;">
          ▶
        </span>

        <span style="color:#2DAC92;">
          Buyer
        </span>

      </div>
    </div>

  </div>

  <div class="page-container p-3">



    <div class="meetingPpage">

      <div class="row">

        <div class="col-md-12">



          <div class="card" style="
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
    padding: 0px;
    border-radius: 20px;
">




            <div class="card-body p-0 tableCustom">



              <div class="table-responsive pt-2">

                <table class="table table-custom table-centered table-sm table-nowrap table-hover mb-0 dataTable" style="width: 100%;">

                  <div class="dt-layout-row">

                    <div class="dt-layout-cell dt-layout-start">

                      

                    </div>

                    <div class="dt-layout-cell dt-layout-end">

                      <div class="dt-search"><label for="dt-search-0">Search:</label><input type="search" class="dt-input" id="dt-search-0" placeholder="" aria-controls="complex-header-datatable"></div>

                    </div>

                  </div>

                  <thead>

                    <tr>

                      <th>S No.</th>

                      <th>Name</th>

                      <th>Email</th>

                      <th>Mobile </th>

                      <th>Status</th>

                      <th>Actions</th>

                    </tr>

                  </thead>

                  <tbody>

                    @foreach($users as $user)

                    <tr>

                      <td>

                        <h5 class="fs-14 mt-1 fw-normal">{{ $loop->iteration }}</h5>

                      </td>



                      <td>

                        <div class="d-flex align-items-center">



                          <div>

                            <h5 class="fs-14 mt-1">{{ $user->name }}</h5>

                          </div>

                        </div>

                      </td>

                      <td>

                        <h5 class="fs-14 mt-1 fw-normal">{{ $user->email }}</h5>

                      </td>

                      <td>

                        <h5 class="fs-14 mt-1 fw-normal">{{ $user->phone }}</h5>

                      </td>



                      <td>

                        <div class="form-check form-switch">

                          <input class="form-check-input user-status-toggle" type="checkbox" data-id="{{ $user->id }}" {{ $user->status == '1' ? 'checked' : '' }}>

                          <span class="badge bg-{{ $user->status == '1' ? 'success' : 'danger' }} ms-2">{{ $user->status == '1' ? 'Active' : 'Inactive' }}</span>

                        </div>

                      </td>

                      <td>

                        <div class="actionBtn">

                          <a href="javascript:void(0);" class="dropdown-item viewBtn" data-user='@json($user)'><i class="ri-eye-line"></i></a>

                        </div>

                      </td>

                    </tr>

                    @endforeach

                    <!-- More rows as needed -->

                  </tbody>

                </table>



              </div> <!-- end table-responsive-->



            </div> <!-- end card-body-->

          </div>

        </div>



      </div>

    </div>





  </div> <!-- container -->



  <!-- User Details Modal -->

  <div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">

    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <ul class="list-group">

            <li class="list-group-item"><strong>Name:</strong> <span id="modalUserName"></span></li>

            <li class="list-group-item"><strong>Email:</strong> <span id="modalUserEmail"></span></li>

            <li class="list-group-item"><strong>Phone:</strong> <span id="modalUserPhone"></span></li>

            <li class="list-group-item"><strong>Status:</strong> <span id="modalUserStatus"></span></li>

            <li class="list-group-item"><strong>Created At:</strong> <span id="modalUserCreated"></span></li>

          </ul>

        </div>

      </div>

    </div>

  </div>

  <script>
    document.querySelectorAll('.user-status-toggle').forEach(function(toggle) {

      toggle.addEventListener('change', function() {

        var userId = this.getAttribute('data-id');

        var status = this.checked ? 1 : 0;

        fetch("{{ url('admin/buyer/status') }}/" + userId, {

            method: 'POST',

            headers: {

              'X-CSRF-TOKEN': '{{ csrf_token() }}',

              'Content-Type': 'application/json'

            },

            body: JSON.stringify({
              status: status
            })

          })

          .then(response => response.json())

          .then(data => {

            if (data.success) {

              this.nextElementSibling.className = 'badge bg-' + (status ? 'success' : 'danger') + ' ms-2';

              this.nextElementSibling.textContent = status ? 'Active' : 'Inactive';

              // Show success message

              let msg = document.createElement('div');

              msg.className = 'alert alert-success position-fixed top-0 end-0 m-3';

              msg.style.zIndex = 9999;

              msg.textContent = 'Status changed successfully!';

              document.body.appendChild(msg);

              setTimeout(() => msg.remove(), 2000);

            }

          });

      });

    });

    // User details modal logic

    document.querySelectorAll('.viewBtn').forEach(function(btn) {

      btn.addEventListener('click', function() {

        var user = JSON.parse(this.getAttribute('data-user'));

        document.getElementById('modalUserName').textContent = user.name || '';

        document.getElementById('modalUserEmail').textContent = user.email || '';

        document.getElementById('modalUserPhone').textContent = user.phone || '';

        document.getElementById('modalUserStatus').textContent = user.status == 1 ? 'Active' : 'Inactive';

        document.getElementById('modalUserCreated').textContent = user.created_at || '';

        var modal = new bootstrap.Modal(document.getElementById('userDetailsModal'));

        modal.show();

      });

    });
  </script>

<script>
  const searchInput = document.getElementById('dt-search-0');
  const table = document.querySelector('.table-custom tbody');
  const rows = table.getElementsByTagName('tr');

  function filterTable() {
    const filter = searchInput.value.toLowerCase();

    for (let i = 0; i < rows.length; i++) {
      const cells = rows[i].getElementsByTagName('td');
      let found = false;

      for (let j = 0; j < cells.length; j++) {
        if (cells[j].textContent.toLowerCase().includes(filter)) {
          found = true;
          break;
        }
      }

      rows[i].style.display = found ? '' : 'none';
    }
  }

  // Works for typing + clear (✖) icon
  searchInput.addEventListener('input', filterTable);
</script>



  @include('admin.Include.footer')