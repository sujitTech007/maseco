@include('admin.Include.header')

<div class="page-content">





  <div class="page-title-head d-flex align-items-center gap-2">

    <div class="flex-grow-1">

      <h4 class="fs-18 fw-bold mb-0">Admin Dashboard</h4>

    </div>

  </div>



  <div class="page-container p-1">

    <div class="container py-1">

      

      <div class="row">

        <!-- Left Half (Ludo style 2x2 cards) -->

        <div class="col-lg-12">

          <div class="row g-3">

            <!-- Total Customers -->

            <div class="col-3">

              <div class="card h-100 text-center shadow">

                <div class="card-body custom-card-body card-body-users">



                  <div class="growth-text">

                    <p class="card-text mb-0 card-text-users"> Enquiry</p>



                    <h5 class="card-title mb-1 card-title-users fs-3">{{ $enquiryCount }}</h5>



                  </div>

                  <div class="icon-box display-4 text-primary mb-2">

                    <i class="bi bi-chat-left-text"></i>

                  </div>



                </div>

                

              </div>

            </div>



            <!-- New Orders -->

            <div class="col-3">

              <div class="card h-100 text-center shadow">

                <div class="card-body custom-card-body card-body-growth">

                  <div class="growth-text">

                    <p class="card-text  mb-0 card-text-growth"> Orders</p>



                    <h5 class="card-title mb-1 card-title-growth fs-3">{{ $orderCount }}</h5>

                  </div>

                  <div class="icon-box display-4 text-success mb-2">

                    <i class="bi bi-bag-check"></i>

                  </div>



                </div>

                

              </div>

            </div>



            <!-- New Designers -->

            <div class="col-3">

              <div class="card h-100 text-center shadow">

                <div class="card-body custom-card-body card-body-rating">

                  <div class="growth-text">

                    <p class="card-text  mb-0 card-text-rating"> Payments</p>



                    <h5 class="card-title mb-1 card-title-rating fs-3">$ {{ number_format($paymentTotal, 2) }}</h5>

                  </div>

                  <div class="icon-box display-4 text-warning mb-2">

                    <i class="bi bi-credit-card"></i>

                  </div>



                </div>

                

              </div>

            </div>



            <!-- Total Revenue -->

            <div class="col-3">

              <div class="card h-100 text-center shadow">

                <div class="card-body custom-card-body card-body-uptime">

                  <div class="growth-text">

                    <p class="card-text mb-0 card-text-uptime">Total Profit</p>



                    <h5 class="card-title mb-1 card-title-uptime fs-3">$19,800</h5>

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

      <div class="row mt-4">

        <!-- Left Half (Ludo style 2x2 cards) -->

        <div class="col-lg-12">

          <div class="row g-3">

            <!-- Total Customers -->

            <div class="col-3">

              <div class="card h-100 text-center shadow">

                <div class="card-body custom-card-body card-body-users">



                  <div class="growth-text">

                    <p class="card-text mb-0 card-text-users"> Buyer</p>



                    <h5 class="card-title mb-1 card-title-users fs-3">{{ $buyerCount }}</h5>



                  </div>

                  <div class="icon-box display-4 text-primary mb-2">

                    <i class="bi bi-person-circle"></i>

                  </div>



                </div>

                

              </div>

            </div>



            <!-- New Orders -->

            <div class="col-3">

              <div class="card h-100 text-center shadow">

                <div class="card-body custom-card-body card-body-growth">

                  <div class="growth-text">

                    <p class="card-text  mb-0 card-text-growth"> Seller</p>



                    <h5 class="card-title mb-1 card-title-growth fs-3">{{ $sellerCount }}</h5>

                  </div>

                  <div class="icon-box display-4 text-success mb-2">

                  <i class="bi bi-person-circle"></i>

                  </div>



                </div>

                

              </div>

            </div>



            <!-- New Designers -->

            <div class="col-3">

              <div class="card h-100 text-center shadow">

                <div class="card-body custom-card-body card-body-rating">

                  <div class="growth-text">

                    <p class="card-text  mb-0 card-text-rating"> Manufacturer</p>



                    <h5 class="card-title mb-1 card-title-rating">{{$manufacturerCount }}</h5>

                  </div>

                  <div class="icon-box display-4 text-warning mb-2">

                  <i class="bi bi-person-circle"></i>

                  </div>



                </div>

                

              </div>

            </div>



            <!-- Total Revenue -->

            

          </div>

        </div>



      </div>

    </div>

  </div>

</div> <!-- container -->



@include('admin.Include.footer')