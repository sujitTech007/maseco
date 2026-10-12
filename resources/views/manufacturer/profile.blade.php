@include('manufacturer.Include.header')



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
  <div class="myaccountPage p-3 mt-4">





    <div class="dashboardForms py-0">



      <!-- ========== manufacturer Profile Section ========== -->

      <h3 class="mb-3">manufacturer Profile</h4>

        <form id="profile-form" method="POST" action="{{ route('manufacturer.profile.update') }}">

          @csrf

          <div class="row">

            <div class="col-md-4">

              <div class="form-group">

                <label for="name"> Name</label>

                <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" value="{{ $user->name }}" required>

              </div>

            </div>

            <div class="col-md-4">

              <div class="form-group">

                <label for="email">Email</label>

                <input type="email" name="email" id="email" placeholder="Enter your Email" class="form-control" value="{{ $user->email }}" required>

              </div>

            </div>

            <div class="col-md-4">

              <div class="form-group">

                <label for="phone">Phone No</label>

                <input type="text" name="phone" id="phone" placeholder="Enter your Phone Number" class="form-control" value="{{ $user->phone }}" required>

              </div>

            </div>

            <div class="col-md-4">

              <div class="form-group">

                <label for="companyName">Company Name</label>

                <input type="text" name="company_name" id="companyName" placeholder="Enter your Company Name" class="form-control" value="{{ $user->company_name }}" required>

              </div>

            </div>

            <div class="col-md-4">

              <div class="form-group">

                <label for="password">New Password</label>

                <input type="password" name="password" id="password" class="form-control" minlength="6">

              </div>

            </div>

            <div class="col-md-4">

              <div class="form-group">

                <label for="password_confirmation">Confirm Password</label>

                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" minlength="6">

              </div>

            </div>

          </div>



          <!-- Button for Profile Form -->

          <div class="row mt-3">

            <div class="col-md-4">

              <button type="submit" class="lab-btn">Save Profile</button>

            </div>

          </div>

        </form>







        <hr class="my-5">



        <!-- ========== Business Details Section ========== -->

        <h3 class="mb-3">Business Details</h4>

          <form id="business-details-form" method="POST" action="{{ route('manufacturer.profile.business') }}">

            @csrf

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label for="businessName">Business / Company Name</label>

                  <input type="text" name="business_name" id="businessName" placeholder="Enter Business Name" class="form-control" value="{{ old('business_name', $user->company_name) }}" required>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <label for="businessType">Business Type</label>

                  <select id="businessType" name="business_type" class="form-control" required>

                    <option disabled selected value>Select Business Type</option>

                    <option value="Manufacturer" @if(old('business_type', $user->business_type) == 'Manufacturer') selected @endif>Manufacturer</option>

                    <option value="Distributor" @if(old('business_type', $user->business_type) == 'Distributor') selected @endif>Distributor</option>

                    <option value="Supplier" @if(old('business_type', $user->business_type) == 'Supplier') selected @endif>Supplier</option>
                    <option value="Trader" @if(old('business_type', $user->business_type) == 'Trader') selected @endif>Trader</option>

                  </select>

                </div>

              </div>



              <div class="col-md-6">
    <div class="form-group">
        <label for="country">Country</label>
          <select id="country" class="form-control" name="country" required>
        <option value="">Select Country</option>
    </select>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="state">State</label>
        <select id="state" class="form-control" name="state" required>
        <option value="">Select State</option>
    </select>
    </div>
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




              <div class="col-md-12">

                <div class="form-group">

                  <label for="address">Business Address</label>

                  <textarea name="address" id="address" rows="3" placeholder="Enter full business address" class="form-control" required>{{ old('address', $user->address) }}</textarea>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <label for="gst">GST Number</label>

                  <input type="text" name="gst" id="gst" placeholder="Enter GST number" class="form-control" value="{{ old('gst', $user->gst) }}">

                </div>

              </div>

            </div>



            <!-- Button for Business Form -->

            <div class="row mt-3">

              <div class="col-md-4">

                <button type="submit" class="lab-btn">Save Business Details</button>

              </div>

            </div>

          </form>



    </div>

  </div>

</div>



@include('manufacturer.Include.footer')