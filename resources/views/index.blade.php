@include('Include.header')

<main>


  <section class="position-relative text-white overflow-hidden"
    style="background: #073b35;">

    <!-- Background image and overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100"
      style="background: linear-gradient(90deg, rgba(3,38,39,.94), rgba(3,38,39,.45)), url('{{ asset('assets/images/homebanner.png') }}') center/cover no-repeat;">
    </div>

    <div class="container position-relative py-4 py-lg-5">

      <div class="row">
        <div class="col-lg-10">

          <span class="text-uppercase small fw-bold text-success-emphasis">
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
                    class="btn btn-success  flex-grow-1 fw-semibold text-nowrap p-3">
                    <i class="fa fa-search me-1"></i> Search
                  </button>


                </div>
              </div>

            </div>
          </form>



          <!-- Trust indicators -->
          <div class="row g-3 mt-3">

            <div class="col-6 col-md-3">
              <i class="fa fa-shield me-2 text-success"></i>
              <strong class="small">Verified Suppliers</strong>
              <div class="small text-white-50">
                Trusted textile partners
              </div>
            </div>

            <div class="col-6 col-md-3">
              <i class="fa fa-sliders me-2 text-success"></i>
              <strong class="small">Advanced Search</strong>
              <div class="small text-white-50">
                Find suitable materials
              </div>
            </div>

            <div class="col-6 col-md-3">
              <i class="fa fa-leaf me-2 text-success"></i>
              <strong class="small">Sustainable Textiles</strong>
              <div class="small text-white-50">
                Eco-conscious sourcing
              </div>
            </div>

            <div class="col-6 col-md-3">
              <i class="fa fa-comments me-2 text-success"></i>
              <strong class="small">Buyer–Seller Support</strong>
              <div class="small text-white-50">
                Connect and collaborate
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>
  </section>


<section class="maseco-featured py-5" id="featured-suppliers">
    <div class="container-fluid px-3 px-lg-5">

        <!-- Section heading -->
        <div class="featured-heading">
            <div>
                <span class="featured-eyebrow">
                    <i class="bi bi-leaf-fill"></i> SUSTAINABLE SOURCING
                </span>
                <h2>Meet our <span>featured suppliers.</span></h2>
                <p>Thoughtfully sourced materials. Trusted textile partners.</p>
            </div>

            <a href="{{ url('/marketplace') }}" class="featured-view-all">
                Explore all suppliers <i class="bi bi-arrow-up-right"></i>
            </a>
        </div>

        <!-- Supplier carousel -->
        <div class="supplier-carousel">

            <button class="supplier-nav supplier-prev"
                    type="button" aria-label="Previous suppliers">
                <i class="bi bi-arrow-left"></i>
            </button>

            <div class="supplier-track" id="supplierTrack">

                <!-- Supplier 1 -->
                <article class="supplier-card">
                    <div class="supplier-image-wrap">
                        <div class="supplier-image">
                            <img src="{{ asset('assets/images/sustainable-materials.png') }}"
                                 alt="GreenTextiles sustainable materials"
                                 loading="lazy">
                        </div>

                        <span class="supplier-tag supplier-tag-green">
                            <i class="bi bi-leaf-fill"></i> Eco materials
                        </span>

                        <span class="supplier-category">ORGANIC</span>

                        <button class="supplier-favorite" type="button"
                                aria-label="Add GreenTextiles to favourites"
                                aria-pressed="false">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="supplier-specs">
                        <div class="supplier-moq">
                            <span>MINIMUM ORDER</span>
                            <strong>500 kg</strong>
                        </div>
                        <div class="supplier-rating-box">
                            <i class="bi bi-star-fill"></i>
                            <strong>4.8</strong>
                            <small>24 reviews</small>
                        </div>
                    </div>

                    <div class="supplier-info">
                        <span class="supplier-location">
                            <i class="bi bi-geo-alt"></i> Bangladesh
                        </span>
                        <h3>GreenTextiles Co.</h3>
                        <div class="supplier-materials">
                            <span>Organic cotton</span>
                            <span>Linen</span>
                            <span>Hemp</span>
                        </div>
                        <a href="{{ url('/marketplace') }}" class="supplier-cta">
                            View supplier <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </div>
                </article>

                <!-- Supplier 2 -->
                <article class="supplier-card">
                    <div class="supplier-image-wrap">
                        <div class="supplier-image">
                            <img src="{{ asset('assets/images/manufacture.png') }}"
                                 alt="Sunrise Fabrics textile manufacturing"
                                 loading="lazy">
                        </div>

                        <span class="supplier-tag supplier-tag-pink">
                            <i class="bi bi-recycle"></i> Recycled fibres
                        </span>

                        <span class="supplier-category">RECYCLED</span>

                        <button class="supplier-favorite" type="button"
                                aria-label="Add Sunrise Fabrics to favourites"
                                aria-pressed="false">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="supplier-specs">
                        <div class="supplier-moq">
                            <span>MINIMUM ORDER</span>
                            <strong>300 kg</strong>
                        </div>
                        <div class="supplier-rating-box">
                            <i class="bi bi-star-fill"></i>
                            <strong>4.7</strong>
                            <small>18 reviews</small>
                        </div>
                    </div>

                    <div class="supplier-info">
                        <span class="supplier-location">
                            <i class="bi bi-geo-alt"></i> India
                        </span>
                        <h3>Sunrise Fabrics</h3>
                        <div class="supplier-materials">
                            <span>Recycled polyester</span>
                            <span>Cotton</span>
                            <span>Knits</span>
                        </div>
                        <a href="{{ url('/marketplace') }}" class="supplier-cta">
                            View supplier <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </div>
                </article>

                <!-- Supplier 3 -->
                <article class="supplier-card">
                    <div class="supplier-image-wrap">
                        <div class="supplier-image">
                            <img src="{{ asset('assets/images/logistics.png') }}"
                                 alt="EcoWeave linen and modal materials"
                                 loading="lazy">
                        </div>

                        <span class="supplier-tag supplier-tag-blue">
                            <i class="bi bi-flower1"></i> Natural fibres
                        </span>

                        <span class="supplier-category">NATURAL</span>

                        <button class="supplier-favorite" type="button"
                                aria-label="Add EcoWeave to favourites"
                                aria-pressed="false">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="supplier-specs">
                        <div class="supplier-moq">
                            <span>MINIMUM ORDER</span>
                            <strong>1,000 kg</strong>
                        </div>
                        <div class="supplier-rating-box">
                            <i class="bi bi-star-fill"></i>
                            <strong>4.6</strong>
                            <small>22 reviews</small>
                        </div>
                    </div>

                    <div class="supplier-info">
                        <span class="supplier-location">
                            <i class="bi bi-geo-alt"></i> Turkey
                        </span>
                        <h3>EcoWeave Ltd.</h3>
                        <div class="supplier-materials">
                            <span>Linen</span>
                            <span>Tencel</span>
                            <span>Modal</span>
                        </div>
                        <a href="{{ url('/marketplace') }}" class="supplier-cta">
                            View supplier <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </div>
                </article>

                <!-- Supplier 4 -->
                <article class="supplier-card">
                    <div class="supplier-image-wrap">
                        <div class="supplier-image">
                            <img src="{{ asset('assets/images/sustainable-materials.png') }}"
                                 alt="Global Textiles fabric collection"
                                 loading="lazy">
                        </div>

                        <span class="supplier-tag supplier-tag-orange">
                            <i class="bi bi-patch-check"></i> Textile partner
                        </span>

                        <span class="supplier-category">WOVEN FABRICS</span>

                        <button class="supplier-favorite" type="button"
                                aria-label="Add Global Textiles to favourites"
                                aria-pressed="false">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="supplier-specs">
                        <div class="supplier-moq">
                            <span>MINIMUM ORDER</span>
                            <strong>500 kg</strong>
                        </div>
                        <div class="supplier-rating-box">
                            <i class="bi bi-star-fill"></i>
                            <strong>4.5</strong>
                            <small>27 reviews</small>
                        </div>
                    </div>

                    <div class="supplier-info">
                        <span class="supplier-location">
                            <i class="bi bi-geo-alt"></i> China
                        </span>
                        <h3>Global Textiles</h3>
                        <div class="supplier-materials">
                            <span>Polyester</span>
                            <span>Nylon</span>
                            <span>Wovens</span>
                        </div>
                        <a href="{{ url('/marketplace') }}" class="supplier-cta">
                            View supplier <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </div>
                </article>

                <!-- Supplier 5 -->
                <article class="supplier-card">
                    <div class="supplier-image-wrap">
                        <div class="supplier-image">
                            <img src="{{ asset('assets/images/manufacture.png') }}"
                                 alt="Pure Fibers organic and recycled fibres"
                                 loading="lazy">
                        </div>

                        <span class="supplier-tag supplier-tag-green">
                            <i class="bi bi-leaf-fill"></i> Natural fibres
                        </span>

                        <span class="supplier-category">ECO FIBRES</span>

                        <button class="supplier-favorite" type="button"
                                aria-label="Add Pure Fibers to favourites"
                                aria-pressed="false">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="supplier-specs">
                        <div class="supplier-moq">
                            <span>MINIMUM ORDER</span>
                            <strong>200 kg</strong>
                        </div>
                        <div class="supplier-rating-box">
                            <i class="bi bi-star-fill"></i>
                            <strong>4.6</strong>
                            <small>16 reviews</small>
                        </div>
                    </div>

                    <div class="supplier-info">
                        <span class="supplier-location">
                            <i class="bi bi-geo-alt"></i> Pakistan
                        </span>
                        <h3>Pure Fibers Co.</h3>
                        <div class="supplier-materials">
                            <span>Organic cotton</span>
                            <span>Recycled fibres</span>
                            <span>Bamboo</span>
                        </div>
                        <a href="{{ url('/marketplace') }}" class="supplier-cta">
                            View supplier <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </div>
                </article>

            </div>

            <button class="supplier-nav supplier-next"
                    type="button" aria-label="Next suppliers">
                <i class="bi bi-arrow-right"></i>
            </button>
        </div>

        <div class="supplier-carousel-footer">
            <div class="supplier-progress">
                <span id="supplierProgress"></span>
            </div>
            <span class="supplier-slide-count" id="supplierSlideCount">
                01 — 05
            </span>
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


  <section class="maseco-about py-5" id="about-us">
    <div class="container">
      <div class="row align-items-center g-4 g-lg-5">

        <!-- Left: About image -->
        <div class="col-md-6">
          <div class="maseco-about-visual reveal-about">
            <div class="maseco-about-image">
              <img src="{{ asset('assets/images/about-thumb.png') }}"
                alt="Maseco sustainable fashion and textile solutions"
                loading="lazy">
            </div>

            <div class="maseco-about-stamp">
              <i class="fa fa-leaf"></i>
              <span>Sourcing for<br> a better future</span>
            </div>

            <div class="maseco-about-caption">
              <span class="maseco-caption-icon">
                <i class="fa fa-check"></i>
              </span>
              <div>
                <strong>Designed for sustainability</strong>
                <small>Better choices. Better materials.</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Right: About content -->
        <div class="col-md-6">
          <div class="maseco-about-content reveal-about">
            <span class="maseco-about-eyebrow">
              <span class="maseco-eyebrow-line"></span>
              ABOUT MASECO
            </span>

            <h2 class="maseco-about-title">
              Let’s Build Something
              <span>Creative Together.</span>
            </h2>

            <p class="maseco-about-description">
              Maseco is a sustainability-driven fashion solutions provider,
              empowering designers with responsible sourcing, ethical
              manufacturing, and AI-powered design insights.
            </p>

            <div class="maseco-about-features">

              <div class="maseco-about-feature">
                <span class="maseco-feature-icon">
                  <i class="fa fa-leaf"></i>
                </span>
                <div>
                  <h3>Ethical &amp; Sustainable Materials</h3>
                  <p>Discover materials aligned with more responsible sourcing.</p>
                </div>
              </div>

              <div class="maseco-about-feature">
                <span class="maseco-feature-icon">
                  <i class="fa fa-industry"></i>
                </span>
                <div>
                  <h3>Seamless Manufacturing Support</h3>
                  <p>Connect with partners to support your production journey.</p>
                </div>
              </div>

              <div class="maseco-about-feature">
                <span class="maseco-feature-icon">
                  <i class="fa fa-recycle"></i>
                </span>
                <div>
                  <h3>Recycling &amp; R&amp;D Innovation</h3>
                  <p>Explore ideas for material innovation and circularity.</p>
                </div>
              </div>

              <div class="maseco-about-feature">
                <span class="maseco-feature-icon">
                  <i class="fa fa-lightbulb-o"></i>
                </span>
                <div>
                  <h3>AI-Driven Design Assistance</h3>
                  <p>Bring design ideas forward with AI-powered insights.</p>
                </div>
              </div>

              <div class="maseco-about-feature">
                <span class="maseco-feature-icon">
                  <i class="fa fa-truck"></i>
                </span>
                <div>
                  <h3>Hassle-Free Logistics &amp; Admin</h3>
                  <p>Simplify the steps involved in managing your sourcing needs.</p>
                </div>
              </div>

            </div>

            <div class="maseco-about-actions">
              <a href="{{ url('about-us') }}" class="maseco-about-btn">
                Discover Our Story
                <i class="fa fa-arrow-right ms-2"></i>
              </a>

              <span class="maseco-about-note">
                <i class="fa fa-leaf me-1"></i>
                A more thoughtful approach to fashion
              </span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="py-5 bg-light" id="how-it-works">
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
        <div class="col-lg-5 text-lg-end">
          <a href="{{ url('/marketplace') }}"
            class="btn btn-success btn-sm px-4">
            Explore Marketplace <i class="fa fa-arrow-right ms-2"></i>
          </a>
        </div>
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

                  <p class="small fw-semibold text-success mb-2">
                    {{ $item['subtitle'] }}
                  </p>

                  <p class="small text-secondary">
                    {{ $item['description'] }}
                  </p>

                  <ul class="list-unstyled small text-secondary mb-4">
                    @foreach($item['points'] as $point)
                    <li class="mb-2">
                      <i class="fa fa-check-circle text-success me-2"></i>
                      {{ $point }}
                    </li>
                    @endforeach
                  </ul>

                  <a href="{{ url('/marketplace') }}"
                    class="small fw-semibold text-success text-decoration-none">
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
          <p class="small text-secondary mb-0">
            Connect with textile partners and explore more
            sustainable sourcing opportunities.
          </p>
        </div>

        <div class="col-6 col-lg-3">
          <i class="fa fa-shield text-success me-2"></i>
          <span class="small fw-semibold">Supplier Verification</span>
        </div>

        <div class="col-6 col-lg-2">
          <i class="fa fa-recycle text-success me-2"></i>
          <span class="small fw-semibold">Eco-conscious Options</span>
        </div>

        <div class="col-lg-3 text-lg-end">
          <a href="{{ url('/marketplace') }}"
            class="btn btn-success btn-sm px-4">
            Get Started <i class="fa fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

    </div>
  </section>


  <!-- 
  <section class="services py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="section-heading">
            <span class="needle-heading text-uppercase d-block needleIcon">Our Services</span>
            <h2>Exploring the Role of Textiles</h2>
            <p>Textiles are materials made from fibers or yarn, and they are used to create widetest range of products
              such as clothing and industrial goods.</p>
          </div>
        </div>
        <div class="col-md-4 px-lg-5 px-md-3 px-sm-0">
          <div class="serviceBox">
            <div class="serviceBox-media">
              <img decoding="async" src="{{ asset('assets/images/fabric-thumb.png')}}" alt="raw material suppliers">
            </div>
            <div class="serviceBox-info">
              <div class="serviceBox-icon">
                <img src="assets/images/raw-material-icon.svg" alt="">
              </div>
              <h4>raw material suppliers</h4>
              <p>This type of database is invaluable for businesses aiming to reduce their environmental footprint</p>
              <div class="section-button mt-2 d-block">
                <a href="{{ url('raw-material-supplier') }}" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="serviceList">
            <ul>
              <li>
                <div class="iconThumb">
                  <img src="{{ asset('assets/images/icon/fabric.png')}}" alt="">
                </div>
                <h4>raw material suppliers</h4>
              </li>
              <li>
                <div class="iconThumb">
                  <img src="{{ asset('assets/images/icon/textile.png')}}" alt="">
                </div>
                <h4>Reducing textiles</h4>
              </li>
              <li>
                <div class="iconThumb">
                  <img src="{{ asset('assets/images/icon/machine-learning.png')}}" alt="">
                </div>
                <h4>AI Driven suggestions</h4>
              </li>
              <li>
                <div class="iconThumb">
                  <img src="{{ asset('assets/images/icon/fabrication.png')}}" alt="">
                </div>
                <h4>Manufacturers</h4>
              </li>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
   -->
  <!-- Our Services Section -->


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

            <h3>Supplier<br>Discovery</h3>

            <p>
              Discover textile manufacturers and suppliers
              that match your sourcing requirements.
            </p>

            <a href="{{ url('/marketplace') }}" class="service-button">
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

            <h3>Sustainable<br>Materials</h3>

            <p>
              Explore eco-conscious fabrics and materials
              for more responsible textile production.
            </p>

            <a href="{{ url('/marketplace') }}?eco_certified=1"
              class="service-button">
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

            <h3>Compare &amp;<br>Connect</h3>

            <p>
              Review supplier options, compare your sourcing
              needs, and find the right business partner.
            </p>

            <a href="{{ url('/marketplace') }}" class="service-button">
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

            <h3>Business<br>Communication</h3>

            <p>
              Connect with textile businesses to discuss
              requirements and build lasting relationships.
            </p>

            <a href="{{ url('/contact-us') }}" class="service-button">
              Get in touch
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </article>
        </div>

      </div>

    </div>
  </section>


  <!-- End Our Services Section -->


  <section class="process-section py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading text-white">
            <span class="needle-heading text-uppercase d-block needleIcon">Brands That Trust Maseco</span>
            <h2 class="text-white">We Give Top Production From
              Every Angle</h2>
            <p>Maseco is a sustainability-driven fashion solutions provider, empowering designers with responsible
              sourcing, ethical manufacturing, and AI-powered design insights.</p>
          </div>
        </div>
      </div>
      <div class="process-box">
        <div class="row">
          <div class="col-md-3 mb- ">
            <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="65"
              data-empty-color="#fff" data-fill-color="#2DAC92">
              <span class="progress-count">65%</span>
            </div>
            <div class="processBox">
              <h4 class="text-white">febric design</h4>
              <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
            </div>
          </div>
          <div class="col-md-3 mb-">
            <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="75"
              data-empty-color="#fff" data-fill-color="#2DAC92">
              <span class="progress-count">75%</span>
            </div>
            <div class="processBox">
              <h4 class="text-white">trusted clients</h4>
              <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
            </div>
          </div>
          <div class="col-md-3 mb-">
            <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="80"
              data-empty-color="#fff" data-fill-color="#2DAC92">
              <span class="progress-count">80%</span>
            </div>
            <div class="processBox">
              <h4 class="text-white">experience years</h4>
              <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
            </div>
          </div>
          <div class="col-md-3 mb-">
            <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="70"
              data-empty-color="#fff" data-fill-color="#2DAC92">
              <span class="progress-count">70%</span>
            </div>
            <div class="processBox">
              <h4 class="text-white">visited confernance</h4>
              <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="production py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <span class="needle-heading text-uppercase d-block needleIcon">Sustainable Journey</span>
            <h2>Sustainable Fashion Business with Maseco</h2>
            <p>Maseco is a sustainability-driven fashion solutions provider, empowering designers with responsible
              sourcing, ethical manufacturing, and AI-powered design insights.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container position-relative mt-5">
      <div class="border-line"></div>
      <div class="row">
        <div class="col-lg-12">
          <div class="timelines">
            <div class="timeline">
              <div class="timeline-states">
                <div class="timeline-state">
                  <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                      <div class="timeline-image">
                        <img decoding="async" src="{{ asset('assets/images/sustainable-materials.png')}}" alt="images"
                          style="visibility: visible; animation-name: fadeInLeft;">
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <div class="timeline-details position-relative">
                        <div class="timeline-content">
                          <h3>01. Source Ethical & Sustainable Materials</h3>
                          <p>There are many variations of passages of Lorem Ipsum available, the majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't look
                            even slightly believable. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                          <div class="section-button mt-2 d-block">
                            <a href="{{ url('about-us') }}" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="dot-circle" data-aos="zoom-in"></div>
                </div>
                <div class="timeline-state">
                  <div class="row align-items-center flex-column-reverse flex-md-row">
                    <div class="col-lg-6 col-md-6">
                      <div class="timeline-content">
                        <h3>02. Manufacture with Trusted Partners</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, the majority have suffered
                          alteration in some form, by injected humour, or randomised words which don't look even
                          slightly believable. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="section-button mt-2 d-block">
                          <a href="{{ url('about-us') }}" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <div class="timeline-image">
                        <img decoding="async" src="{{ asset('assets/images/manufacture.png')}}" class="wow  fadeInRight animated"
                          alt="images" style="visibility: visible; animation-name: fadeInRight;">
                      </div>
                    </div>
                  </div>
                  <div class="dot-circle" data-aos="zoom-in"></div>
                </div>
                <div class="timeline-state">
                  <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                      <div class="timeline-image">
                        <img decoding="async" src="{{ asset('assets/images/logistics.png')}}" alt="images">
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <div class="timeline-content">
                        <h3>03.Simplify Logistics & Design</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, the majority have suffered
                          alteration in some form, by injected humour, or randomised words which don't look even
                          slightly believable. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="section-button mt-2 d-block">
                          <a href="{{ url('about-us') }}" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="dot-circle" data-aos="zoom-in"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="price-section py-5">
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


  <section class="provide-section py-4">
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
  </section>
  <section class="testimonial py-5 mb-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4 col-sm-12">
          <div class="testimonial-image-box m-auto">
            <img src="{{ asset('assets/images/testimonial-thumb-1.jpg')}}" alt="">
            <!-- <div class="quote">
                <i class="fas fa-quote-right"></i>
              </div> -->
            <!-- <div class="icon-box"  >
                <div class="icon">
                  <img src="{{ asset('assets/images/icon/machine-icon.svg')}}" alt="">
                </div>
                <div class="icon-box-content">
                  <h6>Over All Rating</h6>
                  <p>Based on 2555 Reviews</p>
                </div>
              </div> -->
          </div>
        </div>
        <div class="col-md-8 col-sm-12 ps-md-5">
          <div class="section-heading text-white">
            <span class="needle-heading text-uppercase d-block needleIcon">our testimonials</span>
            <h2 class="text-white">what our happy clients say</h2>
          </div>
          <div class="testimonials">
            <div class="testimonial-slider">
              <div class="testimonial-box">
                <div class="testimonial-content py-4">
                  <p>Maseco has made sustainable material sourcing much easier for our design process. Being able to explore suitable materials and connect with relevant suppliers in one place has saved us valuable time</p>
                </div>
                <div class="testimonial-info">
                  <div class="testimonial-meta d-flex align-items-center">
                    <div class="testimonial-img d-none">
                      <img decoding="async" src="{{ asset('assets/images/testimonial-user.jpg')}}" alt="testimonial-img">
                    </div>
                    <div class="testimonial-data">
                      <h5>Alessia Romano</h5>
                      <span>Fashion Designer</span>
                    </div>
                  </div>
                  <!-- <div class="testimonial-meta">
                      <div class="testimonial-star">
                        <i class="fa fa-star"  ></i>
                        <i class="fa fa-star"  ></i>
                        <i class="fa fa-star"  ></i>
                        <i class="fa fa-star"  ></i>
                        <i class="fa fa-star"  ></i>
                      </div>
                      <div class="owlNav"></div>
                    </div> -->
                </div>
              </div>
              <div class="testimonial-box">
                <div class="testimonial-content py-5">
                  <p>Maseco gives us a much clearer path from sourcing to manufacturing. The platform helps us discover the right materials and production partners without making the process unnecessarily complicated.</p>
                </div>
                <div class="testimonial-info">
                  <div class="testimonial-meta d-flex align-items-center">

                    <div class="testimonial-data">
                      <h5>Tanvir Hasan</h5>
                      <span>Apparel Brand Founder</span>
                    </div>
                  </div>

                </div>
              </div>
              <div class="testimonial-box">
                <div class="testimonial-content py-5">
                  <p>The AI-driven suggestions have been particularly useful when exploring new design and material possibilities. Maseco brings technology and sustainability together in a way that supports our creative process.</p>
                </div>
                <div class="testimonial-info">
                  <div class="testimonial-meta d-flex align-items-center">

                    <div class="testimonial-data">
                      <h5>Yuki Nakamura</h5>
                      <span>Product Designer</span>
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
    const track = document.getElementById('supplierTrack');
    if (!track) return;

    const cards = Array.from(track.querySelectorAll('.supplier-card'));
    const prev = document.querySelector('.supplier-prev');
    const next = document.querySelector('.supplier-next');
    const progress = document.getElementById('supplierProgress');
    const count = document.getElementById('supplierSlideCount');

    function visibleCards() {
        if (window.innerWidth <= 479) return 1;
        if (window.innerWidth <= 767) return 2;
        if (window.innerWidth <= 1199) return 3;
        return 4;
    }

    function cardStep() {
        const card = cards[0];
        if (!card) return 0;

        const styles = getComputedStyle(track);
        const gap = parseFloat(styles.columnGap) || 0;
        return card.getBoundingClientRect().width + gap;
    }

    function updateCarousel() {
        const step = cardStep();
        const visible = visibleCards();
        const maxScroll = Math.max(0, track.scrollWidth - track.clientWidth);
        const current = step ? Math.round(track.scrollLeft / step) : 0;
        const maxIndex = Math.max(0, cards.length - visible);

        if (prev) prev.disabled = track.scrollLeft <= 2;
        if (next) next.disabled = track.scrollLeft >= maxScroll - 2;

        if (progress) {
            const percentage = maxScroll > 0
                ? (track.scrollLeft / maxScroll) * 100
                : 100;
            progress.style.width = percentage + '%';
        }

        if (count) {
            const first = Math.min(current + 1, cards.length);
            const last = Math.min(first + visible - 1, cards.length);

            count.textContent =
                String(first).padStart(2, '0') + ' — ' +
                String(last).padStart(2, '0');
        }
    }

    function moveCarousel(direction) {
        track.scrollBy({
            left: cardStep() * visibleCards() * direction,
            behavior: 'smooth'
        });
    }

    prev?.addEventListener('click', () => moveCarousel(-1));
    next?.addEventListener('click', () => moveCarousel(1));

    track.addEventListener('scroll', updateCarousel, { passive: true });
    window.addEventListener('resize', updateCarousel);

    // Favourite button interaction
    document.querySelectorAll('.supplier-favorite').forEach(button => {
        button.addEventListener('click', function () {
            const active = this.getAttribute('aria-pressed') !== 'true';

            this.setAttribute('aria-pressed', String(active));
            this.classList.toggle('is-favorite', active);

            const icon = this.querySelector('i');
            if (icon) {
                icon.classList.toggle('bi-heart-fill', active);
                icon.classList.toggle('bi-heart', !active);
            }
        });
    });

    updateCarousel();
});
</script>

@include('Include.footer')