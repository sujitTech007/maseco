@include('user.Include.header')

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

    .ud-table th {
        /* background: #f8f9fa !important; */
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

    .ud-ico {
        width: 36px;
        height: 36px;
        background: #e6f4ec;
        color: #198754;
    }

    .ud-ico svg {
        width: 18px !important;
        height: 18px !important;
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

    .ud-st-warning {
        background: #fff4d6;
        color: #a06a00;
    }

    .ud-st-danger {
        background: #fde8e8;
        color: #c0392b;
    }

    .ud-st-secondary {
        background: #eceff3;
        color: #5f6b7a;
    }

    thead {
        background-color: rgb(76 76 92);
    }
</style>

@php
// TEMP DEMO DATA: only shows when the list is empty, APP_DEBUG is true and the URL has ?demo=1. Delete before launch.
$rows = $enquiries;
if ($rows->isEmpty() && config('app.debug') && request()->boolean('demo')) {
$rows = collect([
(object) ['id' => 12, 'subject' => 'Organic cotton fabric - bulk order', 'expected_price' => '2500.00', 'quantity' => 500, 'status' => 'pending', 'created_at' => now()->subDays(1)],
(object) ['id' => 11, 'subject' => 'GOTS-certified linen supplier', 'expected_price' => '1800.00', 'quantity' => 300, 'status' => 'approved', 'created_at' => now()->subDays(6)],
(object) ['id' => 10, 'subject' => 'Recycled polyester yarn', 'expected_price' => '950.00', 'quantity' => 1200, 'status' => 'completed', 'created_at' => now()->subDays(18)],
(object) ['id' => 9, 'subject' => 'Cut and sew manufacturer for activewear', 'expected_price' => '6400.00', 'quantity' => 800, 'status' => 'pending', 'created_at' => now()->subDays(27)],
(object) ['id' => 8, 'subject' => 'Hemp blend denim samples', 'expected_price' => '420.00', 'quantity' => 50, 'status' => 'rejected', 'created_at' => now()->subDays(43)],
]);
}
@endphp

<div class="page-content">

    <div class="container py-0">

        <h4 class="mb-1 fs-bold main-heading"> Enquiries</h4>
        <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">

            <a href="{{ route('user.dashboard') }}" style="color:#454545; text-decoration:none;">
                Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:10px;">
                ▶
            </span>

            <span style="color:#2DAC92;">
                Enquiries
            </span>

        </div>

        <p class="text-muted mb-3">Track the requests you have sent to suppliers and manufacturers and follow their
            status.</p>


        <!-- RFQ Header -->



        <!-- RFQ Filter Card -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3">

                <div class="row g-2 align-items-end">

                    <!-- Search -->
                    <div class="col-12 col-md-6 col-xl-3">
                        <label for="rfq-search" class="form-label small fw-semibold">
                            Search RFQs
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fa-solid fa-magnifying-glass text-muted"></i>
                            </span>
                            <input type="search" class="form-control"
                                id="rfq-search"
                                placeholder="Search RFQs...">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-6 col-md-3 col-xl-2">
                        <label for="rfq-status" class="form-label small fw-semibold">
                            RFQ Status
                        </label>
                        <select class="form-select" id="rfq-status">
                            <option value="">All Statuses</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="open">Open</option>
                            <option value="in progress">In Progress</option>
                            <option value="quoted">Quoted</option>
                            <option value="closed">Closed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="col-6 col-md-3 col-xl-2">
                        <label for="rfq-category" class="form-label small fw-semibold">
                            Category
                        </label>
                        <select class="form-select" id="rfq-category">
                            <option value="">All Categories</option>
                            <option value="electronics">Electronics</option>
                            <option value="textiles">Textiles</option>
                            <option value="machinery">Machinery</option>
                            <option value="raw materials">Raw Materials</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- From Date -->
                    <div class="col-6 col-md-4 col-xl-2">
                        <label for="rfq-start-date" class="form-label small fw-semibold">
                            From Date
                        </label>
                        <input type="date" class="form-control" id="rfq-start-date">
                    </div>

                    <!-- To Date -->
                    <div class="col-6 col-md-4 col-xl-2">
                        <label for="rfq-end-date" class="form-label small fw-semibold">
                            To Date
                        </label>
                        <input type="date" class="form-control" id="rfq-end-date">
                    </div>

                    <!-- Buttons: Same Row -->
                    <div class="col-6 col-md-2 col-xl-1">
                        <label class="form-label small fw-semibold invisible">Filter</label>
                        <button type="button"
                            class="btn btn-success w-100 text-nowrap"
                            id="rfq-filter-btn"
                            title="Apply Filters">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                    </div>

                    <div class="col-6 col-md-2 col-xl-12 d-xl-none">
                        <button type="button"
                            class="btn btn-outline-secondary w-100"
                            id="rfq-reset-btn">
                            <i class="fa-solid fa-rotate-left me-1"></i> Reset
                        </button>
                    </div>

                </div>

                <!-- Reset aligned at right on XL -->
                <!-- <div class="d-none d-xl-flex justify-content-end mt-2">
            <button type="button"
                    class="btn btn-outline-secondary btn-sm"
                    id="rfq-reset-btn-desktop">
                <i class="fa-solid fa-rotate-left me-1"></i> Reset
            </button>
        </div> -->

            </div>
        </div>



        <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden">

            <div class="ud-scroll">

                <table class="ud-table">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Subject</th>

                            <th>Expected Price</th>

                            <th>Quantity</th>

                            <th>Status</th>

                            <th>Date</th>

                            <th>Chat</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($rows as $enquiry)

                        @php
                        $st = [
                        'pending' => 'warning',
                        'approved' => 'success',
                        'accepted' => 'success',
                        'completed' => 'success',
                        'rejected' => 'danger',
                        'cancelled' => 'danger',
                        ][strtolower($enquiry->status)] ?? 'secondary';
                        @endphp

                        <tr>

                            <td class="text-muted">{{ $enquiry->id }}</td>

                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span
                                        class="ud-ico rounded-3 d-inline-flex align-items-center justify-content-center flex-shrink-0"
                                        aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <path d="M14 2v6h6" />
                                            <path d="M8 13h8M8 17h5" />
                                        </svg>
                                    </span>
                                    <span class="fw-semibold">{{ $enquiry->subject }}</span>
                                </div>
                            </td>

                            <td class="text-nowrap">{{ $enquiry->expected_price }}</td>

                            <td>{{ $enquiry->quantity }}</td>

                            <td><span
                                    class="ud-st ud-st-{{ $st }} rounded-pill d-inline-block text-nowrap">{{ ucfirst($enquiry->status) }}</span>
                            </td>

                            <td class="text-nowrap text-muted">{{ $enquiry->created_at->format('d M Y') }}</td>

                            <td><a href="{{ route('chat.show', $enquiry->id) }}" class="btn btn-sm btn-outline-success text-nowrap" data-chat-enquiry="{{ $enquiry->id }}"><i class="fa-regular fa-comments me-1"></i>Open chat <span class="badge bg-danger rounded-pill ms-1" data-chat-unread-count hidden></span></a><small class="d-block text-danger mt-1" data-chat-unread-sender hidden></small></td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center text-muted">
                                <div>No enquiries found.</div>
                                <div class="small">Requests you send to suppliers and manufacturers will appear here.
                                </div>
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div
            class="bg-white shadow-sm rounded-4 p-3 mt-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h6 class="fw-bold mb-1">Need help?</h6>
                <p class="text-muted small mb-0">Have a question about an enquiry? Email connect@maseco.ca.</p>
            </div>
            <a href="{{ url('contact-us') }}" class="btn btn-outline-success btn-sm px-3">Contact us</a>
        </div>

    </div>

</div>

@include('user.Include.footer')