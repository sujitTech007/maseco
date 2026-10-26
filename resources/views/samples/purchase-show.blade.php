@include($type === 'buyer' ? 'user.Include.header' : ($type === 'supplier' ? 'seller.Include.header' : 'manufacturer.Include.header'))
<div class="container py-4" style="max-width:1100px; margin-left:18% "><a class="btn btn-sm btn-outline-secondary mb-3" href="{{ $type==='buyer' ? ($purchase->original_order_id ? route('user.orders.sharing',$purchase->original_order_id) : route('user.samples.orders')) : ($type==='supplier'?route('seller.samples.index'):route('manufacturer.samples.index')) }}">Back</a>
    <h3>Sample purchase {{ $purchase->reference }}</h3>
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>{{ $purchase->sample->name ?? 'Sample' }}</h5>
                    <p>{{ $purchase->material->name ?? '' }}</p>
                    <dl class="row mb-0">
                        <dt class="col-6">Quantity</dt>
                        <dd class="col-6">{{ $purchase->quantity }}</dd>
                        <dt class="col-6">Subtotal</dt>
                        <dd class="col-6">{{ number_format($purchase->subtotal,2) }}</dd>
                        <dt class="col-6">Shipping</dt>
                        <dd class="col-6">{{ number_format($purchase->shipping_fee,2) }}</dd>
                        <dt class="col-6">Total</dt>
                        <dd class="col-6 fw-bold">{{ number_format($purchase->total_amount,2) }}</dd>
                        <dt class="col-6">Payment</dt>
                        <dd class="col-6">{{ ucfirst($purchase->payment_status) }}</dd>
                        <dt class="col-6">Status</dt>
                        <dd class="col-6">{{ ucfirst(str_replace('_',' ',$purchase->order_status)) }}</dd>
                        <dt class="col-6">Delivery address</dt>
                        <dd class="col-6">{{ $purchase->shipping_address }}</dd>@if($purchase->tracking_number)<dt class="col-6">Courier / Tracking</dt>
                        <dd class="col-6">{{ $purchase->courier }} · {{ $purchase->tracking_number }}</dd>@endif
                    </dl>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body">
                    <h5>Status history</h5>
                    <ol class="mb-0">@forelse($purchase->statusLogs as $log)<li class="mb-2"><strong>{{ ucfirst(str_replace('_',' ',$log->new_status)) }}</strong> · {{ $log->created_at->format('d M Y H:i') }} · {{ ucfirst($log->changed_by_type) }} @if($log->note)<div class="small text-muted">{{ $log->note }}</div>@endif</li>@empty<li>Purchase created</li>@endforelse</ol>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Actions</h5>
                    @if($type==='buyer' && $purchase->order_status==='awaiting_payment' && $purchase->payment_status!=='paid')<form method="POST" action="{{ route('user.samples.checkout',$purchase) }}">@csrf<button class="btn btn-success w-100">Pay {{ number_format($purchase->total_amount,2) }}</button></form>
                    <p class="small text-muted mt-2 mb-0">If online payment is unavailable, the order stays pending for admin confirmation.</p>@endif
                    @if($type!=='buyer' && $purchase->payment_status==='paid' && in_array($purchase->order_status,['processing','shipped'],true))<form method="POST" action="{{ route($type.'.samples.status',$purchase) }}" enctype="multipart/form-data" class="row g-2">@csrf<div class="col-12"><label class="form-label">Update status</label><select class="form-select" name="status" required>@if($purchase->order_status==='processing')<option value="shipped">Shipped</option>@elseif($purchase->order_status==='shipped')<option value="delivered">Delivered</option>@endif</select></div>
                        <div class="col-6"><input class="form-control" name="courier" placeholder="Courier" value="{{ $purchase->courier }}"></div>
                        <div class="col-6"><input class="form-control" name="tracking_number" placeholder="Tracking number" value="{{ $purchase->tracking_number }}"></div>
                        <div class="col-12"><input class="form-control" type="file" name="shipping_document" accept=".pdf,.png,.jpg,.jpeg,.webp,.doc,.docx"></div>
                        <div class="col-12"><button class="btn btn-primary w-100">Save shipment update</button></div>
                    </form>@endif
                    @if($type==='buyer' && $purchase->order_status==='shipped')<form class="mt-2" method="POST" action="{{ route('user.samples.status',$purchase) }}">@csrf<input type="hidden" name="status" value="delivered"><button class="btn btn-outline-success w-100">Confirm delivery</button></form>@endif
                    @if($type==='buyer' && $purchase->order_status==='awaiting_approval')<div class="alert alert-info mb-0">Waiting for seller approval. Payment is not collected yet.</div>@endif
                </div>
            </div>
            <!-- <div class="card border-0 shadow-sm mt-3">
                <div class="card-body">
                    <h5>Messages and files</h5>
                    <div class="mb-3">@forelse($purchase->messages as $message)<div class="border-bottom py-2"><strong>{{ ucfirst($message->sender_type) }}</strong> <span class="small text-muted">{{ $message->created_at->format('d M Y H:i') }}</span>
                            <p class="mb-1">{{ $message->message }}</p>@if($message->sample_file_id)<a href="{{ route('sharing.files.download',$message->sample_file_id) }}">Download attachment</a>@endif
                        </div>@empty<p class="text-muted">No messages yet.</p>@endforelse</div>
                    <form method="POST" action="{{ $type==='buyer'?route('user.samples.messages',$purchase):route($type.'.samples.messages',$purchase) }}" enctype="multipart/form-data">@csrf<textarea class="form-control mb-2" name="message" rows="3" maxlength="5000" required placeholder="Write a message"></textarea><input type="file" name="file" class="form-control mb-2" accept=".pdf,.png,.jpg,.jpeg,.webp,.doc,.docx,.xls,.xlsx,.csv,.txt"><button class="btn btn-outline-success">Send message</button></form>
                    @foreach($purchase->files as $file)<div class="small mt-2"><a href="{{ route('sharing.files.download',$file) }}">{{ $file->original_filename }}</a> · {{ ucfirst($file->uploaded_by_type) }}</div>@endforeach
                </div>
            </div> -->
        </div>
    </div>
</div>
@include($type === 'buyer' ? 'user.Include.footer' : ($type === 'supplier' ? 'seller.Include.footer' : 'manufacturer.Include.footer'))
