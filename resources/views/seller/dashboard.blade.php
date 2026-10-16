@include('seller.Include.header')

<style>
  .ud-hero {
    background: #3f4a1c;
  }

  .ud-chip {
    width: 44px;
    height: 44px;
  }

  .ud-accent {
    border-top: 4px solid var(--bs-success) !important;
  }
</style>

<!-- Begin page -->
<div class="wrapper active ">

  <div class="page-content mt-3">
    <div class="page-title-head d-flex align-items-center gap-2">
      <div class="flex-grow-1">
        <h2 class="fs-18 fw-bold mb-0">Dashboard</h2>
      </div>
    </div>

    <div class="page-container p-1">
      <div class="container py-1">

        {{-- Welcome banner --}}
        <div class="ud-hero text-white rounded-4 shadow-sm p-4 mb-4">
          <h4 class="fw-bold text-white mb-1">Welcome back.</h4>
          <p class="mb-0 opacity-75">Keep track of the orders, payments and buyer enquiries coming through your
            Maseco supplier account.</p>
        </div>

        <div class="row g-3">

          <!-- Total Orders -->
          <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 ud-accent">
              <div class="card-body p-3">
                <div class="d-flex align-items-center gap-2 mb-3">
                  <span
                    class="ud-chip bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0"
                    aria-hidden="true">
                    <i class="bi bi-bag fs-5"></i>
                  </span>
                  <h5 class="card-text fw-bold mb-2">Total Orders</h5>
                </div>
                <p class="display-6 fw-bold mb-1">{{ $ordersCount }}</p>
                <p class="text-muted small mb-0">All orders placed with you.</p>
              </div>
            </div>
          </div>

          <!-- Completed Orders -->
          <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 ud-accent">
              <div class="card-body p-3">
                <div class="d-flex align-items-center gap-2 mb-3">
                  <span
                    class="ud-chip bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0"
                    aria-hidden="true">
                    <i class="bi bi-check-circle fs-5"></i>
                  </span>
                  <h5 class="card-text fw-bold mb-2">Completed Orders</h5>
                </div>
                <p class="display-6 fw-bold mb-1">{{ $paidOrdersCount }}</p>
                <p class="text-muted small mb-0">Orders that have been paid.</p>
              </div>
            </div>
          </div>

          <!-- Payments Received -->
          <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 ud-accent">
              <div class="card-body p-3">
                <div class="d-flex align-items-center gap-2 mb-3">
                  <span
                    class="ud-chip bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0"
                    aria-hidden="true">
                    <i class="bi bi-credit-card fs-5"></i>
                  </span>
                  <h5 class="card-text fw-bold mb-2">Payments Received</h5>
                </div>
                <p class="display-6 fw-bold mb-1">${{ number_format($paymentsTotal, 2) }}</p>
                <p class="text-muted small mb-0">Total received from your orders.</p>
              </div>
            </div>
          </div>

          <!-- Enquiries -->
          <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 ud-accent">
              <div class="card-body p-3">
                <div class="d-flex align-items-center gap-2 mb-3">
                  <span
                    class="ud-chip bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0"
                    aria-hidden="true">
                    <i class="bi bi-chat-dots fs-5"></i>
                  </span>
                  <h5 class="card-text fw-bold mb-2">Enquiries</h5>
                </div>
                <p class="display-6 fw-bold mb-1">{{ $enquiriesCount }}</p>
                <p class="text-muted small mb-0">Requests from buyers.</p>
              </div>
            </div>
          </div>

          {{-- Help --}}
          <div class="col-12">
            <div class="card border-0 bg-white shadow-sm rounded-4">
              <div
                class="card-body p-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                  <h4 class="fw-bold mb-1">Need help?</h4>
                  <p class="text-muted small mb-0">Questions about your orders, payments or listings? Email
                    connect@maseco.ca.</p>
                </div>
                <a href="{{ url('contact-us') }}" class="btn btn-outline-success btn-sm px-3">Contact us</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
  @include('seller.Include.footer')