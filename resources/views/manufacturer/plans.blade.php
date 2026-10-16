@include('manufacturer.Include.header')

<style>
  .ud-scroll {
    overflow-x: auto;
  }

  .ud-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
    border: 0 !important;
    background: transparent;
  }

  .ud-table th,
  .ud-table td {
    border: 0 !important;
    border-bottom: 1px solid #eef0f3 !important;
    padding: .9rem 1rem !important;
    text-align: left;
    vertical-align: middle;
    background: transparent;
    box-shadow: none !important;
  }

  .ud-table thead {
    background-color: rgb(76 76 92);
  }

  .ud-table th {
    color: #fff;
    font-weight: 700;
    font-size: .85rem;
  }

  .ud-table tbody tr:last-child td {
    border-bottom: 0 !important;
  }

  .ud-table tbody tr:hover td {
    background: #f3faf8 !important;
  }
</style>

<body>

  <!-- Begin page -->

  <div class="wrapper active">

    <div class="page-content mt-3">

      <div class="page-title-head d-flex align-items-center gap-2">

        <div class="flex-grow-1">

          <h4 class="fs-18 fw-bold mb-0">Plans </h4>
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

                      <button type="submit" class="btn btn-success w-100">Submit</button>

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

      @include('manufacturer.Include.footer')