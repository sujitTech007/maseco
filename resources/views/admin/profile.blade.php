@include('admin.Include.header')

        <div class="page-content">
            <div class="myaccountPage p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="userProfile">
                        <div class="userThumb">
                            <img src="assets/images/user.png" alt="">
                        </div>
                        <div class="userName">
                            <h3>Alexa Rawles</h3>
                            <p><i class="ri-mail-line"></i> alexarawles@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="dashboardForms py-5"> 
                    <form id="survey-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="name-label" for="name">First Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter First Name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="name-label" for="lastname">Last Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Last Name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="email-label" for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="email-label" for="phone">Phone No</label>
                                    <input type="number" name="phone" id="email" placeholder="Enter your Phone" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select id="dropdown" name="role" class="form-control" required>
                                        <option value="United States">United States</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antartica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State</label>
                                    <select id="dropdown" name="role" class="form-control" required>
                                        <option disabled selected value>Select</option>
                                        <option value="United States">United States</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antartica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                    </select>
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