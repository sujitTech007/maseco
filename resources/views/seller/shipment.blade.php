@include('seller.Include.header')

<div class="wrapper active">
    <div class="page-content mt-3">
        <div class="page-container p-1">
            <div class="container py-3">

                {{-- Page Heading --}}
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">Shipment Management</h2>
                        <p class="text-muted mb-0">
                            Manage dispatches, shipping details and deliveries for your orders.
                        </p>
                    </div>

                    <a href="{{ route('seller.tracking') }}"
                        class="btn btn-outline-success rounded-pill px-4">
                        <i class="fa-solid fa-location-dot me-2"></i> Track Orders
                    </a>
                </div>

                {{-- Summary Cards --}}
                <div class="row g-3 mb-4">

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <span class="p-3 rounded-3 bg-primary bg-opacity-10 text-primary">
                                    <i class="fa-solid fa-boxes-stacked fa-xl"></i>
                                </span>
                                <div>
                                    <p class="text-muted small mb-1">Total Shipments</p>
                                    <h3 class="fw-bold mb-0">{{ $shipmentsCount ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <span class="p-3 rounded-3 bg-warning bg-opacity-10 text-warning">
                                    <i class="fa-solid fa-clock fa-xl"></i>
                                </span>
                                <div>
                                    <p class="text-muted small mb-1">Pending Dispatch</p>
                                    <h3 class="fw-bold mb-0">{{ $pendingShipmentsCount ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <span class="p-3 rounded-3 bg-info bg-opacity-10 text-info">
                                    <i class="fa-solid fa-truck-fast fa-xl"></i>
                                </span>
                                <div>
                                    <p class="text-muted small mb-1">In Transit</p>
                                    <h3 class="fw-bold mb-0">{{ $inTransitCount ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <span class="p-3 rounded-3 bg-success bg-opacity-10 text-success">
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

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <strong>Please check the following:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Search and Filters --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-3">
                        <form action="{{ route('seller.shipments') }}" method="GET">
                            <div class="row g-3 align-items-end">
                                <div class="col-12 col-lg-6">
                                    <label for="search" class="form-label fw-semibold">
                                        Search Shipments
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fa-solid fa-magnifying-glass text-success"></i>
                                        </span>
                                        <input type="text" name="search" id="search"
                                            class="form-control"
                                            value="{{ request('search') }}"
                                            placeholder="Order ID, buyer or tracking number">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-3">
                                    <label for="status" class="form-label fw-semibold">
                                        Shipment Status
                                    </label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="">All statuses</option>
                                        @foreach([
                                            'pending' => 'Pending Dispatch',
                                            'processing' => 'Processing',
                                            'shipped' => 'Shipped',
                                            'in_transit' => 'In Transit',
                                            'out_for_delivery' => 'Out for Delivery',
                                            'delivered' => 'Delivered',
                                            'cancelled' => 'Cancelled',
                                        ] as $value => $label)
                                            <option value="{{ $value }}"
                                                @selected(request('status') === $value)>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 col-lg-3 d-flex gap-2">
                                    <button type="submit" class="btn btn-success flex-grow-1">
                                        <i class="fa-solid fa-filter me-1"></i> Apply
                                    </button>
                                    <a href="{{ route('seller.shipments') }}"
                                        class="btn btn-outline-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Shipment Table --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 p-4">
                        <h5 class="fw-bold mb-1">All Shipments</h5>
                        <p class="text-muted small mb-0">
                            Review shipment details and update dispatch information.
                        </p>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4 py-3">Order ID</th>
                                        <th class="py-3">Buyer</th>
                                        <th class="py-3">Tracking Number</th>
                                        <th class="py-3">Shipping Method</th>
                                        <th class="py-3">Dispatch Date</th>
                                        <th class="py-3">Estimated Delivery</th>
                                        <th class="py-3">Status</th>
                                        <th class="px-4 py-3 text-end">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($shipments ?? [] as $shipment)
                                        @php
                                            $shipmentStatus = strtolower($shipment->status ?? 'pending');

                                            $statusClass = match($shipmentStatus) {
                                                'delivered' => 'bg-success',
                                                'shipped', 'in_transit', 'out_for_delivery' => 'bg-primary',
                                                'cancelled', 'canceled' => 'bg-danger',
                                                'processing' => 'bg-info text-dark',
                                                default => 'bg-warning text-dark',
                                            };
                                        @endphp

                                        <tr>
                                            <td class="px-4 py-3 fw-bold">
                                                #{{ $shipment->id }}
                                            </td>

                                            <td class="py-3">
                                                {{ $shipment->buyer_name ?? $shipment->user->name ?? 'Buyer' }}
                                            </td>

                                            <td class="py-3">
                                                @if($shipment->tracking_number)
                                                    <span class="fw-semibold">
                                                        {{ $shipment->tracking_number }}
                                                    </span>
                                                @else
                                                    <span class="text-muted small">Not assigned</span>
                                                @endif
                                            </td>

                                            <td class="py-3">
                                                {{ $shipment->shipping_method ?? 'Not specified' }}
                                            </td>

                                            <td class="py-3">
                                                {{ $shipment->shipped_at
                                                    ? \Illuminate\Support\Carbon::parse($shipment->shipped_at)->format('d M Y')
                                                    : '—' }}
                                            </td>

                                            <td class="py-3">
                                                {{ $shipment->estimated_delivery
                                                    ? \Illuminate\Support\Carbon::parse($shipment->estimated_delivery)->format('d M Y')
                                                    : '—' }}
                                            </td>

                                            <td class="py-3">
                                                <span class="badge {{ $statusClass }} px-3 py-2">
                                                    {{ ucwords(str_replace('_', ' ', $shipmentStatus)) }}
                                                </span>
                                            </td>

                                            <td class="px-4 py-3 text-end">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-success rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#shipmentModal{{ $shipment->id }}">
                                                    <i class="fa-solid fa-pen-to-square me-1"></i> Manage
                                                </button>
                                            </td>
                                        </tr>

                                        {{-- Update Shipment Modal --}}
                                        <div class="modal fade"
                                            id="shipmentModal{{ $shipment->id }}"
                                            tabindex="-1"
                                            aria-labelledby="shipmentModalLabel{{ $shipment->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 rounded-4">
                                                    <form
                                                        action="{{ route('seller.shipments.update', $shipment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')

                                                        <div class="modal-header border-0 p-4">
                                                            <div>
                                                                <h5 class="modal-title fw-bold"
                                                                    id="shipmentModalLabel{{ $shipment->id }}">
                                                                    Manage Shipment #{{ $shipment->id }}
                                                                </h5>
                                                                <p class="text-muted small mb-0">
                                                                    Update shipping and delivery information.
                                                                </p>
                                                            </div>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body px-4">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">
                                                                    Tracking Number
                                                                </label>
                                                                <input type="text"
                                                                    name="tracking_number"
                                                                    class="form-control"
                                                                    maxlength="100"
                                                                    value="{{ $shipment->tracking_number }}"
                                                                    placeholder="Enter tracking number">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">
                                                                    Shipping Method
                                                                </label>
                                                                <input type="text"
                                                                    name="shipping_method"
                                                                    class="form-control"
                                                                    maxlength="100"
                                                                    value="{{ $shipment->shipping_method }}"
                                                                    placeholder="e.g. Courier, Freight">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">
                                                                    Shipment Status
                                                                </label>
                                                                <select name="status" class="form-select" required>
                                                                    @foreach([
                                                                        'pending' => 'Pending Dispatch',
                                                                        'processing' => 'Processing',
                                                                        'shipped' => 'Shipped',
                                                                        'in_transit' => 'In Transit',
                                                                        'out_for_delivery' => 'Out for Delivery',
                                                                        'delivered' => 'Delivered',
                                                                        'cancelled' => 'Cancelled',
                                                                    ] as $value => $label)
                                                                        <option value="{{ $value }}"
                                                                            @selected($shipmentStatus === $value)>
                                                                            {{ $label }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">
                                                                    Estimated Delivery
                                                                </label>
                                                                <input type="date"
                                                                    name="estimated_delivery"
                                                                    class="form-control"
                                                                    value="{{ $shipment->estimated_delivery
                                                                        ? \Illuminate\Support\Carbon::parse($shipment->estimated_delivery)->format('Y-m-d')
                                                                        : '' }}">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer border-0 px-4 pb-4">
                                                            <button type="button"
                                                                class="btn btn-light rounded-pill px-4"
                                                                data-bs-dismiss="modal">
                                                                Cancel
                                                            </button>
                                                            <button type="submit"
                                                                class="btn btn-success rounded-pill px-4">
                                                                <i class="fa-solid fa-floppy-disk me-2"></i>
                                                                Save Changes
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <i class="fa-solid fa-truck-fast fa-2x text-muted mb-3"></i>
                                                <h6 class="fw-bold">No shipments found</h6>
                                                <p class="text-muted small mb-0">
                                                    Your orders and shipment records will appear here.
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if(isset($shipments) && method_exists($shipments, 'links'))
                        <div class="card-footer bg-white border-0 p-3">
                            {{ $shipments->withQueryString()->links() }}
                        </div>
                    @endif
                </div>

                {{-- Support Card --}}
                <div class="card rounded-4 shadow-sm bg-success bg-opacity-10 border border-success border-opacity-25 mb-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center g-3">
                            <div class="col-auto">
                                <span class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-success text-white">
                                    <i class="fa-solid fa-headset fa-xl"></i>
                                </span>
                            </div>
                            <div class="col">
                                <h5 class="fw-bold mb-1">Need shipment support?</h5>
                                <p class="text-muted mb-0">
                                    Contact the Maseco team if you need help with shipping or delivery.
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