@include('admin.Include.header')

<div class="page-content newsletter-page">
    <div class="page-container">
        <div class="container">
            <div>
                <h1 class="mb-1 dashboard_title">Sample Purchases</h1>
                <p>View and manage your sample purchases.</p>
            </div>

            <div class="buyer-panel">

                <div class="buyer-table-wrap">
                    <table class="table table-custom table-centered table-sm table-hover mb-0 dataTable"
                        id="complex-header-datatable"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Buyer</th>
                                <th>Sample / product</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>@forelse($purchases as $purchase)<tr>
                                <td>{{ $purchase->reference }}</td>
                                <td>{{ $purchase->buyer->name ?? 'Buyer #'.$purchase->buyer_id }}</td>
                                <td>{{ $purchase->sample->name ?? 'Sample' }}
                                    <div class="small text-muted">{{ $purchase->material->name ?? '' }}</div>
                                </td>
                                <td>{{ number_format($purchase->total_amount,2) }}</td>
                                <td>{{ ucfirst($purchase->payment_status) }}</td>
                                <td>{{ ucfirst(str_replace('_',' ',$purchase->order_status)) }}</td>
                                <td>@if($purchase->payment_status==='pending'&&$purchase->order_status==='awaiting_payment')<form method="POST" action="{{ route('admin.samples.payment.confirm',$purchase) }}" onsubmit="return confirm('Confirm that the payment was received outside the online gateway?')">@csrf<button class="btn btn-sm btn-success">Confirm manual payment</button></form>@else—@endif</td>
                            </tr>@empty<tr>
                                <td colspan="7" class="text-center text-muted">No sample purchases.</td>
                            </tr>@endforelse</tbody>
                    </table>
                </div>{{ $purchases->links() }}


            </div>
        </div>
    </div>
</div>


    @include('admin.Include.footer')