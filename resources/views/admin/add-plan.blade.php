@include('admin.Include.header')
    
    

            

            <div class="myaccountPage p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="userProfile">
                        <!-- <div class="userThumb">
                            <img src="assets/images/user.png" alt="">
                        </div> -->
                        <!-- <div class="userName">
                            <h3>Alexa Rawles</h3>
                            <p><i class="ri-mail-line"></i> alexarawles@gmail.com</p>
                        </div>
                    </div> -->
                    
                </div>
                <div class="dashboardForms py-5"> 
                    <form id="survey-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="name-label" for="name"> Name</label>
                                    <input type="text" name="firstName" id="name" placeholder="Enter First Name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Title</label>
                                    <input type="text" name="Title" id="lastname" placeholder="Enter Title" class="form-control" required>
                                </div>
                            </div>
                           
                    
                            <!-- Subscription -->
                           
                    
                            <!-- Call Count -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="callCount">Call Count</label>
                                    <input type="number" name="callCount" id="callCount" placeholder="Enter Call Count" class="form-control">
                                </div>
                            </div>
                    
                            <!-- Register Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="registerDate">Register Date</label>
                                    <input type="date" name="registerDate" id="registerDate" class="form-control">
                                </div>
                            </div>
                    
                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="status">Status</label>
                                  <select name="status"  class="form-control" style="display: block;">
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subscription">Subscription</label>
                                    <input type="text" name="subscription" id="subscription" placeholder="Enter Subscription Type" class="form-control">
                                </div>
                            </div>
                        </div>
                     
                    
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <button type="submit" id="submit" class="lab-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
               </div>



        </div> <!-- container -->
@include('admin.Include.footer')