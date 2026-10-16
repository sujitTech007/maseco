@include('Include.header')


<style>
  .wsus__category_single_slider {
    position: relative;
    display: block;
    overflow: hidden;
  }

  /* Transparent black overlay upar */
  .overlay-text {
    position: absolute;
    top: 118px;
    left: 0;
    width: 100%;
    background: rgba(0, 0, 0, 0.5);
    /* transparent black */
    color: #fff;
    padding: 8px 10px;
    text-align: center;
    box-sizing: border-box;
  }

  /* Listing text upar right */
  .listing-text {
    position: absolute;
    top: 8px;
    right: 10px;
    background: rgba(0, 123, 255, 0.8);
    /* blue transparent */
    color: #fff;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;

  }

  .overlay-text h3 {
    font-size: 15px;
    align-items: center;
    justify-content: center;
    position: relative;
    display: inline-flex;
    color: white !important;

    top: 0px;
  }

  .col-12.col-lg-2.col-md-12.categoryItem img {
    height: 150px;
    object-fit: cover;
  }

  
.category-card {
    background: #fff;
    border: 1px solid #e5ebe8;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.category-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 22px rgba(25, 60, 48, 0.09);
}

.category-image {
    height: 170px;
    overflow: hidden;
    background: #edf2ef;
}

.category-image img {
    display: block;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.category-card:hover .category-image img {
    transform: scale(1.04);
}

.category-count {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #2DAC92;
    color: #fff;
    padding: 5px 9px;
    border-radius: 5px;
    font-size: 11px;
}

.category-title {
    color: #263b3a;
    font-size: 15px;
    font-weight: 600;
    line-height: 1.5;
    overflow-wrap: anywhere;
}

.category-arrow {
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    background: #e5f5ef;
    color: #238d79;
    font-size: 12px;
    flex-shrink: 0;
}

.category-card:hover .category-arrow {
    background: #2DAC92;
    color: #fff;
}

@media (max-width: 576px) {
    .category-image {
        height: 125px;
    }

    .category-title {
        font-size: 14px;
    }

    .category-card .p-3 {
        padding: 10px !important;
    }
}

</style>
<main>



  
<!-- Category Page Header -->
  <section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('assets/images/homepage-banner.webp') }});">
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
                <h2 class="fw-bold mb-1" style="font-size:22px;color:#263b3a;">
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

                <a href="{{ route('listing', ['category' => $category->name]) }}"
                   class="category-card d-block text-decoration-none h-100">

                    <!-- Image -->
                    <div class="category-image position-relative">
                        <img
                            src="{{ asset('public/' . ($category->image ?? 'assets/images/blog-thumb-1.jpeg')) }}"
                            alt="{{ $category->name }}"
                            class="w-100 h-100"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='{{ asset('assets/images/blog-thumb-1.jpeg') }}';">

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

                </a>
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