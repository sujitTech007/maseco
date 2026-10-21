

  <footer class="footer">

    <div class="footer-top">

      <div class="footer-bottom-list">

        <div class="container">

          <div class="row">

            <div class="col-lg-3" >

              <div class="footer-img">

                <img src="{{ asset('public/assets/images/footer-logo.png') }}" class="footer-logo" alt="logo">

              </div>

            </div>

            <div class="col-lg-9" >

              <div class="row">

                <div class="col-lg-7 p-lg-0">

                  <div class="footer-items">

                    <i class="fa-solid fa-location-dot"></i>

                    <div class="footer-items-info">

                      <h4>Address</h4>

                      <span>8920 Woodbine Avenue, 304, Markham, Ontario,<br>Canada, L3R 9W9</span>

                    </div>

                  </div>

                </div>

               

                <div class="col-lg-5 p-lg-0">

                  <div class="footer-items">

                    <i class="fa-solid fa-envelope"></i>

                    <div class="footer-items-info">

                      <h4>Email Us</h4>

                      <a href="#">

                        <span>info@maseco.ca</span>

                      </a>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-md-6">

            <div class="widget">

              <h4 class="footer-title" >About Maseco</h4>

              <p >It helps designers plan out where the content will sit, the content to be written and approved.</p>

            </div>

          </div>

          <div class="col-lg-3  col-md-6">

            <div class="widget">

              <h4 class="footer-title" >Maseco Services</h4>

              <div class="menu-textile-service-container">

                <ul id="menu-textile-service" class="menu">

                <li class="menu-item" >

                            <a href="{{ route('raw.material.supplier') }}">Raw material suppliers</a>

                          </li>

                          <li class="menu-item" >

                            <a href="{{ route('reducing.textiles') }}">Reducing textiles</a>

                          </li>

                          <li class="menu-item" >

                            <a href="{{ route('ai.driven.suggestion') }}">AI Driven suggestions</a>

                          </li>

                          <li class="menu-item" >

                            <a href="{{ route('manufacturer') }}">Manufacturers</a>

                          </li>

                          <li class="menu-item" >

                            <a href="{{ route('post.production.services') }}">post production services</a>

                          </li>

                </ul>

              </div>

            </div>

          </div>

          <div class="col-lg-3  col-md-6">

            <div class="widget">

              <h4 class="footer-title" >Usefull Links</h4>

              <div class="menu-useful-links-container">

                <ul id="menu-useful-links" class="menu">

                  <li class="menu-item" >

                    <a href="{{ route('about.us') }}">About Us</a>

                  </li>

                  <!-- <li class="menu-item" >

                    <a href="{{ route('blog') }}">Blog</a>

                  </li> -->

                  <li class="menu-item" >

                    <a href="{{ route('category') }}">Category</a>

                  </li>

                  <li class="menu-item" >

                    <a href="{{ route('contact.us') }}">Contact</a>

                  </li>

                 

                  <li class="menu-item" data-aos="fade-in">

                        <a href="{{ route('subscription.plan') }}">Subscription</a>

                      </li>

                </ul>

              </div>

            </div>

          </div>

          <div class="col-lg-3  col-md-6">

            <div class="widget">

              <div class="subscribe">

                <div class="subscribe-details">

                  <h4 class="footer-title" >our newsletter</h4>

                  <p >Sign up for the latest deals products news and more from us.</p>

                </div>

              </div>

              <div class="subscribe-from" >

                <form class="sign-up-form" method="POST" action="{{ route('newsletter.store') }}">
                  @csrf

                  <input type="email" name="email" placeholder="Your email address" class="form-control">

                  <input class="submit" type="submit" value="Sign up">

                  <i class="fa-solid fa-paper-plane"></i>

                </form>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="copyright-footer">

      <div class="container">

        <div class="row align-items-center">

          <div class="col-md-4 text-center text-md-start">

            <div class="footer-social">

              <ul>

              <li><a href="https://www.facebook.com/masecotech"><i class="fa-brands fa-facebook-f"></i></a></li>

<li><a href="https://www.instagram.com/masecotech/"><i class="fa-brands fa-instagram"></i></a></li>

<li><a href="https://www.linkedin.com/company/masecotech/"><i class="fa-brands fa-linkedin-in"></i></a></li>

              </ul>

            </div>

          </div>

          <div class="col-md-4 text-center text-md-center">

            <span class="copyright">Maseco © 2026. All rights reserved.</span>

          </div>
          <div class="col-md-4 text-center text-md-end">

            <div class=" d-flex align-item-center justify-content-end">

              <ul class="d-flex gap-3">

              <li><a href="{{ route('privacy.policy') }}" class="text-white">Privacy Policy</a></li>

              <li><a href="{{ route('terms.condition') }}" class="text-white">Terms and Condition</a></li>

              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>

    </div>

  </footer>

  

  <div id="back-to-top">

    <a class="top" id="top" href="#top">

      <i class="fa-solid fa-chevron-up"></i>

    </a>

</div>

<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/slick.min.js') }}"></script>   
<script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>

@if (Request::is('login', 'sign-up', 'forgot-password', 'contact-us'))
    <script src="{{ asset('public/assets/js/bootstrap-select.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.selectpicker').each(function () {
                const selectedCode = $(this).attr('data-selected-country-code');
                if (selectedCode) $(this).val(selectedCode);
                $(this).selectpicker();
            });
        });
    </script>
@endif

<script src="{{ asset('public/assets/js/script.js') }}"></script>



  

</body>



</html>
