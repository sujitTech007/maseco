@include('admin.Include.header')

<div class="page-content">




<!-- 
  <div class="page-title-head d-flex align-items-center gap-2">

    <div class="flex-grow-1">

      <h4 class="fs-18 fw-bold mb-0">Admin Dashboard</h4>

    </div>

  </div> -->



  <div class="page-container p-1">

    <div class="container py-1">



      <div class="row">

        <!-- Left Half (Ludo style 2x2 cards) -->

        <div class="col-lg-12">

          <div class="row g-3">

            <!-- Total Customers -->

            <div class="col-12 col-sm-6 col-xl-3">

              <div class="card  text-center shadow">

                <div class="card-body custom-card-body card-body-users">



                  <div class="growth-text">

                    <p class="card-text mb-0 card-text-users"> Enquiry</p>



                    <h5 class="card-title mb-1 card-title-users fs-3">{{ $enquiryCount }}</h5>



                  </div>

                  <div class="icon-box display-4 text-primary mb-2">

                    <i class="fa-solid fa-comment-dots"></i>

                  </div>



                </div>



              </div>

            </div>



            <!-- New Orders -->

            <div class="col-12 col-sm-6 col-xl-3">

              <div class="card  text-center shadow">

                <div class="card-body custom-card-body card-body-growth">

                  <div class="growth-text">

                    <p class="card-text  mb-0 card-text-growth"> Orders</p>



                    <h5 class="card-title mb-1 card-title-growth fs-3">{{ $orderCount }}</h5>

                  </div>

                  <div class="icon-box display-4 text-success mb-2">

                    <i class="fa-solid fa-bag-shopping"></i>

                  </div>



                </div>



              </div>

            </div>



            <!-- New Designers -->

            <div class="col-12 col-sm-6 col-xl-3">

              <div class="card  text-center shadow">

                <div class="card-body custom-card-body card-body-rating">

                  <div class="growth-text">

                    <p class="card-text  mb-0 card-text-rating"> Payments</p>



                    <h5 class="card-title mb-1 card-title-rating fs-3">$ {{ number_format($paymentTotal, 2) }}</h5>

                  </div>

                  <div class="icon-box display-4 text-warning mb-2">

                    <i class="fa-solid fa-credit-card"></i>

                  </div>



                </div>



              </div>

            </div>



            <!-- Total Revenue -->

            <div class="col-12 col-sm-6 col-xl-3">

              <div class="card  text-center shadow">

                <div class="card-body custom-card-body card-body-uptime">

                  <div class="growth-text">

                    <p class="card-text mb-0 card-text-uptime">Total Profit</p>



                    <h5 class="card-title mb-1 card-title-uptime fs-3">$19,800</h5>

                  </div>

                  <div class="icon-box display-4 text-danger mb-2">

                    <i class="fa-solid fa-dollar-sign"></i>

                  </div>



                </div>



              </div>

            </div>

          </div>

        </div>



      </div>

      <div class="row mt-4">

        <!-- Left Half (Ludo style 2x2 cards) -->

        <div class="col-lg-12">

          <div class="row g-3">

            <!-- Total Customers -->

            <div class="col-12 col-sm-6 col-xl-3">

              <div class="card  text-center shadow">

                <div class="card-body custom-card-body card-body-users">



                  <div class="growth-text">

                    <p class="card-text mb-0 card-text-users"> Buyer</p>



                    <h5 class="card-title mb-1 card-title-users fs-3">{{ $buyerCount }}</h5>



                  </div>

                  <div class="icon-box display-4 text-primary mb-2">

                    <i class="fa-solid fa-circle-user"></i>

                  </div>



                </div>



              </div>

            </div>



            <!-- New Orders -->

            <div class="col-12 col-sm-6 col-xl-3">

              <div class="card  text-center shadow">

                <div class="card-body custom-card-body card-body-growth">

                  <div class="growth-text">

                    <p class="card-text  mb-0 card-text-growth"> Seller</p>



                    <h5 class="card-title mb-1 card-title-growth fs-3">{{ $sellerCount }}</h5>

                  </div>

                  <div class="icon-box display-4 text-success mb-2">

                    <i class="fa-solid fa-circle-user"></i>

                  </div>



                </div>



              </div>

            </div>



            <!-- New Designers -->

            <div class="col-12 col-sm-6 col-xl-3">

              <div class="card  text-center shadow">

                <div class="card-body custom-card-body card-body-rating">

                  <div class="growth-text">

                    <p class="card-text  mb-0 card-text-rating"> Manufacturer</p>



                    <h5 class="card-title mb-1 card-title-rating">{{$manufacturerCount }}</h5>

                  </div>

                  <div class="icon-box display-4 text-warning mb-2">

                    <i class="fa-solid fa-circle-user"></i>

                  </div>



                </div>



              </div>

            </div>



            <!-- Total Revenue -->



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
