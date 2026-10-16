@include('Include.header')

<main>

   <section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('assets/images/homepage-banner.webp') }});">
    <div class="container">
      <div class="row">
        <div class="inner-banner-heading position-relative z-1 text-center text-white">
         
          <h1>Subscription</h1>
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

        <div class="col-lg-4 col-md-4">
          <div class="pricebox">

            <div class="price-content">
              <div class="priceboxIcon">
                <img src="{{ asset('assets/images/icon/basic-icon.svg')}}" alt="">
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
        <div class="col-lg-4 col-md-4">
          <div class="pricebox">

            <div class="price-content">
              <div class="priceboxIcon">
                <img src="{{ asset('assets/images/icon/premium-icon.svg') }}" alt="Premium Icon">
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
        <div class="col-lg-4 col-md-4">
          <div class="pricebox">
            <div class="priceboxIcon">
              <img src="{{ asset('assets/images/icon/pro-icon.svg')}}" alt="">
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
  </section>
</main>
@include('Include.footer')


</body>
</php>