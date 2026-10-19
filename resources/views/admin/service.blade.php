@include('admin.Include.header')

        <div class="page-content">

            
            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-bold mb-0">Services 
                    </h4>
                </div>

                
            </div>
            

            

            <div class="page-container p-3">

              <div class="meetingPpage">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                                <div class="flex-grow-1">
                                    <h4 class="header-title">Services 
                                    </h4>
                                </div>

                                <div class="d-flex flex-wrap flex-lg-nowrap gap-2">
                                    
                                    <a href="add-plan.php" class="btn themeBtn"><i class="fa-solid fa-plus me-1"></i>Add New
                                    </a>
                                </div><!-- end d-flex -->
                            </div>

                            <div class="card-body p-0 tableCustom">
                               
                                <div class="table-responsive pt-2">
                                <!-- Service List -->


<!-- Textile Services Table -->
<table class="table table-custom table-centered table-sm table-nowrap table-hover mb-0 dataTable" id="complex-header-datatable" aria-describedby="complex-header-datatable_info" style="width: 100%;">
   
    <thead>
        <tr>
            <th>Sr. No</th>
            <th>Name</th>
            <th>Description</th> 
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Raw Material Suppliers</td>
            <td>Suppliers providing raw materials for textile manufacturing.</td>
            
            <td>
                <a href="javascript:void(0);" class="btn btn-soft-primary btn-icon btn-sm rounded-circle">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Reducing Textiles</td>
            <td>Reducing textile waste through recycling and reusing materials.</td>
            
            <td>
                <a href="javascript:void(0);" class="btn btn-soft-primary btn-icon btn-sm rounded-circle">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>AI Driven Suggestions</td>
            <td>Using AI to provide tailored textile solutions and product recommendations.</td>
             
            <td>
                <a href="javascript:void(0);" class="btn btn-soft-primary btn-icon btn-sm rounded-circle">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Manufacturers</td>
            <td>Manufacturers of various textile products.</td>
            
            <td>
                <a href="javascript:void(0);" class="btn btn-soft-primary btn-icon btn-sm rounded-circle">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Post Production Services</td>
            <td>Services provided after the production of textiles, such as packaging and shipping.</td>
             
            <td>
                <a href="javascript:void(0);" class="btn btn-soft-primary btn-icon btn-sm rounded-circle">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </td>
        </tr>
    </tbody>
</table>

                                    
                                    
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-body-->

                            
                        </div>

                        



                       

                       
                    

                        


                    </div>
                   
                </div>
              </div>
                

            </div> <!-- container -->
@include('admin.Include.footer')