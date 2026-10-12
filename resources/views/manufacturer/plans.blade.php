@include('manufacturer.Include.header')
<body>
    <!-- Begin page -->
    <div class="wrapper active">

        <div class="page-content">

            
            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-bold mb-0">Plans </h4>
                </div>

                
            </div>
            

            

            <div class="page-container p-3">

              <div class="meetingPpage">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header d-flex flex-wrap align-items-center gap-2">
                                <h4 class="header-title me-auto">Plans</h4>                                
                            </div>

                      <!-- Form Row Start -->
<form id="planForm" class="mb-4">
    <div class="row g-2 align-items-end p-2">
      <div class="col-md-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Name" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Features</label>
        <input type="text" class="form-control" id="features" placeholder="Enter Features" required>
      </div>
      <div class="col-md-2">
        <label class="form-label">Plans</label>
        <select class="form-select" id="plans" required>
          <option value="" disabled selected>Select Plan</option>
          <option value="Basic">Basic</option>
          <option value="Standard">Standard</option>
          <option value="Premium">Premium</option>
        </select>
      </div>
      <div class="col-md-2">
        <label class="form-label">Call Limit</label>
        <input type="number" class="form-control" id="callLimit" placeholder="Enter Limit" required>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </div>
    </div>
  </form>
  <!-- Form Row End -->
  

                            <div class="card tableCustom mb-0">                               
                                   
                                    
    
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
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
                                            <td>1.</td>
                                            <td>Raw Material Suppliers</td>
                                            <td>No </td>
                                            <td>Yes</td>
                                            <td>10</td>
                                          </tr>
                                          <tr>
                                            <td>2.</td>
                                            <td>Raw Material Suppliers</td>
                                            <td>No </td>
                                            <td>Yes</td>
                                            <td>10</td>
                                          </tr>
                                          <tr>
                                            <td>3.</td>
                                            <td>Raw Material Suppliers</td>
                                            <td>No </td>
                                            <td>Yes</td>
                                            <td>10</td>
                                          </tr>
                                          <tr>
                                            <td>4.</td>
                                            <td>Raw Material Suppliers</td>
                                            <td>No </td>
                                            <td>Yes</td>
                                            <td>10</td>
                                          </tr>
                                         
                                        </tbody>
                                      </table>
                                      
                                    
                                      
                                      <!-- end table -->
                                </div>
    
                                
                            </div>

                            
                        </div>

                        



                       

                       
                    

                        


                    </div>
                    
                </div>
              </div>
                

            </div> <!-- container -->
@include('manufacturer.Include.footer')