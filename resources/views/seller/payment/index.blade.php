@include('seller.Include.header')

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
</style>

@php
  // TEMP DEMO DATA: only shows when the list is empty, APP_DEBUG is true and the URL has ?demo=1. Delete before launch.
  $rows = $payments;
  if ($rows->isEmpty() && config('app.debug') && request()->boolean('demo')) {
    $rows = collect([
      (object) ['id' => 31, 'order_id' => 1048, 'order' => (object) ['user' => (object) ['name' => 'Northwind Apparel'], 'user_id' => 5], 'amount' => 2500, 'status' => 'pending', 'provider' => 'stripe', 'transaction_id' => null, 'created_at' => now()->subDays(1)],
      (object) ['id' => 30, 'order_id' => 1047, 'order' => (object) ['user' => (object) ['name' => 'Greenleaf Studio'], 'user_id' => 8], 'amount' => 1800, 'status' => 'paid', 'provider' => 'stripe', 'transaction_id' => 'pi_3Q8demo001', 'created_at' => now()->subDays(6)],
      (object) ['id' => 29, 'order_id' => 1046, 'order' => (object) ['user' => (object) ['name' => 'Maple & Thread'], 'user_id' => 9], 'amount' => 950, 'status' => 'paid', 'provider' => 'stripe', 'transaction_id' => 'pi_3Q7demo002', 'created_at' => now()->subDays(18)],
      (object) ['id' => 28, 'order_id' => 1045, 'order' => (object) ['user' => (object) ['name' => 'Harbour Active'], 'user_id' => 12], 'amount' => 420, 'status' => 'failed', 'provider' => 'stripe', 'transaction_id' => null, 'created_at' => now()->subDays(43)],
    ]);
  }
@endphp

<div class="page-content">

  <div class="page-title-head d-flex align-items-center gap-2">

    <div class="flex-grow-1">

      <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
        <h3 class="mb-1">Payments </h3>

        <a href="https://maseco.ca/UAT/user/dashboard" style="color:#555; text-decoration:none;">
          Dashboard
        </a>

        <span style="padding:0 6px; color:#999; font-size:14px;">
          ▶
        </span>

        <span style="color:#2DAC92;">
          Payments
        </span>

      </div>
    </div>

  </div>

  <div class="page-container p-3">
  
{{-- Payment Filters --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
        <div class="row g-3 align-items-end">

            {{-- Search Payments --}}
            <div class="col-lg-3 col-md-6">
                <label for="payment-search" class="form-label fw-semibold">
                    Search Payments
                </label>
                <input
                    type="text"
                    id="payment-search"
                    class="form-control"
                    placeholder="Payment ID or Order ID..."
                    value="{{ request('search') }}"
                >
            </div>

            {{-- Payment Status --}}
            <div class="col-lg-2 col-md-6">
                <label for="payment-status" class="form-label fw-semibold">
                    Payment Status
                </label>
                <select id="payment-status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>

            {{-- Payment Method --}}
            <div class="col-lg-2 col-md-6">
                <label for="payment-method" class="form-label fw-semibold">
                    Payment Method
                </label>
                <select id="payment-method" class="form-select">
                    <option value="">All Methods</option>
                    <option value="bank_transfer" {{ request('method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="upi" {{ request('method') == 'upi' ? 'selected' : '' }}>UPI</option>
                    <option value="card" {{ request('method') == 'card' ? 'selected' : '' }}>Card</option>
                    <option value="cash" {{ request('method') == 'cash' ? 'selected' : '' }}>Cash</option>
                </select>
            </div>

            {{-- From Date --}}
            <div class="col-lg-2 col-md-6">
                <label for="payment-start-date" class="form-label fw-semibold">
                    From Date
                </label>
                <input
                    type="date"
                    id="payment-start-date"
                    class="form-control"
                    value="{{ request('start_date') }}"
                >
            </div>

            {{-- To Date --}}
            <div class="col-lg-2 col-md-6">
                <label for="payment-end-date" class="form-label fw-semibold">
                    To Date
                </label>
                <input
                    type="date"
                    id="payment-end-date"
                    class="form-control"
                    value="{{ request('end_date') }}"
                >
            </div>

            {{-- Buttons --}}
            <div class="col-lg-1 col-md-12 d-flex gap-2">
                <button
                    type="button"
                    id="payment-filter-btn"
                    class="btn btn-success"
                    title="Filter Payments"
                >
                    <i class="fa-solid fa-filter"></i>
                </button>

                <!-- <a
                    href=""
                    class="btn btn-outline-secondary"
                    title="Reset Filters"
                >
                    <i class="fa-solid fa-rotate-left"></i>
                </a> -->
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterBtn = document.getElementById('payment-filter-btn');
    const searchInput = document.getElementById('payment-search');
    const statusSelect = document.getElementById('payment-status');
    const methodSelect = document.getElementById('payment-method');
    const startDateInput = document.getElementById('payment-start-date');
    const endDateInput = document.getElementById('payment-end-date');

    function applyPaymentFilters() {
        const search = searchInput.value.trim();
        const status = statusSelect.value;
        const method = methodSelect.value;
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;

        if (startDate && endDate && startDate > endDate) {
            alert('From Date cannot be later than To Date.');
            return;
        }

        const url = new URL(window.location.href);
        const params = url.searchParams;

        [
            'search',
            'status',
            'method',
            'start_date',
            'end_date',
            'page'
        ].forEach(param => params.delete(param));

        if (search) params.set('search', search);
        if (status) params.set('status', status);
        if (method) params.set('method', method);
        if (startDate) params.set('start_date', startDate);
        if (endDate) params.set('end_date', endDate);

        window.location.href = url.toString();
    }

    filterBtn.addEventListener('click', applyPaymentFilters);

    searchInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            applyPaymentFilters();
        }
    });
});
</script>


    <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden">

      <div class="px-3 py-3 border-bottom">
        <h5 class="header-title fw-bold mb-1">Order Payments</h5>
        <p class="text-muted small mb-0">Payments received from buyers for your orders.</p>
      </div>

      <div class="ud-scroll">

        <table class="ud-table">

          <thead>

            <tr>

              <th>ID</th>

              <th>Order</th>

              <th>Buyer</th>

              <th>Amount</th>

              <th>Status</th>

              <th>Provider</th>

              <th>Transaction</th>

              <th>Date</th>

            </tr>

          </thead>

          <tbody>

            @forelse($rows as $p)

              @php
                $st = [
                  'paid' => 'success',
                  'failed' => 'danger',
                  'cancelled' => 'danger',
                ][strtolower($p->status)] ?? 'warning';
              @endphp

              <tr>

                <td class="text-muted">{{ $p->id }}</td>

                <td class="fw-semibold">#{{ $p->order_id }}</td>

                <td>{{ optional(optional($p->order)->user)->name ?? 'User #' . optional($p->order)->user_id }}</td>

                <td class="fw-semibold text-nowrap">${{ number_format($p->amount, 2) }}</td>

                <td><span
                    class="ud-st ud-st-{{ $st }} rounded-pill d-inline-block text-nowrap">{{ ucfirst($p->status) }}</span>
                </td>

                <td class="text-nowrap">{{ strtoupper($p->provider ?? '-') }}</td>

                <td><code>{{ $p->transaction_id ?? '-' }}</code></td>

                <td class="text-nowrap text-muted">{{ $p->created_at->format('d M Y H:i') }}</td>

              </tr>

            @empty

              <tr>

                <td colspan="8" class="text-center text-muted">
                  <div>No payments found.</div>
                  <div class="small">Payments for your orders will appear here.</div>
                </td>

              </tr>

            @endforelse

          </tbody>

        </table>

      </div>

    </div>

    <div
      class="bg-white shadow-sm rounded-4 p-3 mt-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
      <div>
        <h6 class="fw-bold mb-1">Need help?</h6>
        <p class="text-muted small mb-0">Questions about a payment? Email connect@maseco.ca.</p>
      </div>
      <a href="{{ url('contact-us') }}" class="btn btn-outline-success btn-sm px-3">Contact us</a>
    </div>

  </div>

</div> <!-- container -->


@include('seller.Include.footer')