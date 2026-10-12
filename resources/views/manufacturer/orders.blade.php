@include('manufacturer.Include.header')



<div class="page-content">



  <div class="page-title-head d-flex align-items-center gap-2">

    <div class="flex-grow-1">

      <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
        <h3 class="mb-1">Orders </h3>

        <a href="https://maseco.ca/UAT/manufacturer/dashboard" style="color:#555; text-decoration:none;">
          Dashboard
        </a>

        <span style="padding:0 6px; color:#999; font-size:14px;">
          ▶
        </span>

        <span style="color:#2DAC92;">
          Orders
        </span>

      </div>
    </div>





  </div>









  <div class="page-container p-3">



    <div class="meetingPpage">

      <div class="row">

        <div class="col-md-12">



          <div class="card">

            <div class="card-header d-flex flex-wrap align-items-center gap-2">

              <h4 class="header-title me-auto">Orders</h4>

            </div>







            <div class="card tableCustom mb-0">







              <div class="table-responsive" style="border-bottom-left-radius: 10px !important;border-bottom-right-radius: 10px !important;border-top-left-radius: 10px;border-top-right-radius: 10px; 0;">

                <table class="table table-custom table-centered table-sm table-nowrap table-hover mb-0 dataTable" style="width: 100%;">

                  <thead>

                    <tr>

                      <th>ID</th>

                      <th>Buyer</th>

                      <th>Material</th>

                      <th>Quantity</th>

                      <th>Amount</th>

                      <th>Date</th>

                      <th>Status</th>

                    </tr>

                  </thead>

                  <tbody>

                    @php

                    $manufacturer = Auth::guard('manufacturer')->user();

                    $orders = \App\Models\Order::where('manufacturer_id', $manufacturer->id)->latest()->get();

                    @endphp

                    @foreach($orders as $o)

                    <tr>

                      <td>{{ $o->id }}</td>

                      <td>{{ optional($o->user)->name ?? 'User #'.$o->user_id }}</td>

                      <td>{{ optional(\App\Models\Material::find($o->material_id))->name }}</td>

                      <td>{{ $o->quantity ?? '-' }}</td>

                      <td>

                        ${{ number_format($o->amount ?? 0, 2) }}

                        <div class="text-muted small">Payment: {{ ucfirst($o->payment_status ?? 'pending') }}</div>

                      </td>

                      <td>{{ $o->created_at?->format('d M Y') }}</td>

                      <td><span class="badge bg-{{ ($o->payment_status ?? 'pending') === 'paid' ? 'success' : 'warning' }}">{{ ucfirst($o->status) }}</span></td>

                    </tr>

                    @endforeach

                  </tbody>

                </table>





                <!-- end table -->

              </div>





            </div>





          </div>



























        </div>
      </div>
    </div>
  </div>
  @include('manufacturer.Include.footer')
  <script>
    new DataTable('#payment-datatable');
  </script>