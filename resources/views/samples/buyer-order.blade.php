@include($type === 'buyer' ? 'user.Include.header' : ($type === 'supplier' ? 'seller.Include.header' : 'manufacturer.Include.header'))
<div class="container py-4" style="max-width:1180px; margin-left:18% ">
    <h3>File &amp; Sample Sharing</h3>
    <p class="text-muted">Order #{{ $order->uid ?? $order->id }} · {{ $order->material->name ?? 'Product' }}</p>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sharing-files" type="button">File Sharing</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#samples" type="button">Samples</button></li>
    </ul>
    <div class="tab-content pt-3">
        <div class="tab-pane fade show active" id="sharing-files">
            @if($type==='buyer'||$type!=='buyer')
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5>Share a file</h5>
                    <form method="POST" action="{{ $type==='buyer'?route('user.orders.files.store',$order):route($type.'.orders.files.store',$order) }}" enctype="multipart/form-data" class="row g-2">@csrf<div class="col-md-3"><input class="form-control" name="title" placeholder="File title" required maxlength="255"></div>
                        <div class="col-md-4"><input class="form-control" name="description" placeholder="Description (optional)"></div>
                        <div class="col-md-3"><input class="form-control" type="file" name="file" required accept=".pdf,.png,.jpg,.jpeg,.webp,.doc,.docx,.xls,.xlsx,.csv,.txt"></div>
                        <div class="col-md-2"><button class="btn btn-success w-100">Upload</button></div>
                    </form><small class="text-muted">Private order files, up to 20 MB.</small>
                </div>
            </div>@endif
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Shared files</h5>@forelse($files as $file)<div class="border-bottom py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>{{ $file->title }}</strong> · {{ $file->original_filename }} <span class="badge bg-light text-dark">{{ ucfirst($file->status ?? 'shared') }}</span>
                                <div class="small text-muted">{{ ucfirst($file->uploaded_by_type) }} · {{ $file->created_at->format('d M Y H:i') }} · {{ $file->mime_type }}</div>@if($file->description)<div>{{ $file->description }}</div>@endif
                            </div>
                            <div class="d-flex gap-2"><a class="btn btn-sm btn-outline-primary" href="{{ route('sharing.files.download',$file) }}">Download</a>@if($type==='buyer'&&$file->uploaded_by_type==='buyer')<form method="POST" action="{{ route('user.sharing.files.destroy',$file) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this file?')">Delete</button></form>@endif</div>
                        </div>
                        <form method="POST" action="{{ $type==='buyer'?route('user.orders.messages.store',$order):route($type.'.orders.messages.store',$order) }}" class="row g-2 mt-2">@csrf<input type="hidden" name="sample_file_id" value="{{ $file->id }}">
                            <div class="col"><input name="message" class="form-control form-control-sm" placeholder="Comment on this file" required maxlength="5000"></div>
                            <div class="col-auto"><button class="btn btn-sm btn-outline-secondary">Comment</button></div>
                        </form>@foreach($messages->where('sample_file_id',$file->id) as $comment)<div class="small ms-2 mt-2"><strong>{{ ucfirst($comment->sender_type) }}:</strong> {{ $comment->message }}</div>@endforeach
                    </div>@empty<p class="text-muted mb-0">No files shared for this order yet.</p>@endforelse
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body">
                    <h5>Order messages</h5>@forelse($messages->whereNull('sample_file_id') as $message)<p><strong>{{ ucfirst($message->sender_type) }}:</strong> {{ $message->message }}</p>@empty<p class="text-muted">No general messages for this order.</p>@endforelse<form method="POST" action="{{ $type==='buyer'?route('user.orders.messages.store',$order):route($type.'.orders.messages.store',$order) }}" class="mt-3">@csrf<textarea class="form-control mb-2" name="message" rows="3" required maxlength="5000" placeholder="Write to the other party"></textarea><button class="btn btn-outline-success">Send message</button></form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="samples">
            <div class="row g-3">@forelse($samples as $sample)<div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm">@if($sample->image_path)<img src="{{ asset('storage/'.$sample->image_path) }}" class="card-img-top" alt="{{ $sample->name }}" style="height:190px;object-fit:cover">@endif<div class="card-body">
                            <h5>{{ $sample->name }}</h5>
                            <div class="small text-muted">{{ $sample->supplier->company_name ?? $sample->manufacturer->company_name ?? 'Seller' }} · {{ $sample->material->name ?? 'Product' }}</div>
                            <p class="my-2">{{ $sample->description }}</p>
                            <div><strong>Price:</strong> {{ number_format($sample->price,2) }} · <strong>Shipping:</strong> {{ number_format($sample->shipping_fee,2) }}</div>
                            <div><strong>Stock:</strong> {{ $sample->stock_quantity }} · <strong>Processing:</strong> {{ $sample->processing_days }} days</div>
                            <div class="small text-muted mt-2">{{ $sample->specifications }}</div>
                            @foreach($sample->files as $doc)<div class="small mt-2"><a href="{{ route('sharing.files.download',$doc) }}">Supporting file: {{ $doc->title }}</a></div>@endforeach
                            @if($type==='buyer')<form method="POST" action="{{ route('user.samples.purchase') }}" class="mt-3">@csrf<input type="hidden" name="sample_id" value="{{ $sample->id }}"><input type="hidden" name="original_order_id" value="{{ $order->id }}"><label class="form-label">Quantity</label><input type="number" name="quantity" value="1" min="1" max="{{ $sample->stock_quantity }}" class="form-control mb-2" required><textarea name="shipping_address" class="form-control mb-2" maxlength="3000" placeholder="Delivery address" required>{{ old('shipping_address',$order->shipping_address) }}</textarea>
                                <div class="small text-muted mb-2">Estimated total: quantity × sample price + shipping (confirmed server-side).</div><button class="btn btn-success w-100">Request sample purchase</button>
                            </form>@endif
                        </div>
                    </div>
                </div>@empty<div class="col-12">
                    <div class="alert alert-light">No active samples are currently available for this order's product and seller.</div>
                </div>@endforelse</div>{{ $samples->links() }}
            @if($type==='buyer'&&$purchases->isNotEmpty())<h5 class="mt-4">Your sample purchases</h5>@foreach($purchases as $purchase)<div class="card card-body mb-2"><a href="{{ route('user.samples.purchase.show',$purchase) }}">{{ $purchase->reference }} · {{ $purchase->sample->name ?? 'Sample' }} · {{ ucfirst(str_replace('_',' ',$purchase->order_status)) }} / {{ $purchase->payment_status }}</a></div>@endforeach
            @endif
        </div>
    </div>
</div>
@include($type === 'buyer' ? 'user.Include.footer' : ($type === 'supplier' ? 'seller.Include.footer' : 'manufacturer.Include.footer'))