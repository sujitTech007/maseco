@include('admin.Include.header')



<div class="page-content p-4">

  <!-- Page Header -->

  <div class="d-flex justify-content-between align-items-center mb-3">

<div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
      <h3 class="mb-1"> Material Details</h3>

      <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
        Dashboard
      </a>

      <span style="padding:0 6px; color:#999; font-size:14px;">
        ▶
      </span>

      <span style="color:#2DAC92;">
        Materials Details
      </span>

    </div>
    <a href="raw-material-listing.php" class="btn btn-secondary btn-sm">← Back to List</a>

  </div>



  <!-- Material Details Card -->

  <div class="card shadow">

    <div class="card-body">

      <div class="row g-4">

        

        <!-- Left: Image -->

        <div class="col-md-4">

          <img src="assets/images/material1.jpg" class="img-fluid rounded shadow-sm" alt="Material Image">

        </div>



        <!-- Right: Details -->

        <div class="col-md-8">

          <h4>Cotton Fabric (Organic)</h4>

          <p class="text-muted">High quality organic cotton fabric suitable for garments and textile applications.</p>



          <div class="row mb-2">

            <div class="col-6"><strong>Material Code / SKU:</strong> COT123</div>

            <div class="col-6"><strong>Category:</strong> Fabric</div>

          </div>



          <div class="row mb-2">

            <div class="col-6"><strong>Sub-Category:</strong> Organic</div>

            <div class="col-6"><strong>Grade / Quality:</strong> High</div>

          </div>



          <div class="row mb-2">

            <div class="col-6"><strong>Strength / Durability:</strong> 120 GSM</div>

            <div class="col-6"><strong>Size / Dimensions:</strong> 100m x 1.5m</div>

          </div>



          <div class="row mb-2">

            <div class="col-6"><strong>Weight / Unit:</strong> Meter</div>

            <div class="col-6"><strong>Price per Unit:</strong> $50</div>

          </div>



          <div class="row mb-2">

            <div class="col-6"><strong>Minimum Order Qty:</strong> 100 m</div>

            <div class="col-6"><strong>Available Stock:</strong> 1000 m</div>

          </div>



          <div class="row mb-2">

            <div class="col-6"><strong>Supplier:</strong> ABC Suppliers</div>

            <div class="col-6"><strong>Location:</strong> Delhi, India</div>

          </div>



          <div class="row mb-2">

            <div class="col-6"><strong>Lead Time:</strong> 7 Days</div>

            <div class="col-6"><strong>Certification:</strong> ISO 9001</div>

          </div>



          <div class="row mb-2">

            <div class="col-12"><strong>Safety / Handling Instructions:</strong> Keep in dry place, avoid direct sunlight.</div>

          </div>



          <div class="row mb-2">

            <div class="col-6"><strong>Status:</strong> <span class="badge bg-success">Active</span></div>

            <div class="col-6"><strong>Last Updated:</strong> 12-Sep-2025</div>

          </div>



          <div class="mt-3 d-flex gap-2 flex-wrap">

            <a href="uploads/cotton-fabric-brochure.pdf" target="_blank" class="btn btn-outline-primary btn-sm mtrlbtn">

              📄 View Brochure

            </a>

            <a href="add-new-material.php?id=COT123" class="btn btn-primary btn-sm mtrlbtn">

              ✏️ Edit Material

            </a>

          </div>

        </div>



      </div>

    </div>

  </div>

</div>



@include('admin.Include.footer')

