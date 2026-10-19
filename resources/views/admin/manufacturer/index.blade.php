@include('admin.Include.header')



<div class="page-content manufacturer-page">
<!-- 
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h3 class="manufacturer-heading">Manufacturer</h3>

            <div class="manufacturer-breadcrumb">
                <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                <span class="separator">›</span>
                <span class="current">Manufacturer</span>
            </div>
        </div>
    </div> -->

    <div class="page-container">

        @php
            $manufacturerTotal = $manufacturers->count();
            $manufacturerActive = $manufacturers->where('status', '1')->count();
            $manufacturerInactive = $manufacturerTotal - $manufacturerActive;
        @endphp

        <div class="manufacturer-summary">

            <div class="summary-card">
                <div class="summary-icon">
                    <i class="ri-building-4-line"></i>
                </div>
                <div>
                    <p class="summary-label">Total Manufacturers</p>
                    <h4 class="summary-number">{{ $manufacturerTotal }}</h4>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon">
                    <i class="ri-checkbox-circle-line"></i>
                </div>
                <div>
                    <p class="summary-label">Active Manufacturers</p>
                    <h4 class="summary-number">{{ $manufacturerActive }}</h4>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon">
                    <i class="ri-user-unfollow-line"></i>
                </div>
                <div>
                    <p class="summary-label">Inactive Manufacturers</p>
                    <h4 class="summary-number">{{ $manufacturerInactive }}</h4>
                </div>
            </div>

        </div>

        <div class="manufacturer-table-card">

            <div class="table-card-header">
                <div>
                    <h4 class="table-card-title">Manufacturer Directory</h4>
                    <p class="table-card-subtitle">
                        View manufacturer details and manage account status.
                    </p>
                </div>

                <div class="manufacturer-search">
                    <i class="ri-search-line"></i>
                    <input
                        type="search"
                        id="manufacturer-search"
                        placeholder="Search manufacturers..."
                        aria-label="Search manufacturers"
                    >
                </div>
            </div>

            <div class="table-responsive">
                <table class="table manufacturer-table table-hover mb-0"
                       id="manufacturer-directory-table"
                       style="width:100%;">

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
                        @forelse($manufacturers as $manufacturer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <h5 class="manufacturer-name">
                                        {{ $manufacturer->name }}
                                    </h5>
                                </td>

                                <td>
                                    <span class="manufacturer-email">
                                        {{ $manufacturer->email }}
                                    </span>
                                </td>

                                <td>{{ $manufacturer->phone }}</td>

                                <td>
                                    <span class="manufacturer-company">
                                        {{ $manufacturer->company_name }}
                                    </span>
                                </td>

                                <td>
                                    <div class="manufacturer-status">
                                        <div class="form-check form-switch">
                                            <input
                                                class="form-check-input manufacturer-status-toggle"
                                                type="checkbox"
                                                data-id="{{ $manufacturer->id }}"
                                                aria-label="Toggle status for {{ $manufacturer->name }}"
                                                {{ $manufacturer->status == '1' ? 'checked' : '' }}
                                            >
                                        </div>

                                        <span class="status-label {{ $manufacturer->status == '1' ? 'active' : 'inactive' }}">
                                            {{ $manufacturer->status == '1' ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="actionBtn">
                                        <a
                                            href="javascript:void(0);"
                                            class="manufacturer-view-btn viewManufacturerBtn"
                                            data-manufacturer='@json($manufacturer)'
                                            title="View manufacturer"
                                            aria-label="View {{ $manufacturer->name }}"
                                        >
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="manufacturer-empty">
                                    No manufacturers found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>


  @include('admin.Include.footer')



  <!-- Manufacturer Details Modal -->

 
<!-- Manufacturer Details Modal -->
<div class="modal fade maseco-user-modal" id="manufacturerDetailsModal"
    tabindex="-1" aria-labelledby="manufacturerDetailsModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <div>
                    <span class="user-modal-eyebrow">MASECO ADMIN</span>
                    <h5 class="modal-title" id="manufacturerDetailsModalLabel">
                        Manufacturer Details
                    </h5>
                </div>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Manufacturer Profile -->
                <div class="user-modal-profile">
                    <div class="user-modal-avatar">
                        <i class="ri-building-2-line"></i>
                    </div>

                    <div>
                        <h6 id="modalManufacturerName" class="user-modal-name">—</h6>
                        <span class="user-modal-caption">Manufacturer Profile</span>
                    </div>
                </div>

                <!-- Manufacturer Information -->
                <div class="user-modal-details">

                    <div class="user-detail-item">
                        <div class="user-detail-icon">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div class="user-detail-content">
                            <span>Email Address</span>
                            <strong id="modalManufacturerEmail">—</strong>
                        </div>
                    </div>

                    <div class="user-detail-item">
                        <div class="user-detail-icon">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div class="user-detail-content">
                            <span>Phone Number</span>
                            <strong id="modalManufacturerPhone">—</strong>
                        </div>
                    </div>

                    <div class="user-detail-item">
                        <div class="user-detail-icon">
                            <i class="ri-building-line"></i>
                        </div>
                        <div class="user-detail-content">
                            <span>Company Name</span>
                            <strong id="modalManufacturerCompany">—</strong>
                        </div>
                    </div>

                    <div class="user-detail-item">
                        <div class="user-detail-icon">
                            <i class="ri-shield-check-line"></i>
                        </div>
                        <div class="user-detail-content">
                            <span>Account Status</span>
                            <strong id="modalManufacturerStatus">—</strong>
                        </div>
                    </div>

                    <div class="user-detail-item">
                        <div class="user-detail-icon">
                            <i class="ri-calendar-line"></i>
                        </div>
                        <div class="user-detail-content">
                            <span>Registered On</span>
                            <strong id="modalManufacturerCreated">—</strong>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="user-modal-close-btn"
                    data-bs-dismiss="modal">
                    Close
                </button>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('manufacturer-search');
        const table = document.getElementById('manufacturer-directory-table');

        if (!searchInput || !table) {
            return;
        }

        // Use simple client-side search without changing existing backend behavior.
        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(function (row) {
                const isEmptyRow = row.querySelector('.manufacturer-empty');

                if (isEmptyRow) {
                    return;
                }

                row.style.display = row.textContent.toLowerCase().includes(searchTerm)
                    ? ''
                    : 'none';
            });
        });
    });
</script>