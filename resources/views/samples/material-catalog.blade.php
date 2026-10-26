@include('user.Include.header')
<div class="container py-4" style="max-width:1180px;margin-left:18% "><a class="btn btn-sm btn-outline-secondary mb-3" href="{{ route('listing.details',$material->id) }}">Back to product</a>
    <h3>Available Samples</h3>
    <p class="text-muted">{{ $material->name }} · select a sample to request a purchase.</p>
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="row g-3">@forelse($samples as $sample)<div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 shadow-sm">@if($sample->image_path)<img src="{{ asset('storage/'.$sample->image_path) }}" alt="{{ $sample->name }}" class="card-img-top" style="height:190px;object-fit:cover">@endif<div class="card-body">
                    <h5>{{ $sample->name }}</h5>
                    <div class="small text-muted">{{ $sample->supplier->company_name ?? $sample->manufacturer->company_name ?? 'Seller' }} · {{ $material->name }}</div>
                    <p>{{ $sample->description }}</p>
                    <div>Sample {{ number_format($sample->price,2) }} · Shipping {{ number_format($sample->shipping_fee,2) }}</div>
                    <div class="small text-muted">Stock {{ $sample->stock_quantity }} · Processing {{ $sample->processing_days }} days</div>
                    <div class="small mt-2">{{ $sample->specifications }}</div>@foreach($sample->files as $doc)<div class="small mt-2"><a href="{{ route('sharing.files.download',$doc) }}">{{ $doc->title }}</a></div>@endforeach
                    <form method="POST" action="{{ route('user.samples.purchase') }}" class="mt-3">@csrf<input type="hidden" name="sample_id" value="{{ $sample->id }}"><label class="form-label">Quantity</label><input class="form-control mb-2" type="number" name="quantity" min="1" max="{{ $sample->stock_quantity }}" value="1" required><textarea class="form-control mb-2" name="shipping_address" placeholder="Delivery address" maxlength="3000" required>{{ old('shipping_address',auth()->user()->address ?? '') }}</textarea>
                        <p class="small text-muted">Final total is calculated on the server: sample price × quantity + shipping.</p><button class="btn btn-success w-100">Request Sample Purchase</button>
                    </form>
                </div>
            </div>
        </div>@empty<div class="col-12">
            <div class="alert alert-light">No active samples are currently listed for this product.</div>
        </div>@endforelse</div>{{ $samples->links() }}
</div>
@include('user.Include.footer')