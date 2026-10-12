@include('admin.Include.header')



<div class="page-content">
  <div class="page-title-head d-flex align-items-center gap-2">

    <div class="flex-grow-1">

      <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
        <h3 class="mb-1">Manufacturer</h3>

        <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
          Dashboard
        </a>

        <span style="padding:0 6px; color:#999; font-size:14px;">
          ▶
        </span>

        <span style="color:#2DAC92;">
          Manufacturer
        </span>

      </div>
    </div>

  </div>

  <div class="page-container p-3">

    <div class="meetingPpage">

      <div class="row">

        <div class="col-md-12">



          <div class="card" style="
    box-shadow: 0 0 2px rgb(0 0 0 / 0%);
    padding: 0px;
    border-radius: 20px;
">

            

            <div class="card tableCustom mb-0">



              <div class="table-responsive">

                <table class="table table-custom table-centered table-sm table-nowrap table-hover mb-0 dataTable" style="width: 100%;">

                  <div class="dt-layout-row">

                    <div class="dt-layout-cell dt-layout-start">

                      

                    </div>

                    <div class="dt-layout-cell dt-layout-end">

                      <div class="dt-search"><label for="dt-search-0">Search:</label>
                      
                      <input type="search" class="dt-input" id="dt-search-0" placeholder="" aria-controls="complex-header-datatable">
                      </div>

                    </div>

                  </div>

                  <thead style="background:#F7F7F7 !important">

                    <tr>

                          <th>S No.</th>
 
                      <th>Name</th>

                      <th>Email</th>

                      <th>Mobile No</th>

                      <th>Company Name</th>

                      <th>Status</th>

                      <th>Actions</th>

                    </tr>

                  </thead>

                  <tbody>

                    @foreach($manufacturers as $manufacturer)

                    <tr>
                        <td>

                        <h5 class="fs-14 mt-1 fw-normal">{{ $loop->iteration }}</h5>

                      </td>
                      

                      <td>

                        <div class="d-flex align-items-center">



                          <div>

                            <h5 class="fs-14 mt-1">{{ $manufacturer->name }}</h5>

                          </div>

                        </div>

                      </td>

                      <td>

                        <h5 class="fs-14 mt-1 fw-normal">{{ $manufacturer->email }}</h5>

                      </td>

                      <td>

                        <h5 class="fs-14 mt-1 fw-normal">{{ $manufacturer->phone }}</h5>

                      </td>

                      <td>

                        <h5 class="fs-14 mt-1 fw-normal">{{ $manufacturer->company_name }}</h5>

                      </td>



                      <td>

                        <div class="form-check form-switch">

                          <input class="form-check-input manufacturer-status-toggle" type="checkbox" data-id="{{ $manufacturer->id }}" {{ $manufacturer->status == '1' ? 'checked' : '' }}>

                          <span class="badge bg-{{ $manufacturer->status == '1' ? 'success' : 'danger' }} ms-2">{{ $manufacturer->status == '1' ? 'Active' : 'Inactive' }}</span>

                        </div>

                      </td>

                      <td>

                        <div class="actionBtn">

                          <a href="javascript:void(0);" class="dropdown-item viewManufacturerBtn" data-manufacturer='@json($manufacturer)'><i class="ri-eye-line"></i></a>

                        </div>

                      </td>

                    </tr>

                    @endforeach

                    <!-- More rows as needed -->

                  </tbody>

                </table><!-- end table -->

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div> <!-- container -->



  @include('admin.Include.footer')



  <!-- Manufacturer Details Modal -->

  <div class="modal fade" id="manufacturerDetailsModal" tabindex="-1" aria-labelledby="manufacturerDetailsModalLabel" aria-hidden="true">

    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="manufacturerDetailsModalLabel">Manufacturer Details</h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <ul class="list-group">

            <li class="list-group-item"><strong>Name:</strong> <span id="modalManufacturerName"></span></li>

            <li class="list-group-item"><strong>Email:</strong> <span id="modalManufacturerEmail"></span></li>

            <li class="list-group-item"><strong>Phone:</strong> <span id="modalManufacturerPhone"></span></li>

            <li class="list-group-item"><strong>Company Name:</strong> <span id="modalManufacturerCompany"></span></li>

            <li class="list-group-item"><strong>Status:</strong> <span id="modalManufacturerStatus"></span></li>

            <li class="list-group-item"><strong>Created At:</strong> <span id="modalManufacturerCreated"></span></li>

          </ul>

        </div>

      </div>

    </div>

  </div>

  <script>
    document.querySelectorAll('.manufacturer-status-toggle').forEach(function(toggle) {

      toggle.addEventListener('change', function() {

        var manufacturerId = this.getAttribute('data-id');

        var status = this.checked ? 1 : 0;

        fetch("{{ url('admin/manufacturer/status') }}/" + manufacturerId, {

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

    // Manufacturer details modal logic

    document.querySelectorAll('.viewManufacturerBtn').forEach(function(btn) {

      btn.addEventListener('click', function() {

        var manufacturer = JSON.parse(this.getAttribute('data-manufacturer'));

        document.getElementById('modalManufacturerName').textContent = manufacturer.name || '';

        document.getElementById('modalManufacturerEmail').textContent = manufacturer.email || '';

        document.getElementById('modalManufacturerPhone').textContent = manufacturer.phone || '';

        document.getElementById('modalManufacturerCompany').textContent = manufacturer.company_name || '';

        document.getElementById('modalManufacturerStatus').textContent = manufacturer.status == 1 ? 'Active' : 'Inactive';

        document.getElementById('modalManufacturerCreated').textContent = manufacturer.created_at || '';

        var modal = new bootstrap.Modal(document.getElementById('manufacturerDetailsModal'));

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