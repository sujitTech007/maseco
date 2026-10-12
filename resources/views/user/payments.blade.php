@include('user.Include.header')





<div class="page-content">



    <div class="container py-1">

        <h4 class="mb-1 fs-bold main-heading"> Payments</h2>
            <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">

                <a href="{{ route('user.dashboard') }}" style="color:#454545; text-decoration:none;">
                    Dashboard
                </a>

                <span style="padding:0 6px; color:#999; font-size:10px;">
                    ▶
                </span>

                <span style="color:#2DAC92;">
                    Payments
                </span>

            </div>
            <div class="table-responsive">

                <table class="table table-striped align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Order</th>

                            <th>Amount</th>

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

                            <td>${{ number_format($p->amount, 2) }}</td>

                            <td>{{ ucfirst($p->status) }}</td>

                            <td>{{ strtoupper($p->provider ?? '-') }}</td>

                            <td><code>{{ $p->transaction_id ?? '-' }}</code></td>

                            <td>{{ $p->created_at->format('d M Y H:i') }}</td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">No payments found.</td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

    </div>

</div>

@include('user.Include.footer')