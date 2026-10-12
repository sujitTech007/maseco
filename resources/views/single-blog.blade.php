@include('Include.header')

    <main>

        <section class="banner inner-banner" style="background-image: url(assets/images/inner-banner.jpg);">
            <div class="container">
                <div class="row">
                    <div class="inner-banner-heading">
                        <h1>Raw Material Suppliers</h1>
                    </div>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}"><i class="fas fa-home mr-2"></i>Home</a>
                            </li>
                            <li class="breadcrumb-item active">Raw Material Supplier</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <section class="listing-details-page py-5">
            <div class="container">
                <div class="row">                    
                    <div class="listings-details col-md-8">
                       <div class="details-thumb">
                        <img src="assets/images/blog-thumb-1.jpeg" alt="">
                       </div>
                       <div class="deatils-textarea pt-4">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>
                       </div>

                       <div class="product-types">
                        <div class="section-heading">
                            <h3>Types of Raw Materials We Source</h3>                           
                          </div>
                          <ul>
                            <li>
                                <h5>01.  Natural and Organic Materials</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </li>
                            <li>
                                <h5>02.  Recycled Materials</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </li>
                            <li>
                                <h5>03.  Innovative Sustainable Materials</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </li>
                            <li>
                                <h5>04.  Eco-Friendly Packaging Materials</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </li>
                          </ul>
                        
                       </div>
                        
                        

                    </div>
                    <div class="aside col-md-4">
                        <div class="serviceList">
                            <ul>
                              <li>
                                <div class="iconThumb">
                                  <img src="assets/images/icon/fabric.png" alt="">
                                </div>
                                <h4>raw material suppliers</h4>
                              </li>
                              <li>
                                <div class="iconThumb">
                                  <img src="assets/images/icon/textile.png" alt="">
                                </div>
                                <h4>Reducing textiles</h4>
                              </li>
                              <li>
                                <div class="iconThumb">
                                  <img src="assets/images/icon/machine-learning.png" alt="">
                                </div>
                                <h4>AI Driven suggestions</h4>
                              </li>
                              <li>
                                <div class="iconThumb">
                                  <img src="assets/images/icon/fabrication.png" alt="">
                                </div>
                                <h4>Manufacturers</h4>
                              </li>
              
                            </ul>
                          </div>
                         

                          <div class="manufacturer-details">
                            <div class="manufacturer-info">
                                <h5>About</h5>
                            </div>
                            <div class="manufacturer-name">
                                <div class="manufacturer-thumb">
                                    <img src="assets/images/testimonial-user.jpg" alt="">
                                </div>
                                <div class="manufacturer-title">
                                    <h5>William</h5>
                                    <div class="manufacturer-rating">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        </div>
                                        <span>5.0 Review</span>
                                      </div>

                                </div>
                            </div>
                            <div class="manufacturer-address">
                                <div class="addressBox">                                    
                                    <i class="fa-solid fa-location-dot"></i>
                                    <div class="footer-items-info">
                                        <h4>Address</h4>
                                        <span>8920 Woodbine Avenue, 304, Markham, Ontario, Canada, L3R 9W9</span>
                                    </div>                                      
                                </div>
                                <div class="addressBox">                                    
                                   
                                        <i class="fa-solid fa-mobile-retro"></i>
                                          <div class="footer-items-info">
                                              <h4>call Us On</h4>
                                              <a href="tel:+180045647824">
                                                  <span>+1800-001-6555</span>
                                              </a>
                                          </div>
                                      
                                                                       
                                </div>
                            </div>
                            
                          </div>
 
                     </div>
                </div>
            </div>
        </section>
    </main>

@include('Include.footer')