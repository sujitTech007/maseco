@include('admin.Include.header')

       
<div class="page-content maseco-profile-page">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="profile-page-header">
            <div>
                <div class="profile-breadcrumb">
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="fa-solid fa-house"></i> Dashboard
                    </a>
                    <i class="fa-solid fa-chevron-right"></i>
                    <span>My Account</span>
                </div>

                <h2>My Profile</h2>
                <p>Manage your personal information and account details.</p>
            </div>
        </div>

        <!-- Profile Banner -->
        <div class="profile-banner">
            <div class="profile-banner-content">
                <div class="profile-avatar">
                    <img src="{{ asset('public/assets/images/user.png') }}"
                         alt="User Profile">
                </div>

                <div class="profile-user-info">
                    <h3>{{ $admin->name }}</h3>
                    <p>
                        <i class="fa-solid fa-envelope"></i>
                        {{ $admin->email }}
                    </p>
                    <span class="profile-account-label">
                        <i class="fa-solid fa-user"></i>
                        Account Profile
                    </span>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="profile-form-card">

            <div class="profile-form-heading">
                <div class="profile-section-icon">
                    <i class="fa-solid fa-user-gear"></i>
                </div>

                <div>
                    <h4>Personal Information</h4>
                    <p>Keep your account information accurate and up to date.</p>
                </div>
            </div>

            <div class="dashboardForms profile-form-content">
                <form id="survey-form" method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @if(session('success'))<div class="alert alert-success" role="status">{{ session('success') }}</div>@endif
                    @if($errors->any())<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>@endif

                    <!-- Name -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="profile-field">
                                <label id="name-label" for="name">
                                    Name <span>*</span>
                                </label>

                                <div class="profile-input-wrap">
                                    <i class="fa-solid fa-user"></i>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        placeholder="Enter Name"
                                        class="form-control"
                                        value="{{ old('name', $admin->name) }}"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="profile-field">
                                <label id="email-label" for="email">
                                    Email Address <span>*</span>
                                </label>

                                <div class="profile-input-wrap">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        placeholder="Enter your email"
                                        class="form-control"
                                        value="{{ old('email', $admin->email) }}"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <div class="profile-field">
                                <label for="dropdown">
                                    Country <span>*</span>
                                </label>

                                <div class="profile-input-wrap profile-select-wrap">
                                    <i class="fa-solid fa-globe"></i>

                                        <select
                                        id="dropdown"
                                        name="country"
                                        class="form-control"
                                        required
                                    >
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country }}" @selected(old('country', $admin->country) === $country)>{{ $country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- State -->
                        <div class="col-md-6">
                            <div class="profile-field">
                                <label for="state">
                                    State <span>*</span>
                                </label>

                                <div class="profile-input-wrap profile-select-wrap">
                                    <i class="fa-solid fa-location-dot"></i>

                                    <select
                                        id="state"
                                        name="state"
                                        class="form-control"
                                        required
                                    >
                                        <option value="{{ old('state', $admin->state) }}">
                                            {{ old('state', $admin->state) ?: 'Select State' }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="profile-form-actions">
                        <button type="submit" id="submit" class="profile-submit-btn">
                            <i class="fa-solid fa-paper-plane"></i>
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const countrySelect = document.getElementById('dropdown');
    const stateSelect = document.getElementById('state');
    const selectedCountry = @json(old('country', $admin->country ?? ''));
    const selectedState = @json(old('state', $admin->state ?? ''));

    function loadStates(countryName) {
        const country = window.adminCountriesData?.find(item => item.name === countryName);
        if (!country) return;

        stateSelect.replaceChildren(new Option('Select State', ''));
        country.states.forEach(function (state) {
            stateSelect.add(new Option(state.name, state.name, false, state.name === selectedState));
        });

        if (selectedState && !Array.from(stateSelect.options).some(option => option.value === selectedState)) {
            stateSelect.add(new Option(selectedState, selectedState, true, true));
        }
    }

    countrySelect.addEventListener('change', function () {
        loadStates(this.value);
    });

    fetch('https://countriesnow.space/api/v0.1/countries/states')
        .then(response => response.json())
        .then(result => {
            window.adminCountriesData = Array.isArray(result.data) ? result.data : [];
            window.adminCountriesData.forEach(function (country) {
                if (!Array.from(countrySelect.options).some(option => option.value === country.name)) {
                    countrySelect.add(new Option(country.name, country.name));
                }
            });
            countrySelect.value = selectedCountry;
            loadStates(selectedCountry);
        })
        .catch(function () {
            if (selectedState && !Array.from(stateSelect.options).some(option => option.value === selectedState)) {
                stateSelect.add(new Option(selectedState, selectedState, true, true));
            }
        });
});
</script>

@include('admin.Include.footer')
