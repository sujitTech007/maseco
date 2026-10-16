@include('Include.header')



<main>



    <section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('assets/images/homepage-banner.webp') }});">
    <div class="container">
      <div class="row">
        <div class="inner-banner-heading position-relative z-1 text-center text-white">
         
          <h1>Ai driven suggestion</h1>
          <p class="text-white mb-0">Maseco connects fashion designers with sustainable materials, trusted manufacturing partners, and AI-powered solutions to make fashion sourcing smarter, simpler, and more responsible.</p>
        </div>
        
      </div>
    </div>
  </section>





    <!-- <section class="listing-details-page pt-5">

        <div class="container">

            <div class="row">

                <div class="listings-details col-md-12">

                    <div class="details-thumb">

                        <img src="{{ asset('assets/images/material-1.png') }}" alt="material">

                    </div>

                    <div class="blog-categories">

                        <ul>

                            <li><a href="#"><i class="fa fa-user"></i> William@maseco.com</a></li>

                            <li><a href="#">Home Textiles</a></li>

                            <li>MAY 24, 2025</li>

                        </ul>

                    </div>

                    <div class="bolg-title">



                        <p>

                            Maseco leverages AI-driven suggestions to optimize the selection of raw materials for sustainable textiles. Our AI system analyzes trends, quality metrics, and environmental impact to provide intelligent recommendations that help manufacturers and designers make informed decisions.

                        </p>

                        <p>

                            By integrating AI technology, we ensure minimal waste, improved efficiency, and superior product quality. Our solutions enable clients to source innovative, eco-friendly, and cost-effective materials while adhering to global sustainability standards.

                        </p>

                    </div>



                    <div class="bolg-title">

                        <h2 class="material-types">Types of Raw Materials We Source</h2>

                    </div>



                    <div class="bolg-title">

                        <h2>01. Natural and Organic Materials</h2>

                        <p>We source high-quality natural and organic fibers recommended by AI analytics, ensuring sustainability, durability, and low environmental impact for home and industrial textiles.</p>

                    </div>

                    <div class="bolg-title">

                        <h2>02. Recycled Materials</h2>

                        <p>Our AI-driven insights guide the selection of recycled materials that meet quality standards, reduce waste, and support circular textile manufacturing processes.</p>

                    </div>

                    <div class="bolg-title">

                        <h2>03. Innovative Sustainable Materials</h2>

                        <p>AI suggestions help identify new sustainable fibers and innovative blends, enabling us to introduce eco-friendly alternatives without compromising on performance or aesthetics.</p>

                    </div>



                    <div class="bolg-title">

                        <h2>04. Eco-Friendly Packaging Materials</h2>

                        <p>We use AI to evaluate packaging options that minimize environmental footprint, promoting recyclable, biodegradable, and responsible packaging practices.</p>

                    </div>

                </div>

            </div>

        </div>

    </section> -->

    
<!-- AI Driven Suggestions Section -->
<section class="py-5">
    <div class="container">

        <!-- Section Heading -->
        <div class="row align-items-center mb-4">
            <div class="col-lg-8">
                <p class="text-uppercase small fw-semibold mb-2"
                   style="color:rgba(45,172,146,1);">
                    <i class="bi bi-stars me-2"></i>Smart Recommendations
                </p>

                <h2 class="fw-bold mb-2">AI-Driven Suggestions</h2>

                <p class="text-secondary mb-0">
                    Discover relevant suppliers, textile materials and
                    sustainable alternatives with intelligent recommendations.
                </p>
            </div>

            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <button class="btn btn-outline-success rounded-pill px-4"
                        style="--bs-btn-color:rgba(45,172,146,1);
                               --bs-btn-border-color:rgba(45,172,146,1);
                               --bs-btn-hover-bg:rgba(45,172,146,1);
                               --bs-btn-hover-border-color:rgba(45,172,146,1);">
                    <i class="bi bi-arrow-clockwise me-1"></i> Refresh Suggestions
                </button>
            </div>
        </div>

        <!-- Suggestion Cards -->
        <div class="row g-4">

            <!-- Supplier Suggestions -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between mb-3">
                            <div class="rounded-3 p-3"
                                 style="background:#e6f6f2;color:rgba(45,172,146,1);">
                                <i class="bi bi-buildings fs-3"></i>
                            </div>

                            <span class="badge rounded-pill align-self-start"
                                  style="background:#e6f6f2;color:#167d6b;">
                                Supplier Match
                            </span>
                        </div>

                        <h5 class="fw-bold">Recommended Suppliers</h5>

                        <p class="text-secondary small">
                            Explore suppliers that match your textile
                            requirements and sourcing preferences.
                        </p>

                        <ul class="list-unstyled small text-secondary mb-4">
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill me-2"
                                   style="color:rgba(45,172,146,1);"></i>
                                Relevant product categories
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill me-2"
                                   style="color:rgba(45,172,146,1);"></i>
                                MOQ and pricing preferences
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill me-2"
                                   style="color:rgba(45,172,146,1);"></i>
                                Supplier comparison
                            </li>
                        </ul>

                        <a href="#" class="text-decoration-none fw-semibold"
                           style="color:rgba(45,172,146,1);">
                            Explore Suppliers <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>
                </div>
            </div>

            <!-- Material Suggestions -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between mb-3">
                            <div class="rounded-3 p-3"
                                 style="background:#e6f6f2;color:rgba(45,172,146,1);">
                                <i class="bi bi-layers fs-3"></i>
                            </div>

                            <span class="badge rounded-pill align-self-start"
                                  style="background:#e6f6f2;color:#167d6b;">
                                Material Match
                            </span>
                        </div>

                        <h5 class="fw-bold">Textile Alternatives</h5>

                        <p class="text-secondary small">
                            Find alternative and recycled materials
                            that may suit your sourcing needs.
                        </p>

                        <ul class="list-unstyled small text-secondary mb-4">
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill me-2"
                                   style="color:rgba(45,172,146,1);"></i>
                                Recycled textile options
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill me-2"
                                   style="color:rgba(45,172,146,1);"></i>
                                Material specifications
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill me-2"
                                   style="color:rgba(45,172,146,1);"></i>
                                Alternative product discovery
                            </li>
                        </ul>

                        <a href="#" class="text-decoration-none fw-semibold"
                           style="color:rgba(45,172,146,1);">
                            Explore Materials <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>
                </div>
            </div>

            <!-- Sustainability Suggestions -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between mb-3">
                            <div class="rounded-3 p-3"
                                 style="background:#e6f6f2;color:rgba(45,172,146,1);">
                                <i class="bi bi-recycle fs-3"></i>
                            </div>

                            <span class="badge rounded-pill align-self-start"
                                  style="background:#e6f6f2;color:#167d6b;">
                                Sustainability
                            </span>
                        </div>

                        <h5 class="fw-bold">Eco-Friendly Alternatives</h5>

                        <p class="text-secondary small">
                            Discover material reuse and recycling
                            opportunities across the textile marketplace.
                        </p>

                        <ul class="list-unstyled small text-secondary mb-4">
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill me-2"
                                   style="color:rgba(45,172,146,1);"></i>
                                Recycled material listings
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill me-2"
                                   style="color:rgba(45,172,146,1);"></i>
                                Waste material exchange
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill me-2"
                                   style="color:rgba(45,172,146,1);"></i>
                                Sustainability score tagging
                            </li>
                        </ul>

                        <a href="#" class="text-decoration-none fw-semibold"
                           style="color:rgba(45,172,146,1);">
                            Explore Alternatives
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>
                </div>
            </div>

        </div>

        <!-- AI Suggestion Notice -->
        <div class="mt-4 p-3 rounded-3 d-flex align-items-start gap-3"
             style="background:#f0faf8;">
            <i class="bi bi-info-circle fs-5"
               style="color:rgba(45,172,146,1);"></i>

            <p class="small text-secondary mb-0">
                Suggestions should be based on available marketplace data,
                product details and user preferences. Actual AI-powered
                recommendations require a connected recommendation system.
            </p>
        </div>

    </div>
</section>





</main>



@include('Include.footer')