@include('Include.header')

    <main>

         <section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('assets/images/homepage-banner.webp') }});">
    <div class="container">
      <div class="row">
        <div class="inner-banner-heading position-relative z-1 text-center text-white">
         
          <h1>Material list</h1>
        </div>
        
      </div>
    </div>
  </section>


<section class="listing-page py-5 bg-light">
    <div class="container">

        {{-- Page Heading --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Explore Materials</h2>
                <p class="text-muted mb-0">
                    Find the right materials for your business
                </p>
            </div>

           
        </div>

        <div class="row g-4">

            {{-- FILTER SIDEBAR --}}
            <div class="col-lg-3 col-md-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">
                                <i class="fa fa-sliders me-2 text_color_primary"></i>
                                Filters
                            </h5>
                            <a href="{{ route('listing') }}"
                               class="text-decoration-none small text-success">
                                Clear All
                            </a>
                        </div>

                        <form method="GET" action="{{ route('listing') }}">

                            {{-- Search --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Search Materials</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fa fa-search text-muted"></i>
                                    </span>
                                    <input type="text" name="q"
                                        class="form-control"
                                        value="{{ data_get($filters, 'q') }}"
                                        placeholder="Material name...">
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Category</label>
                                <select name="category" class="form-select">
                                    <option value="">All Categories</option>
                                    @foreach(($categories ?? []) as $cat)
                                        <option value="{{ $cat }}"
                                            {{ $cat == data_get($filters, 'category') ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Location --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Location</label>
                                <select name="location" class="form-select">
                                    <option value="">All Locations</option>
                                    @foreach(($locations ?? []) as $loc)
                                        <option value="{{ $loc }}"
                                            {{ $loc == data_get($filters, 'location') ? 'selected' : '' }}>
                                            {{ $loc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Price --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Price Range</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" step="0.01"
                                            min="0" name="price_min"
                                            class="form-control"
                                            value="{{ data_get($filters, 'price_min') }}"
                                            placeholder="Min">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" step="0.01"
                                            min="0" name="price_max"
                                            class="form-control"
                                            value="{{ data_get($filters, 'price_max') }}"
                                            placeholder="Max">
                                    </div>
                                </div>
                            </div>

                            {{-- Specifications --}}
                            <h6 class="fw-bold border-bottom pb-2 mb-3">
                                Specifications
                            </h6>

                            <div class="mb-3">
                                <label class="form-label">Grade</label>
                                <select name="grade" class="form-select">
                                    <option value="">All Grades</option>
                                    @foreach(($grades ?? []) as $g)
                                        <option value="{{ $g }}"
                                            {{ $g == data_get($filters, 'grade') ? 'selected' : '' }}>
                                            {{ $g }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Size / Thickness</label>
                                <input type="text" name="size"
                                    class="form-control"
                                    value="{{ data_get($filters, 'size') }}"
                                    placeholder="e.g. 12mm">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Certification</label>
                                <input type="text" name="certification"
                                    class="form-control"
                                    value="{{ data_get($filters, 'certification') }}"
                                    placeholder="e.g. GOTS">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Unit</label>
                                <select name="unit" class="form-select">
                                    <option value="">All Units</option>
                                    @foreach(($units ?? []) as $u)
                                        <option value="{{ $u }}"
                                            {{ $u == data_get($filters, 'unit') ? 'selected' : '' }}>
                                            {{ $u }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn theme_btn{ w-100 py-2">
                                <i class="fa fa-filter me-2"></i>Apply Filters
                            </button>

                            <a href="{{ route('listing') }}"
                               class="btn btn-outline-secondary w-100 mt-2">
                                Reset Filters
                            </a>

                        </form>
                    </div>
                </div>
            </div>

            {{-- MATERIAL LISTINGS --}}
            <div class="col-lg-9 col-md-8">
                <div class="row g-4">

                    @forelse($materials as $material)
                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6">

                            <div class="card material-card h-100 border-0 shadow-sm">

                                {{-- Image --}}
                                <div class="material-image position-relative">
                                    <a href="{{ route('listing.details', $material->id) }}">
                                        <img
                                            src="{{ asset('public/' . $material->image) }}"
                                            class="card-img-top"
                                            alt="{{ $material->name }}">
                                    </a>

                                    <span class="badge bg-white text_color_primary position-absolute top-0 start-0 m-3 shadow-sm">
                                        <i class="fa fa-check-circle me-1"></i>
                                        Verified Listing
                                    </span>
                                </div>

                                {{-- Details --}}
                                <div class="card-body p-3 d-flex flex-column">

                                    <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                        <h5 class="fw-bold mb-0 material-name">
                                            <a href="{{ route('listing.details', $material->id) }}"
                                               class="text-dark text-decoration-none">
                                                {{ $material->name }}
                                            </a>
                                        </h5>
                                    </div>

                                    <h4 class="text_color_primary fw-bold mb-3">
                                        ${{ number_format($material->price, 2) }}
                                        <small class="text-muted fs-6 fw-normal">
                                            / {{ $material->unit }}
                                        </small>
                                    </h4>

                                    <div class="material-info mb-3">
                                        <p class="mb-2 text-muted">
                                            <i class="fa fa-map-marker-alt text_color_primary me-2"></i>
                                            {{ $material->location ?: 'Location not specified' }}
                                        </p>

                                        <p class="mb-2 text-muted">
                                            <i class="fa fa-building text_color_primary me-2"></i>
                                            <span class="text-dark fw-semibold">Brand:</span>
                                            {{ is_string($material->supplier) ? $material->supplier : (optional($material->supplier)->company_name ?? 'N/A') }}
                                        </p>

                                        <p class="mb-0 text-muted">
                                            <i class="fa fa-cubes text_color_primary me-2"></i>
                                            <span class="text-dark fw-semibold">Grade / Size:</span>
                                            {{ $material->grade ?: '-' }}
                                            /
                                            {{ $material->size ?: '-' }}
                                        </p>
                                    </div>

                                    <div class="mt-auto">
                                        <a href="{{ route('listing.details', $material->id) }}"
                                           class="btn btn-outline-success w-100 mb-2">
                                            View Details
                                            <i class="fa fa-arrow-right ms-1"></i>
                                        </a>

                                        @if(!Auth::guard('supplier')->check() && !Auth::guard('manufacturer')->check())
                                            @php
                                                $contactType = $material->manufacturer_id
                                                    ? 'Manufacturer'
                                                    : 'Supplier';
                                            @endphp

                                            <button type="button"
                                                class="btn btn-outline-success { w-100"
                                                data-bs-toggle="modal"
                                                data-bs-target="#enquiryModal"
                                                data-material-id="{{ $material->id }}"
                                                data-material-name="{{ $material->name }}">
                                                <i class="fa fa-envelope me-2"></i>
                                                Contact {{ $contactType }}
                                            </button>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm text-center py-5">
                                <div class="card-body">
                                    <i class="fa fa-search fa-3x text-muted mb-3"></i>
                                    <h5 class="fw-bold">No Materials Found</h5>
                                    <p class="text-muted">
                                        Try changing your search or filter options.
                                    </p>
                                    <a href="{{ route('listing') }}"
                                       class="btn theme_btn{">
                                        View All Materials
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforelse

                </div>

                {{-- Pagination --}}
                @if(method_exists($materials, 'links'))
                    <div class="mt-4">
                        {{ $materials->appends(request()->query())->links() }}
                    </div>
                @endif

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
                            <button type="submit" class="btn theme_btn{">Submit Enquiry</button>
                            @else
                            <a class="btn theme_btn{" href="{{ route('login') }}">Login to Continue</a>
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