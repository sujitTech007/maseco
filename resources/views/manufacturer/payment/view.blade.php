@include('manufacturer.Include.header')

<div class="page-content p-4">
  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Payment Details</h3>
    <a href="payment.php" class="btn btn-secondary btn-sm">← Back to Payments</a>
  </div>

  <!-- Payment Details Card -->
  <div class="card shadow">
    <div class="card-body">
      <div class="row g-4">

        <!-- Left: Payment Proof / Invoice -->
        <div class="col-md-4">
          <img src="assets/images/payment-proof.jpg" class="img-fluid rounded shadow-sm" alt="Payment Proof">
        </div>

        <!-- Right: Payment Info -->
        <div class="col-md-8">
          <h4>Payment #PMT12345</h4>
          <p class="text-muted">Details of payment transaction for raw material order.</p>

          <div class="row mb-2">
            <div class="col-6"><strong>Order ID:</strong> ORD56789</div>
            <div class="col-6"><strong>Supplier Name:</strong> ABC Traders</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Material:</strong> Steel Rod (HR Grade)</div>
            <div class="col-6"><strong>Quantity:</strong> 500 Kg</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Total Amount:</strong> $2,50,000</div>
            <div class="col-6"><strong>Paid Amount:</strong> $1,50,000</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Balance:</strong> $1,00,000</div>
            <div class="col-6"><strong>Payment Method:</strong> Bank Transfer</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Transaction ID:</strong> TXN889900</div>
            <div class="col-6"><strong>Payment Date:</strong> 10-Sep-2025</div>
          </div>

          <div class="row mb-2">
            <div class="col-6"><strong>Status:</strong> <span class="badge bg-warning">Partially Paid</span></div>
            <div class="col-6"><strong>Due Date:</strong> 20-Sep-2025</div>
          </div>

          <div class="mt-3 d-flex gap-2 flex-wrap">
            <a href="uploads/payment-receipt.pdf" target="_blank" class="btn btn-outline-primary btn-sm">
              📄 View Receipt
            </a>
            <a href="edit-payment.php?id=PMT12345" class="btn btn-primary btn-sm">
              ✏️ Edit Payment
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@include('manufacturer.Include.footer')
