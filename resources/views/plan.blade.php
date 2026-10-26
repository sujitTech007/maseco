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
  <!-- <section class="price-section py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading" data-aos="fade-down">
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
          <div class="pricebox" data-aos="fade-up" data-aos-duration="{{ 500 + ($loop->index * 300) }}">
            <div class="priceboxIcon">
              @php
              $icon = 'basic-icon.svg';
              if(stripos($plan->name, 'premium') !== false) $icon = 'premium-icon.svg';
              elseif(stripos($plan->name, 'pro') !== false) $icon = 'pro-icon.svg';
              @endphp
              <img src="{{ asset('public/assets/images/icon/' . $icon) }}" alt="">
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
        <div class="pricing-heading text-center mb-3">
            <span class="pricing-eyebrow">OUR SUBSCRIPTION</span>
            <h2 class="section-title-h2 mb-2 primary-text-color">Choose the right plan for your sourcing journey</h2>
            <p>
                Access textile suppliers, sustainable materials and production
                solutions — all in one place.
            </p>
            @if(session('error'))<div class="alert alert-danger mt-3">{{ session('error') }}</div>@endif
            @if($activeSubscription)
                <div class="alert alert-success mt-3">Your {{ $activeSubscription->plan_name }} plan is active until {{ \Illuminate\Support\Carbon::parse($activeSubscription->end_date)->format('d M Y') }}. You can upgrade to a higher plan.</div>
            @endif
        </div>

        <!-- Plans -->
        <div class="row g-4 align-items-stretch pricing_row">

            @foreach($plans as $plan)

            @php
                $planName = strtolower($plan->name ?? '');

                if (stripos($planName, 'premium') !== false) {
                    $planIcon = 'fa-solid fa-wand-magic-sparkles';
                } elseif (stripos($planName, 'pro') !== false) {
                    $planIcon = 'fa-solid fa-city';
                } else {
                    $planIcon = 'fa-solid fa-leaf';
                }

                $storedFeatures = $plan->features;

                if (is_string($storedFeatures)) {
                    $decodedFeatures = json_decode($storedFeatures, true);
                    $storedFeatures = is_array($decodedFeatures)
                        ? $decodedFeatures
                        : [$storedFeatures];
                }

                $features = [];

                foreach (is_array($storedFeatures) ? $storedFeatures : [] as $storedFeature) {
                    if (!is_scalar($storedFeature)) {
                        continue;
                    }

                    foreach (preg_split('/\r\n|\r|\n/', (string) $storedFeature) as $feature) {
                        $feature = trim($feature);

                        if (substr($feature, -1) === '+') {
                            $feature = rtrim($feature, '+ ');
                        }

                        if ($feature !== '') {
                            $features[] = $feature;
                        }
                    }
                }

                $isPremium = stripos($plan->name ?? '', 'premium') !== false;
                $hasActiveSubscription = !empty($activeSubscription);
                $isCurrentOrLower = $hasActiveSubscription && (float)$plan->price <= (float)($activeSubscription->price ?? 0);
            @endphp

            <div class="col-lg-4">
                <article class="maseco-plan {{ $isPremium ? 'maseco-plan-featured bg-success bg-opacity-10' : '' }} shadow">

                    @if($isPremium)
                        <span class="plan-popular">MOST POPULAR</span>
                    @endif

                    <div class="plan-icon">
                        <i class="{{ $planIcon }}"></i>
                    </div>

                    <h3>{{ $plan->name }}</h3>

                    <div class="plan-price">
                        @if($plan->price == 0)
                            Free
                        @else
                            ${{ rtrim(rtrim(number_format($plan->price, 2, '.', ''), '0'), '.') }}
                            <span>/ {{ $plan->duration }}</span>
                        @endif
                    </div>

                    <!-- <p class="plan-description">
                        {{ $plan->description ?? '' }}
                    </p> -->

                    <!-- @if($plan->commission)
                        <p class="plan-description">
                            + Commission = {{ $plan->commission }}
                        </p>
                    @endif -->

                    <hr>

                    @if(count($features))
                        <ul class="plan-features">
                            @foreach($features as $feature)
                                <li>
                                    <i class="fa-solid fa-circle-check"></i>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="getStarted-btn">
                            @if($isCurrentOrLower)
                                <button type="button" class="btn theme-btn-outline w-100" disabled>{{ strtolower($plan->name) === strtolower($activeSubscription->plan_name ?? '') ? 'Current Plan' : 'Included in Your Plan' }}</button>
                            @else
                            <button
                                type="button"
                                class="btn {{ $isPremium ? 'theme-btn text-white w-100' : '' }} theme-btn-outline w-100"
                                data-plan-id="{{ $plan->id }}"
                                data-plan-name="{{ $plan->name }}"
                                data-plan-price="{{ $plan->price }}"
                                data-plan-duration="{{ $plan->duration }}"
                                onclick="handlePlanChooseFromButton(this)">

                                @if($hasActiveSubscription)
                                    Upgrade Plan
                                @elseif($plan->price == 0)
                                    Get started
                                @elseif($isPremium)
                                    Explore Premium
                                @else
                                    Contact our team
                                @endif

                            </button>
                            @endif

                    </div>

                </article>
            </div>

            @endforeach

        </div>
    </div>
</section>

</main>

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

@include('Include.footer')

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
          "Accept": "application/json",
        },
        body: JSON.stringify({
          plan_id: planId,
        }),
      })
      .then(async res => {
        const data = await res.json().catch(() => ({}));
        if (!res.ok && !data.error) data.error = data.message || "The subscription request could not be completed.";
        return data;
      })
      .then(data => {
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
        document.getElementById("card-errors").textContent = "Something went wrong. Please try again.";
      });
  }

  document.getElementById("payButton").addEventListener("click", async () => {
    if (!selectedPlan) return;
    // Paid plan -> hit server to get Stripe URL
    purchasePlan(selectedPlan.id);
  });
</script>
