@include('Include.header')

<style>
  
.contact-icon {
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e5f5ef;
    color: #2DAC92;
    border-radius: 8px;
}

.contactPage .form-control,
.contactPage .form-select {
    min-height: 43px;
    font-size: 14px;
    border-color: #dce3e0;
}

.contactPage .form-control:focus,
.contactPage .form-select:focus {
    border-color: #2DAC92;
    box-shadow: 0 0 0 0.15rem rgba(45, 172, 146, 0.15);
}

@media (max-width: 576px) {
    .contactPage .p-4 {
        padding: 1rem !important;
    }
}

</style>
<main>
  
<!-- Contact Banner -->
  <section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('assets/images/homepage-banner.webp') }});">
    <div class="container">
      <div class="row">
        <div class="inner-banner-heading position-relative z-1 text-center text-white">
         
          <h1>Contact us</h1>
          <p class="text-white mb-0">Maseco connects fashion designers with sustainable materials, trusted manufacturing partners, and AI-powered solutions to make fashion sourcing smarter, simpler, and more responsible.</p>
        </div>
        
      </div>
    </div>
  </section>

<!-- Contact Section -->
<section class="py-5" style="background:#f6f8f7;">
    <div class="container">

        <div class="row g-4">

            <!-- Contact Form and Details -->
            <div class="col-lg-7">
                <div class="bg-white border rounded-3 p-4 p-md-5 h-100">

                    <span class="text-uppercase fw-semibold"
                          style="font-size:12px;letter-spacing:1px;color:#2DAC92;">
                        Get In Touch
                    </span>

                    <h2 class="fw-bold mt-2 mb-2"
                        style="font-size:26px;color:#263b3a;">
                        Let's Start a Conversation
                    </h2>

                    <p class="text-secondary mb-4" style="font-size:14px;line-height:1.7;">
                        Have a question about Maseco or want to discuss your business
                        requirements? Send us a message and our team will get in touch.
                    </p>

                    <!-- Contact Form -->
                    <form method="POST" action="{{ route('contact-us.store') }}">
                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="name" class="form-label"
                                       style="font-size:13px;">Full Name *</label>
                                <input type="text" name="name" id="name"
                                       class="form-control"
                                       placeholder="Enter your name"
                                       value="{{ old('name') }}"
                                       required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label"
                                       style="font-size:13px;">Business Email *</label>
                                <input type="email" name="email" id="email"
                                       class="form-control"
                                       placeholder="name@company.com"
                                       value="{{ old('email') }}"
                                       required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-4">
                                <label for="phone" class="form-label"
                                       style="font-size:13px;">Phone Number *</label>
                                <input type="tel" name="phone" id="phone"
                                       class="form-control"
                                       placeholder="Enter phone number"
                                       value="{{ old('phone') }}"
                                       required>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-4">
                                <label for="find_us" class="form-label"
                                       style="font-size:13px;">How did you find us? *</label>
                                <select name="find_us" id="find_us"
                                        class="form-select" required>
                                    <option value="" disabled
                                        {{ old('find_us') ? '' : 'selected' }}>
                                        Select an option
                                    </option>
                                    <option value="google"
                                        {{ old('find_us') == 'google' ? 'selected' : '' }}>
                                        Google
                                    </option>
                                    <option value="social media"
                                        {{ old('find_us') == 'social media' ? 'selected' : '' }}>
                                        Social Media
                                    </option>
                                    <option value="friend"
                                        {{ old('find_us') == 'friend' ? 'selected' : '' }}>
                                        Referral / Friend
                                    </option>
                                </select>
                                @error('find_us')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit"
                                        class="btn text-white w-100 py-2 theme_btn"
                                        style="background:#2DAC92;font-size:14px;">
                                    Send Enquiry
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>

                        </div>
                    </form>

                    <hr class="my-4">

                    <!-- Contact Information -->
                    <h5 class="fw-bold mb-3"
                        style="font-size:16px;color:#263b3a;">
                        Contact Information
                    </h5>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <p class="text-secondary mb-1"
                                       style="font-size:13px;">Call Us</p>
                                    <!-- <a href="tel:+18000016555"
                                       class="text-decoration-none text-dark"
                                       style="font-size:14px;">
                                        +1 800-001-6555
                                    </a> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <p class="text-secondary mb-1"
                                       style="font-size:13px;">Email Us</p>
                                    <a href="mailto:info@maseco.ca"
                                       class="text-decoration-none text-dark"
                                       style="font-size:14px;overflow-wrap:anywhere;">
                                        info@maseco.ca
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-start gap-3">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <p class="text-secondary mb-1"
                                       style="font-size:13px;">Office Address</p>
                                    <p class="mb-0" style="font-size:14px;line-height:1.7;">
                                        8920 Woodbine Avenue, 304,<br>
                                        Markham, Ontario, Canada, L3R 9W9
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Location and Map -->
            <div class="col-lg-5">
                <div class="bg-white border rounded-3 p-3 h-100">

                    <div class="p-2 mb-3">
                        <span class="text-uppercase fw-semibold"
                              style="font-size:12px;letter-spacing:1px;color:#2DAC92;">
                            Find Us
                        </span>

                        <h4 class="fw-bold mt-2 mb-2"
                            style="font-size:21px;color:#263b3a;">
                            Visit Our Office
                        </h4>

                        <p class="text-secondary mb-0" style="font-size:14px;line-height:1.7;">
                            Connect with Maseco at our Markham, Ontario location.
                        </p>
                    </div>

                    <div class="rounded-3 overflow-hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28841.836884257886!2d-79.4484611!3d43.8555085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b018c257027b3%3A0x5e0c50b644d8bb1f!2s8920%20Woodbine%20Ave%2C%20Markham%2C%20ON%20L3R%209W9%2C%20Canada!5e0!3m2!1sen!2sin!4v1635158912345!5m2!1sen!2sin"
                            width="100%"
                            height="350"
                            style="border:0;display:block;"
                            allowfullscreen
                            loading="lazy"
                            title="Maseco office location map"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <a href="https://www.google.com/maps/search/?api=1&query=8920+Woodbine+Avenue+Markham+Ontario+L3R+9W9"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn btn-outline-secondary w-100 mt-3"
                       style="font-size:14px;">
                        <i class="fas fa-directions me-2"></i>
                        Get Directions
                    </a>

                    <div class="p-3 rounded-3 mt-3"
                         style="background:#eef8f4;">
                        <div class="d-flex gap-2 align-items-start">
                            <i class="fas fa-info-circle mt-1"
                               style="color:#2DAC92;"></i>
                            <p class="mb-0" style="font-size:13px;line-height:1.7;color:#47645b;">
                                For business enquiries, please include accurate contact
                                details so our team can respond to your request.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

</main>

@include('Include.footer')