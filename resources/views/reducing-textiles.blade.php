@include('Include.header')


<main>



<section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('public/assets/images/homepage-banner.webp') }});">
    <div class="container">
      <div class="row">
        <div class="inner-banner-heading position-relative z-1 text-center text-white">
         
          <h1>Reducing textiles</h1>
        </div>
        
      </div>
    </div>
</section>


        
<!-- Reducing Textiles Content Section -->
<section class="py-5">
    <div class="container">
        <!-- Our Approach -->
        <div class="row align-items-center g-4 mb-5">

            <div class="col-lg-5">
                <img src="{{ asset('public/assets/images/service-box.webp') }}"
                     class="img-fluid rounded-3 w-100"
                     alt="Recycled textile materials">
            </div>

            <div class="col-lg-7">
                <p class="mb-2 text-uppercase small fw-semibold"
                   style="color:rgba(45,172,146,1);">
                    Our Approach
                </p>

                <h2 class="section-title-h2 mb-2 primary-text-color">
                    Turning Textile Waste into New Opportunities
                </h2>

                <p class="text-secondary">
                    Maseco promotes a circular economy through responsible
                    sourcing, recycled material exchange and supplier
                    connections to help businesses reduce textile waste.
                </p>

                <div class="row g-3 mt-3">

                        <div class="col-6 col-md-3">
                            <i class="fa-solid fa-leaf fs-3 primary-text-color"></i>
                            <h6 class="mt-2">Sustainable Sourcing</h6>
                        </div>

                        <div class="col-6 col-md-3">
                            <i class="fa-solid fa-recycle fs-3 primary-text-color"></i>
                            <h6 class="mt-2">Recycled Materials</h6>
                        </div>

                        <div class="col-6 col-md-3">
                            <i class="fa-solid fa-shield-halved fs-3 primary-text-color"></i>
                            <h6 class="mt-2">Eco Certifications</h6>
                        </div>

                        <div class="col-6 col-md-3">
                            <i class="fa-solid fa-earth-americas fs-3 primary-text-color"></i>
                            <h6 class="mt-2">Circular Economy</h6>
                        </div>

                        </div>
            </div>
        </div>
    </div>
</section>




    <section class="features-section p-4 p-md-5 mb-5">

    

        <!-- Marketplace Features -->
        <div class="container">

            <div class="mb-4">
                <p class="small text-uppercase fw-semibold mb-2"
                   style="color:rgba(45,172,146,1);">
                    Marketplace Features
                </p>

                <h2 class="section-title-h2 mb-2 primary-text-color">
                    Everything You Need in One Place
                </h2>

                <p class="text-secondary mb-0">
                    Discover, connect and manage your textile supply chain.
                </p>
            </div>

            <div class="row g-3">

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 rounded-3 h-100 p-3">
                        <i class="fa-solid fa-magnifying-glass fs-2 mb-3"
                           style="color:rgba(45,172,146,1);"></i>
                        <h5 class="h6 fw-bold">Advanced Search & Filters</h5>
                        <p class="text-secondary mb-0">
                            Find suppliers using search, MOQ filters
                            and certification details.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 rounded-3 h-100 p-3">
                        <i class="fa-solid fa-users fs-2 mb-3"
                           style="color:rgba(45,172,146,1);"></i>
                        <h5 class="h6 fw-bold">Supplier Comparison</h5>
                        <p class="text-secondary mb-0">
                            Compare supplier details, pricing and
                            sustainability credentials.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 rounded-3 h-100 p-3">
                        <i class="fa-solid fa-certificate fs-2 mb-3"
                           style="color:rgba(45,172,146,1);"></i>
                        <h5 class="h6 fw-bold">Eco-Certification Badges</h5>
                        <p class="text-secondary mb-0">
                            Identify suppliers with relevant
                            eco-certification badges.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 rounded-3 h-100 p-3">
                        <i class="fa-solid fa-heart fs-2 mb-3"
                           style="color:rgba(45,172,146,1);"></i>
                        <h5 class="h6 fw-bold">Saved Suppliers</h5>
                        <p class="text-secondary mb-0">
                            Save favorite suppliers and listings
                            for quick access.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

<section>
    <div class="container">
        <div class="row align-items-center g-4 mb-5">

    <div class="col-lg-5">
        <img src="{{ asset('public/assets/images/sustainable-img.webp') }}" class="img-fluid rounded-3 w-100"
            alt="Textile recycling and reuse">
    </div>

    <div class="col-lg-7">
        <p class="small text-uppercase fw-semibold mb-2" style="color:rgba(45,172,146,1);">
            Circular Economy
        </p>

        <h2 class="section-title-h2 mb-2">
            Give Textile Materials a Second Life
        </h2>

        <p class="text-secondary">
            Support textile reuse through recycled material listings,
            donation requests and waste material exchange.
        </p>

        <div class="row g-3 mt-2">

            <div class="col-sm-6">
                <div class="d-flex align-items-center gap-2">
                    <div class="icon_box">
                        <i class="fa-solid fa-recycle"></i>
                    </div>
                    <h6 class="mt-2 fs-6">Recycled Textile Marketplace</h6>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="d-flex align-items-center gap-2">
                    <div class="icon_box">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <h6 class="mt-2 fs-6">Textile Donation Requests</h6>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="d-flex align-items-center gap-2">
                    <div class="icon_box">
                        <i class="fa-solid fa-right-left"></i>
                    </div>
                    <h6 class="mt-2 fs-6">Waste Material Exchange</h6>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="d-flex align-items-center gap-2">
                    <div class="icon_box">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                    <h6 class="mt-2 fs-6">Sustainability Score Tagging</h6>
                </div>
            </div>

        </div>
    </div>
</div>
    </div>
        

    </div>
</section>


    </main>



@include('Include.footer')

