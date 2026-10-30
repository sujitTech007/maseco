@include('seller.Include.header')


<body>

  <!-- Begin page -->

  <div class="wrapper active">

    <div class="page-content">

      <div class="page-title-head d-flex align-items-center gap-2">

        <div class="flex-grow-1">

          <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
            <h3 class="mb-1">Plans</h3>

            <a href="{{ route('user.dashboard') }}" style="color:#555; text-decoration:none;">
              Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:14px;">
              ▶
            </span>

            <span style="color:#2DAC92;">
              Plans
            </span>

          </div>
        </div>

      </div>

      <div class="page-container p-3">

        <div class="meetingPpage">

          <div class="row">

            <div class="col-md-12">

              <div class="ud-table-wrap bg-white shadow-sm rounded-4 overflow-hidden">

                <div class="px-3 py-3 border-bottom">
                  <h5 class="header-title fw-bold mb-1">Plans</h5>
                  <p class="text-muted small mb-0">Add a plan and review the plans listed on your account.</p>
                </div>

                <!-- Form Row Start -->

                <form id="planForm" class="px-3 py-3 border-bottom bg-light rounded-0">

                  <div class="row g-3 align-items-end">

                    <div class="col-lg-3 col-md-6">

                      <label class="form-label fw-semibold small">Name</label>

                      <input type="text" class="form-control" id="name" placeholder="Enter Name" required>

                    </div>

                    <div class="col-lg-3 col-md-6">

                      <label class="form-label fw-semibold small">Features</label>

                      <input type="text" class="form-control" id="features" placeholder="Enter Features" required>

                    </div>

                    <div class="col-lg-2 col-md-4">

                      <label class="form-label fw-semibold small">Plans</label>

                      <select class="form-select" id="plans" required>

                        <option value="" disabled selected>Select Plan</option>

                        <option value="Basic">Basic</option>

                        <option value="Standard">Standard</option>

                        <option value="Premium">Premium</option>

                      </select>

                    </div>

                    <div class="col-lg-2 col-md-4">

                      <label class="form-label fw-semibold small">Call Limit</label>

                      <input type="number" class="form-control" id="callLimit" placeholder="Enter Limit" required>

                    </div>

                    <div class="col-lg-2 col-md-4">

                      <button type="submit" class="btn btn-success w-100 smtplan">Submit</button>

                    </div>

                  </div>

                </form>

                <!-- Form Row End -->

                <div class="ud-scroll">

                  <table class="ud-table">

                    <thead>

                      <tr>

                        <th>Sr No.</th>

                        <th>Name</th>

                        <th>Features</th>

                        <th>Plans</th>

                        <th>Enquiry</th>

                      </tr>

                    </thead>

                    <tbody>

                      <tr>

                        <td class="text-muted">1.</td>

                        <td class="fw-semibold">Raw Material Suppliers</td>

                        <td>No </td>

                        <td>Yes</td>

                        <td>10</td>

                      </tr>

                      <tr>

                        <td class="text-muted">2.</td>

                        <td class="fw-semibold">Raw Material Suppliers</td>

                        <td>No </td>

                        <td>Yes</td>

                        <td>10</td>

                      </tr>

                      <tr>

                        <td class="text-muted">3.</td>

                        <td class="fw-semibold">Raw Material Suppliers</td>

                        <td>No </td>

                        <td>Yes</td>

                        <td>10</td>

                      </tr>

                      <tr>

                        <td class="text-muted">4.</td>

                        <td class="fw-semibold">Raw Material Suppliers</td>

                        <td>No </td>

                        <td>Yes</td>

                        <td>10</td>

                      </tr>

                    </tbody>

                  </table>

                  <!-- end table -->

                </div>

              </div>

              <div
                class="bg-white shadow-sm rounded-4 p-3 mt-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                  <h6 class="fw-bold mb-1">Need help?</h6>
                  <p class="text-muted small mb-0">Questions about plans or limits? Email connect@maseco.ca.</p>
                </div>
                <a href="{{ url('contact-us') }}" class="btn btn-outline-success btn-sm px-3">Contact us</a>
              </div>

            </div>

          </div>
        </div>

      </div> <!-- container -->

      @include('seller.Include.footer')