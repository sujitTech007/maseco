@include('user.Include.header')

<style>
    .profile-form {
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
        padding: 28px;
        border-radius: 20px;
        background: white;
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

</style>

<div class="page-content">

    <div class="container py-1">

        <h4 class="mb-1 fs-bold main-heading">Account & Settings</h4>
        <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">

            <a href="{{ route('user.dashboard') }}" style="color:#454545; text-decoration:none;">
                Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:10px;">
                ▶
            </span>

            <span style="color:#2DAC92;">
                Profile
            </span>

        </div>


        <!-- ===== TAB BUTTONS ===== -->
        <div class="d-flex mb-4 " style="background: white;padding:6px;border-radius: 14px;border: 1px solid #D1D1D1;">
            <button class="tab-btn active me-2" data-tab="account_tab"
                style="flex: 1 1 0%;border: 1px solid #a9a9a999;background: rgb(201, 245, 233);padding: 7px;border-radius: 8px;color: rgb(45, 172, 146);    max-width: 250px;">
                Account
            </button>

            <button class="tab-btn" data-tab="security_tab"
                style="flex:1; border:1px solid #a9a9a999; background:transparent; padding:7px; border-radius:8px;color: rgb(45, 172, 146);     max-width: 250px;">
                Security
            </button>
        </div>

        <!-- SUCCESS / ERROR -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- =============== ACCOUNT TAB =============== -->
        <div id="account_tab" class="tab-content active">

            <form class="profile-form" method="POST" action="{{ route('user.profile.update') }}">
                @csrf

                <div class="row">

                    <!-- Full Name -->
                    <div class="mb-3 col-4">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}"
                            required>
                    </div>

                    <!-- Phone Number -->
                   
<div class="col-4 mb-3">
    <div class="form-group mb-3">
        <label for="manufacturer_phone" class="form-label">
            Phone Number
        </label>

        <div class="input-group">
            <select
                id="manufacturer_phone_country_code"
                name="country_code"
                class="form-select border-0"
                style="max-width: 100px;"
                data-country-code-select
                data-selected-country-code="+1"
                aria-label="Country calling code"
                required
            >
                <option value="+93">🇦🇫 +93</option>
                <option value="+1" selected>🇺🇸 +1</option>
                <option value="+61">🇦🇺 +61</option>
                <option value="+86">🇨🇳 +86</option>
                <option value="+33">🇫🇷 +33</option>
                <option value="+49">🇩🇪 +49</option>
                <option value="+91">🇮🇳 +91</option>
                <option value="+81">🇯🇵 +81</option>
                <option value="+92">🇵🇰 +92</option>
                <option value="+971">🇦🇪 +971</option>
                <option value="+44">🇬🇧 +44</option>
            </select>

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

                    <!-- Email -->
                    <div class="mb-3 col-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                            required>
                    </div>

                </div>


                <div class="row">

                    <!-- Gender -->
                    <div class="mb-3 col-4">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">Select</option>
                            <option value="Male" {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="Female" {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected' : '' }}>
                                Female</option>
                            <option value="Other" {{ old('gender', $user->gender ?? '') == 'Other' ? 'selected' : '' }}>
                                Other</option>
                        </select>
                    </div>

                    <!-- Birth Date -->
                    <div class="mb-3 col-4">
                        <label class="form-label">Birth Date</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob', $user->dob ?? '') }}">
                    </div>

                    <!-- Country -->
                    <div class="mb-3 col-4">
                        <label class="form-label">Country</label>
                        <select id="country" class="form-control" name="country" required>
                            <option value="">Select Country</option>
                        </select>
                    </div>
                    <div class="mb-3 col-4">
                        <label class="form-label">State</label>
                        <select id="state" class="form-control" name="state" required>
                            <option value="">Select State</option>
                        </select>
                    </div>



                    <div class="mb-3 col-8">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" value="{{ old('address', $user->address ?? '') }}"
                            rows="1"></textarea>
                    </div>

                </div>


                <button type="submit" class="btn btn-primary prflbtn">Update</button>
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary cancel">Cancel</a>
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




        <!-- =============== SECURITY TAB =============== -->
        <div id="security_tab" class="tab-content" style="display:none;">

            <form class="profile-form" method="POST" action="{{ route('user.profile.update') }}">
                @csrf

                <div class="row">

                    <div class="mb-3 col-4">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Leave blank to keep current" minlength="6">
                    </div>

                    <div class="mb-3 col-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" minlength="6">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary prflbtn">Update Password</button>

            </form>

        </div>




    </div>


</div>


<!-- TAB SWITCH SCRIPT -->
<script>
    document.querySelectorAll(".tab-btn").forEach(btn => {
        btn.addEventListener("click", function () {

            // remove active from both
            document.querySelectorAll(".tab-btn").forEach(b => {
                b.classList.remove("active");
                b.style.background = "transparent";
            });

            // activate current
            this.classList.add("active");
            this.style.background = "#C9F5E9";

            let tabId = this.getAttribute("data-tab");

            // hide both contents
            document.querySelectorAll(".tab-content").forEach(t => t.style.display = "none");

            // show selected
            document.getElementById(tabId).style.display = "block";
        });
    });
</script>


@include('user.Include.footer')
