@include('admin.Include.header')


<div class="page-content seller-page">

    <!-- <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <div class="seller-heading">
                <div class="seller-breadcrumb">
                    <a href="https://maseco.ca/UAT/admin/dashboard">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="current">Seller Management</span>
                </div>

                <h3>Seller Management</h3>
                <p class="seller-subtitle">
                    Manage seller accounts and monitor supplier activity.
                </p>
            </div>
        </div>
    </div> -->

    <div class="page-container p-3">

        @php
            $sellerTotal = $suppliers->count();
            $sellerActive = $suppliers->where('status', '1')->count();
            $sellerInactive = $sellerTotal - $sellerActive;
        @endphp

        <div class="seller-overview">

            <div class="seller-stat">
                <div class="seller-stat-icon">
                    <i class="ri-store-2-line"></i>
                </div>
                <div>
                    <div class="seller-stat-label">Total Sellers</div>
                    <h4 class="seller-stat-value">{{ $sellerTotal }}</h4>
                </div>
            </div>

            <div class="seller-stat">
                <div class="seller-stat-icon">
                    <i class="ri-user-follow-line"></i>
                </div>
                <div>
                    <div class="seller-stat-label">Active Sellers</div>
                    <h4 class="seller-stat-value">{{ $sellerActive }}</h4>
                </div>
            </div>

            <div class="seller-stat">
                <div class="seller-stat-icon">
                    <i class="ri-user-unfollow-line"></i>
                </div>
                <div>
                    <div class="seller-stat-label">Inactive Sellers</div>
                    <h4 class="seller-stat-value">{{ $sellerInactive }}</h4>
                </div>
            </div>

        </div>

        <div class="seller-panel">

            <div class="seller-panel-header">
                <div>
                    <h5>Registered Sellers</h5>
                    <p>Review seller details and manage account status.</p>
                </div>

                <div class="seller-search-wrap">
                    <i class="ri-search-line"></i>
                    <input
                        type="search"
                        class="dt-input seller-search"
                        id="dt-search-0"
                        placeholder="Search sellers..."
                        aria-label="Search sellers"
                        aria-controls="complex-header-datatable"
                    >
                </div>
            </div>

            <div class="seller-table-wrap">
                <table
                    class="table table-custom table-centered table-sm table-hover mb-0 dataTable"
                    id="complex-header-datatable"
                    style="width: 100%;"
                >
                    <thead>
                        <tr>
                            <th>S No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Company Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($suppliers as $supplier)
                            <tr>
                                <td>
                                    <p class="seller-cell-text">{{ $loop->iteration }}</p>
                                </td>

                                <td>
                                    <p class="seller-name">{{ $supplier->name }}</p>
                                </td>

                                <td>
                                    <p class="seller-cell-text">{{ $supplier->email }}</p>
                                </td>

                                <td>
                                    <p class="seller-cell-text">{{ $supplier->phone }}</p>
                                </td>

                                <td>
                                    <p class="seller-cell-text">{{ $supplier->company_name }}</p>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="form-check form-switch mb-0">
                                            <input
                                                class="form-check-input supplier-status-toggle"
                                                type="checkbox"
                                                data-id="{{ $supplier->id }}"
                                                {{ $supplier->status == '1' ? 'checked' : '' }}
                                            >
                                        </div>

                                        <span class="seller-status {{ $supplier->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $supplier->status == '1' ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="actionBtn">
                                        <a
                                            href="javascript:void(0);"
                                            class="dropdown-item viewSupplierBtn"
                                            data-supplier='@json($supplier)'
                                            aria-label="View seller {{ $supplier->name }}"
                                            title="View seller details"
                                        >
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="seller-empty">
                                    No sellers found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>



  <!-- Supplier Details Modal -->

  <div class="modal fade" id="supplierDetailsModal" tabindex="-1" aria-labelledby="supplierDetailsModalLabel" aria-hidden="true">

    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="supplierDetailsModalLabel">Supplier Details</h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <ul class="list-group">

            <li class="list-group-item"><strong>Name:</strong> <span id="modalSupplierName"></span></li>

            <li class="list-group-item"><strong>Email:</strong> <span id="modalSupplierEmail"></span></li>

            <li class="list-group-item"><strong>Phone:</strong> <span id="modalSupplierPhone"></span></li>

            <li class="list-group-item"><strong>Company Name:</strong> <span id="modalSupplierCompany"></span></li>

            <li class="list-group-item"><strong>Status:</strong> <span id="modalSupplierStatus"></span></li>

            <li class="list-group-item"><strong>Created At:</strong> <span id="modalSupplierCreated"></span></li>

          </ul>

        </div>

      </div>

    </div>

  </div>

  <script>
    document.querySelectorAll('.supplier-status-toggle').forEach(function(toggle) {

      toggle.addEventListener('change', function() {

        var supplierId = this.getAttribute('data-id');

        var status = this.checked ? 1 : 0;

        fetch("{{ url('admin/seller/status') }}/" + supplierId, {

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

    // Supplier details modal logic

    document.querySelectorAll('.viewSupplierBtn').forEach(function(btn) {

      btn.addEventListener('click', function() {

        var supplier = JSON.parse(this.getAttribute('data-supplier'));

        document.getElementById('modalSupplierName').textContent = supplier.name || '';

        document.getElementById('modalSupplierEmail').textContent = supplier.email || '';

        document.getElementById('modalSupplierPhone').textContent = supplier.phone || '';

        document.getElementById('modalSupplierCompany').textContent = supplier.company_name || '';

        document.getElementById('modalSupplierStatus').textContent = supplier.status == 1 ? 'Active' : 'Inactive';

        document.getElementById('modalSupplierCreated').textContent = supplier.created_at || '';

        var modal = new bootstrap.Modal(document.getElementById('supplierDetailsModal'));

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