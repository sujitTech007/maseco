@include('Include.header')

<main>


  <section class="position-relative text-white overflow-hidden section_hero" tyle="background: #073b35;">
    <img src="{{ asset('assets/images/homepage-banner.webp') }}" class="w-100 h-100 position-absolute object-fit-cover" alt="banner">

    <!-- Background image and overlay -->
    <!-- <div class="position-absolute top-0 start-0 w-100 h-100"
      style="background:     linear-gradient(
        90deg,
        rgba(15, 35, 29, 0.68) 0%,
        rgba(15, 35, 29, 0.48) 45%,
        rgba(15, 35, 29, 0.12) 100%
    ), url('{{ asset('assets/images/homepage-banner.webp') }}') center/cover no-repeat;">
    </div> -->

    <div class="container position-relative py-4 py-lg-5 z-1">

      <div class="row">
        <div class="col-lg-10">

          <span class="text-uppercase small fw-bold text-white">
            Canada's Textile Sourcing & Sustainability Platform
          </span>

          <h1 class="display-5 fw-bold mt-2 mb-3 text-white">
            Find the Right Textile Suppliers
            <span class="d-block text-success">
              for Your Business
            </span>
          </h1>

          <p class="mb-4 text-white" style="max-width: 600px; ">
            Discover trusted textile suppliers, compare materials,
            filter by minimum order quantity, and source sustainable
            fabrics — all in one place.
          </p>

          <!-- Search form -->



          <form action="{{ url('/marketplace') }}" method="GET"
            class="bg-white text-dark rounded-3 shadow p-3 border form_container">

            <div class="d-flex flex-nowrap align-items-end gap-2">

              <!-- Search Materials -->
              <div style="flex: 2; min-width: 0;">
                <label for="q" class="form-label small fw-semibold mb-1">
                  Search Materials
                </label>
                <input type="text" name="q" id="q"
                  class="form-control bg-light"
                  placeholder="Search materials...">
              </div>

              <!-- Category -->
              <div style="flex: 1.2; min-width: 0;">
                <label for="category" class="form-label small fw-semibold mb-1">
                  Category
                </label>
                <select name="category" id="category"
                  class="form-select bg-light">
                  <option value="">All categories</option>
                  <option value="Fabric">Fabric</option>
                  <option value="Chemicals">Chemicals</option>
                </select>
              </div>

              <!-- Location -->
              <div style="flex: 1.6; min-width: 0;">
                <label for="location" class="form-label small fw-semibold mb-1">
                  Location
                </label>
                <select name="location" id="location"
                  class="form-select bg-light">
                  <option value="">All locations</option>
                  <option value="USA – Chicago, Illinois">USA – Chicago, Illinois</option>
                  <option value="USA – Dallas, Texas">USA – Dallas, Texas</option>
                </select>
              </div>

              <!-- Minimum Price -->
              <div>
                <label for="price_min" class="form-label small fw-semibold mb-1">
                  Min Price
                </label>
                <input type="number" step="0.01" min="0"
                  name="price_min" id="price_min"
                  class="form-control bg-light"
                  placeholder="Min">
              </div>

              <!-- Buttons -->
              <div>
                <div class="d-flex gap-2">
                  <button type="submit"
                    class="btn theme_btn">
                    <i class="fa fa-search me-1"></i> Search
                  </button>


                </div>
              </div>

            </div>
          </form>



         
        </div>
      </div>

    </div>
  </section>

<section class="maseco-advantages-section py-3">
    <div class="container">

      

        <!-- Feature Cards -->
        <div class="row g-3 maseco-advantages-row">

            <!-- Verified Suppliers -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="maseco-advantage-card">
                    <div class="maseco-advantage-icon bg-danger bg-opacity-10">
                        <i class="fa fa-shield text-danger"></i>
                    </div>

                    <div class="maseco-advantage-content">
                        <h5>Verified Suppliers</h5>
                        <p>Trusted textile partners</p>
                    </div>
                </div>
            </div>

            <!-- Advanced Search -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="maseco-advantage-card">
                    <div class="maseco-advantage-icon bg-warning bg-opacity-10">
                        <i class="fa fa-sliders text-warning"></i>
                    </div>

                    <div class="maseco-advantage-content">
                        <h5>Advanced Search</h5>
                        <p>Find suitable materials</p>
                    </div>
                </div>
            </div>

            <!-- Sustainable Textiles -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="maseco-advantage-card">
                    <div class="maseco-advantage-icon bg-secondary bg-opacity-10">
                        <i class="fa fa-leaf text-white"></i>
                    </div>

                    <div class="maseco-advantage-content">
                        <h5>Sustainable Textiles</h5>
                        <p>Eco-conscious sourcing</p>
                    </div>
                </div>
            </div>

            <!-- Buyer-Seller Support -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="maseco-advantage-card">
                    <div class="maseco-advantage-icon bg-success bg-opacity-10">
                        <i class="fa fa-comments text-success"></i>
                    </div>

                    <div class="maseco-advantage-content">
                        <h5>Buyer–Seller Support</h5>
                        <p>Connect and collaborate</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<section class="maseco-about-clean py-5" id="about-maseco">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">

            <!-- Left: About content -->
            <div class="col-lg-5">
                <div class="maseco-about-copy">

                    <span class="maseco-about-eyebrow">
                        ABOUT MASECO
                    </span>

                    <h2 class="maseco-about-title">
                        A better way to
                        <span>source textiles.</span>
                    </h2>

                    <p class="maseco-about-description">
                        Maseco connects businesses with textile suppliers
                        and supports more responsible material sourcing
                        and production.
                    </p>

                    <p class="maseco-about-description maseco-about-secondary">
                        We make it easier to find the right partners,
                        explore sustainable materials, and build a more
                        transparent supply chain for the fashion industry.
                    </p>

                    <a href="{{ route('about.us') }}"
                       class="maseco-about-button">
                        Explore the marketplace
                        
                    </a>

                </div>
            </div>

            <!-- Right: Textile image and capability strip -->
            <div class="col-lg-7">
                <div class="maseco-about-visual position-relative">

                    <img
                        src="{{ asset('assets/images/about-us.webp') }}"
                        alt="Textile manufacturing and fabric production"
                        class="maseco-about-photo"
                        loading="lazy"
                    >

                    <div class="maseco-about-capabilities">

                        <div class="maseco-capability">
                            <span class="maseco-capability-icon">
                                <i class="bi bi-search"></i>
                            </span>
                            <span>Supplier discovery</span>
                        </div>

                        <div class="maseco-capability">
                            <span class="maseco-capability-icon">
                                <i class="bi bi-leaf"></i>
                            </span>
                            <span>Sustainable materials</span>
                        </div>

                        <div class="maseco-capability">
                            <span class="maseco-capability-icon">
                                <i class="bi bi-buildings"></i>
                            </span>
                            <span>Production support</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



  <section class="maseco-services">
    <div class="container">

      <!-- Section Intro -->
      <div class="services-intro">
        <div class="services-heading">
          <span class="services-eyebrow">WHAT WE OFFER</span>
          <h2>Everything you need to<br>source better textiles.</h2>
        </div>

        <div class="services-description">
          <p>
            Maseco helps businesses discover reliable textile suppliers,
            explore sustainable materials, compare sourcing options,
            and connect with partners that align with their business needs.
          </p>
          <p>
            From finding the right manufacturer to building lasting
            supplier relationships, our marketplace makes textile
            sourcing simpler and more transparent.
          </p>
        </div>
      </div>

      <!-- Service Cards -->
      <div class="row g-4 services-grid">

        <!-- Service 1 -->
        <div class="col-12 col-sm-6 col-lg-3">
          <article class="service-card">
            <div class="service-icon service-icon-green">
              <i class="fa-solid fa-globe"></i>
            </div>

            <h3>Supplier Discovery</h3>

            <p class="mt-2 mb-3">
              Discover textile manufacturers and suppliers
              that match your sourcing requirements.
            </p>

            <a href="{{ url('/marketplace') }}" class="btn theme_btn rounded-5">
              Explore suppliers
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </article>
        </div>

        <!-- Service 2 -->
        <div class="col-12 col-sm-6 col-lg-3">
          <article class="service-card">
            <div class="service-icon service-icon-pink">
              <i class="fa-solid fa-leaf"></i>
            </div>

            <h3>Sustainable Materials</h3>

            <p class="mt-2 mb-3">
              Explore eco-conscious fabrics and materials
              for more responsible textile production.
            </p>

            <a href="{{ url('/marketplace') }}?eco_certified=1"
              class="btn theme_btn rounded-5">
              Explore materials
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </article>
        </div>

        <!-- Service 3 -->
        <div class="col-12 col-sm-6 col-lg-3">
          <article class="service-card">
            <div class="service-icon service-icon-blue">
              <i class="fa-solid fa-scale-balanced"></i>
            </div>

            <h3>Compare &amp; Connect</h3>

            <p class="mt-2 mb-3">
              Review supplier options, compare your sourcing
              needs, and find the right business partner.
            </p>

            <a href="{{ url('/marketplace') }}" class="btn theme_btn rounded-5">
              Find your match
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </article>
        </div>

        <!-- Service 4 -->
        <div class="col-12 col-sm-6 col-lg-3">
          <article class="service-card">
            <div class="service-icon service-icon-orange">
              <i class="fa-solid fa-handshake"></i>
            </div>

            <h3>Business Communication</h3>

            <p class="mt-2 mb-3">
              Connect with textile businesses to discuss
              requirements and build lasting relationships.
            </p>

            <a href="{{ url('/contact-us') }}" class="btn theme_btn rounded-5">
              Get in touch
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </article>
        </div>

      </div>

    </div>
  </section>


<section class="maseco-featured py-5" id="featured-suppliers">
    <div class="container">

        <!-- Heading -->
        <div class="maseco-featured-heading">
            <div>
                <span class="maseco-featured-eyebrow">
                    <i class="bi bi-leaf-fill"></i> SUSTAINABLE SOURCING
                </span>
                <h2>Featured <span>textile suppliers</span></h2>
                <p>Discover trusted partners for responsible textile sourcing.</p>
            </div>

            <a href="{{ url('/marketplace') }}" class="maseco-view-all">
                View all suppliers 
            </a>
        </div>

        <!-- Supplier carousel -->
        <div class="maseco-supplier-carousel">

            <button class="maseco-supplier-nav prev" type="button"
                    aria-label="Previous suppliers">
                <i class="bi bi-chevron-left"></i>
            </button>

            <div class="maseco-supplier-track" id="masecoSupplierTrack">

                <!-- Supplier 1 -->
                <article class="maseco-supplier-card">
                    <div class="maseco-supplier-photo">
                        <img src="{{ asset('assets/images/sustainable-materials.png') }}"
                             alt="GreenTextiles organic textile materials"
                             loading="lazy">

                        <span class="maseco-verified">
                            <i class="bi bi-patch-check-fill"></i> Supplier
                        </span>

                        <button class="maseco-favorite" type="button"
                                aria-label="Add GreenTextiles Co. to favourites"
                                aria-pressed="false">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="maseco-supplier-details">
                        <h3>GreenTextiles Co.</h3>

                        <p class="maseco-supplier-location">
                            <i class="bi bi-geo-alt-fill"></i>
                            Bangladesh
                        </p>

                        <div class="maseco-supplier-meta">
                            <span><i class="bi bi-box-seam-fill"></i> Organic textiles</span>
                            <span><i class="bi bi-bounding-box"></i> MOQ: 500 kg</span>
                        </div>

                        <div class="maseco-supplier-price-row">
                            <div class="maseco-supplier-moq">
                                <small>MINIMUM ORDER</small>
                                <strong>500 kg</strong>
                            </div>
                            <div class="maseco-supplier-rating">
                                <i class="bi bi-star-fill"></i>
                                <strong>4.8</strong>
                                <small>(24 reviews)</small>
                            </div>
                        </div>

                        <div class="maseco-supplier-benefits">
                            <span><i class="bi bi-leaf-fill"></i> Organic cotton</span>
                            <span><i class="bi bi-check-circle-fill"></i> Linen & hemp</span>
                        </div>

                        <a href="{{ url('/marketplace') }}" class="maseco-supplier-button">
                            View details 
                        </a>
                    </div>
                </article>

                <!-- Supplier 2 -->
                <article class="maseco-supplier-card">
                    <div class="maseco-supplier-photo">
                        <img src="{{ asset('assets/images/manufacture.png') }}"
                             alt="Sunrise Fabrics textile manufacturing"
                             loading="lazy">

                        <span class="maseco-verified">
                            <i class="bi bi-patch-check-fill"></i> Supplier
                        </span>

                        <button class="maseco-favorite" type="button"
                                aria-label="Add Sunrise Fabrics to favourites"
                                aria-pressed="false">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="maseco-supplier-details">
                        <h3>Sunrise Fabrics</h3>

                        <p class="maseco-supplier-location">
                            <i class="bi bi-geo-alt-fill"></i>
                            India
                        </p>

                        <div class="maseco-supplier-meta">
                            <span><i class="bi bi-recycle"></i> Recycled fabrics</span>
                            <span><i class="bi bi-bounding-box"></i> MOQ: 300 kg</span>
                        </div>

                        <div class="maseco-supplier-price-row">
                            <div class="maseco-supplier-moq">
                                <small>MINIMUM ORDER</small>
                                <strong>300 kg</strong>
                            </div>
                            <div class="maseco-supplier-rating">
                                <i class="bi bi-star-fill"></i>
                                <strong>4.7</strong>
                                <small>(18 reviews)</small>
                            </div>
                        </div>

                        <div class="maseco-supplier-benefits">
                            <span><i class="bi bi-recycle"></i> Recycled polyester</span>
                            <span><i class="bi bi-check-circle-fill"></i> Cotton & knits</span>
                        </div>

                        <a href="{{ url('/marketplace') }}" class="maseco-supplier-button">
                            View details 
                        </a>
                    </div>
                </article>

                <!-- Supplier 3 -->
                <article class="maseco-supplier-card">
                    <div class="maseco-supplier-photo">
                        <img src="{{ asset('assets/images/logistics.png') }}"
                             alt="EcoWeave sustainable linen and modal textiles"
                             loading="lazy">

                        <span class="maseco-verified">
                            <i class="bi bi-patch-check-fill"></i> Supplier
                        </span>

                        <button class="maseco-favorite" type="button"
                                aria-label="Add EcoWeave Ltd. to favourites"
                                aria-pressed="false">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="maseco-supplier-details">
                        <h3>EcoWeave Ltd.</h3>

                        <p class="maseco-supplier-location">
                            <i class="bi bi-geo-alt-fill"></i>
                            Turkey
                        </p>

                        <div class="maseco-supplier-meta">
                            <span><i class="bi bi-flower1"></i> Natural fabrics</span>
                            <span><i class="bi bi-bounding-box"></i> MOQ: 1,000 kg</span>
                        </div>

                        <div class="maseco-supplier-price-row">
                            <div class="maseco-supplier-moq">
                                <small>MINIMUM ORDER</small>
                                <strong>1,000 kg</strong>
                            </div>
                            <div class="maseco-supplier-rating">
                                <i class="bi bi-star-fill"></i>
                                <strong>4.6</strong>
                                <small>(22 reviews)</small>
                            </div>
                        </div>

                        <div class="maseco-supplier-benefits">
                            <span><i class="bi bi-leaf-fill"></i> Linen</span>
                            <span><i class="bi bi-check-circle-fill"></i> Tencel & modal</span>
                        </div>

                        <a href="{{ url('/marketplace') }}" class="maseco-supplier-button">
                            View details 
                        </a>
                    </div>
                </article>

                <!-- Supplier 4 -->
                <article class="maseco-supplier-card">
                    <div class="maseco-supplier-photo">
                        <img src="{{ asset('assets/images/sustainable-journey-img.webp') }}"
                             alt="Global Textiles woven fabrics"
                             loading="lazy">

                        <span class="maseco-verified">
                            <i class="bi bi-patch-check-fill"></i> Supplier
                        </span>

                        <button class="maseco-favorite" type="button"
                                aria-label="Add Global Textiles to favourites"
                                aria-pressed="false">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="maseco-supplier-details">
                        <h3>Global Textiles</h3>

                        <p class="maseco-supplier-location">
                            <i class="bi bi-geo-alt-fill"></i>
                            China
                        </p>

                        <div class="maseco-supplier-meta">
                            <span><i class="bi bi-layers-fill"></i> Woven fabrics</span>
                            <span><i class="bi bi-bounding-box"></i> MOQ: 500 kg</span>
                        </div>

                        <div class="maseco-supplier-price-row">
                            <div class="maseco-supplier-moq">
                                <small>MINIMUM ORDER</small>
                                <strong>500 kg</strong>
                            </div>
                            <div class="maseco-supplier-rating">
                                <i class="bi bi-star-fill"></i>
                                <strong>4.5</strong>
                                <small>(27 reviews)</small>
                            </div>
                        </div>

                        <div class="maseco-supplier-benefits">
                            <span><i class="bi bi-layers-fill"></i> Polyester</span>
                            <span><i class="bi bi-check-circle-fill"></i> Nylon & wovens</span>
                        </div>

                        <a href="{{ url('/marketplace') }}" class="maseco-supplier-button">
                            View details 
                        </a>
                    </div>
                </article>

                <!-- Supplier 5 -->
                <article class="maseco-supplier-card">
                    <div class="maseco-supplier-photo">
                        <img src="{{ asset('assets/images/manufacture.png') }}"
                             alt="Pure Fibers organic and recycled fibres"
                             loading="lazy">

                        <span class="maseco-verified">
                            <i class="bi bi-patch-check-fill"></i> Supplier
                        </span>

                        <button class="maseco-favorite" type="button"
                                aria-label="Add Pure Fibers Co. to favourites"
                                aria-pressed="false">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="maseco-supplier-details">
                        <h3>Pure Fibers Co.</h3>

                        <p class="maseco-supplier-location">
                            <i class="bi bi-geo-alt-fill"></i>
                            Pakistan
                        </p>

                        <div class="maseco-supplier-meta">
                            <span><i class="bi bi-leaf-fill"></i> Eco fibres</span>
                            <span><i class="bi bi-bounding-box"></i> MOQ: 200 kg</span>
                        </div>

                        <div class="maseco-supplier-price-row">
                            <div class="maseco-supplier-moq">
                                <small>MINIMUM ORDER</small>
                                <strong>200 kg</strong>
                            </div>
                            <div class="maseco-supplier-rating">
                                <i class="bi bi-star-fill"></i>
                                <strong>4.6</strong>
                                <small>(16 reviews)</small>
                            </div>
                        </div>

                        <div class="maseco-supplier-benefits">
                            <span><i class="bi bi-leaf-fill"></i> Organic cotton</span>
                            <span><i class="bi bi-check-circle-fill"></i> Bamboo & recycled</span>
                        </div>

                        <a href="{{ url('/marketplace') }}" class="maseco-supplier-button">
                            View details 
                        </a>
                    </div>
                </article>

            </div>

            <button class="maseco-supplier-nav next" type="button"
                    aria-label="Next suppliers">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>

        <!-- Carousel progress -->
        <div class="maseco-supplier-footer">
            <div class="maseco-supplier-progress">
                <span id="masecoSupplierProgress"></span>
            </div>
            <span id="masecoSupplierCount">01 — 05</span>
        </div>

    </div>
</section>

  <script>
    function toggleSupplierFavorite(button) {
      const icon = button.querySelector('i');
      const active = icon.classList.toggle('text-danger');
      icon.classList.toggle('text-secondary', !active);
    }

    function compareSupplier(button) {
      const name = button.dataset.supplier;
      alert(name + ' selected for comparison. Connect this action to your comparison page.');
    }
  </script>

  <!-- <section class="section-Info py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="thumb">
            <img src="{{ asset('assets/images/about-thumb.png')}}" alt="About" />
          </div>
        </div>
        <div class="col-md-6 col-sm-12 text-wrapper ps-md-5">
          <div class="section-heading">
            <span class="needle-heading text-uppercase d-block needleIcon">About Us</span>
            <h2>Let’s Build Something Creative Together</h2>
            <p>Maseco is a sustainability-driven fashion solutions provider, empowering designers with responsible
              sourcing, ethical manufacturing, and AI-powered design insights.</p>
          </div>
          <ul class="listing list-with-icon">
            <li>Ethical & Sustainable Materials</li>
            <li>Seamless Manufacturing Support</li>
            <li>Recycling & R&D Innovation</li>
            <li>AI-Driven Design Assistance</li>
            <li>Hassle-Free Logistics & Admin</li>
          </ul>
          <div class="section-button mt-5 d-block">
            <a href="{{ url('about-us') }}" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
   -->






  <section class="maseco-process">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">

            <!-- Left introduction -->
            <div class="col-lg-3">
                <div class="process-intro">
                    <span class="process-eyebrow">
                        <span></span> OUR PROCESS
                    </span>

                    <h2>Better sourcing.<br>
                        <span>Greater impact.</span>
                    </h2>

                    <p>
                        Maseco helps fashion businesses discover sustainable
                        materials, connect with trusted suppliers and move
                        towards smarter production — all in one place.
                    </p>

                    <a href="{{ url('/marketplace') }}"
                       class="theme_link">
                        Explore the marketplace
                        
                    </a>
                </div>
            </div>

            <!-- Right process steps -->
            <div class="col-lg-9">
                <div class="process-steps">

                    <article class="process-step">
                        <div class="process-image">
                            <img
                                src="{{ asset('assets/images/sustainable-img.webp') }}"
                                alt="Sustainable textile materials"
                                loading="lazy">
                            <span class="process-number">01</span>
                        </div>

                        <h3>Discover Materials</h3>
                        <p>
                            Explore textile materials and find suitable
                            options for your sourcing needs.
                        </p>
                    </article>

                    <div class="process-arrow">
                        
                    </div>

                    <article class="process-step">
                        <div class="process-image">
                            <img
                                src="{{ asset('assets/images/Sustainable-journey-img.webp') }}"
                                alt="Textile manufacturing and supplier connections"
                                loading="lazy">
                            <span class="process-number">02</span>
                        </div>

                        <h3>Connect with Suppliers</h3>
                        <p>
                            Discover potential partners and build
                            relationships for your business.
                        </p>
                    </article>

                    <div class="process-arrow">
                        
                    </div>

                    <article class="process-step">
                        <div class="process-image">
                            <img
                                src="{{ asset('assets/images/service-box.webp') }}"
                                alt="Textile design and material planning"
                                loading="lazy">
                            <span class="process-number">03</span>
                        </div>

                        <h3>Design with AI</h3>
                        <p>
                            Explore AI-assisted design and material
                            recommendations as they become available.
                        </p>
                    </article>

                    <div class="process-arrow">
                        
                    </div>

                    <article class="process-step">
                        <div class="process-image">
                            <img
                                src="{{ asset('assets/images/testimonial-img.webp') }}"
                                alt="Textile production and logistics"
                                loading="lazy">
                            <span class="process-number">04</span>
                        </div>

                        <h3>Scale Production</h3>
                        <p>
                            Work towards a smoother production journey
                            with manufacturing and post-production support.
                        </p>
                    </article>

                </div>
            </div>

        </div>
    </div>
</section>



  <section class="maseco-journey">
    <div class="container">

        <!-- Section heading -->
        <div class="journey-heading">
            <span class="journey-eyebrow">
                <i class="bi bi-leaf"></i> THE MASECO JOURNEY
            </span>
            <h2>A Smarter Way to Source Textiles</h2>
            <p>
                From finding the right materials to connecting with manufacturing
                partners, Maseco brings your sourcing journey together.
            </p>
        </div>

        <div class="row align-items-center g-4 g-lg-5">

            <!-- Left: Image -->
            <div class="col-lg-5">
                <div class="journey-visual">
                    <img
                        src="{{ asset('assets/images/sustainable-img.webp') }}"
                        alt="Textile materials and sustainable fabric sourcing"
                        loading="lazy"
                    >

                    <div class="journey-image-caption">
                        <span class="journey-caption-icon">
                            <i class="bi bi-recycle"></i>
                        </span>
                        <div>
                            <strong>Better sourcing starts here.</strong>
                            <p>Materials, partners and smarter decisions.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Rollout steps -->
            <div class="col-lg-7">
                <div class="journey-steps">

                    <!-- Step 01 -->
                    <article class="journey-step">
                        <div class="journey-step-number">01</div>
                        <div class="journey-step-content">
                            <span class="journey-step-label">DISCOVER</span>
                            <h3>Find Sustainable Materials</h3>
                            <p>
                                Explore textile materials and supplier options
                                in one place. Compare available materials and
                                identify the right fit for your business.
                            </p>
                        </div>
                    </article>

                    <!-- Step 02 -->
                    <article class="journey-step">
                        <div class="journey-step-number">02</div>
                        <div class="journey-step-content">
                            <span class="journey-step-label">CONNECT</span>
                            <h3>Meet Manufacturing Partners</h3>
                            <p>
                                Discover potential suppliers and manufacturing
                                partners based on your material requirements
                                and production needs.
                            </p>
                        </div>
                    </article>

                    <!-- Step 03 -->
                    <article class="journey-step">
                        <div class="journey-step-number">03</div>
                        <div class="journey-step-content">
                            <span class="journey-step-label">GROW</span>
                            <h3>Move Towards Smarter Production</h3>
                            <p>
                                Build a more informed sourcing process with
                                sustainable material choices and access to
                                Maseco's evolving sourcing and design solutions.
                            </p>
                        </div>
                    </article>

                </div>

                <a href="{{ url('/marketplace') }}" class="theme_link">
                    Explore the marketplace
                    <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>



  <!-- <section class="price-section py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <span class="needle-heading text-uppercase d-block needleIcon">Our subscription</span>
            <h2>Find Your Perfect Plan</h2>
            <p>Discover the ideal plan to fuel your business growth. Our pricing options are carefully crafted to
              cater to businesses.</p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mt-4">

        @foreach($plans as $plan)
        <div class="col-lg-4 col-md-4">
          <div class="pricebox" data-aos-duration="{{ 500 + ($loop->index * 300) }}">
            <div class="priceboxIcon">
              @php
              $icon = 'basic-icon.svg';
              if(stripos($plan->name, 'premium') !== false) $icon = 'premium-icon.svg';
              elseif(stripos($plan->name, 'pro') !== false) $icon = 'pro-icon.svg';
              @endphp
              <img src="assets/images/icon/{{ $icon }}" alt="">
            </div>
            <div class="price-content">
              <h5>{{ $plan->name }}</h5>
              <p class="price-text">{{ $plan->description ?? '' }}</p>
              <h2 class="price">
                @if($plan->price == 0)
                Free
                @else
                <span class="dollar">$</span>{{ rtrim(rtrim(number_format($plan->price, 2, '.', ''), '0'), '.') }}
                <span class="price-month">/ {{ $plan->duration }}</span>
                @endif
                @if($plan->commission)
                <span class="pricebox-comment">+ Commission = {{ $plan->commission }}</span>
                @endif
              </h2>
              @php
              $features = $plan->features;
              if(is_array($features)) {
              $features = implode("\n", $features);
              }
              if(is_string($features)) {
              $decoded = json_decode($features, true);
              if(is_array($decoded)) {
              $features = $decoded;
              } else {
              $features = preg_split('/\r?\n/', $features);
              }
              }
              @endphp
              @if($features && is_array($features))
              <ul class="list-info">
                @foreach($features as $feature)
                @php
                $feature = trim($feature);
                if(substr($feature, -1) === '+') {
                $feature = rtrim($feature, '+ ');
                }
                @endphp
                @if($feature !== '')
                <li><i class="fa-solid fa-square-up-right"></i><span>{{ $feature }}</span></li>
                @endif
                @endforeach
              </ul>
              @endif
              <div class="getStarted-btn">
                @if(Auth::guard('supplier')->check() || Auth::guard('manufacturer')->check())
                <button class="theme-btn disabled" disabled>Not Available</button>
                @else
                <button class="theme-btn purchase-btn"
                  data-plan-id="{{ $plan->id }}"
                  data-plan-name="{{ $plan->name }}"
                  data-plan-price="{{ $plan->price }}"
                  data-plan-duration="{{ $plan->duration }}"
                  onclick="handlePlanChooseFromButton(this)">
                  Get Started
                </button>
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section> -->

  
<section class="maseco-pricing py-3 py-md-5" id="subscription">
    <div class="container">

        <!-- Heading -->
        <div class="pricing-heading text-center">
            <span class="pricing-eyebrow">OUR SUBSCRIPTION</span>
            <h2>Choose the right plan for your sourcing journey</h2>
            <p>
                Access textile suppliers, sustainable materials and production
                solutions — all in one place.
            </p>
        </div>

        <!-- Plans -->
        <div class="row g-4 align-items-stretch pricing_row">

            <!-- Basic -->
            <div class="col-lg-4">
                <article class="maseco-plan shadow">
                    <div class="plan-icon">
                        <i class="bi bi-leaf"></i>
                    </div>

                    <h3>Basic</h3>
                    <div class="plan-price">Free</div>
                    <p class="plan-description">
                        Explore the Maseco supplier marketplace.
                    </p>

                    <hr>

                    <ul class="plan-features">
                        <li><i class="bi bi-check-circle-fill"></i> Browse textile suppliers</li>
                        <li><i class="bi bi-check-circle-fill"></i> Explore materials and categories</li>
                        <li><i class="bi bi-check-circle-fill"></i> Discover sourcing options</li>
                    </ul>

                    <a href="{{ route('subscription.plan') }}" class="plan-button">
                        Get started 
                    </a>
                </article>
            </div>

            <!-- Premium -->
            <div class="col-lg-4">
                <article class="maseco-plan maseco-plan-featured bg-success bg-opacity-10 shadow">
                    <span class="plan-popular">MOST POPULAR</span>

                    <div class="plan-icon">
                        <i class="bi bi-stars"></i>
                    </div>

                    <h3>Premium</h3>
                    <div class="plan-price">
                        $69 <span>/ month</span>
                    </div>
                    <p class="plan-description">
                        For teams ready to source smarter.
                    </p>

                    <hr>

                    <ul class="plan-features">
                        <li><i class="bi bi-check-circle-fill"></i> Everything in Basic</li>
                        <li><i class="bi bi-check-circle-fill"></i> AI-powered sourcing insights</li>
                        <li><i class="bi bi-check-circle-fill"></i> Supplier and vendor matching</li>
                    </ul>

                    <a href="{{ route('subscription.plan') }}" class="plan-button plan-button-primary text-white">
                        Explore Premium 
                    </a>
                </article>
            </div>

            <!-- Pro -->
            <div class="col-lg-4">
                <article class="maseco-plan shadow">
                    <div class="plan-icon">
                        <i class="bi bi-buildings"></i>
                    </div>

                    <h3>Pro</h3>
                    <div class="plan-price">
                        $299 <span>/ month</span>
                    </div>
                    <p class="plan-description">
                        For growing production teams.
                    </p>

                    <hr>

                    <ul class="plan-features">
                        <li><i class="bi bi-check-circle-fill"></i> Everything in Premium</li>
                        <li><i class="bi bi-check-circle-fill"></i> Post-production support</li>
                        <li><i class="bi bi-check-circle-fill"></i> Advanced production workflows</li>
                    </ul>

                    
                    <a href="{{ route('subscription.plan') }}" class="plan-button">
                        Contact our team 
                    </a>
                </article>
            </div>

        </div>
    </div>
</section>



  <section class="py-5" id="how-it-works">
    <div class="container py-lg-4">

      <!-- Heading -->
      <div class="row align-items-center mb-4">
        <div class="col-lg-7">
          <span class="text-success small fw-bold text-uppercase">
            Your Sourcing Journey
          </span>
          <h2 class="display-6 fw-bold mt-2">
            How <span class="text-success">Maseco</span> Works
          </h2>
          <p class="text-secondary">
            From finding the right supplier to tracking production,
            manage your textile journey in one place.
          </p>
        </div>
        <!-- <div class="col-lg-5 text-lg-end">
          <a href="{{ url('/marketplace') }}"
            class="btn btn-success btn-sm px-4">
            Explore Marketplace <i class="fa fa-arrow-right ms-2"></i>
          </a>
        </div> -->
      </div>

      <!-- Workflow slider -->
      <div class="position-relative">

        <button type="button" class="btn btn-light shadow-sm rounded-circle
                    position-absolute top-50 start-0 translate-middle-y"
          id="workflowPrev" aria-label="Previous steps"
          style="z-index:2">
          <i class="fa fa-chevron-left text-success"></i>
        </button>

        <div class="overflow-hidden mx-3 mx-md-4">
          <div class="d-flex gap-3" id="workflowTrack">

            @php
            $workflow = [
            [
            'step' => '01',
            'title' => 'Discover Suppliers',
            'subtitle' => 'Find the right match',
            'image' => 'assets/images/suppliers/green-textiles.jpg',
            'icon' => 'fa-search',
            'description' => 'Find textile suppliers using advanced filters for material, category, MOQ and eco-certification.',
            'points' => ['Advanced search & filters', 'Verified supplier profiles', 'Sustainable materials'],
            ],
            [
            'step' => '02',
            'title' => 'Compare & Select',
            'subtitle' => 'Make informed decisions',
            'image' => 'assets/images/suppliers/sunrise-fabrics.jpg',
            'icon' => 'fa-balance-scale',
            'description' => 'Review supplier details, compare options and save your preferred textile partners.',
            'points' => ['Supplier comparison', 'Saved suppliers & favorites', 'MOQ and material review'],
            ],
            [
            'step' => '03',
            'title' => 'Connect & Collaborate',
            'subtitle' => 'Bring ideas to life',
            'image' => 'assets/images/suppliers/eco-weave.jpg',
            'icon' => 'fa-comments',
            'description' => 'Send quotation requests and coordinate enquiries, files, samples and supplier conversations.',
            'points' => ['RFQ and bulk enquiries', 'File and sample sharing', 'Messaging and notifications'],
            ],
            [
            'step' => '04',
            'title' => 'Manage Production',
            'subtitle' => 'Keep projects moving',
            'image' => 'assets/images/suppliers/global-textiles.jpg',
            'icon' => 'fa-truck',
            'description' => 'Coordinate production milestones, sample approvals and delivery schedules with your partners.',
            'points' => ['Production milestones', 'Sample approval workflow', 'Delivery coordination'],
            ],
            ];
            @endphp

            @foreach($workflow as $item)
            <div class="workflow-slide">
              <div class="card h-100 border-0 shadow-sm overflow-hidden">
                <div class="position-relative">
                  <img src="{{ asset($item['image']) }}"
                    class="w-100"
                    alt="{{ $item['title'] }}"
                    style="height:150px;object-fit:cover">

                  <span class="badge bg-success position-absolute top-0 start-0 m-3">
                    STEP {{ $item['step'] }}
                  </span>

                  <span class="workflow-icon">
                    <i class="fa {{ $item['icon'] }}"></i>
                  </span>
                </div>

                <div class="card-body p-4">
                  <h3 class="h5 fw-bold">
                    {{ $item['title'] }}
                  </h3>

                  <p class="fw-semibold text-success mb-2">
                    {{ $item['subtitle'] }}
                  </p>

                  <p class="text-secondary">
                    {{ $item['description'] }}
                  </p>

                  <ul class="list-unstyled text-secondary mb-4">
                    @foreach($item['points'] as $point)
                    <li class="mb-2">
                      <i class="fa fa-check-circle text-success me-2"></i>
                      {{ $point }}
                    </li>
                    @endforeach
                  </ul>

                  <a href="{{ url('/marketplace') }}"
                    class="btn theme_btn rounded-5">
                    Learn More <i class="fa fa-arrow-right ms-1"></i>
                  </a>
                </div>
              </div>
            </div>
            @endforeach

          </div>
        </div>

        <button type="button" class="btn btn-light shadow-sm rounded-circle
                    position-absolute top-50 end-0 translate-middle-y"
          id="workflowNext" aria-label="Next steps"
          style="z-index:2">
          <i class="fa fa-chevron-right text-success"></i>
        </button>
      </div>

      <!-- Slider indicators -->
      <div class="d-flex justify-content-center gap-2 mt-4"
        id="workflowDots">
        @foreach($workflow as $index => $item)
        <button type="button"
          class="workflow-dot {{ $index === 0 ? 'active' : '' }}"
          data-index="{{ $index }}"
          aria-label="Go to step {{ $index + 1 }}">
        </button>
        @endforeach
      </div>

      <!-- Trust banner -->
      <div class="row g-3 align-items-center bg-white rounded-4 shadow-sm p-4 mt-5">
        <div class="col-lg-4">
          <h3 class="h5 fw-bold mb-2">
            <i class="fa fa-leaf text-success me-2"></i>
            Sustainable Sourcing
          </h3>
          <p class="text-secondary mb-0">
            Connect with textile partners and explore more
            sustainable sourcing opportunities.
          </p>
        </div>

       
        <div class="col-6 col-lg-3">
            <div class="d-flex align-items-center gap-2 p-3 rounded-3 border supplier-benefit-card">
                <i class="fa fa-shield text-success fs-5"></i>
                <span class="fs-14 fw-semibold">Supplier Verification</span>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="d-flex align-items-center gap-2 p-3 rounded-3 border supplier-benefit-card">
                <i class="fa fa-recycle text-success fs-5"></i>
                <span class="fs-14 fw-semibold">Eco-conscious Options</span>
            </div>
        </div>


        <div class="col-lg-2 text-lg-end">
          <a href="{{ url('/marketplace') }}"
            class="btn theme_btn px-4">
            Get Started <i class="fa fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

    </div>
  </section>



  {{-- ================== STRIPE PAYMENT MODAL ================== --}}
  <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 shadow-lg">
        <!-- <div id="paymentProcessingOverlay" class="d-flex">
        <div class="spinner-border text-success"></div>
      </div> -->
        <div class="modal-header border-0">
          <h5 class="modal-title fw-bold">Checkout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label">Plan</label>
            <input type="text" id="planName" class="form-control" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Duration</label>
            <input type="text" id="planDuration" class="form-control" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="text" id="planAmount" class="form-control" readonly>
          </div>

          <div id="card-errors" class="text-danger mt-2"></div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success btn-no-hover" id="payButton">Pay Now</button>
        </div>
      </div>
    </div>
  </div>


  <!-- <section class="provide-section py-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-xl-8">
          <div class="provide-title">
            <h5>Provide the highest quality work that meets your expectation</h5>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="section-button mt-2 text-right">
            <a href="{{ url('contact-us') }}" class="theme-btn">contact us <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

    </div>
  </section> -->

<section class="testimonial py-5">
    <div class="container">

        <!-- Section Heading -->
        <div class="text-center mb-5">
            <span class="text-uppercase small fw-semibold d-block mb-2"
                  style="color: rgba(45, 172, 146, 1);">
                <i class="fa-solid fa-quote-left me-2"></i>Testimonials
            </span>
            <h2 class="fw-semibold mb-2">What Our Happy Clients Say</h2>
            <p class="text-muted mb-0">
                Trusted experiences from our valued clients.
            </p>
        </div>

        <!-- Slick Slider -->
        <div class="testimonial-slider">

            <!-- Testimonial 1 -->
            <div class="px-2 h-100">
                <div class="testimonial-box bg-white border rounded-3 p-4 h-100">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="text-warning small">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <i class="fa-solid fa-quote-right fs-3"
                           style="color: rgba(45, 172, 146, 0.25);"></i>
                    </div>

                    <p>
                        Maseco made our sourcing process easier and more efficient.
                        The experience was smooth, and the team was very helpful.
                    </p>

                    <div class="d-flex align-items-center gap-3 border-top pt-3">
                        <img src="{{ asset('assets/images/testimonial-user.jpg') }}"
                             alt="Client"
                             class="rounded-circle"
                             width="52" height="52"
                             style="object-fit: cover;">

                        <div>
                            <h6 class="mb-1 fw-semibold">Alex John Martin</h6>
                            <small class="text-muted fs-12">Business Client</small>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="px-2 h-100">
                <div class="testimonial-box bg-white border rounded-3 p-4 h-100">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="text-warning small">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <i class="fa-solid fa-quote-right fs-3"
                           style="color: rgba(45, 172, 146, 0.25);"></i>
                    </div>

                    <p>
                        We appreciate the quality and professionalism.
                        Communication was clear, and the overall experience
                        was excellent.
                    </p>

                    <div class="d-flex align-items-center gap-3 border-top pt-3">
                        <img src="{{ asset('assets/images/testimonial-user.jpg') }}"
                             alt="Client"
                             class="rounded-circle"
                             width="52" height="52"
                             style="object-fit: cover;">

                        <div>
                            <h6 class="mb-1 fw-semibold">Sarah Williams</h6>
                            <small class="text-muted fs-12">Verified Client</small>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="px-2 h-100">
                <div class="testimonial-box bg-white border rounded-3 p-4 h-100">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="text-warning small">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <i class="fa-solid fa-quote-right fs-3"
                           style="color: rgba(45, 172, 146, 0.25);"></i>
                    </div>

                    <p>
                        The team was responsive and professional throughout
                        the process. We look forward to continuing our
                        business relationship.
                    </p>

                    <div class="d-flex align-items-center gap-3 border-top pt-3">
                        <img src="{{ asset('assets/images/testimonial-user.jpg') }}"
                             alt="Client"
                             class="rounded-circle"
                             width="52" height="52"
                             style="object-fit: cover;">

                        <div>
                            <h6 class="mb-1 fw-semibold">Michael Brown</h6>
                            <small class="text-muted fs-12">Business Client</small>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>



  <!-- <section class="blogs py-5">
      <div class="container">
        <div class="row">
          <div class="section-heading text-center mt-5" >
            <span class="needle-heading text-uppercase d-block needleIcon">Building  the future</span>
            <h2>whatch our latest blog</h2>
            <p>Textiles are materials made from fibers or yarn, and they are used to create widetest range of products
              such as clothing and industrial goods.</p>
          </div>
        </div>

        <div class="row">

          <div class="blogs-slider">
            <div class="post-post-box" >
              <div class="blogBox">
                <div class="postBox-media">
                  <img src="assets/images/blog-thumb-1.jpeg" class="img-fluid" alt="" decoding="async">
                </div>
                <div class="postBox-textarea">
                  <ul>
                    <li class="postCategory"><i class="fa fa-user"></i>peacefulqode</li>
                    <li class="postDate"><i class="fa fa-calendar"></i>April 13, 202</li>
                  </ul>
                  <h5><a href="#">Empowering Designers with Sustainable Solutions</a></h5>
                  <p>Maseco offers a curated selection of ethically produced and sustainable raw materials...</p>
                  <div class="slider-button">
                    <a href="#" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="post-post-box" >
              <div class="blogBox">
                <div class="postBox-media">
                  <img src="assets/images/blog-thumb-1.jpeg" class="img-fluid" alt="" decoding="async">
                </div>
                <div class="postBox-textarea">
                  <ul>
                    <li class="postCategory"><i class="fa fa-user"></i>peacefulqode</li>
                    <li class="postDate"><i class="fa fa-calendar"></i>April 13, 202</li>
                  </ul>
                  <h5><a href="#">Empowering Designers with Sustainable Solutions</a></h5>
                  <p>Maseco offers a curated selection of ethically produced and sustainable raw materials...</p>
                  <div class="slider-button">
                    <a href="#" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="post-post-box" >
              <div class="blogBox">
                <div class="postBox-media">
                  <img src="assets/images/blog-thumb-1.jpeg" class="img-fluid" alt="" decoding="async">
                </div>
                <div class="postBox-textarea">
                  <ul>
                    <li class="postCategory"><i class="fa fa-user"></i>peacefulqode</li>
                    <li class="postDate"><i class="fa fa-calendar"></i>April 13, 202</li>
                  </ul>
                  <h5><a href="#">Empowering Designers with Sustainable Solutions</a></h5>
                  <p>Maseco offers a curated selection of ethically produced and sustainable raw materials...</p>
                  <div class="slider-button">
                    <a href="#" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="post-post-box" >
              <div class="blogBox">
                <div class="postBox-media">
                  <img src="assets/images/blog-thumb-1.jpeg" class="img-fluid" alt="" decoding="async">
                </div>
                <div class="postBox-textarea">
                  <ul>
                    <li class="postCategory"><i class="fa fa-user"></i>peacefulqode</li>
                    <li class="postDate"><i class="fa fa-calendar"></i>April 13, 202</li>
                  </ul>
                  <h5><a href="#">Empowering Designers with Sustainable Solutions</a></h5>
                  <p>Maseco offers a curated selection of ethically produced and sustainable raw materials...</p>
                  <div class="slider-button">
                    <a href="#" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section> -->
</main>


<script>
  let selectedPlan = null;

  function handlePlanChooseFromButton(btn) {
    const plan = {
      id: btn.getAttribute('data-plan-id'),
      name: btn.getAttribute('data-plan-name'),
      price: parseFloat(btn.getAttribute('data-plan-price')),
      duration: btn.getAttribute('data-plan-duration')
    };
    handlePlanChoose(plan);
  }

  function handlePlanChoose(plan) {
    selectedPlan = plan;
    document.getElementById("planName").value = plan.name;
    document.getElementById("planDuration").value = plan.duration;
    document.getElementById("planAmount").value = plan.price == 0 ? "Free" : "$" + plan.price;
    if (Number(plan.price) === 0) {
      // Directly activate free plan without showing modal
      purchasePlan(plan.id);
    } else {
      new bootstrap.Modal(document.getElementById("paymentModal")).show();
    }
  }

  function purchasePlan(planId) {
    fetch("{{ route('subscription.purchase') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        body: JSON.stringify({
          plan_id: planId,
        }),
      })
      .then(res => res.json())
      .then(async data => {
        if (data.redirect) {
          window.location.href = data.redirect;
        } else if (data.stripe_url) {
          window.location.href = data.stripe_url;
        } else if (data.error) {
          document.getElementById("card-errors").textContent = data.error;
        }
      })
      .catch(err => {
        console.error(err);
        document.getElementById("card-errors").textContent = "Something went wrong!";
      });
  }

  document.getElementById("payButton").addEventListener("click", async () => {
    if (!selectedPlan) return;
    // Paid plan -> hit server to get Stripe URL
    purchasePlan(selectedPlan.id);
  });
</script>


<script>
  (function() {
    function initWorkflowSlider() {
      const section = document.getElementById('how-it-works');
      if (!section) return;

      const track = section.querySelector('#workflowTrack');
      const wrapper = track?.parentElement;
      const slides = track ?
        Array.from(track.querySelectorAll('.workflow-slide')) : [];
      const prev = section.querySelector('#workflowPrev');
      const next = section.querySelector('#workflowNext');
      const dotsContainer = section.querySelector('#workflowDots');

      if (!track || !wrapper || !slides.length || !prev || !next) return;

      let current = 0;
      let startX = 0;
      let resizeTimer;

      function visibleCount() {
        if (window.innerWidth < 576) return 1;
        if (window.innerWidth < 992) return 2;
        return 3;
      }

      function maxIndex() {
        return Math.max(0, slides.length - visibleCount());
      }

      function buildDots() {
        if (!dotsContainer) return;

        dotsContainer.replaceChildren();

        for (let i = 0; i <= maxIndex(); i++) {
          const dot = document.createElement('button');
          dot.type = 'button';
          dot.className = 'workflow-dot';
          dot.setAttribute('aria-label', 'Show slide ' + (i + 1));

          dot.addEventListener('click', function() {
            current = i;
            render();
          });

          dotsContainer.appendChild(dot);
        }
      }

      function render() {
        current = Math.max(0, Math.min(current, maxIndex()));

        const gap = parseFloat(getComputedStyle(track).gap) || 0;
        const availableWidth = wrapper.clientWidth;
        const count = visibleCount();
        const slideWidth = (availableWidth - gap * (count - 1)) / count;

        slides.forEach(function(slide) {
          slide.style.flex = `0 0 ${slideWidth}px`;
        });

        track.style.transform =
          `translateX(-${current * (slideWidth + gap)}px)`;

        prev.disabled = current === 0;
        next.disabled = current === maxIndex();

        prev.classList.toggle('opacity-50', prev.disabled);
        next.classList.toggle('opacity-50', next.disabled);

        if (dotsContainer) {
          Array.from(dotsContainer.children).forEach(function(dot, i) {
            dot.classList.toggle('active', i === current);
            dot.setAttribute('aria-current',
              i === current ? 'true' : 'false');
          });
        }
      }

      prev.addEventListener('click', function() {
        if (current > 0) {
          current--;
          render();
        }
      });

      next.addEventListener('click', function() {
        if (current < maxIndex()) {
          current++;
          render();
        }
      });

      track.addEventListener('touchstart', function(event) {
        startX = event.changedTouches[0].clientX;
      }, {
        passive: true
      });

      track.addEventListener('touchend', function(event) {
        const difference = event.changedTouches[0].clientX - startX;

        if (Math.abs(difference) < 45) return;

        if (difference < 0 && current < maxIndex()) current++;
        if (difference > 0 && current > 0) current--;

        render();
      }, {
        passive: true
      });

      buildDots();
      render();

      window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
          buildDots();
          render();
        }, 100);
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initWorkflowSlider);
    } else {
      initWorkflowSlider();
    }
  })();
</script>

<script>
  function toggleSupplierFavorite(button) {
    const active = button.classList.toggle('is-favorite');
    button.setAttribute('aria-pressed', String(active));
  }

  function compareSupplier(button) {
    const isSelected = button.classList.contains('is-selected');

    const selected = document.querySelectorAll(
      '.maseco-compare-btn.is-selected'
    );

    if (!isSelected && selected.length >= 3) {
      alert('You can compare up to 3 suppliers at a time.');
      return;
    }

    button.classList.toggle('is-selected', !isSelected);
    button.setAttribute('aria-pressed', String(!isSelected));

    button.innerHTML = !isSelected ?
      '<i class="fa fa-check me-1"></i> Selected' :
      '<i class="fa fa-balance-scale me-1"></i> Compare';
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const section = document.querySelector('#featured-suppliers');

    if (!section) return;

    // 1. Reveal elements smoothly as they enter the viewport
    const revealItems = section.querySelectorAll('.reveal-on-scroll');

    if ('IntersectionObserver' in window) {
      const revealObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-revealed');
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.12,
        rootMargin: '0px 0px -25px 0px'
      });

      revealItems.forEach(function(item) {
        revealObserver.observe(item);
      });
    } else {
      revealItems.forEach(function(item) {
        item.classList.add('is-revealed');
      });
    }

    // 2. Toggle supplier favourites
    section.querySelectorAll('.maseco-favorite').forEach(function(button) {
      button.addEventListener('click', function() {
        const isFavourite = button.getAttribute('aria-pressed') === 'true';
        const icon = button.querySelector('i');

        button.setAttribute('aria-pressed', String(!isFavourite));
        button.setAttribute(
          'aria-label',
          (isFavourite ? 'Add ' : 'Remove ') +
          button.closest('.maseco-supplier-card')
          .querySelector('.maseco-supplier-name').textContent +
          (isFavourite ? ' to favourites' : ' from favourites')
        );

        if (icon) {
          icon.classList.toggle('bi-heart', isFavourite);
          icon.classList.toggle('bi-heart-fill', !isFavourite);
        }

        button.classList.remove('is-pop');
        void button.offsetWidth; // Restart the small animation
        button.classList.add('is-pop');
      });
    });

    // 3. Supplier comparison selection
    const compareButtons = section.querySelectorAll('.maseco-compare-btn');
    const compareBar = section.querySelector('#compareBar');
    const compareCount = section.querySelector('#compareCount');
    const clearCompare = section.querySelector('#clearCompare');

    function updateCompareStatus() {
      const selected = section.querySelectorAll(
        '.maseco-compare-btn[aria-pressed="true"]'
      );

      compareCount.textContent = selected.length;
      compareBar.classList.toggle('is-visible', selected.length > 0);
    }

    compareButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        const isSelected = button.getAttribute('aria-pressed') === 'true';
        const selectedCount = section.querySelectorAll(
          '.maseco-compare-btn[aria-pressed="true"]'
        ).length;

        // Limit selection to three suppliers
        if (!isSelected && selectedCount >= 3) {
          compareBar.classList.add('is-visible');
          compareCount.textContent = selectedCount;
          compareBar.setAttribute(
            'aria-label',
            'You can compare up to three suppliers at a time.'
          );
          return;
        }

        button.setAttribute('aria-pressed', String(!isSelected));

        const icon = button.querySelector('i');
        if (icon) {
          icon.className = !isSelected ?
            'bi bi-check2 me-1' :
            'bi bi-arrow-left-right me-1';
        }

        button.lastChild.textContent = !isSelected ?
          ' Selected' :
          ' Compare';

        updateCompareStatus();
      });
    });

    // 4. Clear all selected suppliers
    clearCompare.addEventListener('click', function() {
      compareButtons.forEach(function(button) {
        button.setAttribute('aria-pressed', 'false');

        const icon = button.querySelector('i');
        if (icon) {
          icon.className = 'bi bi-arrow-left-right me-1';
        }

        button.lastChild.textContent = ' Compare';
      });

      updateCompareStatus();
      compareBar.removeAttribute('aria-label');
    });
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('masecoSupplierTrack');

    if (!track) return;

    const cards = Array.from(
        track.querySelectorAll('.maseco-supplier-card')
    );

    const prevButton = document.querySelector('.maseco-supplier-nav.prev');
    const nextButton = document.querySelector('.maseco-supplier-nav.next');
    const progress = document.getElementById('masecoSupplierProgress');
    const count = document.getElementById('masecoSupplierCount');

    if (!cards.length) return;

    function getVisibleCards() {
        if (window.innerWidth <= 575.98) return 1;
        if (window.innerWidth <= 767.98) return 2;
        if (window.innerWidth <= 1199.98) return 3;
        return 4;
    }

    function updateCarousel() {
        const visible = getVisibleCards();
        const maxIndex = Math.max(0, cards.length - visible);
        const cardStep = cards[0].getBoundingClientRect().width +
            parseFloat(getComputedStyle(track).columnGap || 0);

        const index = Math.min(
            maxIndex,
            Math.max(0, Math.round(track.scrollLeft / cardStep))
        );

        const start = Math.min(cards.length, index + 1);
        const end = Math.min(cards.length, index + visible);

        if (progress) {
            const percent = maxIndex === 0
                ? 100
                : ((index + visible) / cards.length) * 100;

            progress.style.width = Math.min(100, percent) + '%';
        }

        if (count) {
            count.textContent =
                String(start).padStart(2, '0') +
                ' — ' +
                String(end).padStart(2, '0');
        }

        if (prevButton) {
            prevButton.disabled = track.scrollLeft <= 2;
            prevButton.style.opacity = prevButton.disabled ? '0.45' : '1';
        }

        if (nextButton) {
            const atEnd =
                track.scrollLeft + track.clientWidth >= track.scrollWidth - 3;

            nextButton.disabled = atEnd;
            nextButton.style.opacity = atEnd ? '0.45' : '1';
        }
    }

    function moveCarousel(direction) {
        const visible = getVisibleCards();
        const gap = parseFloat(getComputedStyle(track).columnGap || 0);
        const cardWidth = cards[0].getBoundingClientRect().width;
        const distance = (cardWidth + gap) * visible;

        track.scrollBy({
            left: direction * distance,
            behavior: 'smooth'
        });
    }

    prevButton?.addEventListener('click', () => moveCarousel(-1));
    nextButton?.addEventListener('click', () => moveCarousel(1));

    track.addEventListener('scroll', updateCarousel, { passive: true });
    window.addEventListener('resize', updateCarousel);

    // Favourite button toggle (visual only; no backend storage)
    document.querySelectorAll('.maseco-favorite').forEach(function (button) {
        button.addEventListener('click', function () {
            const isFavorite = this.getAttribute('aria-pressed') === 'true';

            this.setAttribute('aria-pressed', String(!isFavorite));
            this.classList.toggle('is-favorite', !isFavorite);

            const icon = this.querySelector('i');

            if (icon) {
                icon.classList.toggle('bi-heart', isFavorite);
                icon.classList.toggle('bi-heart-fill', !isFavorite);
            }
        });
    });

    updateCarousel();
});

</script>


@include('Include.footer')