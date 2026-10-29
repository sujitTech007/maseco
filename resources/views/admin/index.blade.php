@include('admin.Include.header')

<div class="page-content">






<div class="page-container">


<div class="container-fluid px-0">

    {{-- First Row --}}
    <div class="row g-3 mb-1">

        {{-- Enquiry --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 rounded-4 shadow-sm bg-success bg-opacity-10">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-secondary fw-semibold mb-3">
                                Enquiry
                            </p>
                            <h2 class="fw-bold text-dark mb-0">
                                {{ $enquiryCount }}
                            </h2>
                            <small class="text-success fw-medium">
                                <i class="fa-solid fa-comments me-1"></i>
                                Total enquiries
                            </small>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-4 bg-success bg-opacity-25 text-success"
                             style="width:64px;height:64px;">
                            <i class="fa-solid fa-comment-dots fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Orders --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 rounded-4 shadow-sm bg-primary bg-opacity-10">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-secondary fw-semibold mb-3">
                                Orders
                            </p>
                            <h2 class="fw-bold text-dark mb-0">
                                {{ $orderCount }}
                            </h2>
                            <small class="text-primary fw-medium">
                                <i class="fa-solid fa-bag-shopping me-1"></i>
                                Total orders
                            </small>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-4 bg-primary bg-opacity-25 text-primary"
                             style="width:64px;height:64px;">
                            <i class="fa-solid fa-bag-shopping fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payments --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 rounded-4 shadow-sm bg-warning bg-opacity-10">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-secondary fw-semibold mb-3">
                                Payments
                            </p>
                            <h2 class="fw-bold text-dark mb-0">
                                ${{ number_format($paymentTotal, 2) }}
                            </h2>
                            <small class="text-warning-emphasis fw-medium">
                                <i class="fa-solid fa-credit-card me-1"></i>
                                Total payments
                            </small>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-4 bg-warning bg-opacity-25 text-warning-emphasis"
                             style="width:64px;height:64px;">
                            <i class="fa-solid fa-credit-card fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Profit --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 rounded-4 shadow-sm bg-danger bg-opacity-10">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-secondary fw-semibold mb-3">
                                Total Profit
                            </p>
                            <h2 class="fw-bold text-dark mb-0">
                                $19,800
                            </h2>
                            <small class="text-danger fw-medium">
                                <i class="fa-solid fa-chart-line me-1"></i>
                                Overall profit
                            </small>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-4 bg-danger bg-opacity-25 text-danger"
                             style="width:64px;height:64px;">
                            <i class="fa-solid fa-dollar-sign fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- KYC Pending Alert --}}
    @if(($kycPendingCount ?? 0) > 0)
    <div class="alert alert-warning d-flex align-items-center gap-3 shadow-sm border-0 mb-3" role="alert">
        <div class="rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center flex-shrink-0"
             style="width:42px;height:42px;font-size:1.2rem">
            <i class="ri-time-line"></i>
        </div>
        <div class="flex-grow-1">
            <strong>{{ $kycPendingCount }} KYC {{ Str::plural('submission', $kycPendingCount) }} pending review.</strong>
            Approve or reject them so users can access their dashboards.
        </div>
        <a href="{{ route('admin.kyc.index', ['status'=>'pending']) }}" class="btn btn-sm btn-warning text-white flex-shrink-0">
            Review now
        </a>
    </div>
    @endif

    {{-- Second Row: User Statistics --}}
    <div class="row g-3">

        {{-- Buyers --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 rounded-4 shadow-sm bg-success bg-opacity-10">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-secondary fw-semibold mb-3">
                                Buyers
                            </p>
                            <h2 class="fw-bold text-dark mb-0">
                                {{ $buyerCount }}
                            </h2>
                            <small class="text-success fw-medium">
                                <i class="fa-solid fa-user-check me-1"></i>
                                Registered buyers
                            </small>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-4 bg-success bg-opacity-25 text-success"
                             style="width:64px;height:64px;">
                            <i class="fa-solid fa-users fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sellers --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 rounded-4 shadow-sm bg-primary bg-opacity-10">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-secondary fw-semibold mb-3">
                                Sellers
                            </p>
                            <h2 class="fw-bold text-dark mb-0">
                                {{ $sellerCount }}
                            </h2>
                            <small class="text-primary fw-medium">
                                <i class="fa-solid fa-store me-1"></i>
                                Registered sellers
                            </small>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-4 bg-primary bg-opacity-25 text-primary"
                             style="width:64px;height:64px;">
                            <i class="fa-solid fa-store fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Manufacturers --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 rounded-4 shadow-sm bg-warning bg-opacity-10">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-secondary fw-semibold mb-3">
                                Manufacturers
                            </p>
                            <h2 class="fw-bold text-dark mb-0">
                                {{ $manufacturerCount }}
                            </h2>
                            <small class="text-warning-emphasis fw-medium">
                                <i class="fa-solid fa-industry me-1"></i>
                                Registered manufacturers
                            </small>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-4 bg-warning bg-opacity-25 text-warning-emphasis"
                             style="width:64px;height:64px;">
                            <i class="fa-solid fa-industry fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>




      
    <div class="row mt-1 g-3 dashboard-analytics">

            {{-- Platform Overview Chart --}}
        <div class="col-lg-8 col-12">
            <div class="card analytics-card h-100">
                <div class="card-body">
                    <div class="analytics-heading">
                        <div>
                            <h5>Platform Overview</h5>
                            <p>Current platform statistics</p>
                        </div>
                    </div>

                    <div class="analytics-chart"
                        style="position: relative; height: 280px; width: 100%;">
                        <canvas id="dashboardOverviewChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
          {{-- Quick Summary --}}
          <div class="col-lg-4 col-12">
            <div class="card analytics-card h-100">
              <div class="card-body">

                <h5 class="summary-heading">User Overview</h5>
                <p class="summary-subtitle">Registered accounts</p>

                <div class="summary-item">
                  <span class="summary-dot dot-buyer"></span>
                  <span>Buyers</span>
                  <strong>{{ $buyerCount }}</strong>
                </div>

                <div class="summary-item">
                  <span class="summary-dot dot-seller"></span>
                  <span>Sellers</span>
                  <strong>{{ $sellerCount }}</strong>
                </div>

                <div class="summary-item">
                  <span class="summary-dot dot-manufacturer"></span>
                  <span>Manufacturers</span>
                  <strong>{{ $manufacturerCount }}</strong>
                </div>

                <div class="summary-item">
                  <span class="summary-dot dot-enquiry"></span>
                  <span>Enquiries</span>
                  <strong>{{ $enquiryCount }}</strong>
                </div>

                <div class="summary-item">
                  <span class="summary-dot dot-orders"></span>
                  <span>Orders</span>
                  <strong>{{ $orderCount }}</strong>
                </div>

              </div>
            </div>
          </div>
    </div>

      <div class="row mt-3 g-3">
        <div class="col-lg-6 col-12">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <h5 class="mb-1">Newsletter subscribers</h5>
                  <small class="text-muted">{{ $newsletterCount }} total subscribers</small>
                </div>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.newsletter.list') }}">View all</a>
              </div>
              @forelse($recentNewsletters as $newsletter)
                <div class="d-flex justify-content-between border-top py-2">
                  <a href="mailto:{{ $newsletter->email }}">{{ $newsletter->email }}</a>
                  <small class="text-muted">{{ $newsletter->created_at?->format('d M Y') }}</small>
                </div>
              @empty
                <p class="text-muted mb-0">No newsletter subscribers yet.</p>
              @endforelse
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-12">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <h5 class="mb-1">Contact submissions</h5>
                  <small class="text-muted">{{ $contactCount }} total submissions</small>
                </div>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.contact.list') }}">View all</a>
              </div>
              @forelse($recentContacts as $contact)
                <div class="border-top py-2">
                  <div class="d-flex justify-content-between">
                    <strong>{{ $contact->name }}</strong>
                    <small class="text-muted">{{ $contact->created_at?->format('d M Y') }}</small>
                  </div>
                  <div><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></div>
                  <small class="text-muted">{{ $contact->phone }}</small>
                </div>
              @empty
                <p class="text-muted mb-0">No contact submissions yet.</p>
              @endforelse
            </div>
          </div>
        </div>
      </div>
</div>

</div> <!-- container -->
{{-- Load Chart.js once in your layout --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('dashboardOverviewChart');

    if (!canvas) {
        console.error('Dashboard chart canvas not found.');
        return;
    }

    if (typeof Chart === 'undefined') {
        console.error('Chart.js failed to load.');
        return;
    }

    // Avoid initializing the same chart twice
    const existingChart = Chart.getChart(canvas);
    if (existingChart) {
        existingChart.destroy();
    }

    new Chart(canvas, {
        type: 'line',

        data: {
            labels: [
                'Enquiries',
                'Orders',
                'Buyers',
                'Sellers',
                'Manufacturers'
            ],
            datasets: [{
                label: 'Total Records',
                data: [
                    {{ (int) $enquiryCount }},
                    {{ (int) $orderCount }},
                    {{ (int) $buyerCount }},
                    {{ (int) $sellerCount }},
                    {{ (int) $manufacturerCount }}
                ],
                borderColor: '#2DAC92',
                backgroundColor: 'rgba(45, 172, 146, 0.12)',
                borderWidth: 3,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#2DAC92',
                fill: true,
                tension: 0.35
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                }
            },

            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
});
</script>

@include('admin.Include.footer')
