@include('seller.Include.header')

<style>
  .myaccountPage,
  form#profileform {
    background: transparent;
    padding: 0;
    border-radius: 0;
  }

  form#profileform {
    margin-bottom: 0;
  }
  
  /* Make the phone field look like other Bootstrap inputs */
  .input-group:has(select[name="country_code"]) {
    border: 1.7px solid #D1D1D1;
    border-radius: 12px;
    overflow: hidden;
  }

  .input-group:has(select[name="country_code"]) .form-select,
  .input-group:has(select[name="country_code"]) .form-control {
    border: 0;
    box-shadow: none;
  }

  .input-group:has(select[name="country_code"]):focus-within {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
  }

  .iti {
    width: 100%;
  }

  .iti input {
    width: 100%;
  }
</style>

<div class="page-content">
  <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
    <h3 class="mb-1">Profile</h3>

    <a href="{{ route('user.dashboard') }}" style="color:#555; text-decoration:none;">
      Dashboard
    </a>

    <span style="padding:0 6px; color:#999; font-size:14px;">
      ▶
    </span>

    <span style="color:#2DAC92;">
      Profile
    </span>

  </div>

  <div class="myaccountPage py-1">

    <!-- Seller Profile Section -->

    <div class="bg-white shadow-sm rounded-4 p-4 mb-4">

      <form id="profile-form" method="POST" action="{{ route('seller.profile.update') }}">
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
              <label for="manufacturer_phone" class="form-label">
                Phone Number
              </label>

              <div class="input-group">

                <input
                  type="tel"
                  name="phone"
                  id="manufacturer_phone"
                  class="form-control"
                  value="8745987359"
                  placeholder="Enter your phone number"
                  autocomplete="tel-national"
                  inputmode="tel"
                  required>

                <input
                  type="hidden"
                  name="country_code"
                  id="manufacturer_phone_country_code"
                  value="+1">

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
              @error('password')
              <div class="text-danger small mt-1">{{ $message }}</div>@enderror
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

          <div class="col-md-6">
            <button type="submit" class="btn btn-success px-4 w-100 m-auto">Save Profile</button>
          </div>

        </div>

      </form>

    </div>

    {{-- <!-- Business Details Section --> --}}

    <div class="bg-white shadow-sm rounded-4 p-4">

      <h3 class="h5 fw-bold mb-3">Business Details</h3>

      <form id="business-details-form" method="POST" action="{{ route('seller.profile.business') }}">

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

          <div class="col-md-6">
            <button type="submit" class="btn btn-success px-4 w-100">Save Business Details</button>
          </div>

        </div>

        <!-- Button for Business Form -->



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
     <script>
      document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.querySelector('#manufacturer_phone');
        const countryCodeInput = document.querySelector('#manufacturer_phone_country_code');

        if (!phoneInput || !countryCodeInput) return;

        const iti = window.intlTelInput(phoneInput, {
          initialCountry: 'us',
          separateDialCode: true,
          nationalMode: true,
          countrySearch: true,
          loadUtils: () => import(
            'https://cdn.jsdelivr.net/npm/intl-tel-input@25.10.5/build/js/utils.js'
          )
        });

        function updateCountryCode() {
          countryCodeInput.value =
            '+' + iti.getSelectedCountryData().dialCode;
        }

        updateCountryCode();
        phoneInput.addEventListener('countrychange', updateCountryCode);

        phoneInput.form?.addEventListener('submit', updateCountryCode);
      });
    </script>

  </div>

</div>

@include('seller.Include.footer')
