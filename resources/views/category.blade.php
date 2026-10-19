@include('Include.header')



<main>



  
<!-- Category Page Header -->
  <section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('public/assets/images/homepage-banner.webp') }});">
    <div class="container">
      <div class="row">
        <div class="inner-banner-heading position-relative z-1 text-center text-white">
         
          <h1>Category</h1>
        </div>
        
      </div>
    </div>
  </section>

<!-- Category Listing -->
<section class="py-5" style="background:#f6f8f7;">
    <div class="container">

        <!-- Section Heading -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h2 class="section-title-h2 mb-2 primary-text-color">
                    Material Categories
                </h2>
                <p class="text-secondary mb-0" style="font-size:13px;">
                    Browse categories to find suitable materials.
                </p>
            </div>

            <span class="badge rounded-pill px-3 py-2"
                  style="background:#e1f4ed;color:#238d79;font-size:13px;">
                {{ count($categories) }} Categories
            </span>
        </div>

        <!-- Category Cards -->
        <div class="row g-3 g-md-4">

            @foreach($categories as $category)
            <div class="col-6 col-md-4 col-lg-3 col-xl-3">

                
                    <!-- Image -->
                    <div class="category-image position-relative">
                        <img
                            src="{{ asset('public/' . ($category->image ?? 'assets/images/blog-thumb-1.jpeg')) }}"
                            alt="{{ $category->name }}"
                            class="w-100 h-100"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='{{ asset('public/assets/images/blog-thumb-1.jpeg') }}';">

                        <span class="category-count">
                            <i class="fas fa-layer-group me-1"></i>
                            Materials
                        </span>
                    </div>

                    <!-- Card Content -->
                    <div class="p-3">
                        <h3 class="category-title mb-1">
                            {{ $category->name }}
                        </h3>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-secondary" style="font-size:13px;">
                                Explore category
                            </span>

                           
                        </div>
                    </div>

            
            </div>
            @endforeach

        </div>

        @if($categories->isEmpty())
            <div class="bg-white border rounded-3 text-center p-5">
                <i class="fas fa-folder-open mb-3"
                   style="font-size:32px;color:#2DAC92;"></i>
                <h3 style="font-size:18px;color:#263b3a;">
                    No categories available
                </h3>
                <p class="text-secondary mb-0" style="font-size:14px;">
                    Please check back later for available material categories.
                </p>
            </div>
        @endif

    </div>
</section>


</main>





@include('Include.footer')