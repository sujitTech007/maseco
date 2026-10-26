@include('manufacturer.Include.header')

<style>
  .myaccountPage,
  form#profile-form {
    background: transparent;
    padding: 0;
    border-radius: 0;
  }

  form#profile-form {
    margin-bottom: 0;
  }

  .phone-country-field .form-select {
    flex: 0 0 125px;
    width: 125px;
    min-width: 110px;
    border-radius: 0.375rem 0 0 0.375rem;
    font-size: 14px;
}

.phone-country-field .form-control {
    min-width: 0;
    border-radius: 0 0.375rem 0.375rem 0;
}

.phone-country-field .form-control:focus,
.phone-country-field .form-select:focus {
    z-index: 2;
    box-shadow: none;
    border-color: #20a486;
}
</style>

<div class="page-content">
  <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
    <h3 class="mb-1">Manufacturer Profile </h3>

    <a href="https://maseco.ca/UAT/manufacturer/dashboard" style="color:#555; text-decoration:none;">
      Dashboard
    </a>

    <span style="padding:0 6px; color:#999; font-size:14px;">
      ▶
    </span>

    <span style="color:#2DAC92;">
      Manufacturer Profile
    </span>

  </div>

  <div class="myaccountPage py-1 mt-4">

    <!-- ========== manufacturer Profile Section ========== -->

    <div class="bg-white shadow-sm rounded-4 p-4 mb-4">

      <h3 class="h5 fw-bold mb-3">Manufacturer Profile</h3>

      <form id="profile-form" method="POST" action="{{ route('manufacturer.profile.update') }}">

        @csrf

        <div class="row">

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="name" class="form-label fw-semibold small"> Name</label>
              <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control"
                value="{{ $user->name }}" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="email" class="form-label fw-semibold small">Email</label>
              <input type="email" name="email" id="email" placeholder="Enter your Email" class="form-control"
                value="{{ $user->email }}" required>
            </div>
          </div>

        
<div class="col-md-6">
    <div class="form-group mb-3">
        <label for="manufacturer_phone" class="form-label fw-semibold small">
            Phone No
        </label>

        <div class="input-group phone-country-field">

            <!-- Country Code -->
            <select
                id="manufacturer_phone_country_code"
                name="country_code"
                class="form-select"
                style="max-width: 125px;"
                data-country-code-select
                data-selected-country-code="+91"
                aria-label="Country calling code"
                required
            >
                <option value="+93" data-flag="af">🇦🇫 +93</option>
                <option value="+355" data-flag="al">🇦🇱 +355</option>
                <option value="+213" data-flag="dz">🇩🇿 +213</option>
                <option value="+1" data-flag="us">🇺🇸 +1 (US)</option>
                <option value="+61" data-flag="au">🇦🇺 +61</option>
                <option value="+880" data-flag="bd">🇧🇩 +880</option>
                <option value="+55" data-flag="br">🇧🇷 +55</option>
                <option value="+1" data-flag="ca">🇨🇦 +1 (CA)</option>
                <option value="+86" data-flag="cn">🇨🇳 +86</option>
                <option value="+33" data-flag="fr">🇫🇷 +33</option>
                <option value="+49" data-flag="de">🇩🇪 +49</option>
                <option value="+91" data-flag="in" selected>🇮🇳 +91</option>
                <option value="+62" data-flag="id">🇮🇩 +62</option>
                <option value="+39" data-flag="it">🇮🇹 +39</option>
                <option value="+81" data-flag="jp">🇯🇵 +81</option>
                <option value="+60" data-flag="my">🇲🇾 +60</option>
                <option value="+977" data-flag="np">🇳🇵 +977</option>
                <option value="+64" data-flag="nz">🇳🇿 +64</option>
                <option value="+92" data-flag="pk">🇵🇰 +92</option>
                <option value="+65" data-flag="sg">🇸🇬 +65</option>
                <option value="+27" data-flag="za">🇿🇦 +27</option>
                <option value="+82" data-flag="kr">🇰🇷 +82</option>
                <option value="+94" data-flag="lk">🇱🇰 +94</option>
                <option value="+971" data-flag="ae">🇦🇪 +971</option>
                <option value="+44" data-flag="gb">🇬🇧 +44</option>
            </select>

            <!-- Phone Number -->
            <input
                type="tel"
                name="phone"
                id="manufacturer_phone"
                class="form-control"
                value="8745987359"
                placeholder="Enter your phone number"
                autocomplete="tel-national"
                inputmode="tel"
                required
            >
        </div>
    </div>
</div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="companyName" class="form-label fw-semibold small">Company Name</label>
              <input type="text" name="company_name" id="companyName" placeholder="Enter your Company Name"
                class="form-control" value="{{ $user->company_name }}" required>
            </div>
          </div>

          <div class="col-12">
            <hr class="mt-0 mb-3 text-muted">
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="password" class="form-label fw-semibold small">New Password</label>
              <input type="password" name="password" id="password" class="form-control" minlength="6">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="password_confirmation" class="form-label fw-semibold small">Confirm Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                minlength="6">
            </div>
          </div>

          <!-- Button for Profile Form -->

          <div class="col-md-6 m-auto mt-2">
            <button type="submit" class="btn btn-success px-4 w-100 m-auto">Save Profile</button>
          </div>

        </div>

      </form>

    </div>

    <!-- ========== Business Details Section ========== -->

    <div class="bg-white shadow-sm rounded-4 p-4">

      <h3 class="h5 fw-bold mb-3">Business Details</h3>

      <form id="business-details-form" method="POST" action="{{ route('manufacturer.profile.business') }}">

        @csrf

        <div class="row align-items-center">

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="businessName" class="form-label fw-semibold small">Business / Company Name</label>
              <input type="text" name="business_name" id="businessName" placeholder="Enter Business Name"
                class="form-control" value="{{ old('business_name', $user->company_name) }}" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="businessType" class="form-label fw-semibold small">Business Type</label>
              <select id="businessType" name="business_type" class="form-select" required>

                <option disabled selected value>Select Business Type</option>

                <option value="Manufacturer" @if(old('business_type', $user->business_type) == 'Manufacturer') selected
                @endif>Manufacturer</option>

                <option value="Distributor" @if(old('business_type', $user->business_type) == 'Distributor') selected
                @endif>Distributor</option>

                <option value="Supplier" @if(old('business_type', $user->business_type) == 'Supplier') selected @endif>
                  Supplier</option>
                <option value="Trader" @if(old('business_type', $user->business_type) == 'Trader') selected @endif>Trader
                </option>

              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="country" class="form-label fw-semibold small">Country</label>
              <select id="country" class="form-select" name="country" required>
                <option value="">Select Country</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="state" class="form-label fw-semibold small">State</label>
              <select id="state" class="form-select" name="state" required>
                <option value="">Select State</option>
              </select>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group mb-3">
              <label for="address" class="form-label fw-semibold small">Business Address</label>
              <textarea name="address" id="address" rows="3" placeholder="Enter full business address"
                class="form-control" required>{{ old('address', $user->address) }}</textarea>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="gst" class="form-label fw-semibold small">GST Number</label>
              <input type="text" name="gst" id="gst" placeholder="Enter GST number" class="form-control"
                value="{{ old('gst', $user->gst) }}">
            </div>
          </div>

          <!-- Button for Business Form -->

          <div class="col-md-6">
            <button type="submit" class="btn btn-success px-4 w-100">Save Business Details</button>
          </div>

        </div>

      </form>

    </div>

    <script>
      const countrySelect = document.getElementById('country');
      const stateSelect = document.getElementById('state');

      // Load all countries
      fetch('https://countriesnow.space/api/v0.1/countries/states')
        .then(res => res.json())
        .then(result => {
          window.countriesData = result.data;

          result.data.forEach(country => {
            let option = document.createElement('option');
            option.value = country.name;
            option.textContent = country.name;

            if (country.name === "{{ old('country', $user->country ?? '') }}") {
              option.selected = true;
            }

            countrySelect.appendChild(option);
          });

          // Load states if edit page
          if (countrySelect.value) {
            loadStates(countrySelect.value);
          }
        });

      countrySelect.addEventListener('change', function () {
        loadStates(this.value);
      });

      function loadStates(countryName) {
        stateSelect.innerHTML = '<option value="">Select State</option>';

        let country = window.countriesData.find(c => c.name === countryName);
        if (!country) return;

        country.states.forEach(state => {
          let option = document.createElement('option');
          option.value = state.name;
          option.textContent = state.name;

          if (state.name === "{{ old('state', $user->state ?? '') }}") {
            option.selected = true;
          }

          stateSelect.appendChild(option);
        });
      }
    </script>

  </div>

</div>

@include('manufacturer.Include.footer')
