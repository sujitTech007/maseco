@include('admin.Include.header')
<div class="page-content subscription-page">
    <div class="page-container p-3">

        {{-- Page Heading --}}
        <div class="subscription-heading">
            <div>
                <h3>Subscription Plans</h3>
                <div class="subscription-breadcrumb">
                    <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                    <span>›</span>
                    <span class="current">Subscription Plans</span>
                </div>
            </div>

            <a href="{{ route('admin.subscription.create') }}"
               class="btn subscription-add-btn">
                <i class="fa-solid fa-plus me-2"></i> Add Plan
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success subscription-alert">
                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Summary Cards --}}
        @php
            $subscriptionPlans = collect($plans);
            $activePlans = $subscriptionPlans->filter(function ($plan) {
                return strtolower((string) $plan->status) === 'active';
            })->count();

            $inactivePlans = $subscriptionPlans->count() - $activePlans;
        @endphp

        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="subscription-stat bg-danger bg-opacity-10">
                    <div class="subscription-stat-icon total bg-danger bg-opacity-10">
                        <i class="fa-solid fa-layer-group text-danger"></i>
                    </div>
                    <div>
                        <p>Total Plans</p>
                        <h4>{{ $subscriptionPlans->count() }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4">
                <div class="subscription-stat bg-warning bg-opacity-10">
                    <div class="subscription-stat-icon active bg-warning bg-opacity-10">
                        <i class="fa-solid fa-circle-check text-warning"></i>
                    </div>
                    <div>
                        <p>Active Plans</p>
                        <h4>{{ $activePlans }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4">
                <div class="subscription-stat bg-success bg-opacity-10">
                    <div class="subscription-stat-icon inactive bg-success bg-opacity-10">
                        <i class="fa-solid fa-circle-pause text-success"></i>
                    </div>
                    <div>
                        <p>Inactive Plans</p>
                        <h4>{{ $inactivePlans }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Plans Table --}}
        <div class="subscription-table-card">
            <div class="subscription-table-header">
                <div>
                    <h5>All Subscription Plans</h5>
                    <p>Manage plan pricing, features and commission rates.</p>
                </div>

                <div class="subscription-count">
                    {{ $subscriptionPlans->count() }}
                    {{ $subscriptionPlans->count() === 1 ? 'plan' : 'plans' }}
                </div>
            </div>

            <div class="table-responsive">
                <table class="table subscription-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Plan Details</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Features</th>
                            <th>Commission</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($plans as $plan)
                            @php
                                $planStatus = strtolower((string) $plan->status);
                                $statusClass = $planStatus === 'active'
                                    ? 'status-active'
                                    : ($planStatus === 'inactive'
                                        ? 'status-inactive'
                                        : 'status-other');

                                $features = is_array($plan->features)
                                    ? $plan->features
                                    : (is_string($plan->features)
                                        ? (json_decode($plan->features, true) ?: [])
                                        : []);
                            @endphp

                            <tr>
                                <td>
                                    <span class="subscription-id">#{{ $plan->id }}</span>
                                </td>

                                <td>
                                    <div class="plan-name">
                                        <span class="plan-name-icon">
                                            <i class="fa-solid fa-cube"></i>
                                        </span>
                                        <span>{{ $plan->name }}</span>
                                    </div>
                                </td>

                                <td>
                                    <div class="plan-price">
                                        ${{ number_format((float) $plan->price, 2) }}
                                    </div>
                                </td>

                                <td>
                                    <span class="plan-duration">
                                        {{ ucfirst($plan->duration) }}
                                    </span>
                                </td>

                                <td>
                                    @if(count($features))
                                        <ul class="plan-features">
                                            @foreach(array_slice($features, 0, 3) as $feature)
                                                <li>
                                                    <i class="fa-solid fa-check"></i>
                                                    {{ $feature }}
                                                </li>
                                            @endforeach
                                        </ul>

                                        @if(count($features) > 3)
                                            <span class="more-features">
                                                +{{ count($features) - 3 }} more
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-muted">No features listed</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="commission-value">
                                        {{ $plan->commission }}%
                                    </span>
                                </td>

                                <td>
                                    <span class="plan-status {{ $statusClass }}">
                                        <span></span>
                                        {{ ucfirst($plan->status) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="subscription-actions">
                                        <a href="{{ route('admin.subscription.edit', $plan->id) }}"
                                           class="subscription-action edit"
                                           title="Edit plan"
                                           aria-label="Edit plan">
                                           <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ route('admin.subscription.destroy', $plan->id) }}"
                                              method="POST"
                                              class="mb-0"
                                              onsubmit="return confirm('Delete this plan?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="subscription-action delete"
                                                    title="Delete plan"
                                                    aria-label="Delete plan">
                                               <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="subscription-empty">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <h5>No subscription plans yet</h5>
                                        <p>Create your first plan to get started.</p>
                                        <a href="{{ route('admin.subscription.create') }}"
                                           class="btn subscription-add-btn">
                                            <i class="fa-solid fa-plus me-2"></i> Add Plan
                                        </a>
                                    </div>
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
