@include('Include.header')

<style>
  /* Keep the method button static (no hover visual change) */
  #paymentModal .btn-no-hover:hover,
  #paymentModal .btn-no-hover:focus,
  #paymentModal .btn-no-hover:active {
    background-color: #198754 !important;
    border-color: #198754 !important;
    color: #ffffff !important;
    box-shadow: none !important;
  }

  /* Overlay for processing */
  #paymentModal .modal-content {
    position: relative;
  }

  #paymentProcessingOverlay {
    background: rgba(255, 255, 255, 0.85);
    z-index: 10;
    display: none;
    position: absolute;
    inset: 0;
    align-items: center;
    justify-content: center;
  }

  #paymentProcessingOverlay .spinner-border {
    width: 3rem;
    height: 3rem;
  }
</style>

<main>
  

  <section class="banner inner-banner" style="background-image: url({{ asset('assets/images/inner-banner.jpg)')}};">

    <div class="container">

      <div class="row">

        <div class="inner-banner-heading" data-aos="zoom-in">

          <h1>Subscription Plan</h1>

        </div>

        <div class="breadcrumb-container">

          <ol class="breadcrumb" data-aos="fade-up">

            <li class="breadcrumb-item">

              <a href="{{ route('home') }}"><i class="fas fa-home mr-2"></i>Home</a>

            </li>

            <li class="breadcrumb-item active">Subscription Plan </li>

          </ol>

        </div>

      </div>

    </div>

  </section>
  <section class="price-section py-5">
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
<img src="{{ asset('assets/images/icon/' . $icon) }}" alt="">
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