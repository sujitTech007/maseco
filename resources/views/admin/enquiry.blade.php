@include('admin.Include.header')

<!-- Begin page -->



<div class="page-content">


    <div class="flex-grow-1">

              <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
                <h3 class="mb-1">Enquiry</h3>

                <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
                  Dashboard
                </a>

                <span style="padding:0 6px; color:#999; font-size:14px;">
                  ▶
                </span>

                <span style="color:#2DAC92;">
                  Enquiry
                </span>

              </div>
              </h4>

            </div>


  <div class="meetingPpage">

    <div class="row">

      <div class="col-md-12">



        <div class="card" style="border-radius: 20px;">

          <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">

        

          </div>



          <div class="card-body p-0 tableCustom">



            <div class="table-responsive pt-2">

              <div id="complex-header-datatable_wrapper" class="dt-container dt-empty-footer">



                <div class="dt-layout-row dt-layout-table">

                  <div class="dt-layout-cell  dt-layout-full">

                    <div class="table-responsive pt-2">

                      <div class="dt-container dt-empty-footer">

                        <div class="dt-layout-row">

                          <div class="dt-layout-cell dt-layout-start">

                            <div class="dt-length">

                              <select aria-controls="textile-enquiry-table" class="dt-input" id="dt-length-0">

                                <option value="10">10</option>

                                <option value="25">25</option>

                                <option value="50">50</option>

                                <option value="100">100</option>

                              </select>

                              <label for="dt-length-0"> entries per page</label>

                            </div>

                          </div>

                          <div class="dt-layout-cell dt-layout-end">

                            <div class="dt-search">

                              <label for="dt-search-0">Search:</label>

                              <input type="search" class="dt-input" id="dt-search-0" placeholder="" aria-controls="textile-enquiry-table">

                            </div>

                          </div>

                        </div>



                        <div class="dt-layout-row dt-layout-table">

                          <div class="dt-layout-cell dt-layout-full">

                            <table class="table table-custom table-centered table-sm table-nowrap table-hover mb-0 dataTable" id="textile-enquiry-table" style="width: 100%;">

                              <thead>

                                <tr>

                                  <th>ID</th>

                                  <th>User</th>

                                  <th>Material</th>

                                  <th>Quantity</th>

                                  <th>Expected Price</th>

                                  <th>Status</th>

                                  <th>Date</th>

                                </tr>

                              </thead>

                              <tbody>

                                @foreach(($enquiries ?? []) as $e)

                                <tr>

                                  <td>{{ $e->id }}</td>

                                  <td>{{ optional($e->user)->name ?? 'User #'.$e->user_id }}</td>

                                  <td>{{ optional(\App\Models\Material::find($e->material_id))->name }}</td>

                                  <td>{{ $e->quantity ?? '-' }}</td>

                                  <td>${{ number_format($e->expected_price ?? 0, 2) }}</td>

                                  <td>{{ ucfirst($e->status ?? 'pending') }}</td>

                                  <td>{{ $e->created_at?->format('d M Y') }}</td>

                                </tr>

                                @endforeach

                              </tbody>

                            </table>

                          </div>

                        </div>





                      </div>

                    </div>



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



</div> <!-- container -->

@include('admin.Include.footer')