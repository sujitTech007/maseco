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

                    <span class="text-uppercase fw-semibold fs-14 primary-text-color">
                        Material Information
                    </span>

                    <h2 class="fw-bold mt-2 mb-3" style="font-size:28px;color:#263b3a;">
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


@include('Include.footer')
