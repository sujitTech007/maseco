@include('Include.header')
  <main>

    <section class="banner">
      <ul class="slider-items p-0">
        <li class="slider-item">
          <picture>
            <img src="{{ asset('assets/images/homebanner.png')}}" alt="Banner" />
          </picture>
          <div class="container slider-content">
            <div class="flex-column">
              <span class="sub-heading textpercase d-block needleIcon" >welcome to Maseco</span>
              <h2 >Empowering Canadian Designers Build Sustainable Businesses</h2>
              <p >Textiles are materials made from fibers or yarn, and they are used to create a wide range of products
                such as clothing, household items, and industrial goods.</p>
              <div class="slider-button" >
                <a href="{{ url('contact-us') }}" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </li>
        <li class="slider-item">
          <picture>
            <img src="{{ asset('assets/images/banner.png')}}" alt="Banner" />
          </picture>
          <div class="container slider-content">
            <div class="flex-column">
              <span class="sub-heading textpercase d-block needleIcon" >welcome to Maseco</span>
              <h2 >Empowering Canadian Designers Build Sustainable Businesses</h2>
              <p >Textiles are materials made from fibers or yarn, and they are used to create a wide range of products
                such as clothing, household items, and industrial goods.</p>
              <div class="slider-button" >
                <a href="{{ url('contact-us') }}" class="theme-btn">Read More <i class="fa fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </li>

      </ul>
    </section>

    <section class="section-Info py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12" >
            <div class="thumb">
              <img src="{{ asset('assets/images/about-thumb.png')}}" alt="About" />
            </div>
          </div>
          <div class="col-md-6 col-sm-12 text-wrapper ps-md-5">
            <div class="section-heading" >
              <span class="needle-heading text-uppercase d-block needleIcon">About Us</span>
              <h2>Let’s Build Something Creative Together</h2>
              <p>Maseco is a sustainability-driven fashion solutions provider, empowering designers with responsible
                sourcing, ethical manufacturing, and AI-powered design insights.</p>
            </div>
            <ul class="listing list-with-icon" >
              <li>Ethical & Sustainable Materials</li>
              <li>Seamless Manufacturing Support</li>
              <li>Recycling & R&D Innovation</li>
              <li>AI-Driven Design Assistance</li>
              <li>Hassle-Free Logistics & Admin</li>
            </ul>
            <div class="section-button mt-5 d-block">
              <a href="{{ url('about-us') }}" class="theme-btn" >Read More <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="services py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4" >
            <div class="section-heading" >
              <span class="needle-heading text-uppercase d-block needleIcon">Our Services</span>
              <h2>Exploring the Role of Textiles</h2>
              <p>Textiles are materials made from fibers or yarn, and they are used to create widetest range of products
                such as clothing and industrial goods.</p>
            </div>
          </div>
          <div class="col-md-4 px-lg-5 px-md-3 px-sm-0" >
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
                <li >
                  <div class="iconThumb">
                    <img src="{{ asset('assets/images/icon/fabric.png')}}" alt="">
                  </div>
                  <h4>raw material suppliers</h4>
                </li>
                <li >
                  <div class="iconThumb">
                    <img src="{{ asset('assets/images/icon/textile.png')}}" alt="">
                  </div>
                  <h4>Reducing textiles</h4>
                </li>
                <li >
                  <div class="iconThumb">
                    <img src="{{ asset('assets/images/icon/machine-learning.png')}}" alt="">
                  </div>
                  <h4>AI Driven suggestions</h4>
                </li>
                <li >
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
            <div class="col-md-3 mb- " >
              <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="65"
                data-empty-color="#fff" data-fill-color="#2DAC92">
                <span class="progress-count">65%</span>
              </div>
              <div class="processBox">
                <h4 class="text-white">febric design</h4>
                <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
              </div>
            </div>
            <div class="col-md-3 mb-" >
              <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="75"
                data-empty-color="#fff" data-fill-color="#2DAC92">
                <span class="progress-count">75%</span>
              </div>
              <div class="processBox">
                <h4 class="text-white">trusted clients</h4>
                <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
              </div>
            </div>
            <div class="col-md-3 mb-" >
              <div class="circle-progress-bar" data-size="180" data-thickness="5" data-skill-level="80"
                data-empty-color="#fff" data-fill-color="#2DAC92">
                <span class="progress-count">80%</span>
              </div>
              <div class="processBox">
                <h4 class="text-white">experience years</h4>
                <p class="text-white">From Handcrafted such as using organic Textiles Production</p>
              </div>
            </div>
            <div class="col-md-3 mb-" >
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
            <div class="section-heading" >
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
                      <div class="col-lg-6 col-md-6" >
                        <div class="timeline-image">
                          <img decoding="async" src="{{ asset('assets/images/sustainable-materials.png')}}" alt="images"
                            style="visibility: visible; animation-name: fadeInLeft;">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6" >
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
                      <div class="col-lg-6 col-md-6" >
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
                      <div class="col-lg-6 col-md-6" >
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
                      <div class="col-lg-6 col-md-6" >
                        <div class="timeline-image">
                          <img decoding="async" src="{{ asset('assets/images/logistics.png')}}" alt="images"
                           >
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6" >
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
            <div class="section-heading" >
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
          <div class="pricebox"  data-aos-duration="{{ 500 + ($loop->index * 300) }}">
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
            <div class="provide-title"  >
              <h5>Provide the highest quality work that meets your expectation</h5>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="section-button mt-2 text-right"  >
              <a href="{{ url('contact-us') }}" class="theme-btn">contact us <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

      </div>
    </section>
    <section class="testimonial py-5 mb-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-4 col-sm-12"  >
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
          <div class="col-md-8 col-sm-12 ps-md-5"  >
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

  function handlePlanChooseFromButton(btn){
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

  function purchasePlan(planId){
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

@include('Include.footer')
