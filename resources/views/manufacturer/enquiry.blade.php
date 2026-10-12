@include('manufacturer.Include.header')

<!-- Begin page -->

<div class="wrapper active">



    <!-- Menu -->



    <!-- Topbar Start -->



    <!-- Topbar End -->











    <!-- ============================================================== -->

    <!-- Start Page Content here -->

    <!-- ============================================================== -->



    <div class="page-content">


        <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
            <h3 class="mb-1">RFQ Management </h3>

            <a href="https://maseco.ca/UAT/manufacturer/dashboard" style="color:#555; text-decoration:none;">
                Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:14px;">
                ▶
            </span>

            <span style="color:#2DAC92;">
                RFQ Management
            </span>

        </div>


        <div class="meetingPpage">

            <div class="row">

                <div class="col-md-12">



                    <div class="card mt-4" style="border-bottom-left-radius: 10px !important;border-bottom-right-radius: 10px !important;border-top-left-radius: 10px;border-top-right-radius: 10px; 0;">

                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h4 class="mb-0">RFQ Management</h4>

                            <!-- <a href="new-rfq.php">

                                <button class="btn btn-primary btn-sm">+ New RFQ</button>



                            </a> -->

                        </div>

                        <div class="card-body">

                            <div class="table-responsive" style="border-bottom-left-radius: 10px !important;border-bottom-right-radius: 10px !important;border-top-left-radius: 10;border-top-right-radius: 10px; 0;">

                                <table class="table table-bordered text-center align-middle" id="rfqTable">

                                    <thead class="table" style="background:#E7E7E7 !important">

                                        <tr>

                                            <th>ID</th>

                                            <th>Buyer</th>

                                            <th>Material</th>

                                            <th>Quantity</th>

                                            <th>Expected Price</th>

                                            <th>Date</th>

                                            <th>Status</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @php

                                        $manu = Auth::guard('manufacturer')->user();

                                        $enquiries = \App\Models\Enquiry::where('manufacturer_id', $manu->id)->latest()->get();

                                        @endphp

                                        @foreach($enquiries as $eq)

                                        <tr>

                                            <td>{{ $eq->id }}</td>

                                            <td>{{ optional($eq->user)->name ?? 'User #'.$eq->user_id }}</td>

                                            <td>{{ optional(\App\Models\Material::find($eq->material_id))->name }}</td>

                                            <td>{{ $eq->quantity ?? '-' }}</td>

                                            <td>${{ number_format($eq->expected_price ?? 0, 2) }}</td>

                                            <td>{{ $eq->created_at?->format('d M Y') }}</td>

                                            <td><span class="badge bg-{{ $eq->status === 'approved' ? 'success' : 'warning' }}">{{ ucfirst($eq->status) }}</span></td>

                                            <td>

                                                 @if($eq->status !== 'approved')

                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#approveModal{{ $eq->id }}">Approve & Create Order</button>



                                                <!-- Approve Modal -->

                                                <div class="modal fade" id="approveModal{{ $eq->id }}" tabindex="-1" aria-hidden="true">

                                                    <div class="modal-dialog">

                                                        <div class="modal-content">

                                                            <div class="modal-header">

                                                                <h5 class="modal-title">Approve RFQ #{{ $eq->id }}</h5>

                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                            </div>

                                                            <form method="POST" action="{{ route('manufacturer.enquiry.approve', $eq->id) }}">

                                                                @csrf

                                                                <div class="modal-body text-start">

                                                                    <div class="mb-3">

                                                                        <label class="form-label">Quantity</label>

                                                                        <input type="number" step="0.01" name="quantity" class="form-control" value="{{ $eq->quantity }}" required>

                                                                    </div>

                                                                    <div class="mb-3">

                                                                        <label class="form-label">Order Amount ($)</label>

                                                                        <input type="number" step="0.01" name="amount" class="form-control" value="{{ $eq->expected_price ?? 0 }}" required>

                                                                    </div>

                                                                    <small class="text-muted">This will approve the enquiry and create an order for the buyer.</small>

                                                                </div>

                                                                <div class="modal-footer">

                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                                                                    <button type="submit" class="btn btn-primary">Confirm & Create</button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>

                                                </div>

                                                @else

                                                Approved

                                                @endif
                                                
                                                
                                                
                                                
                                                

                                            </td>

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





    </div> <!-- container -->

    @include('manufacturer.Include.footer')