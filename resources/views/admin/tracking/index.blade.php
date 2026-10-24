@include('admin.Include.header')

<div class="page-content">
    <div class="page-container p-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Order Tracking</h2>
                <p class="text-muted mb-0">Review shipment progress and delivery details for customer orders.</p>
            </div>
            <a href="{{ route('admin.orders') }}" class="btn btn-outline-primary">
                <i class="fa-solid fa-box me-2"></i>All Orders
            </a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-xl-3"><div class="card border-0 shadow-sm h-100"><div class="card-body"><div class="text-muted small">Total orders</div><div class="fs-3 fw-bold">{{ $totalOrders }}</div></div></div></div>
            <div class="col-6 col-xl-3"><div class="card border-0 shadow-sm h-100"><div class="card-body"><div class="text-muted small">In delivery</div><div class="fs-3 fw-bold text-primary">{{ $inTransitOrders }}</div></div></div></div>
            <div class="col-6 col-xl-3"><div class="card border-0 shadow-sm h-100"><div class="card-body"><div class="text-muted small">Delivered</div><div class="fs-3 fw-bold text-success">{{ $deliveredOrders }}</div></div></div></div>
            <div class="col-6 col-xl-3"><div class="card border-0 shadow-sm h-100"><div class="card-body"><div class="text-muted small">Tracking not assigned</div><div class="fs-3 fw-bold text-warning">{{ $untrackedOrders }}</div></div></div></div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body border-bottom">
                <form method="GET" action="{{ route('admin.tracking') }}" class="row g-2 align-items-end" data-auto-filter="true">
                    <div class="col-12 col-md-7">
                        <label for="tracking-search" class="form-label">Search</label>
                        <input id="tracking-search" name="search" type="search" class="form-control" value="{{ request('search') }}" placeholder="Order UID, tracking number, buyer name or email">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="tracking-status" class="form-label">Order status</label>
                        <select id="tracking-status" name="status" class="form-select">
                            <option value="">All statuses</option>
                            @foreach(['pending', 'confirmed', 'processing', 'shipped', 'in_transit', 'out_for_delivery', 'delivered', 'cancelled'] as $statusOption)
                                <option value="{{ $statusOption }}" @selected(request('status') === $statusOption)>{{ ucwords(str_replace('_', ' ', $statusOption)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-1 d-grid"><button class="btn btn-primary" type="submit">Filter</button></div>
                    <div class="col-6 col-md-1 d-grid"><a class="btn btn-light border" href="{{ route('admin.tracking') }}">Reset</a></div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Order ID</th><th>Order UID</th><th>Buyer</th><th>Item</th><th>Status</th><th>Tracking number</th><th>Carrier / method</th><th>Estimated delivery</th><th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            @php
                                $status = strtolower((string) ($order->status ?? 'pending'));
                                $badgeClass = match ($status) {
                                    'delivered', 'completed' => 'bg-success',
                                    'shipped', 'in_transit', 'out_for_delivery' => 'bg-primary',
                                    'cancelled', 'canceled', 'failed' => 'bg-danger',
                                    'pending' => 'bg-warning text-dark',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <tr>
                                <td class="ps-3">#{{ $order->id }}</td>
                                <td class="fw-semibold">{{ $order->uid ?? ('ORD' . str_pad((string) $order->id, 4, '0', STR_PAD_LEFT)) }}</td>
                                <td>{{ $order->user?->name ?? 'Guest / unavailable' }}<div class="small text-muted">{{ $order->user?->email ?? '' }}</div></td>
                                <td>{{ $order->material?->name ?? 'Marketplace order' }}</td>
                                <td><span class="badge {{ $badgeClass }}">{{ ucwords(str_replace('_', ' ', $status)) }}</span></td>
                                <td>{{ filled($order->tracking_number ?? null) ? $order->tracking_number : 'Not assigned' }}</td>
                                <td>{{ $order->shipping_method ?: 'Not updated' }}</td>
                                <td>{{ $order->estimated_delivery ? \Illuminate\Support\Carbon::parse($order->estimated_delivery)->format('d M Y') : 'Not available' }}</td>
                                <td>{{ $order->updated_at?->format('d M Y') ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center py-5"><i class="fa-solid fa-truck-fast fs-2 text-muted mb-3"></i><div class="fw-semibold">No orders found</div><div class="text-muted small">Try changing your search or status filter.</div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="card-footer bg-white">{{ $orders->links() }}</div>
            @endif
        </div>
    </div>
</div>

@include('admin.Include.footer')
