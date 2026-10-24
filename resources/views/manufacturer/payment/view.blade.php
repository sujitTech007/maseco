@include('manufacturer.Include.header')

<style>
  .ud-st {
    font-size: .8rem;
    font-weight: 600;
    padding: .3rem .7rem;
  }

  .ud-st::before {
    content: "";
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
    margin-right: .4rem;
    display: inline-block;
    vertical-align: middle;
  }

  .ud-st-warning {
    background: #fff4d6;
    color: #a06a00;
  }

  .ud-accent {
    border-top: 4px solid var(--bs-success) !important;
  }
</style>

<div class="page-content p-4">
  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h3 class="mb-0">Payment Details</h3>
    <a href="payment.php" class="btn btn-outline-success btn-sm px-3">← Back to Payments</a>
  </div>

  <!-- Payment Details Card -->
  <div class="card border-0 shadow-sm rounded-4 ud-accent">
    <div class="card-body p-4">
      <div class="row g-4">

        <!-- Left: Payment Proof / Invoice -->
        <div class="col-md-4">
          <img src="assets/images/payment-proof.jpg" class="img-fluid w-100 rounded-4 shadow-sm" alt="Payment Proof">
        </div>

        <!-- Right: Payment Info -->
        <div class="col-md-8">
          <h4 class="fw-bold mb-1">Payment #PMT12345</h4>
          <p class="text-muted mb-4">Details of payment transaction for raw material order.</p>

          <!-- Amounts -->
          <div class="row g-3 mb-4">
            <div class="col-sm-4">
              <div class="bg-light rounded-3 p-3 h-100">
                <div class="text-muted small">Total Amount</div>
                <div class="fs-5 fw-bold">$2,50,000</div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="bg-light rounded-3 p-3 h-100">
                <div class="text-muted small">Paid Amount</div>
                <div class="fs-5 fw-bold text-success">$1,50,000</div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="bg-light rounded-3 p-3 h-100">
                <div class="text-muted small">Balance</div>
                <div class="fs-5 fw-bold">$1,00,000</div>
              </div>
            </div>
          </div>

          <!-- Details -->
          <div class="row g-3">
            <div class="col-sm-6">
              <div class="text-muted small">Order UID</div>
              <div class="fw-semibold">ORD56789</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Supplier Name</div>
              <div class="fw-semibold">ABC Traders</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Material</div>
              <div class="fw-semibold">Steel Rod (HR Grade)</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Quantity</div>
              <div class="fw-semibold">500 Kg</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Payment Method</div>
              <div class="fw-semibold">Bank Transfer</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Transaction ID</div>
              <div class="fw-semibold">TXN889900</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Payment Date</div>
              <div class="fw-semibold">10-Sep-2025</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small">Due Date</div>
              <div class="fw-semibold">20-Sep-2025</div>
            </div>
            <div class="col-sm-6">
              <div class="text-muted small mb-1">Status</div>
              <span class="ud-st ud-st-warning rounded-pill d-inline-block text-nowrap">Partially Paid</span>
            </div>
          </div>

          <div class="mt-4 d-flex gap-2 flex-wrap">
            <a href="uploads/payment-receipt.pdf" target="_blank" class="btn btn-outline-success btn-sm px-3">
              📄 View Receipt
            </a>
            <a href="edit-payment.php?id=PMT12345" class="btn btn-success btn-sm px-3">
              ✏️ Edit Payment
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@include('manufacturer.Include.footer')
