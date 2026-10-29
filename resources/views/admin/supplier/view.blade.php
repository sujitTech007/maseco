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


    </div>
</div>



<!-- Supplier Details Modal -->



{{-- Supplier Details Modal - Bootstrap Only --}}
<div class="modal fade" id="supplierDetailsModal" tabindex="-1"
    aria-labelledby="supplierDetailsModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">

            {{-- Header --}}
            <div class="modal-header bg-light border-0 px-4 py-3">
                <div>
                    <h5 class="modal-title fw-bold" id="supplierDetailsModalLabel">
                        <i class="fa-solid fa-store me-2 text-success"></i>
                        Supplier Details
                    </h5>
                    <small class="text-secondary">
                        View registered supplier information
                    </small>
                </div>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body p-4">

                {{-- Supplier Profile --}}
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-circle bg-success bg-opacity-10
                                text-success d-flex align-items-center
                                justify-content-center fw-bold fs-3"
                        style="width:65px;height:65px;">
                        <span id="modalSupplierInitial">S</span>
                    </div>

                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-2" id="modalSupplierName">—</h5>
                        <span id="modalSupplierStatusBadge"
                            class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                            Active
                        </span>
                    </div>
                </div>

                <hr class="text-secondary opacity-25">

                <h6 class="fw-bold mb-3">Supplier Information</h6>

                <div class="row g-3">

                    {{-- Email --}}
                    <div class="col-12">
                        <div class="border rounded-3 p-3">
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-envelope fs-5 text-success mt-1"></i>
                                <div class="flex-grow-1">
                                    <small class="text-secondary d-block mb-1">
                                        Email Address
                                    </small>
                                    <div class="fw-semibold text-break"
                                        id="modalSupplierEmail">—</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="col-12">
                        <div class="border rounded-3 p-3">
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-phone fs-5 text-success mt-1"></i>
                                <div class="flex-grow-1">
                                    <small class="text-secondary d-block mb-1">
                                        Mobile Number
                                    </small>
                                    <div class="fw-semibold"
                                        id="modalSupplierPhone">—</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Company --}}
                    <div class="col-12">
                        <div class="border rounded-3 p-3">
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-building fs-5 text-success mt-1"></i>
                                <div class="flex-grow-1">
                                    <small class="text-secondary d-block mb-1">
                                        Company Name
                                    </small>
                                    <div class="fw-semibold text-break"
                                        id="modalSupplierCompany">—</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Registration Date --}}
                    <div class="col-12">
                        <div class="border rounded-3 p-3">
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-calendar-days fs-5 text-success mt-1"></i>
                                <div class="flex-grow-1">
                                    <small class="text-secondary d-block mb-1">
                                        Registered On
                                    </small>
                                    <div class="fw-semibold"
                                        id="modalSupplierCreated">—</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Footer --}}
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

            document.getElementById('modalSupplierPhone').textContent = [supplier.country_code, supplier.phone].filter(Boolean).join(' ');

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