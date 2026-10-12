@include('user.Include.header')

<div class="page-content">



<div class="container py-1">

    <h3 class="mb-4 fs-bold">My Dashboard</h2>

    <div class="row g-3">

        <div class=" col-lg-3 col-md-12">

            <div class="card h-100">

                <div class="card-body">

                    <h5 class="card-title">Profile</h5>

                    <p class="mb-1"><strong>Name:</strong> {{ $user->name }}</p>

                    <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>

                    <p class="mb-3"><strong>Phone:</strong> {{ $user->phone ?? '-' }}</p>

                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm">Edit Profile</a>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-12">

            <div class="card h-100">

                <div class="card-body">

                    <h5 class="card-title">Enquiries</h5>

                    <p class="display-6">{{ $enquiriesCount }}</p>

                    <a href="{{ route('user.enquiries') }}" class="btn btn-outline-primary btn-sm">View enquiries</a>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-12">

            <div class="card h-100">

                <div class="card-body">

                    <h5 class="card-title">Orders</h5>

                    <p class="display-6">{{ $ordersCount }}</p>

                    <a href="{{ route('user.orders') }}" class="btn btn-outline-primary btn-sm">View orders</a>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-12">

            <div class="card h-100">

                <div class="card-body">

                    <h5 class="card-title">Payments</h5>

                    <p class="display-6">${{ number_format($paymentsTotal, 2) }}</p>

                    <a href="{{ route('user.payments') }}" class="btn btn-outline-primary btn-sm">View payments</a>

                </div>

            </div>

        </div>

        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <h5 class="card-title">Active Subscription</h5>

                    @if($activeSubscription)

                        <div>

                            <p class="mb-1"><strong>Plan:</strong> {{ $activeSubscription->plan_name ?? 'N/A' }}</p>

                            <p class="mb-1"><strong>Amount:</strong> ${{ number_format($activeSubscription->amount ?? $activeSubscription->price ?? 0, 2) }}</p>

                            <p class="mb-0"><strong>Status:</strong> {{ ucfirst($activeSubscription->payment_status) }}</p>

                        </div>

                    @else

                        <p class="mb-0">No active subscription. <a href="{{ route('subscription.plan') }}">Browse plans</a></p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

</div>





@include('user.Include.footer')





