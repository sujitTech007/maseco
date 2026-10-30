@include('user.Include.header')

<div class="page-content">
    <div class="container py-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h1 class="fw-bold mb-1 dashboard_title">My Wishlist</h1>
                <p class="text-muted mb-0">Keep track of your favourite materials and suppliers.</p>
            </div>
            <a href="{{ route('listing') }}" class="btn theme-btn"><i class="fa-solid fa-arrow-left me-2"></i>Continue Browsing</a>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        @php
        $supplierCount = $materials->map(fn($m) => $m->supplier_id ?: 'manufacturer-'.$m->manufacturer_id)->filter()->unique()->count();
        @endphp
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-success-subtle text-success rounded-3 p-3"><i class="fa-solid fa-boxes-stacked fa-xl"></i></div>
                        <div>
                            <p class="text-muted mb-1">Saved Materials</p>
                            <h4 class="fw-bold mb-0">{{ $materials->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-primary-subtle text-primary rounded-3 p-3"><i class="fa-solid fa-building fa-xl"></i></div>
                        <div>
                            <p class="text-muted mb-1">Suppliers</p>
                            <h4 class="fw-bold mb-0">{{ $supplierCount }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        <h5 class="fw-bold mb-1">Your Saved Materials</h5>
                        <p class="text-muted mb-0">{{ $materials->count() }} {{ \Illuminate\Support\Str::plural('material', $materials->count()) }} saved to your wishlist</p>
                    </div><a class="btn btn-outline-success" href="{{ route('user.compare') }}"><i class="fa-solid fa-scale-balanced me-1"></i>Compare Materials</a>
                </div>
            </div>
        </div>

        @if($materials->isEmpty())
        <div class="card border-0 shadow-sm text-center py-5">
            <div class="card-body"><i class="fa-regular fa-heart fa-3x text-muted mb-3"></i>
                <h5 class="fw-bold">Your wishlist is empty</h5>
                <p class="text-muted">Save materials while browsing and they will appear here.</p><a href="{{ route('listing') }}" class="btn theme-btn">Browse Materials</a>
            </div>
        </div>
        @else
        <div class="row g-4">
            @foreach($materials as $material)
            @php
            $supplier = $material->getRelation('supplier');
            $manufacturer = $material->manufacturer;
            $supplierName = optional($supplier)->company_name ?: (optional($supplier)->business_name ?: (optional($supplier)->name ?: ($material->supplier ?: (optional($manufacturer)->company_name ?: (optional($manufacturer)->name ?: 'Supplier')))));
            @endphp
            <div class="col-xl-4 col-md-6">
                <div class="card material-card h-100 border-0 shadow-sm">
                    <div class="material-image position-relative"><a href="{{ route('listing.details', $material->id) }}"><img src="{{ asset('public/' . $material->image) }}" class="card-img-top" alt="{{ $material->name }}" style="height:220px;object-fit:cover;" onerror="this.src='{{ asset('public/assets/images/placeholder.png') }}'"></a>
                        <div class="position-absolute top-0 start-0 p-2">
                            <form method="POST" action="{{ route('user.collection.toggle', ['collection'=>'wishlist','material'=>$material->id]) }}">@csrf<button type="submit" class="listing_badge border-0 rounded-circle shadow-sm" title="Remove from Wishlist"><i class="fa-solid fa-heart text-danger"></i></button></form>
                        </div>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">@if($material->is_certified)<div class="certified-badge mb-2"><img src="{{ asset('public/assets/images/certified-badge.png') }}" alt="Certified Listing" class="h-100 w-auto"></div>@endif<h5 class="fw-bold mb-2"><a href="{{ route('listing.details', $material->id) }}" class="text-dark text-decoration-none">{{ $material->name }}</a></h5>
                        <h4 class="text_color_primary fw-bold mb-3">${{ number_format((float)$material->price, 2) }} <small class="text-muted fs-6 fw-normal">/ {{ $material->unit }}</small></h4>
                        <div class="material-info mb-3">
                            <p class="mb-2 text-muted"><i class="fa-solid fa-location-dot text_color_primary me-2"></i>{{ $material->location ?: 'Location not specified' }}</p>
                            <p class="mb-2 text-muted"><i class="fa-solid fa-building text_color_primary me-2"></i><span class="text-dark fw-semibold">Supplier:</span> {{ $supplierName }}</p>
                            <p class="mb-0 text-muted"><i class="fa-solid fa-cubes text_color_primary me-2"></i><span class="text-dark fw-semibold">Grade / Size:</span> {{ $material->grade ?: '—' }} / {{ $material->size ?: '—' }}</p>
                        </div>
                        <div class="mt-auto"><a href="{{ route('listing.details', $material->id) }}" class="btn theme_btn text-white">View Details <i class="fa-solid fa-arrow-right ms-1"></i></a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@include('user.Include.footer')