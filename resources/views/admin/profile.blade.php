@include('admin.Include.header')

       
<div class="page-content maseco-profile-page">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="profile-page-header">
            <div>
                <div class="profile-breadcrumb">
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="ri-home-4-line"></i> Dashboard
                    </a>
                    <i class="ri-arrow-right-s-line"></i>
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
                    <h3>Alexa Rawles</h3>
                    <p>
                        <i class="ri-mail-line"></i>
                        alexarawles@gmail.com
                    </p>
                    <span class="profile-account-label">
                        <i class="ri-user-line"></i>
                        Account Profile
                    </span>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="profile-form-card">

            <div class="profile-form-heading">
                <div class="profile-section-icon">
                    <i class="ri-user-settings-line"></i>
                </div>

                <div>
                    <h4>Personal Information</h4>
                    <p>Keep your account information accurate and up to date.</p>
                </div>
            </div>

            <div class="dashboardForms profile-form-content">
                <form id="survey-form">

                    <!-- Name -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="profile-field">
                                <label id="name-label" for="name">
                                    First Name <span>*</span>
                                </label>

                                <div class="profile-input-wrap">
                                    <i class="ri-user-line"></i>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        placeholder="Enter First Name"
                                        class="form-control"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="profile-field">
                                <label id="lastname-label" for="lastname">
                                    Last Name <span>*</span>
                                </label>

                                <div class="profile-input-wrap">
                                    <i class="ri-user-line"></i>
                                    <input
                                        type="text"
                                        name="name"
                                        id="lastname"
                                        placeholder="Enter Last Name"
                                        class="form-control"
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
                                    <i class="ri-mail-line"></i>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        placeholder="Enter your email"
                                        class="form-control"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <div class="profile-field">
                                <label for="phone">
                                    Phone Number <span>*</span>
                                </label>

                                <div class="profile-input-wrap">
                                    <i class="ri-phone-line"></i>
                                    <input
                                        type="number"
                                        name="phone"
                                        id="phone"
                                        placeholder="Enter your phone"
                                        class="form-control"
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
                                    <i class="ri-global-line"></i>

                                    <select
                                        id="dropdown"
                                        name="role"
                                        class="form-control"
                                        required
                                    >
                                        <option value="United States">United States</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
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
                                    <i class="ri-map-pin-line"></i>

                                    <select
                                        id="state"
                                        name="role"
                                        class="form-control"
                                        required
                                    >
                                        <option disabled selected value="">Select State</option>
                                        <option value="United States">United States</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="profile-form-actions">
                        <button type="submit" id="submit" class="profile-submit-btn">
                            <i class="ri-send-plane-line"></i>
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@include('admin.Include.footer')