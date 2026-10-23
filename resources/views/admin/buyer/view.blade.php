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

      
    </div>
</div>

<!-- User Details Modal -->



{{-- Buyer Details Modal - Bootstrap Only --}}
<div class="modal fade" id="userDetailsModal" tabindex="-1"
     aria-labelledby="userDetailsModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">

            {{-- Modal Header --}}
            <div class="modal-header bg-light border-0 px-4 py-3">
                <div>
                    <h5 class="modal-title fw-bold" id="userDetailsModalLabel">
                        <i class="fa-solid fa-user me-2 text-success"></i>
                        Buyer Details
                    </h5>
                    <small class="text-secondary">
                        View registered buyer information
                    </small>
                </div>

                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Modal Body --}}
            <div class="modal-body p-4">

                {{-- Buyer Profile --}}
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-circle bg-success bg-opacity-10
                                text-success d-flex align-items-center
                                justify-content-center fw-bold fs-3"
                         style="width:65px;height:65px;">
                        <span id="modalUserInitial">B</span>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-2" id="modalUserName">—</h5>

                        <span id="modalUserStatusBadge"
                              class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                            Active
                        </span>
                    </div>
                </div>

                <hr class="text-secondary opacity-25">

                {{-- Buyer Information --}}
                <h6 class="fw-bold mb-3">Personal Information</h6>

                <div class="row g-3">

                    {{-- Email --}}
                    <div class="col-12">
                        <div class="border rounded-3 p-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-success">
                                    <i class="fa-solid fa-envelope fs-5"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <small class="text-secondary d-block mb-1">
                                        Email Address
                                    </small>
                                    <div class="fw-semibold text-break"
                                         id="modalUserEmail">—</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Mobile --}}
                    <div class="col-12">
                        <div class="border rounded-3 p-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-success">
                                    <i class="fa-solid fa-phone fs-5"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <small class="text-secondary d-block mb-1">
                                        Mobile Number
                                    </small>
                                    <div class="fw-semibold"
                                         id="modalUserPhone">—</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Registration Date --}}
                    <div class="col-12">
                        <div class="border rounded-3 p-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-success">
                                    <i class="fa-solid fa-calendar-days fs-5"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <small class="text-secondary d-block mb-1">
                                        Registered On
                                    </small>
                                    <div class="fw-semibold"
                                         id="modalUserCreated">—</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            {{-- Modal Footer --}}
            <div class="modal-footer bg-light border-0 px-4">
                <button type="button" class="btn btn-outline-secondary px-4"
                        data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark me-1"></i>
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

            document.getElementById('modalUserPhone').textContent = [user.country_code, user.phone].filter(Boolean).join(' ');

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