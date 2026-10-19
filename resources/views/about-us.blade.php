@include('Include.header')

<main>

  <section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('public/assets/images/homepage-banner.webp') }});">
    <div class="container">
      <div class="row">
        <div class="inner-banner-heading position-relative z-1 text-center text-white">
         
          <h1>Redefining Fashion Through Sustainability & Innovation</h1>
        </div>
        
      </div>
    </div>
  </section>
<!-- 
  <section class="section-Info py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="thumb">
            <img src="{{ asset('public/assets/images/about-thumb.png') }}" alt="About">
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
          <a href="#" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a> -->
          <!-- </div>
        </div>
      </div>
    </div>
  </section> -->

  <section class="maseco-about-clean py-5" id="about-maseco">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">

            <!-- Left: About content -->
            <div class="col-lg-5">
                <div class="maseco-about-copy">

                    <span class="maseco-about-eyebrow">
                        ABOUT MASECO
                    </span>

                    <h2 class="section-title-h2 mb-2 primary-text-color">
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

                  

                </div>
            </div>

            <!-- Right: Textile image and capability strip -->
            <div class="col-lg-7">
                <div class="maseco-about-visual position-relative">

                    <img
                        src="{{ asset('public/assets/images/about-us.webp') }}"
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


   <section class="maseco-journey">
    <div class="container">

        <!-- Section heading -->
        <div class="journey-heading">
            <span class="journey-eyebrow">
                <i class="bi bi-leaf"></i> THE MASECO JOURNEY
            </span>
            <h2 class="section-title-h2 mb-2">A Smarter Way to Source Textiles</h2>
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
                        src="{{ asset('public/assets/images/sustainable-img.webp') }}"
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


  <section class="testimonial py-5 mb-5">
    <div class="container">

        <!-- Section Heading -->
        <div class="text-center mb-5">
            <span class="text-uppercase small fw-semibold d-block mb-2"
                  style="color: rgba(45, 172, 146, 1);">
                <i class="fa-solid fa-quote-left me-2"></i>Testimonials
            </span>
            <h2 class="section-title-h2 mb-2">What Our Happy Clients Say</h2>
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

                    <p class="text-secondary lh-lg mb-4">
                        Maseco made our sourcing process easier and more efficient.
                        The experience was smooth, and the team was very helpful.
                    </p>

                    <div class="d-flex align-items-center gap-3 border-top pt-3">
                        <img src="{{ asset('public/assets/images/testimonial-user.jpg') }}"
                             alt="Client"
                             class="rounded-circle"
                             width="52" height="52"
                             style="object-fit: cover;">

                        <div>
                            <h6 class="mb-1 fw-semibold">Alex John Martin</h6>
                            <small class="text-muted">Business Client</small>
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

                    <p class="text-secondary lh-lg mb-4">
                        We appreciate the quality and professionalism.
                        Communication was clear, and the overall experience
                        was excellent.
                    </p>

                    <div class="d-flex align-items-center gap-3 border-top pt-3">
                        <img src="{{ asset('public/assets/images/testimonial-user.jpg') }}"
                             alt="Client"
                             class="rounded-circle"
                             width="52" height="52"
                             style="object-fit: cover;">

                        <div>
                            <h6 class="mb-1 fw-semibold">Sarah Williams</h6>
                            <small class="text-muted">Verified Client</small>
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

                    <p class="text-secondary lh-lg mb-4">
                        The team was responsive and professional throughout
                        the process. We look forward to continuing our
                        business relationship.
                    </p>

                    <div class="d-flex align-items-center gap-3 border-top pt-3">
                        <img src="{{ asset('public/assets/images/testimonial-user.jpg') }}"
                             alt="Client"
                             class="rounded-circle"
                             width="52" height="52"
                             style="object-fit: cover;">

                        <div>
                            <h6 class="mb-1 fw-semibold">Michael Brown</h6>
                            <small class="text-muted">Business Client</small>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

</main>


@include('Include.footer')