 @include('user.Include.header')

 <div class="page-content">
     <div class="container py-4">

         {{-- Page Heading --}}
         <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
             <div>
                 <h2 class="fw-bold mb-1">Order Tracking</h2>
                 <p class="text-muted mb-0">
                     Track your material orders and check their latest delivery status.
                 </p>
             </div>

             <a href="{{ route('user.orders') }}"
                 class="btn btn-outline-success rounded-pill px-4">
                 <i class="fa-solid fa-box me-2"></i> My Orders
             </a>
         </div>

         {{-- Search Tracking --}}
         <!-- <div class="card border-0 shadow-sm rounded-4 mb-4">
             <div class="card-body p-4">
                 <h5 class="fw-bold mb-3">Track Your Shipment</h5>

                 <form action="{{ route('user.tracking') }}" method="GET">
                     <div class="row g-3 align-items-end">
                         <div class="col-12 col-md-9">
                             <label for="tracking_number" class="form-label fw-semibold">
                                 Order UID or Tracking Number
                             </label>
                             <div class="input-group">
                                 <span class="input-group-text bg-light">
                                     <i class="fa-solid fa-magnifying-glass text-success"></i>
                                 </span>
                                 <input type="text"
                                     name="tracking_number"
                                     id="tracking_number"
                                     class="form-control"
                                     placeholder="Enter your order UID or tracking number"
                                     value="{{ request('tracking_number', request('order_id')) }}"
                                     required>
                             </div>
                         </div>

                         <div class="col-12 col-md-3 d-grid">
                             <button type="submit" class="btn btn-success">
                                 Track Order
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </div> -->

         @if($orders->isNotEmpty())
         <!-- <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 p-4 pb-2">
                    <h5 class="fw-bold mb-1">Your Orders</h5>
                    <p class="text-muted small mb-0">Select an order to view its latest tracking status.</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Order ID</th>
                                <th>Order UID</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Tracking number</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $listedOrder)
                                <tr>
                                    <td class="ps-4">#{{ $listedOrder->id }}</td>
                                    <td class="fw-semibold">{{ $listedOrder->uid ?? ('ORD' . str_pad((string) $listedOrder->id, 4, '0', STR_PAD_LEFT)) }}</td>
                                    <td>{{ $listedOrder->material?->name ?? 'Marketplace order' }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ ucwords(str_replace('_', ' ', $listedOrder->status ?? 'pending')) }}</span></td>
                                    <td>{{ $listedOrder->tracking_number ?: 'Not assigned yet' }}</td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('user.tracking', ['tracking_number' => $listedOrder->uid ?? $listedOrder->id]) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            <i class="fa-solid fa-truck-fast me-1"></i> Track
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> -->
         @endif

         {{-- Tracking Result --}}
         @if(isset($order) && $order)

         @php
         $status = strtolower($order->status ?? 'pending');

         $trackingSteps = [
         'pending' => [
         'label' => 'Order Placed',
         'description' => 'Your order has been received.',
         ],
         'confirmed' => [
         'label' => 'Order Confirmed',
         'description' => 'The order has been confirmed by the supplier.',
         ],
         'processing' => [
         'label' => 'Processing',
         'description' => 'Your order is being prepared.',
         ],
         'shipped' => [
         'label' => 'Shipped',
         'description' => 'Your order has been dispatched.',
         ],
         'in_transit' => [
         'label' => 'In Transit',
         'description' => 'Your shipment is on its way.',
         ],
         'out_for_delivery' => [
         'label' => 'Out for Delivery',
         'description' => 'Your shipment is out for delivery.',
         ],
         'delivered' => [
         'label' => 'Delivered',
         'description' => 'Your order has been delivered.',
         ],
         ];

         $stepOrder = [
         'pending',
         'confirmed',
         'processing',
         'shipped',
         'in_transit',
         'out_for_delivery',
         'delivered',
         ];

         $currentStep = array_search($status, $stepOrder);
         $currentStep = $currentStep === false ? 0 : $currentStep;

         $isCancelled = in_array($status, ['cancelled', 'canceled']);
         @endphp

         {{-- Order Summary --}}
         <div class="card border-0 shadow-sm rounded-4 mb-4">
             <div class="card-body p-4">
                 <div class="row g-4 align-items-center">

                     <div class="col-12 col-lg">
                         <div class="d-flex align-items-center gap-3 mb-3">
                             <span class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                                 <i class="fa-solid fa-box-open fa-2x"></i>
                             </span>
                             <div>
                                 <p class="text-muted small mb-1">Order Reference</p>
                                 <h4 class="fw-bold mb-0">
                                     {{ $order->uid ?? ('ORD' . str_pad((string) $order->id, 4, '0', STR_PAD_LEFT)) }}
                                 </h4>
                             </div>
                         </div>

                         <p class="mb-2">
                             <span class="text-muted">Order ID:</span>
                             <span class="fw-semibold">#{{ $order->id }}</span>
                         </p>

                         <p class="mb-2">
                             <span class="text-muted">Tracking Number:</span>
                             <span class="fw-semibold">
                                 {{ $order->tracking_number ?? 'Not assigned yet' }}
                             </span>
                         </p>

                         <p class="mb-0">
                             <span class="text-muted">Order Date:</span>
                             <span class="fw-semibold">
                                 {{ $order->created_at?->format('d M Y') ?? 'N/A' }}
                             </span>
                         </p>
                     </div>

                     <div class="col-12 col-lg-auto">
                         <p class="text-muted small mb-2">Current Status</p>

                         @if($isCancelled)
                         <span class="badge bg-danger fs-6 px-3 py-2">
                             {{ ucfirst($status) }}
                         </span>
                         @elseif($status === 'delivered')
                         <span class="badge bg-success fs-6 px-3 py-2">
                             Delivered
                         </span>
                         @else
                         <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                             {{ ucwords(str_replace('_', ' ', $status)) }}
                         </span>
                         @endif
                     </div>

                 </div>
             </div>
         </div>

         {{-- Progress Timeline --}}
         <div class="card border-0 shadow-sm rounded-4 mb-4">
             <div class="card-body p-4 p-md-5">
                 <h5 class="fw-bold mb-4">Shipment Progress</h5>

                 @if($isCancelled)
                 <div class="alert alert-danger mb-0">
                     <i class="fa-solid fa-circle-exclamation me-2"></i>
                     This order has been cancelled. Please contact the supplier if you need assistance.
                 </div>
                 @else
                 <div class="list-group list-group-flush">

                     @foreach($stepOrder as $index => $step)
                     @php
                     $completed = $index <= $currentStep;
                         $stepInfo=$trackingSteps[$step];
                         @endphp

                         <div class="list-group-item border-0 px-0">
                         <div class="d-flex gap-3">

                             <div class="d-flex flex-column align-items-center">
                                 <span class="rounded-circle d-flex align-items-center justify-content-center
                                                {{ $completed ? 'bg-success text-white' : 'bg-light text-secondary border' }}"
                                     style="width: 42px; height: 42px; min-width: 42px;">
                                     @if($completed)
                                     <i class="fa-solid fa-check"></i>
                                     @else
                                     <i class="fa-solid fa-circle-dot"></i>
                                     @endif
                                 </span>

                                 @if(!$loop->last)
                                 <div class="{{ $index < $currentStep ? 'bg-success' : 'bg-light border-start' }}"
                                     style="width: 2px; min-height: 35px;"></div>
                                 @endif
                             </div>

                             <div class="pb-3">
                                 <h6 class="fw-bold mb-1 {{ $completed ? 'text-success' : 'text-muted' }}">
                                     {{ $stepInfo['label'] }}
                                 </h6>
                                 <p class="text-muted small mb-0">
                                     {{ $stepInfo['description'] }}
                                 </p>

                                 @if($index === $currentStep)
                                 <span class="badge bg-success bg-opacity-10 text-success mt-2">
                                     Current Status
                                 </span>
                                 @endif
                             </div>

                         </div>
                 </div>
                 @endforeach

             </div>
             @endif
         </div>
     </div>

     {{-- Shipment Details --}}
     <div class="row g-4 mb-4">

         <div class="col-12 col-lg-6">
             <div class="card border-0 shadow-sm rounded-4 h-100">
                 <div class="card-body p-4">
                     <h5 class="fw-bold mb-3">
                         <i class="fa-solid fa-truck text-success me-2"></i>
                         Shipment Details
                     </h5>

                     @php $shipper = $order->supplier ?: $order->manufacturer; @endphp
                     <div class="d-flex justify-content-between gap-3 py-2 border-bottom">
                         <span class="text-muted">{{ $order->supplier ? 'Supplier' : 'Manufacturer' }}</span>
                         <span class="fw-semibold text-end">
                             {{ $shipper?->company_name ?: ($shipper?->business_name ?: ($shipper?->name ?? 'To be updated')) }}
                         </span>
                     </div>

                     <div class="d-flex justify-content-between gap-3 py-2 border-bottom">
                         <span class="text-muted">Tracking Number</span>
                         <span class="fw-semibold text-end">
                             {{ $order->tracking_number ?? 'Pending' }}
                         </span>
                     </div>

                     <div class="d-flex justify-content-between gap-3 py-2 border-bottom">
                         <span class="text-muted">Shipping Method</span>
                         <span class="fw-semibold text-end">
                             {{ $order->shipping_method ?? 'Not updated' }}
                         </span>
                     </div>

                     <div class="d-flex justify-content-between gap-3 py-2">
                         <span class="text-muted">Estimated Delivery</span>
                         <span class="fw-semibold text-end">
                             {{ $order->estimated_delivery
                                        ? \Illuminate\Support\Carbon::parse($order->estimated_delivery)->format('d M Y')
                                        : 'Not available' }}
                         </span>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-12 col-lg-6">
             <div class="card border-0 shadow-sm rounded-4 h-100">
                 <div class="card-body p-4">
                     <h5 class="fw-bold mb-3">
                         <i class="fa-solid fa-location-dot text-success me-2"></i>
                         Delivery Information
                     </h5>

                     <p class="text-muted small mb-1">Delivery Address</p>
                     <p class="fw-semibold mb-3">
                         {{ $order->shipping_address ?? 'Delivery address not available' }}
                     </p>

                     <hr>

                     <p class="text-muted small mb-1">Need help with this shipment?</p>
                     <p class="mb-3">
                         Contact our team for assistance with your order.
                     </p>

                     <a href="{{ url('contact-us') }}"
                         class="btn btn-outline-success rounded-pill px-4">
                         <i class="fa-solid fa-headset me-2"></i> Contact Support
                     </a>
                 </div>
             </div>
         </div>

     </div>

     @elseif(request()->filled('tracking_number') || request()->filled('order_id'))
     <div class="alert alert-warning rounded-4">
         <i class="fa-solid fa-circle-exclamation me-2"></i>
         No order was found for that order UID or tracking number. Please check the value and try again.
     </div>

     @else

     {{-- Empty State --}}
     <div class="card border-0 shadow-sm rounded-4">
         <div class="card-body text-center py-5 px-3">
             <span class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-3"
                 style="width: 90px; height: 90px;">
                 <i class="fa-solid fa-truck-fast fa-2x"></i>
             </span>

             <h4 class="fw-bold">Ready to track your order?</h4>
             <p class="text-muted mx-auto mb-4" style="max-width: 500px;">
                 Enter your order UID or tracking number above to view the latest shipment status and delivery details.
             </p>

             <a href="{{ route('user.orders') }}"
                 class="btn btn-success rounded-pill px-4">
                 <i class="fa-solid fa-box me-2"></i> View My Orders
             </a>
         </div>
     </div>

     @endif

 </div>
 </div>

 @include('user.Include.footer')