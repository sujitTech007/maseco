
    @include('manufacturer.Include.header')

    <!-- Begin page -->
    <div class="wrapper active">

        <div class="page-content">
            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                  <h4 class="fs-18 fw-bold mb-0">Manufacturer Dashboard</h4>
                </div>
              </div>
              
             <div class="page-container p-1">
  <div class="container py-1">
   
    <div class="row">
      <!-- Left Half (Ludo style 2x2 cards) -->
      <div class="col-lg-12">
        <div class="row g-3">
          <!-- Total Orders -->
          <div class="col-3">
            <div class="card h-100 text-center shadow">
              <div class="card-body custom-card-body card-body-users">
                <div class="growth-text">
                  <p class="card-text mb-0 card-text-users">Total Orders</p>
                  <h5 class="card-title mb-1 card-title-users">{{ $ordersCount }}</h5>
                </div>
                <div class="icon-box display-4 text-primary mb-2">
                  <i class="bi bi-bag"></i>
                </div>
              </div>
             
            </div>
          </div>

          <!-- Completed Orders -->
          <div class="col-3">
            <div class="card h-100 text-center shadow">
              <div class="card-body custom-card-body card-body-growth">
                <div class="growth-text">
                  <p class="card-text  mb-0 card-text-growth">Completed Orders</p>
                  <h5 class="card-title mb-1 card-title-growth">{{ $ordersCount }}</h5>
                </div>
                <div class="icon-box display-4 text-success mb-2">
                  <i class="bi bi-check-circle"></i>
                </div>
              </div>
               
            </div>
          </div>

          <!-- Payments Received -->
          <div class="col-3">
            <div class="card h-100 text-center shadow">
              <div class="card-body custom-card-body card-body-rating">
                <div class="growth-text">
                  <p class="card-text  mb-0 card-text-rating">Payments Received</p>
                  <h5 class="card-title mb-1 card-title-rating">${{ number_format($paymentsTotal, 2) }}</h5>
                    </div>
                <div class="icon-box display-4 text-warning mb-2">
                  <i class="bi bi-credit-card"></i>
                </div>
              </div>
               
            </div>
          </div>

          <!-- Profit -->
          <div class="col-3">
            <div class="card h-100 text-center shadow">
              <div class="card-body custom-card-body card-body-uptime">
                <div class="growth-text">
                  <p class="card-text mb-0 card-text-uptime">Enquiries</p>
                  <h5 class="card-title mb-1 card-title-uptime">{{ $enquiriesCount }}</h5>
                 </div>
                <div class="icon-box display-4 text-danger mb-2">
                  <i class="bi bi-currency-dollar"></i>
                </div>
              </div>
               
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
</div>


               

              

            </div> 
    @include('manufacturer.Include.footer')


