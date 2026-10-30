@include('user.Include.header')


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

        <div class="d-flex justify-content-between align-items-center">
            <div>
                 <h1 class="fw-bold mb-1 dashboard_title">Enquiries</h1>
         <p class="text-muted mb-3">Track the requests you have sent to suppliers and manufacturers and follow their
            status.</p>
            </div>            
            <a href="{{ route('listing') }}"
                class="buy-plan-btn">
                Create RFQ <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>

        </div>


       


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



                    
            <div class="table-responsive p-0 border-none ud-table-wrap">

                <table class="table align-middle mb-0 border-none ud-table">

                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Subject</th>
                            <th>Expected Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Chat / Meeting</th>
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

                                <td class="px-3 text-muted">
                                    {{ $enquiry->id }}
                                </td>

                                <td class="px-3">
                                    <div class="d-flex align-items-center gap-2">

                                        <span class="rounded-3 bg-success-subtle text-success d-inline-flex align-items-center justify-content-center flex-shrink-0"
                                            style="width:36px; height:36px;"
                                            aria-hidden="true">
                                            <i class="fa-regular fa-file-lines"></i>
                                        </span>

                                        <span class="fw-semibold">
                                            {{ $enquiry->subject }}
                                        </span>

                                    </div>
                                </td>

                                <td class="px-3 text-nowrap">
                                    {{ $enquiry->expected_price }}
                                </td>

                                <td class="px-3">
                                    {{ $enquiry->quantity }}
                                </td>

                                <td class="px-3">
                                    <span class="badge rounded-pill bg-{{ $st }}-subtle text-{{ $st }} px-3 py-2">
                                        {{ ucfirst($enquiry->status) }}
                                    </span>
                                </td>

                                <td class="px-3 text-nowrap text-muted">
                                    {{ $enquiry->created_at->format('d M Y') }}
                                </td>

                                <td class="px-3">
                                    <div class="d-flex flex-wrap gap-2">

                                        <a href="{{ route('chat.show', $enquiry->id) }}"
                                        class="btn btn-sm btn-outline-success text-nowrap"
                                        data-chat-enquiry="{{ $enquiry->id }}">

                                            <i class="fa-regular fa-comments me-1"></i>
                                            Open chat

                                            <span class="badge bg-danger rounded-pill ms-1"
                                                data-chat-unread-count
                                                hidden></span>

                                        </a>

                                        @if($enquiry instanceof \App\Models\Enquiry)

                                            <a href="{{ route('enquiry.meetings.index', $enquiry->id) }}"
                                            class="btn btn-sm btn-outline-primary text-nowrap">

                                                <i class="fa-regular fa-calendar me-1"></i>
                                                Meeting

                                            </a>

                                        @endif

                                    </div>

                                    <small class="d-block text-danger mt-1"
                                        data-chat-unread-sender
                                        hidden></small>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">

                                    <i class="fa-regular fa-folder-open fs-2 d-block mb-2"></i>

                                    <div class="fw-semibold">
                                        No enquiries found.
                                    </div>

                                    <div class="small">
                                        Requests you send to suppliers and manufacturers will appear here.
                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

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
  