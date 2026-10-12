@include('seller.Include.header')



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

    <div class="card">

      <div class="card-header d-flex flex-wrap align-items-center gap-2">

        <h4 class="header-title me-auto">Order Payments</h4>

      </div>

      <div class="card-body">

        <div class="table-responsive">

          <table class="table table-bordered text-center align-middle">

            <thead class="table" style="background:#E7E7E7 !important">

              <tr>

                <th>ID</th>

                <th>Order</th>

                <th>Buyer</th>

                <th>Amount</h4>
                </th>

                <th>Status</th>

                <th>Provider</th>

                <th>Transaction</th>

                <th>Date</th>

              </tr>

            </thead>

            <tbody>

              @forelse($payments as $p)

              <tr>

                <td>{{ $p->id }}</td>

                <td>#{{ $p->order_id }}</td>

                <td>{{ optional(optional($p->order)->user)->name ?? 'User #'.optional($p->order)->user_id }}</td>

                <td>${{ number_format($p->amount, 2) }}</td>

                <td><span class="badge bg-{{ $p->status==='paid'?'success':'warning' }}">{{ ucfirst($p->status) }}</span></td>

                <td>{{ strtoupper($p->provider ?? '-') }}</td>

                <td><code>{{ $p->transaction_id ?? '-' }}</code></td>

                <td>{{ $p->created_at->format('d M Y H:i') }}</td>

              </tr>

              @empty

              <tr>

                <td colspan="8">No payments found.</td>

              </tr>

              @endforelse

            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>



</div> <!-- container -->


@include('seller.Include.footer')