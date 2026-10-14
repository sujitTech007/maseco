@include('Include.header')

<main>

  <section class="banner inner-banner" style="background-image: url({{ asset('assets/images/inner-banner.jpg)')}};">
    <div class="container">
      <div class="row">
        <div class="inner-banner-heading">
          <h1>About Us</h1>
        </div>
        <div class="breadcrumb-container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('home') }}"><i class="fas fa-home mr-2"></i>Home</a>
            </li>
            <li class="breadcrumb-item active">About Us</li>
          </ol>
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
            <img src="{{ asset('assets/images/about-thumb.png') }}" alt="About">
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

                    <a href="{{ url('/marketplace') }}"
                       class="maseco-about-button">
                        Explore the marketplace
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>
            </div>

            <!-- Right: Textile image and capability strip -->
            <div class="col-lg-7">
                <div class="maseco-about-visual">

                    <img
                        src="{{ asset('assets/images/manufacture.png') }}"
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


  <!-- <section class="services py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="section-heading">
              <span class="needle-heading text-uppercase d-block needleIcon"> Our Services</span>
              <h2>Exploring the Role of Textiles</h2>
              <p>Textiles are materials made from fibers or yarn, and they are used to create widetest range of products
                such as clothing and industrial goods.</p>
            </div>
          </div>
          <div class="col-md-4 px-5">
            <div class="serviceBox">
              <div class="serviceBox-media">
                <img decoding="async" src="assets/images/fabric-thumb.png" alt="raw material suppliers">
              </div>
              <div class="serviceBox-info">
                <div class="serviceBox-icon">
                  <img src="assets/images/raw-material-icon.svg" alt="">
                </div>
                <h4>raw material suppliers</h4>
                <p>This type of database is invaluable for businesses aiming to reduce their environmental footprint</p>
                <div class="section-button mt-2 d-block">
                  <a href="#" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="serviceList">
              <ul>
                <li>
                  <div class="iconThumb">
                    <img src="assets/images/icon/fabric.png" alt="">
                  </div>
                  <h4>raw material suppliers</h4>
                </li>
                <li>
                  <div class="iconThumb">
                    <img src="assets/images/icon/textile.png" alt="">
                  </div>
                  <h4>Reducing textiles</h4>
                </li>
                <li>
                  <div class="iconThumb">
                    <img src="assets/images/icon/machine-learning.png" alt="">
                  </div>
                  <h4>AI Driven suggestions</h4>
                </li>
                <li>
                  <div class="iconThumb">
                    <img src="assets/images/icon/fabrication.png" alt="">
                  </div>
                  <h4>Manufacturers</h4>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </section> -->

  <!-- <section class="process-section py-5">
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
            <div class="col-md-3">
              <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="65"
                data-empty-color="#fff" data-fill-color="#2DAC92">
                <span class="progress-count">65%</span>
              </div>
              <div class="processBox">
                <h4 class="text-white">febric design</h4>
                <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="65"
                data-empty-color="#fff" data-fill-color="#2DAC92">
                <span class="progress-count">65%</span>
              </div>
              <div class="processBox">
                <h4 class="text-white">trusted clients</h4>
                <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="65"
                data-empty-color="#fff" data-fill-color="#2DAC92">
                <span class="progress-count">65%</span>
              </div>
              <div class="processBox">
                <h4 class="text-white">experience years</h4>
                <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="65"
                data-empty-color="#fff" data-fill-color="#2DAC92">
                <span class="progress-count">65%</span>
              </div>
              <div class="processBox">
                <h4 class="text-white">visited confernance</h4>
                <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->


  <!-- <section class="production py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <span class="needle-heading text-uppercase d-block needleIcon">Sustainable Journey </span>
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
                        <img decoding="async" src="{{ asset('assets/images/sustainable-materials.png')}}" alt="images">
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
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="dot-circle"></div>
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
                  <div class="dot-circle"></div>
                </div>
                <div class="timeline-state">
                  <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                      <div class="timeline-image">
                        <img decoding="async" src="{{ asset('assets/images/logistics.png')}}" alt="images"
                          style="visibility: visible; animation-name: fadeInLeft;">
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <div class="timeline-content">
                        <h3>03. Simplify Logistics & Design</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, the majority have suffered
                          alteration in some form, by injected humour, or randomised words which don't look even
                          slightly believable. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="section-button mt-2 d-block">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="dot-circle"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
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

                <a href="{{ url('/marketplace') }}" class="journey-link">
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

          <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="pricebox">

              <div class="price-content">
                <div class="priceboxIcon">
                  <img src="assets/images/icon/basic-icon.svg" alt="">
                </div>
                <h5>Basic Subscription</h5>
                <p class="price-text">Unleash the Power of Your Business with Pro Plan.</p>
                <h2 class="price">Free
                  <span class="dollar"></span>
                </h2>
                <p>Access to basic platform features including viewing a list of suppliers to source raw materials.</p>
                <div class="getStarted-btn">
                  <a href="#" class="theme-btn">Get Started</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="pricebox">

              <div class="price-content">
                <div class="priceboxIcon">
                  <img src="assets/images/icon/premium-icon.svg" alt="">
                </div>
                <h5>Premium Subscription</h5>
                <p class="price-text">Unleash the Power of Your Business with Pro Plan.</p>
                <h2 class="price">
                  <span class="dollar">$</span>69
                  <span class="price-month">/ per month</span>
                </h2>
                <ul class="list-info">
                  <li><i class="fa-solid fa-square-up-right"></i><span>Access to basic features +</span></li>
                  <li><i class="fa-solid fa-square-up-right"></i><span>Access to generative AI +</span></li>
                  <li><i class="fa-solid fa-square-up-right"></i><span>Access to supplier + vendor match-making</span>
                  </li>
                </ul>
                <div class="getStarted-btn">
                  <a href="#" class="theme-btn">Get Started</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="pricebox">
              <div class="priceboxIcon">
                <img src="assets/images/icon/pro-icon.svg" alt="">
              </div>

              <div class="price-content">
                <h5>Pro Subscription</h5>
                <p class="price-text">Take Your Business to the Next Level with Business Plan.</p>
                <h2 class="price">
                  <span class="dollar">$</span>299
                  <span class="price-month">/ per month</span>
                  <span class="pricebox-comment"> + Commission = 5-10% (the commission rate is decided on the range of
                    services used by the designer)</span>
                </h2>


                <ul class="list-info">
                  <li><i class="fa-solid fa-square-up-right"></i><span>Access to basic features +</span></li>
                  <li><i class="fa-solid fa-square-up-right"></i><span>Access to post-production features</span></li>
                </ul>
                <div class="getStarted-btn">
                  <a href="#" class="theme-btn active">Get Started</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

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
              <a href="#" class="theme-btn">contact us <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section> -->
  <section class="testimonial py-5 mb-5">
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

                    <p class="text-secondary lh-lg mb-4">
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
                        <img src="{{ asset('assets/images/testimonial-user.jpg') }}"
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
                        <img src="{{ asset('assets/images/testimonial-user.jpg') }}"
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


  <!-- <section class="blogs py-5">
      <div class="container">
        <div class="row">
          <div class="section-heading text-center mt-5">
            <span class="needle-heading text-uppercase d-block needleIcon">Building  the future </span>
            <h2>whatch our latest blog</h2>
            <p>Textiles are materials made from fibers or yarn, and they are used to create widetest range of products
              such as clothing and industrial goods.</p>
          </div>
        </div>

        <div class="row">
          <div class="blogs-slider">
            <div class="post-post-box">
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
            <div class="post-post-box">
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
          <div class="post-post-box">
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
        <div class="post-post-box">
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


@include('Include.footer')