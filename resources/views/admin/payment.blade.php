@include('admin.Include.header')



<div class="page-content">




     <div class="flex-grow-1">

                            <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
                                <h3 class="mb-1">Payments</h3>

                                <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
                                    Dashboard
                                </a>

                                <span style="padding:0 6px; color:#999; font-size:14px;">
                                    ▶
                                </span>

                                <span style="color:#2DAC92;">
                                    Payments
                                </span>

                            </div>
                            </h4>

                        </div>
    <div class="meetingPpage">

        <div class="row">

            <div class="col-md-12">



                <div class="card" style="
    background: white;
    
 box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);    border-radius: 20px;
">

                    <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">

                   



                        <!-- <div class="d-flex flex-wrap flex-lg-nowrap gap-2">



                                    <a href="add-team.php" class="btn themeBtn"><i

                                            class="ri-add-line me-1"></i>Subscription Management

                                    </a>

                                </div>     -->

                        <!-- end d-flex -->

                    </div>



                    <div class="card-body p-0 tableCustom">



                        <div class="table-responsive pt-2">

                            <div id="complex-header-datatable_wrapper" class="dt-container dt-empty-footer">

                                <div class="dt-layout-row">

                                    <div class="dt-layout-cell dt-layout-start">

                                        <div class="dt-length"><select aria-controls="complex-header-datatable"

                                                class="dt-input" id="dt-length-0">

                                                <option value="10">10</option>

                                                <option value="25">25</option>

                                                <option value="50">50</option>

                                                <option value="100">100</option>

                                            </select><label for="dt-length-0"> entries per page</label></div>

                                    </div>

                                    <div class="dt-layout-cell dt-layout-end">

                                        <div class="dt-search"><label for="dt-search-0">Search:</label><input

                                                type="search" class="dt-input" id="dt-search-0" placeholder=""

                                                aria-controls="complex-header-datatable"></div>

                                    </div>

                                </div>

                                <div class="dt-layout-row dt-layout-table">

                                    <div class="dt-layout-cell  dt-layout-full">

                                        <table class="table table-custom table-centered table-sm table-nowrap table-hover mb-0 dataTable" id="payment-table" style="width: 100%;">

                                            <thead>

                                                <tr>

                                                    <th>ID</th>

                                                    <th>Order</th>

                                                    <th>User</th>

                                                    <th>Status</th>

                                                    <th>Amount</th>

                                                    <th>Provider</th>

                                                    <th>Transaction</th>

                                                    <th>Date/Time</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                @foreach(($payments ?? []) as $p)

                                                <tr>

                                                    <td>{{ $p->id }}</td>

                                                    <td>#{{ $p->order_id }}</td>

                                                    <td>{{ optional(optional($p->order)->user)->name ?? 'User #'.optional($p->order)->user_id }}</td>

                                                    <td><span class="badge bg-{{ $p->status==='paid'?'success':'warning' }}">{{ ucfirst($p->status) }}</span></td>

                                                    <td>${{ number_format($p->amount, 2) }}</td>

                                                    <td>{{ strtoupper($p->provider ?? '-') }}</td>

                                                    <td><code>{{ $p->transaction_id ?? '-' }}</code></td>

                                                    <td>{{ $p->created_at->format('d M Y H:i') }}</td>

                                                </tr>

                                                @endforeach

                                            </tbody>

                                        </table>



                                    </div>

                                </div>

                                <div class="dt-layout-row">

                                    <div class="dt-layout-cell dt-layout-start">

                                        <div class="dt-info" aria-live="polite"

                                            id="complex-header-datatable_info" role="status">Showing 1 to 3 of 3

                                            entries</div>

                                    </div>

                                    <div class="dt-layout-cell dt-layout-end">

                                        <div class="dt-paging">

                                            <nav aria-label="pagination"><button

                                                    class="dt-paging-button disabled first" role="link"

                                                    type="button" aria-controls="complex-header-datatable"

                                                    aria-disabled="true" aria-label="First" data-dt-idx="first"

                                                    tabindex="-1">«</button><button

                                                    class="dt-paging-button disabled previous" role="link"

                                                    type="button" aria-controls="complex-header-datatable"

                                                    aria-disabled="true" aria-label="Previous"

                                                    data-dt-idx="previous" tabindex="-1">‹</button><button

                                                    class="dt-paging-button current" role="link" type="button"

                                                    aria-controls="complex-header-datatable" aria-current="page"

                                                    data-dt-idx="0">1</button><button

                                                    class="dt-paging-button disabled next" role="link"

                                                    type="button" aria-controls="complex-header-datatable"

                                                    aria-disabled="true" aria-label="Next" data-dt-idx="next"

                                                    tabindex="-1">›</button><button

                                                    class="dt-paging-button disabled last" role="link"

                                                    type="button" aria-controls="complex-header-datatable"

                                                    aria-disabled="true" aria-label="Last" data-dt-idx="last"

                                                    tabindex="-1">»</button></nav>

                                        </div>

                                    </div>

                                </div>

                                <div class="dt-autosize" style="width: 100%; height: 0px;"></div>

                            </div>



                        </div> <!-- end table-responsive-->



                    </div> <!-- end card-body-->





                </div>



























            </div>



        </div>

    </div>



    <!-- <div class="myaccountPage p-4">

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

                    <div class="editBtn">

                        <button class="lab-btn"><i class="ri-pencil-line"></i> Edit</button>

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

               </div> -->







</div> <!-- container -->

@include('admin.Include.footer')