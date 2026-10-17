@include('admin.Include.header')

<!-- Begin page -->


<div class="page-content buyer-page">
    <!-- <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <div class="buyer-heading">
                <div>
                    <div class="buyer-breadcrumb">
                        <a href="https://maseco.ca/UAT/admin/dashboard">Dashboard</a>
                        <span class="mx-2">/</span>
                        <span class="current">Buyer Management</span>
                    </div>
                    <h3>Buyer Management</h3>
                    <p class="buyer-subtitle">
                        Manage buyer accounts and monitor account activity.
                    </p>
                </div>
            </div>
        </div>
    </div> -->

    <div class="page-container p-3">
       @php
    $buyerTotal = $users->count();
    $buyerActive = $users->where('status', '1')->count();
    $buyerInactive = $buyerTotal - $buyerActive;
@endphp

        <div class="buyer-overview">
            <div class="buyer-stat">
                <div class="buyer-stat-icon">
                    <i class="ri-group-line"></i>
                </div>
                <div>
                    <div class="buyer-stat-label">Total Buyers</div>
                    <h4 class="buyer-stat-value">{{ $buyerTotal }}</h4>
                </div>
            </div>

            <div class="buyer-stat">
                <div class="buyer-stat-icon">
                    <i class="ri-user-follow-line"></i>
                </div>
                <div>
                    <div class="buyer-stat-label">Active Buyers</div>
                    <h4 class="buyer-stat-value">{{ $buyerActive }}</h4>
                </div>
            </div>

            <div class="buyer-stat">
                <div class="buyer-stat-icon">
                    <i class="ri-user-unfollow-line"></i>
                </div>
                <div>
                    <div class="buyer-stat-label">Inactive Buyers</div>
                    <h4 class="buyer-stat-value">{{ $buyerInactive }}</h4>
                </div>
            </div>
        </div>

        <div class="buyer-panel">
            <div class="buyer-panel-header">
                <div>
                    <h5>Registered Buyers</h5>
                    <p>View buyer details and manage account status.</p>
                </div>

                <div class="buyer-search-wrap">
                    <i class="ri-search-line"></i>
                    <input
                        type="search"
                        class="dt-input buyer-search"
                        id="dt-search-0"
                        placeholder="Search buyers..."
                        aria-label="Search buyers"
                        aria-controls="complex-header-datatable"
                    >
                </div>
            </div>

            <div class="buyer-table-wrap">
                <table class="table table-custom table-centered table-sm table-hover mb-0 dataTable"
                       id="complex-header-datatable"
                       style="width: 100%;">
                    <thead>
                        <tr>
                            <th>S No.</th>
                            <th>Buyer</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <p class="buyer-cell-text">{{ $loop->iteration }}</p>
                                </td>

                                <td>
                                    <p class="buyer-name">{{ $user->name }}</p>
                                </td>

                                <td>
                                    <p class="buyer-cell-text">{{ $user->email }}</p>
                                </td>

                                <td>
                                    <p class="buyer-cell-text">{{ $user->phone }}</p>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="form-check form-switch mb-0">
                                            <input
                                                class="form-check-input user-status-toggle"
                                                type="checkbox"
                                                data-id="{{ $user->id }}"
                                                {{ $user->status == '1' ? 'checked' : '' }}
                                            >
                                        </div>

                                        <span class="buyer-status {{ $user->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $user->status == '1' ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="actionBtn">
                                        <a href="javascript:void(0);"
                                           class="dropdown-item viewBtn"
                                           data-user='@json($user)'
                                           aria-label="View buyer {{ $user->name }}"
                                           title="View buyer details">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="buyer-empty">
                                    No buyers found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

  <!-- User Details Modal -->

  
<!-- User Details Modal -->
<div class="modal fade maseco-user-modal" id="userDetailsModal" tabindex="-1"
    aria-labelledby="userDetailsModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <div>
                    <span class="user-modal-eyebrow">MASECO ADMIN</span>
                    <h5 class="modal-title" id="userDetailsModalLabel">
                        User Details
                    </h5>
                </div>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <div class="user-modal-profile">
                    <div class="user-modal-avatar">
                        <i class="ri-user-line"></i>
                    </div>

                    <div>
                        <h6 id="modalUserName" class="user-modal-name">—</h6>
                        <span class="user-modal-caption">User Profile</span>
                    </div>
                </div>

                <div class="user-modal-details">

                    <div class="user-detail-item">
                        <div class="user-detail-icon">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div class="user-detail-content">
                            <span>Email Address</span>
                            <strong id="modalUserEmail">—</strong>
                        </div>
                    </div>

                    <div class="user-detail-item">
                        <div class="user-detail-icon">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div class="user-detail-content">
                            <span>Phone Number</span>
                            <strong id="modalUserPhone">—</strong>
                        </div>
                    </div>

                    <div class="user-detail-item">
                        <div class="user-detail-icon">
                            <i class="ri-shield-user-line"></i>
                        </div>
                        <div class="user-detail-content">
                            <span>Account Status</span>
                            <strong id="modalUserStatus">—</strong>
                        </div>
                    </div>

                    <div class="user-detail-item">
                        <div class="user-detail-icon">
                            <i class="ri-calendar-line"></i>
                        </div>
                        <div class="user-detail-content">
                            <span>Registered On</span>
                            <strong id="modalUserCreated">—</strong>
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