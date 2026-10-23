@include('admin.Include.header')


<div class="page-content orders-page">

    <!-- Page Header -->
 
    
    <div class="page-container p-3">

        @php
            $allOrders = collect($orders ?? []);

            $totalOrders = $allOrders->count();

            $pendingOrders = $allOrders->filter(function ($order) {
                return strtolower((string) ($order->status ?? '')) === 'pending';
            })->count();

            $completedOrders = $allOrders->filter(function ($order) {
                return strtolower((string) ($order->status ?? '')) === 'completed';
            })->count();
        @endphp

       

        <!-- Summary -->
        <div class="orders-summary">

            <div class="orders-summary-card bg-danger bg-opacity-10">
                <div class="orders-summary-icon bg-danger bg-opacity-10">
                    <i class="fa-solid fa-bag-shopping text-danger"></i>
                </div>
                <div>
                    <p class="orders-summary-label">Total Orders</p>
                    <h4 class="orders-summary-number">{{ $totalOrders }}</h4>
                </div>
            </div>

            <div class="orders-summary-card bg-warning bg-opacity-10">
                <div class="orders-summary-icon pending bg-warning bg-opacity-10">
                    <i class="fa-solid fa-clock text-warning"></i>
                </div>
                <div>
                    <p class="orders-summary-label">Pending Orders</p>
                    <h4 class="orders-summary-number">{{ $pendingOrders }}</h4>
                </div>
            </div>

            <div class="orders-summary-card bg-success bg-opacity-10">
                <div class="orders-summary-icon completed bg-success bg-opacity-10">
                    <i class="fa-solid fa-circle-check text-success"></i>
                </div>
                <div>
                    <p class="orders-summary-label">Completed Orders</p>
                    <h4 class="orders-summary-number">{{ $completedOrders }}</h4>
                </div>
            </div>

        </div>

                  <!-- Order Management Header & Filters -->
<div class="orders-table-header d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3 mb-4 card">

   

    <div class="row g-3 align-items-center flex-grow-1 ms-xl-3">

        <!-- Search Orders -->
        <div class="col-12 col-md-6 col-xl-3">
            <input
                type="search"
                class="form-control"
                id="orders-search-input"
                placeholder="Search orders..."
                aria-label="Search orders"
            >
        </div>

        <!-- Order Status -->
        <div class="col-12 col-md-6 col-xl-2">
            <select class="form-select" id="orders-status-filter" aria-label="Filter by order status">
                <option value="">All Order Statuses</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <!-- Payment Status -->
        <div class="col-12 col-md-6 col-xl-2">
            <select class="form-select" id="orders-payment-filter" aria-label="Filter by payment status">
                <option value="">All Payment Statuses</option>
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
                <option value="failed">Failed</option>
                <option value="refunded">Refunded</option>
            </select>
        </div>

        <!-- Start Date -->
        <div class="col-12 col-md-6 col-xl-2">
            <input
                type="date"
                class="form-control"
                id="orders-start-date"
                aria-label="Start date"
            >
        </div>

        <!-- End Date -->
        <div class="col-12 col-md-6 col-xl-2">
            <input
                type="date"
                class="form-control"
                id="orders-end-date"
                aria-label="End date"
            >
        </div>

        <!-- Filter Button -->
        <div class="col-12 col-md-6 col-xl-1">
            <button
                type="button"
                class="btn btn-outline-success w-100"
                id="orders-filter-btn"
            >
                Filter
            </button>
        </div>

    </div>
</div>
        <!-- Orders Table -->
        <div class="orders-table-card">

 

            <div class="table-responsive">
                <table class="table orders-table table-hover mb-0"
                       id="orders-directory-table">

                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($allOrders as $o)
                            @php
                                $orderStatus = strtolower((string) ($o->status ?? 'pending'));
                                $paymentStatus = strtolower((string) ($o->payment_status ?? 'pending'));

                                $orderStatusClass = match ($orderStatus) {
                                    'completed', 'delivered' => 'success',
                                    'pending', 'processing' => 'warning',
                                    'cancelled', 'failed', 'rejected' => 'danger',
                                    'shipped', 'dispatched' => 'info',
                                    default => 'neutral',
                                };

                                $paymentStatusClass = match ($paymentStatus) {
                                    'paid', 'completed', 'success' => 'success',
                                    'pending', 'unpaid' => 'warning',
                                    'failed', 'refunded' => 'danger',
                                    default => 'neutral',
                                };
                            @endphp

                            <tr>
                                <td>
                                    <span class="order-id">#{{ $o->id }}</span>
                                </td>

                                <td>
                                    <span class="order-user">
                                        {{ optional($o->user)->name ?? 'User #'.$o->user_id }}
                                    </span>
                                </td>

                                <td>
                                    <span class="order-material">
                                        {{ optional(\App\Models\Material::find($o->material_id))->name ?? '—' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="order-quantity">
                                        {{ $o->quantity ?? '—' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="order-amount">
                                        ${{ number_format($o->amount ?? 0, 2) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="order-badge {{ $orderStatusClass }}">
                                        {{ ucfirst($orderStatus) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="order-badge {{ $paymentStatusClass }}">
                                        {{ ucfirst($paymentStatus) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="order-date">
                                        {{ $o->created_at?->format('d M Y') ?? '—' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="orders-empty">
                                    <i class="fa-solid fa-inbox"></i>
                                    <strong>No orders found</strong>
                                    There are currently no orders to display.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>


  @include('admin.Include.footer')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('orders-search-input');
        const ordersTable = document.getElementById('orders-directory-table');

        if (!searchInput || !ordersTable) {
            return;
        }

        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase().trim();

            ordersTable.querySelectorAll('tbody tr').forEach(function (row) {
                if (row.querySelector('.orders-empty')) {
                    return;
                }

                row.style.display = row.textContent.toLowerCase().includes(searchTerm)
                    ? ''
                    : 'none';
            });
        });
    });
</script>
  <script>
    new DataTable('#payment-datatable');
  </script>