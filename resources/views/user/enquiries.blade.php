@include('user.Include.header')



<div class="page-content">



<div class="container py-0">

    <h4 class="mb-1 fs-bold main-heading"> Enquiries</h2>
  <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">

                <a href="{{ route('user.dashboard') }}" style="color:#454545; text-decoration:none;">
                    Dashboard
                </a>

                <span style="padding:0 6px; color:#999; font-size:10px;">
                    ▶
                </span>

                <span style="color:#2DAC92;">
                    Enquiries
                </span>

            </div>
    <div class="table-responsive">

        <table class="table table-striped align-middle">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Subject</th>
                    
                    <th>Expected Price</th>
                    
                    <th>Quantity</th>

                    <th>Status</th>

                    <th>Date</th>

                </tr>

            </thead>

            <tbody>

                @forelse($enquiries as $enquiry)

                <tr>

                    <td>{{ $enquiry->id }}</td>

                    <td>{{ $enquiry->subject }}</td>
                    
                    <td>{{ $enquiry->expected_price }}</td>
                    
                    <td>{{ $enquiry->quantity }}</td>

                    <td>{{ ucfirst($enquiry->status) }}</td>

                    <td>{{ $enquiry->created_at->format('d M Y') }}</td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center">No enquiries found.</td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>



@include('user.Include.footer')





