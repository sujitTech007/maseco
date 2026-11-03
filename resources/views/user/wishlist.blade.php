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

    <!-- Saved Materials -->
    <div class="col-md-3">
        <div class="card border-0 shadow-none rounded-4 h-100 bg-success bg-opacity-10">
            <div class="card-body d-flex align-items-center gap-3 p-3">
                <div class="text-success fs-2">
                    <i class="fa-solid fa-boxes-stacked fa-xl"></i>
                </div>
                <div>
                    <p class="text-secondary mb-1 small fw-semibold">Saved Materials</p>
                    <h3 class="fw-bold text-success mb-0 fs-1">{{ $materials->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Suppliers -->
    <div class="col-md-3">
        <div class="card border-0 shadow-none rounded-4 h-100 bg-primary bg-opacity-10">
            <div class="card-body d-flex align-items-center gap-3 p-3">
                <div class="text-primary fs-2">
                    <i class="fa-solid fa-truck-field fa-xl"></i>
                </div>
                <div>
                    <p class="text-secondary mb-1 small fw-semibold">Total Suppliers</p>
                    <h3 class="fw-bold text-primary mb-0 fs-1">{{ $supplierCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Wishlist Information -->
    <div class="col-md-6">
        <div class="card border-0 shadow-none rounded-4 h-100 bg-warning bg-opacity-10">
            <div class="card-body d-flex align-items-center gap-3 p-3">
                <div class="text-warning fs-2">
                    <i class="fa-solid fa-heart fa-xl"></i>
                </div>

                <div class="flex-grow-1">
                    <h5 class="fw-bold text-dark mb-1">
                        Your Saved Materials
                    </h5>

                    <p class="text-secondary small mb-2">
                        <i class="fa-solid fa-bookmark me-1"></i>
                        {{ $materials->count() }}
                        {{ \Illuminate\Support\Str::plural('material', $materials->count()) }}
                        saved to your wishlist
                    </p>

                    <a href="{{ route('user.compare') }}"
                       class="btn btn-outline-success btn-sm rounded-pill px-3">
                        <i class="fa-solid fa-scale-balanced me-1"></i>
                        Compare Materials
                        <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
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
                <div class="card material-card border-0 shadow-sm">
                    <div class="material-image position-relative"><a href="{{ route('listing.details', $material->id) }}"><img src="{{ asset('public/' . $material->image) }}" class="card-img-top" alt="{{ $material->name }}" style="height:220px;object-fit:cover;" onerror="this.onerror=null;this.src='{{ asset('public/assets/images/material-1.png') }}'"></a>
                        <div class="position-absolute top-0 start-0 p-2">
                            <form method="POST" class="p-0 bg-transparent" action="{{ route('user.collection.toggle', ['collection'=>'wishlist','material'=>$material->id]) }}">@csrf<button type="submit" class="listing_badge border-0 rounded-circle shadow-sm wishlist-form-icons" title="Remove from Wishlist"><i class="fa-solid fa-heart text-danger"></i></button></form>
                        </div>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">@if($material->is_certified)<div class="certified-badge mb-2"><img src="{{ asset('public/assets/images/certified-badge.png') }}" alt="Certified Listing" class="h-100 w-auto"></div>@endif<h5 class="fw-bold mb-2"><a href="{{ route('listing.details', $material->id) }}" class="text-dark text-decoration-none">{{ $material->name }}</a></h5>
                        <h4 class="text_color_primary fw-bold mb-2 fs-3">${{ number_format((float)$material->price, 2) }} <small class="text-muted fs-6 fw-normal">/ {{ $material->unit }}</small></h4>
                        <div class="material-info mb-1">
                            <p class="mb-1 text-muted"><i class="fa-solid fa-location-dot text_color_primary me-2"></i>{{ $material->location ?: 'Location not specified' }}</p>
                            <p class="mb-1 text-muted"><i class="fa-solid fa-building text_color_primary me-2"></i><span class="text-dark fw-semibold">Supplier:</span> {{ $supplierName }}</p>
                            <p class="mb-0 text-muted"><i class="fa-solid fa-cubes text_color_primary me-2"></i><span class="text-dark fw-semibold">Grade / Size:</span> {{ $material->grade ?: '—' }} / {{ $material->size ?: '—' }}</p>
                        </div>
                        <div class="mt-2"><a href="{{ route('listing.details', $material->id) }}" class="btn theme-btn">View Details <i class="fa-solid fa-arrow-right ms-1"></i></a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@include('user.Include.footer')