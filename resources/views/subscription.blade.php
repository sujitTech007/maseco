@include('Include.header')

<main>

   <section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('public/assets/images/homepage-banner.webp') }});">
    <div class="container">
      <div class="row">
        <div class="inner-banner-heading position-relative z-1 text-center text-white">
         
          <h1>Subscription</h1>
        </div>
        
      </div>
    </div>
  </section>

 
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
        <div class="row g-4 align-items-stretch pricing_row mt-3">

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
</main>
@include('Include.footer')

