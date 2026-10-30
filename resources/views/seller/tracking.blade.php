@include('seller.Include.header')

<div class="wrapper active">
    <div class="page-content mt-3">
        <div class="page-container p-1">
            <div class="container py-3">

                {{-- Page Heading --}}
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">Order Tracking</h2>
                        <p class="text-muted mb-0">
                            Monitor shipments, update tracking details and manage buyer deliveries.
                        </p>
                    </div>

                    <a href="{{ route('seller.dashboard') }}"
                        class="btn btn-outline-success rounded-pill px-4">
                        <i class="fa-solid fa-gauge-high me-2"></i> Dashboard
                    </a>
                </div>

                {{-- Summary Cards --}}
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <span class="rounded-3 bg-primary bg-opacity-10 text-primary p-3">
                                    <i class="fa-solid fa-boxes-stacked fa-xl"></i>
                                </span>
                                <div>
                                    <p class="text-muted small mb-1">Total Orders</p>
                                    <h3 class="fw-bold mb-0">{{ $ordersCount ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <span class="rounded-3 bg-warning bg-opacity-10 text-warning p-3">
                                    <i class="fa-solid fa-truck-fast fa-xl"></i>
                                </span>
                                <div>
                                    <p class="text-muted small mb-1">In Transit</p>
                                    <h3 class="fw-bold mb-0">{{ $inTransitCount ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <span class="rounded-3 bg-success bg-opacity-10 text-success p-3">
                                    <i class="fa-solid fa-circle-check fa-xl"></i>
                                </span>
                                <div>
                                    <p class="text-muted small mb-1">Delivered</p>
                                    <h3 class="fw-bold mb-0">{{ $deliveredCount ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Search and Filter --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-3">
                        <form action="{{ route('seller.tracking') }}" method="GET">
                            <div class="row g-3 align-items-end">
                                <div class="col-12 col-lg-6">
                                    <label for="search" class="form-label fw-semibold">
                                        Search Orders
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fa-solid fa-magnifying-glass text-success"></i>
                                        </span>
                                        <input type="text" id="search" name="search"
                                            class="form-control"
                                            value="{{ request('search') }}"
                                            placeholder="Order UID, buyer or tracking number">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-3">
                                    <label for="status" class="form-label fw-semibold">
                                        Shipment Status
                                    </label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="">All statuses</option>
                                        @foreach(['pending', 'confirmed', 'processing', 'shipped', 'in_transit', 'out_for_delivery', 'delivered', 'cancelled'] as $statusOption)
                                            <option value="{{ $statusOption }}"
                                                @selected(request('status') === $statusOption)>
                                                {{ ucwords(str_replace('_', ' ', $statusOption)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 col-lg-3 d-flex gap-2">
                                    <button type="submit" class="btn btn-success flex-grow-1">
                                        <i class="fa-solid fa-filter me-1"></i> Filter
                                    </button>
                                    <a href="{{ route('seller.tracking') }}"
                                        class="btn btn-outline-secondary">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Orders Table --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 p-4">
                        <h5 class="fw-bold mb-1">Shipment Overview</h5>
                        <p class="text-muted small mb-0">
                            Review your orders and open their tracking details.
                        </p>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive px-2 border-none shadow-none">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Order UID</th>
                                        <th>Buyer</th>
                                        <th>Tracking Number</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Expected Delivery</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders ?? [] as $order)
                                        @php
                                            $orderStatus = strtolower($order->status ?? 'pending');

                                            $badgeClass = match($orderStatus) {
                                                'delivered' => 'bg-success',
                                                'shipped', 'in_transit', 'out_for_delivery' => 'bg-primary',
                                                'cancelled', 'canceled' => 'bg-danger',
                                                'processing', 'confirmed' => 'bg-info text-dark',
                                                default => 'bg-warning text-dark',
                                            };
                                        @endphp

                                        <tr>
                                            <td class="px-4 py-3">#{{ $order->id }}</td>
                                            <td class="py-3">
                                                <span class="fw-bold">
                                                    {{ $order->uid ?? ('ORD' . str_pad((string) $order->id, 4, '0', STR_PAD_LEFT)) }}
                                                </span>
                                            </td>

                                            <td class="py-3">
                                                {{ $order->buyer_name ?? $order->user->name ?? 'Buyer' }}
                                            </td>

                                            <td class="py-3">
                                                @if($order->tracking_number)
                                                    <span class="fw-semibold">
                                                        {{ $order->tracking_number }}
                                                    </span>
                                                @else
                                                    <span class="text-muted small">Not assigned</span>
                                                @endif
                                            </td>

                                            <td class="py-3">
                                                {{ $order->created_at?->format('d M Y') ?? '—' }}
                                            </td>

                                            <td class="py-3">
                                                <span class="badge {{ $badgeClass }} px-3 py-2">
                                                    {{ ucwords(str_replace('_', ' ', $orderStatus)) }}
                                                </span>
                                            </td>

                                            <td class="py-3">
                                                @if($order->estimated_delivery)
                                                    {{ \Illuminate\Support\Carbon::parse($order->estimated_delivery)->format('d M Y') }}
                                                @else
                                                    <span class="text-muted">Not set</span>
                                                @endif
                                            </td>

                                            <td class="px-4 py-3 text-end">
                                                <a href="{{ route('seller.tracking.show', $order->id) }}"
                                                    class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                    <i class="fa-solid fa-location-dot me-1"></i> Track
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <i class="fa-solid fa-box-open fa-2x text-muted mb-3"></i>
                                                <h6 class="fw-bold">No orders found</h6>
                                                <p class="text-muted small mb-0">
                                                    Orders assigned to your seller account will appear here.
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if(isset($orders) && method_exists($orders, 'links'))
                        <div class="card-footer bg-white border-0 p-3">
                            {{ $orders->withQueryString()->links() }}
                        </div>
                    @endif
                </div>

                {{-- Help Card --}}
                <div class="card rounded-4 shadow-sm bg-success bg-opacity-10 border border-success border-opacity-25 mb-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center g-3">
                            <div class="col-auto">
                                <span class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-success text-white">
                                    <i class="fa-solid fa-headset fa-xl"></i>
                                </span>
                            </div>

                            <div class="col">
                                <h5 class="fw-bold mb-1">Need help with a shipment?</h5>
                                <p class="text-muted mb-0">
                                    Contact the Maseco team for assistance with order or delivery issues.
                                </p>
                            </div>

                            <div class="col-12 col-lg-auto">
                                <a href="{{ url('contact-us') }}"
                                    class="btn btn-success rounded-pill px-4">
                                    Contact Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('seller.Include.footer')
