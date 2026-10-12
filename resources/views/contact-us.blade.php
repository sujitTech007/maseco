@include('Include.header')

    <main>
        <section class="banner inner-banner" style="background-image: url({{ asset('assets/images/inner-banner.jpg)')}};">
            <div class="container">
                <div class="row">
                    <div class="inner-banner-heading" >
                        <h1>Contact US</h1>
                    </div>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}"><i class="fas fa-home mr-2"></i>Home</a>
                            </li>
                            <li class="breadcrumb-item active">Contact</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="contactPage py-5">
          <div class="container">
            <div class="form-wrapper">
              
              <div class="row">
                <div class="col-lg-6 col-md-12" >
                  <div class="contact-area">
                    <div class="contact-heading">
                      <h1>Get In <span>Touch</span></h1>
                      <p>“Have questions? Let’s get in touch and start the conversation.”</p>
                    </div>
        
                    <form class="mt-4" method="POST" action="{{ route('contact-us.store') }}">
                      @csrf
                      <div class="form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name*" required>
                      </div>
                      <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email*" required>
                      </div>
                      <div class="form-group">
                        <input type="number" name="phone" class="form-control" placeholder="Phone Number" required>
                      </div>
                      <div class="form-group">
                        <select class="form-control custom-select" name="find_us" required>
                          <option value="" selected disabled>How did you find us?</option>
                          <option value="google">Google</option>
                          <option value="social media">Social Media</option>
                          <option value="friend">Friend</option>
                        </select>      
                      </div>
                      <div class="form-group">
                        <button type="submit" class="theme-btn w-100 radius-0">Send</button>
                      </div>
                  </form>
                      <div class="d-flex justify-content-start flex-wrap py-2">                        
  <div class="contact-row d-flex align-items-center mb-0 me-3">
    <div class="iconBox">
      <i class="fa-solid fa-mobile-retro"></i>
    </div>
    <p>+1800-001-6555</p>
  </div>

  <div class="contact-row d-flex align-items-center mb-0">
    <div class="iconBox">
      <i class="fa-solid fa-envelope"></i>
    </div>
    <p><a href="#">connect@maseco.ca</a></p>
  </div>
</div>

                      
                      <div class="contact-row d-flex align-items-start mt-3">
                        <div class="iconBox">
                          <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <p>8920 Woodbine Avenue, 304<br> Markham, Ontario, Canada, L3R 9W9</p>
                      </div>
                    </div>
                  
                </div>
        
                
                <div class="col-lg-6 col-md-12">
                  <div class="map-section">
                    <iframe
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28841.836884257886!2d-79.4484611!3d43.8555085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b018c257027b3%3A0x5e0c50b644d8bb1f!2s8920%20Woodbine%20Ave%2C%20Markham%2C%20ON%20L3R%209W9%2C%20Canada!5e0!3m2!1sen!2sin!4v1635158912345!5m2!1sen!2sin"
  width="500"
  height="600"
  style="border:0;"
  allowfullscreen=""
  loading="lazy"
  referrerpolicy="no-referrer-when-downgrade">
</iframe>
                  </div>
                </div>
        
              </div> 
            </div>
          </div>
        </section>
    </main>

@include('Include.footer')