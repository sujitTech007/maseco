@include('Include.header')

    <main>

    <section class="banner inner-banner" style="background-image: url({{ asset('assets/images/inner-banner.jpg)')}};">
            <div class="container">
                <div class="row">
                    <div class="inner-banner-heading" data-aos="zoom-in">
                        <h1>Material Detail</h1>
                    </div>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb" data-aos="fade-up">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}"><i class="fas fa-home mr-2"></i>Home</a>
                            </li>
                            <li class="breadcrumb-item active">Material Detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <section class="listing-page py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                        <div class="product-image">
                            <div class="thumb">
                                <img src="{{ asset('public/' . $material->image) }}" alt="{{ $material->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="product-details">
                            <h2 class="deatil-main">{{ $material->name }}</h2>
                            <p class="mb-1"><strong>Location:</strong> {{ $material->location ?? '-' }}</p>
                            <p class="mb-3"><strong>Price:</strong> $ {{ number_format($material->price, 2) }}/{{ $material->unit }}</p>
                            <ul class="list-unstyled mb-3 ul-detail product-info">
                                <li><strong>Brand:</strong> <span class="brand-detail">{{ optional($material->supplier)->company_name ?? optional($material->supplier)->name ?? 'N/A' }}</span></li>
                                <li><strong>Thickness:</strong> <span class="brand-detail">{{ $material->size ?? '-' }}</span></li>
                                <li><strong>Usage/Application:</strong> <span class="brand-detail">{{ $material->sub_category ?? '-' }}</span></li>
                                <li><strong>Grade:</strong> <span class="brand-detail">{{ $material->grade ?? '-' }}</span></li>
                                <li><strong>Product Type:</strong> <span class="brand-detail">{{ $material->category ?? '-' }}</span></li>
                                <li><strong>Color:</strong> <span class="brand-detail">{{ $material->color ?? 'N/A' }}</span></li>
                                <li><strong>Core Material:</strong> <span class="brand-detail">{{ $material->strength ?? 'N/A' }}</span></li>
                                <li><strong>Availability:</strong> <span class="brand-detail">{{ ($material->stock ?? 0) > 0 ? 'In Stock' : 'Out of Stock' }}</span></li>
                            </ul>
                            <p class="mb-3">{{ $material->description }}</p>
                            <button class="detail-price-btn"  data-bs-toggle="modal">Get Latest Price</button>
                            <div class="card detail-card">
                                <div class="card-body">
                                    <p class="retailer-heading">{{ optional($material->supplier)->company_name ?? optional($material->supplier)->name ?? 'Supplier' }}</p>
                                    <p class="mb-2">GST: {{ optional($material->supplier)->gst ?? 'N/A' }}</p>
                                    <p class="mb-2">TrustSEAL Verified | 6 yrs</p>
                                    <p class="mb-2">Rating: ★★★★☆ 4.7 (98)</p>
                                    <p class="mb-3">Response Rate: 86%</p>
                                    <div class="d-flex gap-3 align-items-center mt-0">
                                        <a href="tel:{{ optional($material->supplier)->phone }}" class="phone-link">
                                            <i class="fa fa-phone"></i> Call {{ optional($material->supplier)->phone ?? 'N/A' }}
                                        </a>
                                        @if(!Auth::guard('supplier')->check() && !Auth::guard('manufacturer')->check())
                                        <button type="button" class="btn btn-success contact-supplier" data-bs-toggle="modal" data-bs-target="#supplierModal" data-material-id="{{ $material->id }}" data-material-name="{{ $material->name }}">
                                        
                                               @php
    $contactType = $material->manufacturer_id ? 'Manufacturer' : 'Supplier';
@endphp
                                            Contact {{ $contactType }}
                                        </button>
                                        @endif
                                        <!-- <button type="button" class="btn btn-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#enquiryModal" data-material-id="{{ $material->id }}" data-material-name="{{ $material->name }}">Get a Quote</button> -->
                                    </div>
                                </div>
                            </div>
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
                            <a class="btn btn-primary" href="{{ route('login') }}">Login to Continue</a>
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