
{{-- resources/views/manufacturer/shipments.blade.php --}}

@include('manufacturer.Include.header')

@php
    $shipments = $shipments ?? collect();

    $totalShipments = $totalShipments ?? $shipments->count();
    $pendingShipments = $pendingShipments ?? 0;
    $inTransitShipments = $inTransitShipments ?? 0;
    $deliveredShipments = $deliveredShipments ?? 0;
@endphp

<div class="wrapper active">
    <div class="page-content mt-3">
        <div class="page-container p-1">
            <div class="container py-1">

                {{-- Page heading --}}
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">Shipment Management</h2>
                        <p class="text-muted mb-0">
                            Manage your shipments, tracking numbers and delivery status.
                        </p>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('manufacturer.dashboard') }}"
                           class="btn btn-outline-success rounded-pill px-3">
                            <i class="fa-solid fa-arrow-left me-2"></i>Dashboard
                        </a>
                    </div>
                </div>

                {{-- Flash messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Please check the following:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Shipment summary --}}
                <div class="row g-3 mb-4">

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card h-100 border rounded-4 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Total Shipments</span>
                                    <span class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                                        <i class="fa-solid fa-boxes-stacked fa-lg"></i>
                                    </span>
                                </div>
                                <h2 class="fw-bold mb-1">{{ $totalShipments }}</h2>
                                <p class="text-muted small mb-0">All your shipments</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card h-100 border rounded-4 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Pending</span>
                                    <span class="bg-warning bg-opacity-10 text-warning rounded-3 p-2">
                                        <i class="fa-solid fa-clock fa-lg"></i>
                                    </span>
                                </div>
                                <h2 class="fw-bold mb-1">{{ $pendingShipments }}</h2>
                                <p class="text-muted small mb-0">Awaiting dispatch</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card h-100 border rounded-4 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">In Transit</span>
                                    <span class="bg-info bg-opacity-10 text-info rounded-3 p-2">
                                        <i class="fa-solid fa-truck-fast fa-lg"></i>
                                    </span>
                                </div>
                                <h2 class="fw-bold mb-1">{{ $inTransitShipments }}</h2>
                                <p class="text-muted small mb-0">Currently on the way</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card h-100 border rounded-4 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Delivered</span>
                                    <span class="bg-success bg-opacity-10 text-success rounded-3 p-2">
                                        <i class="fa-solid fa-circle-check fa-lg"></i>
                                    </span>
                                </div>
                                <h2 class="fw-bold mb-1">{{ $deliveredShipments }}</h2>
                                <p class="text-muted small mb-0">Successfully delivered</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Shipment table --}}
                <div class="card border rounded-4 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 p-3 p-md-4">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                            <div>
                                <h5 class="fw-bold mb-1">Your Shipments</h5>
                                <p class="text-muted small mb-0">
                                    Review and update shipment information.
                                </p>
                            </div>

                            <form method="GET"
                                  action="{{ route('manufacturer.shipments') }}"
                                  class="row g-2">
                                <div class="col-12 col-md-auto">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">
                                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                                        </span>
                                        <input type="text"
                                               name="search"
                                               value="{{ request('search') }}"
                                               class="form-control"
                                               placeholder="Order or tracking no.">
                                    </div>
                                </div>

                                <div class="col-12 col-md-auto">
                                    <select name="status" class="form-select">
                                        <option value="">All statuses</option>
                                        @foreach([
                                            'pending' => 'Pending',
                                            'processing' => 'Processing',
                                            'shipped' => 'Shipped',
                                            'in_transit' => 'In Transit',
                                            'out_for_delivery' => 'Out for Delivery',
                                            'delivered' => 'Delivered',
                                            'cancelled' => 'Cancelled'
                                        ] as $value => $label)
                                            <option value="{{ $value }}"
                                                @selected(request('status') === $value)>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-auto d-flex gap-2">
                                    <button type="submit" class="btn btn-success">
                                        Search
                                    </button>
                                    <a href="{{ route('manufacturer.shipments') }}"
                                       class="btn btn-outline-secondary">
                                        Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-3 py-3">Order</th>
                                        <th class="py-3">Buyer</th>
                                        <th class="py-3">Tracking Number</th>
                                        <th class="py-3">Shipping Method</th>
                                        <th class="py-3">Estimated Delivery</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3 text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($shipments as $shipment)
                                        @php
                                            $status = strtolower($shipment->status ?? 'pending');

                                            $badgeClass = match($status) {
                                                'delivered' => 'bg-success',
                                                'shipped', 'in_transit', 'out_for_delivery' => 'bg-info text-dark',
                                                'processing' => 'bg-primary',
                                                'cancelled' => 'bg-danger',
                                                default => 'bg-warning text-dark',
                                            };

                                            $buyerName = $shipment->user->name
                                                ?? $shipment->buyer_name
                                                ?? 'Buyer';
                                        @endphp

                                        <tr>
                                            <td class="px-3">
                                                <span class="fw-bold">
                                                    #{{ $shipment->id }}
                                                </span>
                                                <div class="text-muted small">
                                                    {{ optional($shipment->created_at)->format('d M Y') }}
                                                </div>
                                            </td>

                                            <td>
                                                <span class="fw-semibold">{{ $buyerName }}</span>
                                            </td>

                                            <td>
                                                @if($shipment->tracking_number)
                                                    <span class="font-monospace">
                                                        {{ $shipment->tracking_number }}
                                                    </span>
                                                @else
                                                    <span class="text-muted small">Not assigned</span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $shipment->shipping_method ?? 'Not specified' }}
                                            </td>

                                            <td>
                                                @if($shipment->estimated_delivery)
                                                    {{ \Illuminate\Support\Carbon::parse($shipment->estimated_delivery)->format('d M Y') }}
                                                @else
                                                    <span class="text-muted">Not set</span>
                                                @endif
                                            </td>

                                            <td>
                                                <span class="badge {{ $badgeClass }}">
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-success"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#shipmentModal{{ $shipment->id }}">
                                                    <i class="fa-solid fa-pen-to-square me-1"></i>
                                                    Update
                                                </button>
                                            </td>
                                        </tr>

                                        {{-- Update shipment modal --}}
                                        <div class="modal fade"
                                             id="shipmentModal{{ $shipment->id }}"
                                             tabindex="-1"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 rounded-4">
                                                    <form method="POST"
                                                          action="{{ route('manufacturer.shipments.update', $shipment->id) }}">
                                                        @csrf
                                                        @method('PATCH')

                                                        <div class="modal-header">
                                                            <div>
                                                                <h5 class="modal-title fw-bold">
                                                                    Update Shipment
                                                                </h5>
                                                                <p class="text-muted small mb-0">
                                                                    Order #{{ $shipment->id }}
                                                                </p>
                                                            </div>
                                                            <button type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">
                                                                    Tracking Number
                                                                </label>
                                                                <input type="text"
                                                                       name="tracking_number"
                                                                       class="form-control"
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
                                                                       value="{{ $shipment->shipping_method }}"
                                                                       placeholder="e.g. Courier, Freight">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">
                                                                    Shipment Status
                                                                </label>
                                                                <select name="status"
                                                                        class="form-select"
                                                                        required>
                                                                    @foreach([
                                                                        'pending' => 'Pending',
                                                                        'processing' => 'Processing',
                                                                        'shipped' => 'Shipped',
                                                                        'in_transit' => 'In Transit',
                                                                        'out_for_delivery' => 'Out for Delivery',
                                                                        'delivered' => 'Delivered',
                                                                        'cancelled' => 'Cancelled'
                                                                    ] as $value => $label)
                                                                        <option value="{{ $value }}"
                                                                            @selected($status === $value)>
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
                                                                       value="{{ $shipment->estimated_delivery ? \Illuminate\Support\Carbon::parse($shipment->estimated_delivery)->format('Y-m-d') : '' }}">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                    class="btn btn-light"
                                                                    data-bs-dismiss="modal">
                                                                Cancel
                                                            </button>
                                                            <button type="submit"
                                                                    class="btn btn-success">
                                                                <i class="fa-solid fa-check me-1"></i>
                                                                Save Changes
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                                                <h6 class="fw-bold">No shipments found</h6>
                                                <p class="text-muted small mb-0">
                                                    Shipments will appear here when matching orders are available.
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if(method_exists($shipments, 'links'))
                        <div class="card-footer bg-white border-0 p-3">
                            {{ $shipments->withQueryString()->links() }}
                        </div>
                    @endif
                </div>

                {{-- Help card --}}
                <div class="card border border-success border-opacity-25 bg-success bg-opacity-10 rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
                            <div class="bg-success text-white rounded-3 p-3">
                                <i class="fa-solid fa-truck-fast fa-xl"></i>
                            </div>

                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-1">Shipment support</h5>
                                <p class="text-muted mb-0">
                                    Keep tracking details and delivery estimates updated so buyers
                                    can follow their orders.
                                </p>
                            </div>

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

@include('manufacturer.Include.footer')