@include('admin.Include.header')


<div class="page-content orders-page">

    <!-- Page Header -->
    <div class="page-title-head d-flex align-items-center gap-2">
        <!-- <div class="flex-grow-1">
            <h3 class="orders-heading">Orders</h3>

            <div class="orders-breadcrumb">
                <a href="https://maseco.ca/UAT/admin/dashboard">Dashboard</a>
                <span class="separator">›</span>
                <span class="current">Orders</span>
            </div>
        </div> -->
    </div>

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

        <p class="orders-intro">
            Monitor order activity, payment status, and order dates.
        </p>

        <!-- Summary -->
        <div class="orders-summary">

            <div class="orders-summary-card">
                <div class="orders-summary-icon">
                    <i class="ri-shopping-bag-3-line"></i>
                </div>
                <div>
                    <p class="orders-summary-label">Total Orders</p>
                    <h4 class="orders-summary-number">{{ $totalOrders }}</h4>
                </div>
            </div>

            <div class="orders-summary-card">
                <div class="orders-summary-icon pending">
                    <i class="ri-time-line"></i>
                </div>
                <div>
                    <p class="orders-summary-label">Pending Orders</p>
                    <h4 class="orders-summary-number">{{ $pendingOrders }}</h4>
                </div>
            </div>

            <div class="orders-summary-card">
                <div class="orders-summary-icon completed">
                    <i class="ri-checkbox-circle-line"></i>
                </div>
                <div>
                    <p class="orders-summary-label">Completed Orders</p>
                    <h4 class="orders-summary-number">{{ $completedOrders }}</h4>
                </div>
            </div>

        </div>

        <!-- Orders Table -->
        <div class="orders-table-card">

            <div class="orders-table-header">
                <div>
                    <h4>Order Management</h4>
                    <p>Review orders and their current payment and fulfilment status.</p>
                </div>

                <div class="orders-search">
                    <i class="ri-search-line"></i>
                    <input
                        type="search"
                        id="orders-search-input"
                        placeholder="Search orders..."
                        aria-label="Search orders"
                    >
                </div>
            </div>

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
                                    <i class="ri-inbox-2-line"></i>
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