@include('Include.header')
<style>
    p.spllier-heading {
    color: green;
    font-weight: 900;
    font-size: 16px;
    padding: 0 0 10px !important;
    margin: 0 0 10pcx !important;
    border-bottom: 1px solid green;
}
span.gst-detail {
    color: grey;
    font-size: 13px;
    justify-content: flex-start;
    /* text-align: center; */
    display: block;
    padding: 5px 0px;
}
i.fa.fa-phone {
    color: green;
    font-size: 18px;
    padding: 0px 10px 0px 0px;
    margin: 0px 0px 0px 0px !important;
    position: relative;
    display: inline-flex
;
    top: 0;
    line-height: 0px;
}
        
        
p.text-primary.contact-line {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-primary-rgb), var(--bs-text-opacity)
--bs-text-opacity is not defined
) !important;
    padding: 0;
    margin: 0;
    /* top: 0; */
    position: relative;
    bottom: 12px;
}
p.rating-txt {
    color: grey;
    font-size: 13px;
    /* top: 0; */
    position: relative;
    display: inline-block;
    bottom: 5px;
}

p.brand {
    font-size: 15px;
    color: green;
    font-weight: 800;
}
p.brand span {
    font-size: 14px;
    color: #8b8b8b;
    font-weight: 800;
    text-transform: capitalize;
}
.location, .brand, .thickness {
    margin: 3px 0;
    font-size: 17px;
    color: #2dac92;
    font-weight: 900;
    text-transform: capitalize;
}
h5.card-title {
    color: #ffffff;
    font-weight: 700;
    font-size: 20px;
    background: #2dac92;
    border: 2px solid #2dac92;
    border-radius: 10px;
    padding: 5px 9px;
    text-align: center;
    transition: all 0.3s ease-in-out; /* smooth effect */
}

h5.card-title:hover {
    background: transparent;
    color: #2dac92;
    border: 2px solid #2dac92;
}

</style>
    <main>

        <section class="banner inner-banner" style="background-image: url({{ asset('assets/images/inner-banner.jpg)')}};">
            <div class="container">
                <div class="row">
                    <div class="inner-banner-heading" data-aos="zoom-in">
                        <h1>Material Listing</h1>
                    </div>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb" data-aos="fade-up">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}"><i class="fas fa-home mr-2"></i>Home</a>
                            </li>
                            <li class="breadcrumb-item active">Material Listing</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <section class="listing-page py-5">
            <div class="container">

                <div class="row">
                    <div class="aside col-md-3" data-aos="fade-right">
                        <form method="GET" action="{{ route('listing') }}" class="listingFilter accordionFilter text-align_center">
                            <article>
                                <h4 class="filterTitle active">Search</h4>
                                <div class="accordionFilter-panel" style="display: block;">
                                    <input type="text" name="q" class="form-control" value="{{ data_get($filters, 'q') }}" placeholder="Search materials">
                                </div>
                            </article>
                            <article>
                                <h4 class="filterTitle active">Categories</h4>
                                <div class="accordionFilter-panel" style="display: block;">
                                    <select name="category" class="form-select">
                                        <option value="">All</option>
                                        @foreach(($categories ?? []) as $cat)
                                            <option value="{{ $cat }}" {{ $cat == data_get($filters,'category') ? 'selected' : '' }}>{{ $cat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </article>
                            <article>
                                <h4 class="filterTitle">Location</h4>
                                <div class="accordionFilter-panel">
                                    <select name="location" class="form-select">
                                        <option value="">All</option>
                                        @foreach(($locations ?? []) as $loc)
                                            <option value="{{ $loc }}" {{ $loc == data_get($filters,'location') ? 'selected' : '' }}>{{ $loc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </article>
                            <article>
                                <h4 class="filterTitle">Price</h4>
                                <div class="accordionFilter-panel">
                                    <div class="row g-2">
                                        <div class="col-6"><input type="number" step="0.01" name="price_min" class="form-control" placeholder="Min" value="{{ data_get($filters,'price_min') }}"></div>
                                        <div class="col-6"><input type="number" step="0.01" name="price_max" class="form-control" placeholder="Max" value="{{ data_get($filters,'price_max') }}"></div>
                                    </div>
                                </div>
                            </article>
                            <article>
                                <h4 class="filterTitle">Specs</h4>
                                <div class="accordionFilter-panel">
                                    <div class="mb-2">
                                        <label class="form-label">Grade</label>
                                        <select name="grade" class="form-select">
                                            <option value="">All</option>
                                            @foreach(($grades ?? []) as $g)
                                                <option value="{{ $g }}" {{ $g == data_get($filters,'grade') ? 'selected' : '' }}>{{ $g }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Size/Thickness</label>
                                        <input type="text" name="size" class="form-control" value="{{ data_get($filters,'size') }}" placeholder="e.g., 12mm">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Certification</label>
                                        <input type="text" name="certification" class="form-control" value="{{ data_get($filters,'certification') }}" placeholder="e.g., GOTS">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Unit</label>
                                        <select name="unit" class="form-select">
                                            <option value="">All</option>
                                            @foreach(($units ?? []) as $u)
                                                <option value="{{ $u }}" {{ $u == data_get($filters,'unit') ? 'selected' : '' }}>{{ $u }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </article>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('listing') }}" class="btn btn-outline-secondary">Reset</a>
                            </div>
                        </form>
                        

                    </div>
                    <div class="listings col-md-9">
                        <div class="row">
                            @forelse($materials as $material)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="listingBox card" data-aos="fade-up">
                                    <div class="media position-relative">
                                        <a href="{{ route('listing.details', $material->id) }}" style="text-decoration: none; color: black;">
                                            <img src="{{ asset('public/' . $material->image) }}" class="card-img-top" alt="{{ $material->name }}">
                                            <span class="badge bg-primary position-absolute top-0 start-0 m-2">Leading Supplier</span>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('listing.details', $material->id) }}" style="text-decoration: none; color: black;">
                                            <h5 class="card-title">{{ $material->name }}</h5>
                                        </a>
                                        <p class="price">${{ number_format($material->price, 2) }} <small>/{{ $material->unit }}</small></p>
                                        <p class="location"><i class="fa fa-map-marker"></i> {{ $material->location }}</p>
                                        <p class="brand">Brand: <span>{{ $material->supplier ?? (optional($material->supplier)->company_name ?? 'N/A') }}</span></p>
                                        <p class="brand">Grade/Size: <span>{{ $material->grade ?? '-' }} / {{ $material->size ?? '-' }} </span></p>
                                         @if(!Auth::guard('supplier')->check() && !Auth::guard('manufacturer')->check())
                                        <button type="button" class="btn btn-primary w-100 mt-0 mb-2" data-bs-toggle="modal" data-bs-target="#enquiryModal" data-material-id="{{ $material->id }}" data-material-name="{{ $material->name }}">
                                            @php
    $contactType = $material->manufacturer_id ? 'Manufacturer' : 'Supplier';
@endphp
                                            Contact {{ $contactType }}
                                            
                                            
                                            </button>
                                            @endif
                                        <hr>
                                        <!--<div class="supplier-info">-->
                                        <!--    <p class="spllier-heading">{{ optional($material->supplier)->company_name ?? optional($material->supplier)->name ?? 'Supplier' }}</p>-->
                                        <!--    <p>-->
                                        <!--        <span class="badge bg-warning text-dark">GST</span> <span class="gst-detail"> TrustSeal Verified | 6 yrs | 86% Response Rate </span>-->
                                        <!--    </p>-->
                                        <!--    <p class="text-primary contact-line"><i class="fa fa-phone"></i> <span class="contct-txt">{{ optional($material->supplier)->phone ? 'View Mobile Number' : 'Contact via site' }}</span></p> -->
                                        <!--    <p class="rating-txt">⭐ 4.7 (98)</p>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <div class="alert alert-info">No materials found.</div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Enquiry Modal -->
        <!-- Supplier Modal -->
<div class="modal fade enquiry-modal" id="enquiryModal" tabindex="-1" aria-hidden="true">
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
        <script>
            const enquiryModal = document.getElementById('enquiryModal');
            enquiryModal && enquiryModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-material-id');
                const name = button.getAttribute('data-material-name');
                document.getElementById('enquiry-material-id').value = id;
                document.getElementById('enquiry-material-name').value = name;
            });
        </script>
    </main>


@include('Include.footer')