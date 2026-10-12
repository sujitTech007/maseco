@include('user.Include.header')



<div class="page-content">



    <div class="container py-1">

        <h4 class="mb-1 fs-bold main-heading"> Subscription</h2>
            <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">

                <a href="{{ route('user.dashboard') }}" style="color:#454545; text-decoration:none;">
                    Dashboard
                </a>

                <span style="padding:0 6px; color:#999; font-size:10px;">
                    ▶
                </span>

                <span style="color:#2DAC92;">
                    Subscription
                </span>

            </div>
            <div class="table-responsive">

                <table class="table table-striped align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Plan</th>

                            <th>Amount</th>

                            <th>Status</th>

                            <th>Purchased At</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($purchases as $purchase)

                        <tr>

                            <td>{{ $purchase->id }}</td>

                            <td>{{ $purchase->plan_name ?? data_get($purchase->details, 'plan_name', 'N/A') }}</td>

                            <td>${{ number_format($purchase->amount ?? $purchase->price ?? 0, 2) }}</td>

                            <td>{{ ucfirst($purchase->payment_status) }}</td>

                            <td>{{ $purchase->created_at->format('d M Y') }}</td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center">No subscriptions found. <a href="{{ route('subscription.plan') }}">Buy a plan</a></td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

    </div>

</div>

@include('user.Include.footer')