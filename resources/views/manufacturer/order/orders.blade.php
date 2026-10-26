@include('manufacturer.Include.header')

<style>
    .ud-scroll { overflow-x: auto; }

    .ud-table { width: 100%; border-collapse: collapse; margin: 0; border: 0 !important; background: transparent; }

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

    .ud-table thead { background-color: rgb(76 76 92); }
    .ud-table th { color: #fff; font-weight: 700; font-size: .85rem; }
    .ud-table tbody tr:last-child td { border-bottom: 0 !important; }
    .ud-table tbody tr:hover td { background: #f3faf8 !important; }
    .ud-table td.text-center { text-align: center !important; }

    .ud-st { font-size: .8rem; font-weight: 600; padding: .3rem .7rem; }
    .ud-st::before { content: ""; width: 6px; height: 6px; border-radius: 50%; background: currentColor; margin-right: .4rem; display: inline-block; vertical-align: middle; }
    .ud-st-success { background: #e6f4ec; color: #198754; }
    .ud-st-warning { background: #fff4d6; color: #a06a00; }
</style>

@php
  $manufacturer = Auth::guard('manufacturer')->user();

  $orders = \App\Models\Order::where('manufacturer_id', $manufacturer->id)->latest()->get();

  // TEMP DEMO DATA: only shows when the list is empty, APP_DEBUG is true and the URL has ?demo=1. Delete before launch.
  $rows = $orders;
  if ($rows->isEmpty() && config('app.debug') && request()->boolean('demo')) {
    $rows = collect([
      (object) ['id' => 1048, 'user' => (object) ['name' => 'Northwind Apparel'], 'user_id' => 5, 'demo_material' => 'Organic Cotton Fabric', 'quantity' => 500, 'amount' => 2500, 'payment_status' => 'pending', 'status' => 'processing', 'created_at' => now()->subDays(1)],
      (object) ['id' => 1047, 'user' => (object) ['name' => 'Greenleaf Studio'], 'user_id' => 8, 'demo_material' => 'GOTS Linen', 'quantity' => 300, 'amount' => 1800, 'payment_status' => 'paid', 'status' => 'completed', 'created_at' => now()->subDays(6)],
      (object) ['id' => 1046, 'user' => (object) ['name' => 'Maple & Thread'], 'user_id' => 9, 'demo_material' => 'Recycled Polyester Yarn', 'quantity' => 1200, 'amount' => 950, 'payment_status' => 'paid', 'status' => 'completed', 'created_at' => now()->subDays(18)],
      (object) ['id' => 1045, 'user' => (object) ['name' => 'Harbour Active'], 'user_id' => 12, 'demo_material' => 'Hemp Blend Denim', 'quantity' => 50, 'amount' => 420, 'payment_status' => 'pending', 'status' => 'pending', 'created_at' => now()->subDays(43)],
    ]);
  }
@endphp

<div class="page-content">

    <div class="page-title-head d-flex align-items-center gap-2">

        <div class="flex-grow-1">

            <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
                <h3 class="mb-1">Orders </h3>

                <a href="https://maseco.ca/UAT/manufacturer/dashboard" style="color:#555; text-decoration:none;">
                    Dashboard
                </a>

                <span style="padding:0 6px; color:#999; font-size:14px;">
                    ▶
                </span>

                <span style="color:#2DAC92;">
                    Orders
                </span>

            </div>
        </div>

    </div>

    <div class="page-container p-3">
        
{{-- Order Filters --}}
<div class="card border-0 shadow-sm rounded-4 mb-3">
    <div class="card-body p-3">
        <div class="row g-3 align-items-end">

            {{-- Search Orders --}}
            <div class="col-lg-3 col-md-6">
                <label for="order-search" class="form-label fw-semibold small">
                    Search Orders
                </label>
                <input
                    type="text"
                    id="order-search"
                    class="form-control"
                    placeholder="Order UID or product name..."
                    value="{{ request('search') }}"
                >
            </div>

            {{-- Order Status --}}
            <div class="col-lg-2 col-md-6">
                <label for="order-status" class="form-label fw-semibold small">
                    Order Status
                </label>
                <select id="order-status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            {{-- Payment Status --}}
            <div class="col-lg-2 col-md-6">
                <label for="payment-status" class="form-label fw-semibold small">
                    Payment Status
                </label>
                <select id="payment-status" class="form-select">
                    <option value="">All Payments</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>

            {{-- From Date --}}
            <div class="col-lg-2 col-md-6">
                <label for="order-start-date" class="form-label fw-semibold small">
                    From Date
                </label>
                <input
                    type="date"
                    id="order-start-date"
                    class="form-control"
                    value="{{ request('start_date') }}"
                >
            </div>

            {{-- To Date --}}
            <div class="col-lg-2 col-md-6">
                <label for="order-end-date" class="form-label fw-semibold small">
                    To Date
                </label>
                <input
                    type="date"
                    id="order-end-date"
                    class="form-control"
                    value="{{ request('end_date') }}"
                >
            </div>

            {{-- Filter & Reset --}}
            <div class="col-lg-1 col-md-12 d-flex gap-2">
                <button
                    type="button"
                    id="order-filter-btn"
                    class="btn btn-success"
                    title="Filter Orders"
                >
                    <i class="fa-solid fa-filter"></i>
                </button>

                <!-- <a
                    href="{{ route('manufacturer.orders') }}"
                    class="btn btn-outline-secondary"
                    title="Reset Filters"
                >
                    <i class="fa-solid fa-rotate-left"></i>
                </a> -->
            </div>

        </div>
    </div>
</div>



        <div class="meetingPpage">

            <div class="row">

                <div class="col-md-12">

                    <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden">

                        <div class="px-3 py-3 border-bottom">
                            <h5 class="header-title fw-bold mb-1">Orders</h5>
                            <p class="text-muted small mb-0">Orders placed with you and their payment status.</p>
                        </div>

                        <div class="ud-scroll">

                            <table class="ud-table">

                                <thead>

                                    <tr>

                                        <th>Order UID</th>
                                        <th>Order ID</th>

                                        <th>Buyer</th>

                                        <th>Material</th>

                                        <th>Quantity</th>

                                        <th>Amount</th>

                                        <th>Date</th>

                                        <th>Status</th>
                                        <th>Files &amp; Samples</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($rows as $o)

                                      <tr>

                                          <td class="text-muted">{{ $o->uid ?? ('ORD' . str_pad((string) $o->id, 4, '0', STR_PAD_LEFT)) }}</td>
                                          <td class="text-muted">#{{ $o->id }}</td>

                                          <td class="fw-semibold">{{ optional($o->user)->name ?? 'User #' . $o->user_id }}</td>

                                          <td>{{ $o->demo_material ?? optional(\App\Models\Material::find($o->material_id))->name }}</td>

                                          <td>{{ $o->quantity ?? '-' }}</td>

                                          <td class="text-nowrap">

                                              <span class="fw-semibold">${{ number_format($o->amount ?? 0, 2) }}</span>

                                              <div class="text-muted small">Payment: {{ ucfirst($o->payment_status ?? 'pending') }}</div>

                                          </td>

                                          <td class="text-nowrap text-muted">{{ $o->created_at?->format('d M Y') }}</td>

                                          <td><span class="ud-st ud-st-{{ ($o->payment_status ?? 'pending') === 'paid' ? 'success' : 'warning' }} rounded-pill d-inline-block text-nowrap">{{ ucfirst($o->status) }}</span></td>
                                          <td><a class="btn btn-sm btn-outline-primary" href="{{ route('manufacturer.orders.sharing',$o->id) }}">Open sharing</a></td>

                                      </tr>

                                    @empty
                                      @if($sampleOrders->isEmpty())
                                      <tr>

                                          <td colspan="9" class="text-center text-muted">
                                              <div>No orders found.</div>
                                              <div class="small">Orders created from approved RFQs will appear here.</div>
                                          </td>

                                      </tr>
                                      @endif

                                    @endforelse

                                    @foreach($sampleOrders as $sampleOrder)
                                      <tr class="table-light">
                                          <td class="text-muted">{{ $sampleOrder->reference }}</td>
                                          <td><span class="badge bg-success-subtle text-success">Sample</span></td>
                                          <td class="fw-semibold">{{ $sampleOrder->buyer->name ?? 'Buyer #'.$sampleOrder->buyer_id }}</td>
                                          <td>{{ $sampleOrder->sample->name ?? 'Sample' }}<div class="small text-muted">{{ $sampleOrder->material->name ?? '' }}</div></td>
                                          <td>{{ $sampleOrder->quantity }}</td>
                                          <td class="text-nowrap"><span class="fw-semibold">{{ number_format($sampleOrder->total_amount,2) }}</span><div class="text-muted small">Payment: {{ ucfirst($sampleOrder->payment_status) }}</div></td>
                                          <td class="text-nowrap text-muted">{{ $sampleOrder->created_at?->format('d M Y') }}</td>
                                          <td>{{ ucfirst(str_replace('_',' ',$sampleOrder->order_status)) }}</td>
                                          <td><div class="d-flex flex-wrap gap-1"><a class="btn btn-sm btn-outline-primary" href="{{ route('manufacturer.samples.purchase.show',$sampleOrder) }}">Details</a>@if($sampleOrder->order_status==='awaiting_approval')<form method="POST" action="{{ route('manufacturer.samples.decision',$sampleOrder) }}">@csrf<input type="hidden" name="decision" value="approve"><button class="btn btn-sm btn-success">Approve</button></form><form method="POST" action="{{ route('manufacturer.samples.decision',$sampleOrder) }}">@csrf<input type="hidden" name="decision" value="reject"><button class="btn btn-sm btn-outline-danger">Reject</button></form>@endif</div></td>
                                      </tr>
                                    @endforeach

                                </tbody>

                            </table>

                            <div class="mt-3">{{ $sampleOrders->links() }}</div>

                            <!-- end table -->

                        </div>

                    </div>

                    <div
                        class="bg-white shadow-sm rounded-4 p-3 mt-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h6 class="fw-bold mb-1">Need help?</h6>
                            <p class="text-muted small mb-0">Questions about an order or a payment? Email connect@maseco.ca.</p>
                        </div>
                        <a href="{{ url('contact-us') }}" class="btn btn-outline-success btn-sm px-3">Contact us</a>
                    </div>

                </div>

            </div>

        </div>

    </div> <!-- container -->

    @include('manufacturer.Include.footer')

    <script>
        new DataTable('#payment-datatable');
    </script>
