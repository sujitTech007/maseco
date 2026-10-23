@include('Include.header')

<main>
   
<!-- Material Detail Banner -->
 <section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('public/assets/images/homepage-banner.webp') }});">
    <div class="container">
      <div class="row">
        <div class="inner-banner-heading position-relative z-1 text-center text-white">
         
          <h1>Material details</h1>
        </div>
        
      </div>
    </div>
  </section>
<!-- Material Detail -->
<section class="py-5" style="background:#f6f8f7;">
    <div class="container">

        <!-- Product Overview -->
        <div class="row g-4 mb-4">

            <!-- Image -->
            <div class="col-lg-5">
                <div class="bg-white border rounded-3 p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-uppercase fw-semibold fs-14 primary-text-color">Material Preview</span>

                        @if(($material->stock ?? 0) > 0)
                            <span class="badge rounded-pill fs-12"
                                  style="background:#e5f6ef;color:#18794e;">
                                In Stock
                            </span>
                        @else
                            <span class="badge bg-light text-danger fs-12 border">
                                Out of Stock
                            </span>
                        @endif
                    </div>

                    <div class="d-flex align-items-center justify-content-center rounded-3"
                         style="height:320px;background:#f7f9f8;">
                        <img
                            src="{{ asset('public/' . $material->image) }}"
                            alt="{{ $material->name }}"
                            class="img-fluid"
                            style="max-height:300px;width:100%;object-fit:contain;">
                    </div>

                    <div class="d-flex align-items-center gap-2 mt-3"
                         style="font-size:13px;color:#687773;">
                        <i class="fa-solid fa-location-dot" style="color:#2DAC92;"></i>
                        {{ $material->location ?? 'Location not specified' }}
                    </div>
                </div>
            </div>

            <!-- Main Information -->
            <div class="col-lg-7">
                <div class="bg-white border rounded-3 p-4 h-100">

                    <div class="d-flex justify-content-between  w-100">
                        <span class="text-uppercase fw-semibold fs-14 primary-text-color">
                        Material Information
                    </span>
                    <div class="d-flex justify-content-between align-items-center">
                                    
                                    
                                    <div class="d-flex gap-2 align-items-center">
                                                                            <!-- Save -->
                                    <button type="button" class="listing_badge border-0 rounded-circle shadow-none" title="Save Listing">
                                        <i class="fa-solid fa-bookmark text-primary"></i>
                                    </button>

                                    <!-- Wishlist -->
                                    <button type="button" class="listing_badge border-0 rounded-circle shadow-none" title="Add to Wishlist"> <i class="fa-solid fa-heart text-danger"></i>
                                    </button>

                                    <!-- Compare -->
                                    <button type="button" class="listing_badge border-0 rounded-circle shadow-none" title="Compare Listing"> <i class="fa-solid fa-scale-balanced text-success"></i>
                                    </button>
                                    </div>
                                </div>
                    </div>

                   
                     <h2 class="fw-bold">
                        {{ $material->name }}
                    </h2>
                   
                   

                    <div class="mb-3">
                        <span class="fw-bold" style="font-size:26px;color:#263b3a;">
                            ${{ number_format($material->price, 2) }}
                        </span>
                        <span class="text-secondary" style="font-size:14px;">
                            / {{ $material->unit }}
                        </span>
                    </div>

                    <p class="text-secondary mb-4" style="font-size:14px;line-height:1.7;">
                        {{ $material->description ?: 'Contact the supplier for further material information.' }}
                    </p>
                     <div class="certified-badge">
                                            <img src="{{ asset('public/assets/images/certified-badge.png') }}" alt="certified-badge" class="h-100 w-auto">
                                        </div>

                    <hr class="my-4">

                    <!-- Quick Specifications -->
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3 h-100" style="background:#f6f8f7;">
                                <p class="text-secondary mb-1" style="font-size:13px;">
                                    Category
                                </p>
                                <h6 class="mb-0" style="font-size:14px;">
                                    {{ $material->category ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 rounded-3 h-100" style="background:#f6f8f7;">
                                <p class="text-secondary mb-1" style="font-size:13px;">
                                    Grade
                                </p>
                                <h6 class="mb-0" style="font-size:14px;">
                                    {{ $material->grade ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 rounded-3 h-100" style="background:#f6f8f7;">
                                <p class="text-secondary mb-1" style="font-size:13px;">
                                    Size / Thickness
                                </p>
                                <h6 class="mb-0" style="font-size:14px;">
                                    {{ $material->size ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 rounded-3 h-100" style="background:#f6f8f7;">
                                <p class="text-secondary mb-1" style="font-size:13px;">
                                    Usage / Application
                                </p>
                                <h6 class="mb-0" style="font-size:14px;">
                                    {{ $material->sub_category ?? '-' }}
                                </h6>
                            </div>
                        </div>
                    </div>

                    <!-- Buyer Actions -->
                    <div class="d-flex flex-wrap gap-2 mt-4">
                        @if(!Auth::guard('supplier')->check() && !Auth::guard('manufacturer')->check())
                            <button type="button"
                                class="btn text-white px-4 py-2"
                                style="background:#2DAC92;font-size:14px;"
                                data-bs-toggle="modal"
                                data-bs-target="#supplierModal"
                                data-material-id="{{ $material->id }}"
                                data-material-name="{{ $material->name }}">
                                <i class="fa-solid fa-envelope me-2"></i>
                                Send Enquiry
                            </button>
                        @endif

                        @if(optional($material->supplier)->phone)
                            <a href="tel:{{ optional($material->supplier)->country_code ? \App\Support\PhoneNumber::toE164(optional($material->supplier)->country_code, optional($material->supplier)->phone) : optional($material->supplier)->phone }}"
                               class="btn btn-outline-secondary px-4 py-2"
                               style="font-size:14px;">
                                <i class="fa-solid fa-phone me-2"></i>Call Supplier
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <!-- Specifications and Supplier -->
        <div class="row g-4">

            <!-- Specifications -->
            <div class="col-lg-7">
                <div class="bg-white border rounded-3 p-4 h-100">

                    <div class="mb-3">
                        <h4 class="fw-bold mb-1" style="font-size:19px;color:#263b3a;">
                            Product Specifications
                        </h4>
                        <p class="text-secondary mb-0" style="font-size:13px;">
                            Material attributes and purchasing information
                        </p>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <tbody style="font-size:14px;">
                                <tr>
                                    <td class="text-secondary py-3">Material Name</td>
                                    <td class="fw-semibold py-3">{{ $material->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary py-3">Category</td>
                                    <td class="fw-semibold py-3">{{ $material->category ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary py-3">Brand</td>
                                    <td class="fw-semibold py-3">
                                        {{ optional($material->supplier)->company_name
                                            ?? optional($material->supplier)->name
                                            ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary py-3">Grade</td>
                                    <td class="fw-semibold py-3">{{ $material->grade ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary py-3">Size / Thickness</td>
                                    <td class="fw-semibold py-3">{{ $material->size ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary py-3">Color</td>
                                    <td class="fw-semibold py-3">{{ $material->color ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary py-3">Core Material / Strength</td>
                                    <td class="fw-semibold py-3">{{ $material->strength ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary py-3">Price per Unit</td>
                                    <td class="fw-semibold py-3">
                                        ${{ number_format($material->price, 2) }}/{{ $material->unit }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 p-3 rounded-3"
                         style="background:#f0f8f5;">
                        <p class="mb-0" style="font-size:13px;color:#48665d;">
                            <i class="fa-solid fa-circle-info me-2" style="color:#2DAC92;"></i>
                            Ask the supplier about minimum order quantity, availability,
                            delivery terms, and sustainability certifications before ordering.
                        </p>
                    </div>

                </div>
            </div>

            <!-- Supplier Card -->
            <div class="col-lg-5">
                <div class="bg-white border rounded-3 p-4 h-100">

                    <h4 class="fw-bold mb-1" style="font-size:19px;color:#263b3a;">
                        Supplier Information
                    </h4>
                    <p class="text-secondary mb-4" style="font-size:13px;">
                        Contact the seller for pricing and order details.
                    </p>

                    <div class="d-flex align-items-center gap-3 p-3 rounded-3 mb-3"
                         style="background:#f6f8f7;">
                        <div class="d-flex align-items-center justify-content-center rounded-3"
                             style="width:46px;height:46px;flex-shrink:0;background:#e0f4ed;color:#2DAC92;">
                            <i class="fa-solid fa-building fa-lg"></i>
                        </div>

                        <div class="min-w-0">
                            <h6 class="fw-bold mb-1" style="font-size:14px;">
                                {{ optional($material->supplier)->company_name
                                    ?? optional($material->supplier)->name
                                    ?? 'Supplier' }}
                            </h6>
                            <p class="text-secondary mb-0" style="font-size:13px;">
                                <i class="fa-solid fa-location-dot me-1"></i>
                                {{ $material->location ?? 'Location not specified' }}
                            </p>
                        </div>
                    </div>

                    <div class="py-3 border-bottom">
                        <div class="d-flex justify-content-between gap-3">
                            <span class="text-secondary" style="font-size:13px;">GST Number</span>
                            <span class="fw-semibold text-end" style="font-size:13px;">
                                {{ optional($material->supplier)->gst ?? 'N/A' }}
                            </span>
                        </div>
                    </div>

                    <div class="py-3 border-bottom">
                        <div class="d-flex justify-content-between gap-3">
                            <span class="text-secondary" style="font-size:13px;">Phone</span>
                            <span class="fw-semibold text-end" style="font-size:13px;">
                                @if(optional($material->supplier)->phone)
                                    {{ trim((optional($material->supplier)->country_code ?? '') . ' ' . optional($material->supplier)->phone) }}
                                @else
                                    N/A
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="py-3 border-bottom">
                        <div class="d-flex justify-content-between gap-3">
                            <span class="text-secondary" style="font-size:13px;">Availability</span>
                            <span class="fw-semibold text-end" style="font-size:13px;">
                                {{ ($material->stock ?? 0) > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>
                    </div>

                    @if(!Auth::guard('supplier')->check() && !Auth::guard('manufacturer')->check())
                        <button type="button"
                            class="btn theme-btn fs-14 w-100 mt-4 p-3 fw-bold"
                            data-bs-toggle="modal"
                            data-bs-target="#supplierModal"
                            data-material-id="{{ $material->id }}"
                            data-material-name="{{ $material->name }}">
                            Contact Supplier <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    @endif

                </div>
            </div>

        </div>
    </div>
</section>

</main>

<!-- Supplier Modal -->
<div class="modal fade supplier-modal" id="supplierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-slideout">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5 col-md-12 border-end">
                        <div class=" text-left mb-3">
                            <img src="{{ asset('public/' . $material->image) }}" class="img-fluid mb-3" alt="{{ $material->name }}">
                            <div class=" detail-popup text-left mb-3">
                                <h6>{{ $material->name }}</h6>
                                <p class="mb-1"><strong>$ {{ number_format($material->price, 2) }}/{{ $material->unit }}</strong></p>
                                <p class="mb-1">{{ optional($material->supplier)->company_name ?? optional($material->supplier)->name ?? 'Supplier' }}</p>
                                <p class="mb-1">{{ $material->location ?? '-' }}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <h5 class="mb-3">Add few details to get quick response from the supplier</h5>
                        <form method="POST" action="{{ route('enquiry.store') }}">
                            @csrf
                            <div class="modal-body">
                                @guest
                                <div class="alert alert-warning">Please <a href="{{ route('login') }}">login</a> to submit an enquiry.</div>
                                @endguest
                                <input type="hidden" name="material_id" id="enquiry-material-id" value="{{ $material->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Material</label>
                                    <input type="text" id="enquiry-material-name" value="{{ $material->name }}" class="form-control" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" min="1" name="quantity" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Expected Price (optional)</label>
                                    <input type="number" step="0.01" name="expected_price" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="3" placeholder="Any specific requirements"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                @auth
                                <button type="submit" class="btn btn-primary">Submit Enquiry</button>
                                @else
                                <a class="btn theme-btn" href="{{ route('login') }}">Login to Continue</a>
                                @endauth
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<!-- add wishlist -->
 

<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-2">
                <i class="fa-solid fa-heart text-danger me-2"></i>
                My Wishlist
            </h3>
            <p class="text-muted mb-0">
                Keep track of your favourite materials and suppliers.
            </p>
        </div>

        <a href="#" class="btn theme-btn">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Continue Browsing
        </a>
    </div>

    <!-- Wishlist Summary -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success-subtle text-success rounded-3 p-3">
                        <i class="fa-solid fa-boxes-stacked fa-xl"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Saved Materials</p>
                        <h4 class="fw-bold mb-0">03</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-primary-subtle text-primary rounded-3 p-3">
                        <i class="fa-solid fa-building fa-xl"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Suppliers</p>
                        <h4 class="fw-bold mb-0">03</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning-subtle text-warning rounded-3 p-3">
                        <i class="fa-solid fa-bookmark fa-xl"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Ready to Explore</p>
                        <h4 class="fw-bold mb-0">03</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Wishlist Toolbar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center g-3">

                <div class="col-lg-7">
                    <h5 class="fw-bold mb-1">Your Saved Materials</h5>
                    <p class="text-muted mb-0">
                        3 materials saved to your wishlist
                    </p>
                </div>

                <div class="col-lg-5">
                    <div class="d-flex gap-2">
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input type="text"
                                   class="form-control"
                                   placeholder="Search saved materials...">
                        </div>

                        <button class="btn theme-btn d-flex"
                                type="button">
                            <i class="fa-solid fa-sliders me-1"></i>
                            Filter
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Wishlist Material Cards -->
    <div class="row g-4">

        <!-- Material 1 -->
        <div class="col-xl-4 col-md-6">
            <div class="card material-card h-100 border-0 shadow-sm">

                <div class="material-image position-relative">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=800&q=80"
                         class="card-img-top"
                         alt="Recycled textile material"
                         style="height:220px; object-fit:cover;">

                         <div class="d-flex position-absolute top-0 start-0 p-2 left-0 justify-content-between w-100">
                                    
                                    
                                    <div class="d-flex gap-2 align-items-center">
                                                                            <!-- Save -->
                                    <button type="button" class="listing_badge border-0 rounded-circle shadow-sm" title="Save Listing">
                                        <i class="fa-solid fa-bookmark text-primary"></i>
                                    </button>

                                    <!-- Wishlist -->
                                    <button type="button" class="listing_badge border-0 rounded-circle shadow-sm" title="Add to Wishlist"> <i class="fa-solid fa-heart text-danger"></i>
                                    </button>

                                    <!-- Compare -->
                                    <button type="button" class="listing_badge border-0 rounded-circle shadow-sm" title="Compare Listing"> <i class="fa-solid fa-scale-balanced text-success"></i>
                                    </button>
                                    </div>
                                </div>
                    
                </div>

                <div class="card-body p-3 d-flex flex-column">

                                    <div class="d-flex justify-content-between align-items-center gap-2 mb-2">
                                        <h5 class="fw-bold mb-0 material-name">
                                            <a href="#" class="text-dark text-decoration-none">
                                               Premium Recycled Fabric
                                            </a>
                                        </h5>
                                        <div class="certified-badge">
                                            <img src="{{ asset('public/assets/images/certified-badge.png') }}" alt="certified-badge" class="h-100 w-auto">
                                        </div>
                                        <span class="badge bg-light text-success border">In Stock</span>
                                    </div>

                                    <h4 class="text_color_primary fw-bold mb-3">
                                        $100.00
                                        <small class="text-muted fs-6 fw-normal">
                                            / KG
                                        </small>
                                    </h4>

                                    <div class="material-info mb-3">
                                        <p class="mb-2 text-muted">
                                            <i class="fa-solid fa-location-dot text_color_primary me-2"></i>
                                            Dallas, Texas, USA
                                        </p>

                                        <p class="mb-2 text-muted">
                                            <i class="fa-solid fa-building text_color_primary me-2"></i>
                                            <span class="text-dark fw-semibold">Supplier:</span>
                                            Maseco Z
                                        </p>

                                        <p class="mb-0 text-muted">
                                            <i class="fa-solid fa-cubes text_color_primary me-2"></i>
                                            <span class="text-dark fw-semibold">Grade / Size:</span>
                                            Premium / 10
                                        </p>
                                        
                                    </div>
                                    <div class="mt-auto d-flex gap-2">
                                        <a href="#"
                                           class="btn theme_btn text-white">
                                            View Details
                                            <i class="fa-solid fa-arrow-right ms-0"></i>
                                        </a>
                                        <button href="#" class="btn btn-outline-success"><i class="fa-solid fa-envelope me-1"></i>Contact Supplier</button>

                                        
                                    </div>
                                    


                   

                    


                    <p class="text-muted small mt-3 mb-0">
                        <i class="fa-regular fa-clock me-1"></i>
                        Added to wishlist 2 days ago
                    </p>

                </div>
            </div>
        </div>

        

    </div>

    <!-- Bottom Information -->
    <div class="alert alert-success d-flex align-items-center gap-3 mt-4 mb-0"
         role="alert">
        <i class="fa-solid fa-circle-info fa-xl"></i>
        <div>
            <strong>Find the right material for your business.</strong>
            <p class="mb-0">
                Compare your saved listings and contact suppliers when you're ready.
            </p>
        </div>
    </div>

</div>


<!-- compare page start  -->



<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-2">
                <i class="fa-solid fa-scale-balanced text-success me-2"></i>
                Compare Materials
            </h3>
            <p class="text-muted mb-0">
                Compare prices, quality, specifications and suppliers before making a decision.
            </p>
        </div>

        <a href="#" class="btn btn-outline-success">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Browse Materials
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success-subtle text-success rounded-3 p-3">
                        <i class="fa-solid fa-boxes-stacked fa-xl"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Materials Compared</p>
                        <h4 class="fw-bold mb-0">03</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-primary-subtle text-primary rounded-3 p-3">
                        <i class="fa-solid fa-building fa-xl"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Suppliers</p>
                        <h4 class="fw-bold mb-0">03</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning-subtle text-warning rounded-3 p-3">
                        <i class="fa-solid fa-tags fa-xl"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Lowest Listed Price</p>
                        <h4 class="fw-bold mb-0">$75.50 / Kg</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Comparison Information -->
    <div class="alert alert-success border-0 d-flex align-items-center gap-3 mb-4">
        <i class="fa-solid fa-circle-info fa-xl"></i>
        <div>
            <strong>Make an informed choice</strong>
            <p class="mb-0">
                Review the specifications and prices of these materials side by side.
                Prices shown are sample data.
            </p>
        </div>
    </div>

    <!-- Comparison Table -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h5 class="fw-bold mb-0 fs-5">Material Comparison</h5>

                <span class="badge bg-success-subtle text-success">
                    <i class="fa-solid fa-check-circle me-1"></i>
                    3 Materials Selected
                </span>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-compare align-middle text-center mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="text-start p-3" style="min-width:170px;">
                                Specifications
                            </th>

                            <th class="p-3" style="min-width:230px;">
                                <div class="d-flex flex-column align-items-center gap-2">

                                    <img
                                        src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=400&q=80"
                                        alt="Premium Recycled Fabric"
                                        class="img-fluid rounded"
                                        style="height:120px; width:160px; object-fit:cover;"
                                    >

                                    <h6 class="fw-bold mb-0">Premium Recycled Fabric</h6>

                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-circle-check me-1"></i>
                                        Verified
                                    </span>

                                </div>
                            </th>

                            <th class="p-3" style="min-width:230px;">
                                <div class="d-flex flex-column align-items-center gap-2">

                                    <img
                                        src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?auto=format&fit=crop&w=400&q=80"
                                        alt="Organic Cotton Fibre"
                                        class="img-fluid rounded"
                                        style="height:120px; width:160px; object-fit:cover;"
                                    >

                                    <h6 class="fw-bold mb-0">Organic Cotton Fibre</h6>

                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-circle-check me-1"></i>
                                        Verified
                                    </span>

                                </div>
                            </th>

                            <th class="p-3" style="min-width:230px;">
                                <div class="d-flex flex-column align-items-center gap-2">

                                    <img
                                        src="https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?auto=format&fit=crop&w=400&q=80"
                                        alt="Industrial Textile Rolls"
                                        class="img-fluid rounded"
                                        style="height:120px; width:160px; object-fit:cover;"
                                    >

                                    <h6 class="fw-bold mb-0">Industrial Textile Rolls</h6>

                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-circle-check me-1"></i>
                                        Verified
                                    </span>

                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        <!-- Price -->
                        <tr>
                            <th class="text-start p-3">
                                <i class="fa-solid fa-tag text-success me-2"></i>
                                Price
                            </th>

                            <td>
                                <h5 class="text-success fw-bold mb-0">$100.00 / Kg</h5>
                            </td>

                            <td class="table-success">
                                <span class="badge bg-success mb-2">Lowest Price</span>
                                <h5 class="text-success fw-bold mb-0">$75.50 / Kg</h5>
                            </td>

                            <td>
                                <h5 class="text-success fw-bold mb-0">$120.00 / Roll</h5>
                            </td>
                        </tr>

                        <!-- Supplier -->
                        <tr>
                            <th class="text-start p-3">
                                <i class="fa-solid fa-building text-success me-2"></i>
                                Supplier
                            </th>
                            <td>Maseco Z</td>
                            <td>Green Fibre Co.</td>
                            <td>Textile Hub Ltd.</td>
                        </tr>

                        <!-- Location -->
                        <tr>
                            <th class="text-start p-3">
                                <i class="fa-solid fa-location-dot text-success me-2"></i>
                                Location
                            </th>
                            <td>Dallas, Texas, USA</td>
                            <td>Toronto, Ontario, Canada</td>
                            <td>Chicago, Illinois, USA</td>
                        </tr>

                        <!-- Grade -->
                        <tr>
                            <th class="text-start p-3">
                                <i class="fa-solid fa-award text-success me-2"></i>
                                Material Grade
                            </th>
                            <td>Premium</td>
                            <td>A Grade</td>
                            <td>Industrial Grade</td>
                        </tr>

                        <!-- Size -->
                        <tr>
                            <th class="text-start p-3">
                                <i class="fa-solid fa-ruler-combined text-success me-2"></i>
                                Size
                            </th>
                            <td>10</td>
                            <td>20</td>
                            <td>15</td>
                        </tr>

                        <!-- Availability -->
                        <tr>
                            <th class="text-start p-3">
                                <i class="fa-solid fa-box-open text-success me-2"></i>
                                Availability
                            </th>
                            <td>
                                <span class="badge bg-success-subtle text-success">
                                    In Stock
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success">
                                    In Stock
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success">
                                    In Stock
                                </span>
                            </td>
                        </tr>

                        <!-- Minimum Order -->
                        <tr>
                            <th class="text-start p-3">
                                <i class="fa-solid fa-truck-fast text-success me-2"></i>
                                Minimum Order
                            </th>
                            <td>50 Kg</td>
                            <td>25 Kg</td>
                            <td>10 Rolls</td>
                        </tr>

                        <!-- Certification -->
                        <tr>
                            <th class="text-start p-3">
                                <i class="fa-solid fa-certificate text-success me-2"></i>
                                Certification
                            </th>
                            <td>Verified Supplier</td>
                            <td>Verified Supplier</td>
                            <td>Verified Supplier</td>
                        </tr>

                        <!-- Actions -->
                        <tr>
                            <th class="text-start p-3">Actions</th>

                            <td class="p-3">
                                <div class="gap-2 table-compare-btn d-flex">
                                    <a href="#" class="btn btn-success">
                                        <i class="fa-solid fa-eye me-1"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-success">
                                        <i class="fa-regular fa-envelope me-1"></i>
                                        Contact
                                    </a>
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="fa-solid fa-trash-can me-1"></i>
                                    </button>
                                </div>
                            </td>

                            <td class="p-3">
                                <div class="gap-2 table-compare-btn d-flex">
                                    <a href="#" class="btn btn-success">
                                        <i class="fa-solid fa-eye me-1"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-success">
                                        <i class="fa-regular fa-envelope me-1"></i>
                                        Contact
                                    </a>
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="fa-solid fa-trash-can me-1"></i>
                                    </button>
                                </div>
                            </td>

                            <td class="p-3">
                                <div class="gap-2 table-compare-btn d-flex">
                                    <a href="#" class="btn btn-success">
                                        <i class="fa-solid fa-eye me-1"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-success">
                                        <i class="fa-regular fa-envelope me-1"></i>
                                        Contact
                                    </a>
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="fa-solid fa-trash-can me-1"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recommendation Cards -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <div class="d-flex align-items-start gap-3">
                <div class="bg-success-subtle text-success rounded-3 p-3">
                    <i class="fa-solid fa-lightbulb fa-xl"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-2">Comparison Tips</h5>
                    <p class="text-muted mb-2">
                        Before choosing a material, consider more than just the listed price.
                    </p>

                    <div class="row g-3 mt-1">
                        <div class="col-md-4">
                            <p class="mb-0">
                                <i class="fa-solid fa-check-circle text-success me-2"></i>
                                Compare prices using the same unit.
                            </p>
                        </div>

                        <div class="col-md-4">
                            <p class="mb-0">
                                <i class="fa-solid fa-check-circle text-success me-2"></i>
                                Check material grade and specifications.
                            </p>
                        </div>

                        <div class="col-md-4">
                            <p class="mb-0">
                                <i class="fa-solid fa-check-circle text-success me-2"></i>
                                Confirm shipping costs and minimum order quantity.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@include('Include.footer')
