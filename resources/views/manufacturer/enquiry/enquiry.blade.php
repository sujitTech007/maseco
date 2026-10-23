@include('manufacturer.Include.header')

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

    .ud-table thead {
        background-color: rgb(76 76 92);
    }

    .ud-table th {
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
</style>

@php
    $manu = Auth::guard('manufacturer')->user();

    $enquiries = \App\Models\Enquiry::where('manufacturer_id', $manu->id)->latest()->get();

    // TEMP DEMO DATA: only shows when the list is empty, APP_DEBUG is true and the URL has ?demo=1. Delete before launch.
    $rows = $enquiries;
    if ($rows->isEmpty() && config('app.debug') && request()->boolean('demo')) {
        $rows = collect([
            (object) ['id' => 21, 'user' => (object) ['name' => 'Northwind Apparel'], 'user_id' => 5, 'demo_material' => 'Organic Cotton Fabric', 'quantity' => 500, 'expected_price' => 2500, 'status' => 'pending', 'created_at' => now()->subDays(1)],
            (object) ['id' => 20, 'user' => (object) ['name' => 'Greenleaf Studio'], 'user_id' => 8, 'demo_material' => 'GOTS Linen', 'quantity' => 300, 'expected_price' => 1800, 'status' => 'approved', 'created_at' => now()->subDays(6)],
            (object) ['id' => 19, 'user' => (object) ['name' => 'Maple & Thread'], 'user_id' => 9, 'demo_material' => 'Recycled Polyester Yarn', 'quantity' => 1200, 'expected_price' => 950, 'status' => 'pending', 'created_at' => now()->subDays(18)],
            (object) ['id' => 18, 'user' => (object) ['name' => 'Harbour Active'], 'user_id' => 12, 'demo_material' => 'Hemp Blend Denim', 'quantity' => 50, 'expected_price' => 420, 'status' => 'rejected', 'created_at' => now()->subDays(43)],
        ]);
    }
@endphp

<!-- Begin page -->

<div class="wrapper active">

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="page-content">

        <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
            <h3 class="mb-1">RFQ Management </h3>

            <a href="https://maseco.ca/UAT/manufacturer/dashboard" style="color:#555; text-decoration:none;">
                Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:14px;">
                ▶
            </span>

            <span style="color:#2DAC92;">
                RFQ Management
            </span>

        </div>

        <div class="meetingPpage">

            <div class="row">

                <div class="col-md-12">
                
{{-- RFQ Filters --}}
<div class="card border-0 shadow-sm rounded-4 mb-3">
    <div class="card-body p-3">
        <div class="row g-3 align-items-end">

            {{-- Search RFQs --}}
            <div class="col-lg-4 col-md-6">
                <label for="rfq-search" class="form-label fw-semibold small">
                    Search RFQs
                </label>
                <input
                    type="text"
                    id="rfq-search"
                    class="form-control"
                    placeholder="RFQ ID or product name..."
                    value="{{ request('search') }}"
                >
            </div>

            {{-- RFQ Status --}}
            <div class="col-lg-2 col-md-6">
                <label for="rfq-status" class="form-label fw-semibold small">
                    RFQ Status
                </label>
                <select id="rfq-status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="quoted" {{ request('status') == 'quoted' ? 'selected' : '' }}>Quoted</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            {{-- From Date --}}
            <div class="col-lg-2 col-md-6">
                <label for="rfq-start-date" class="form-label fw-semibold small">
                    From Date
                </label>
                <input
                    type="date"
                    id="rfq-start-date"
                    class="form-control"
                    value="{{ request('start_date') }}"
                >
            </div>

            {{-- To Date --}}
            <div class="col-lg-2 col-md-6">
                <label for="rfq-end-date" class="form-label fw-semibold small">
                    To Date
                </label>
                <input
                    type="date"
                    id="rfq-end-date"
                    class="form-control"
                    value="{{ request('end_date') }}"
                >
            </div>

            {{-- Filter & Reset --}}
            <div class="col-lg-2 col-md-12 d-flex gap-2">
                <button
                    type="button"
                    id="rfq-filter-btn"
                    class="btn btn-success flex-grow-1"
                >
                    <i class="fa-solid fa-filter me-1"></i> Filter
                </button>

                <a
                    href=""
                    class="btn btn-outline-secondary"
                    title="Reset Filters"
                >
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>

        </div>
    </div>
</div>


                    <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden mt-4">

                        <div class="px-3 py-3 border-bottom">
                            <h5 class="fw-bold mb-1">RFQ Management</h5>
                            <p class="text-muted small mb-0">Review buyer requests and approve them to create an order.
                            </p>
                        </div>

                        <div class="ud-scroll">

                            <table class="ud-table" id="rfqTable">

                                <thead>

                                    <tr>

                                        <th>ID</th>

                                        <th>Buyer</th>

                                        <th>Material</th>

                                        <th>Quantity</th>

                                        <th>Expected Price</th>

                                        <th>Date</th>

                                        <th>Status</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($rows as $eq)

                                        @php
                                            $st = [
                                                'approved' => 'success',
                                                'rejected' => 'danger',
                                                'cancelled' => 'danger',
                                            ][strtolower($eq->status)] ?? 'warning';
                                        @endphp

                                        <tr>

                                            <td class="text-muted">{{ $eq->id }}</td>

                                            <td class="fw-semibold">{{ optional($eq->user)->name ?? 'User #' . $eq->user_id }}
                                            </td>

                                            <td>{{ $eq->demo_material ?? optional(\App\Models\Material::find($eq->material_id))->name }}
                                            </td>

                                            <td>{{ $eq->quantity ?? '-' }}</td>

                                            <td class="fw-semibold text-nowrap">
                                                ${{ number_format($eq->expected_price ?? 0, 2) }}</td>

                                            <td class="text-nowrap text-muted">{{ $eq->created_at?->format('d M Y') }}</td>

                                            <td><span
                                                    class="ud-st ud-st-{{ $st }} rounded-pill d-inline-block text-nowrap">{{ ucfirst($eq->status) }}</span>
                                            </td>

                                            <td>

                                                @unless(isset($eq->demo_material))
                                                    <a href="{{ route('chat.show', $eq->id) }}" class="btn btn-sm btn-outline-success px-3 text-nowrap mb-1" data-chat-enquiry="{{ $eq->id }}"><i class="fa-regular fa-comments me-1"></i>Chat <span class="badge bg-danger rounded-pill ms-1" data-chat-unread-count hidden></span></a><small class="d-block text-danger mt-1" data-chat-unread-sender hidden></small>
                                                @endunless

                                                @if($eq->status !== 'approved')

                                                    <button class="btn btn-sm btn-success px-3 text-nowrap"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#approveModal{{ $eq->id }}">Approve & Create
                                                        Order</button>

                                                @else

                                                    <span class="text-success fw-semibold">Approved</span>

                                                @endif

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="8" class="text-center text-muted">
                                                <div>No RFQs found.</div>
                                                <div class="small">Requests from buyers will appear here.</div>
                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                    {{-- Approve modals (kept outside the table so row hover and scrolling don't affect them) --}}
                    @foreach($rows as $eq)

                        @if($eq->status !== 'approved')

                            <!-- Approve Modal -->

                            <div class="modal fade" id="approveModal{{ $eq->id }}" tabindex="-1" aria-hidden="true">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title">Approve RFQ #{{ $eq->id }}</h5>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>

                                        </div>

                                        <form method="POST" action="{{ route('manufacturer.enquiry.approve', $eq->id) }}">

                                            @csrf

                                            <div class="modal-body text-start">

                                                <div class="mb-3">

                                                    <label class="form-label">Quantity</label>

                                                    <input type="number" step="0.01" name="quantity" class="form-control"
                                                        value="{{ $eq->quantity }}" required>

                                                </div>

                                                <div class="mb-3">

                                                    <label class="form-label">Order Amount ($)</label>

                                                    <input type="number" step="0.01" name="amount" class="form-control"
                                                        value="{{ $eq->expected_price ?? 0 }}" required>

                                                </div>

                                                <small class="text-muted">This will approve the enquiry and create an order for
                                                    the buyer.</small>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Cancel</button>

                                                <button type="submit" class="btn btn-success">Confirm & Create</button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endif

                    @endforeach

                    <div
                        class="bg-white shadow-sm rounded-4 p-3 mt-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h6 class="fw-bold mb-1">Need help?</h6>
                            <p class="text-muted small mb-0">Questions about an RFQ or creating an order? Email
                                connect@maseco.ca.</p>
                        </div>
                        <a href="{{ url('contact-us') }}" class="btn btn-outline-success btn-sm px-3">Contact us</a>
                    </div>

                </div>

            </div>

        </div>

    </div> <!-- container -->

    @include('manufacturer.Include.footer')
