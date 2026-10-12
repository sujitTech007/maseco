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
  background: rgba(0, 0, 0, 0.5); /* transparent black */
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
  background: rgba(0, 123, 255, 0.8); /* blue transparent */
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

</style>
<main>



        <section class="banner inner-banner" style="background-image: url({{ asset('assets/images/inner-banner.jpg)')}};">

    <div class="container">

      <div class="row">

        <div class="inner-banner-heading" data-aos="zoom-in">

          <h1>Category</h1>

        </div>

        <div class="breadcrumb-container">

          <ol class="breadcrumb" data-aos="fade-up">

            <li class="breadcrumb-item">

              <a href="{{ route('home') }}"><i class="fas fa-home mr-2"></i>Home</a>

            </li>

            <li class="breadcrumb-item active">Category </li>

          </ol>

        </div>

      </div>

    </div>

  </section>





<section class="listing-page py-5">

<div class="container">
<div class="row">
<div class="listings col-md-12">
<div class="row">
 @foreach($categories as $category)
<div class="col-12 col-lg-2 col-md-12 categoryItem">
  <a href="{{ url('listing?category=' . $category->id) }}" class="wsus__category_single_slider position-relative d-block">
    
    <!-- Image -->
    <img src="{{ asset('public/' . ($category->image ?? 'assets/images/blog-thumb-1.jpeg')) }}" 
         alt="{{ $category->name }}" class="img-fluid w-100">

    <!-- Transparent black overlay upar -->
    <div class="overlay-text">
      <h3>{{ $category->name }}</h3>
    </div>

    <!-- 0 Listing text right side upar -->
    <span class="listing-text">0 Listing</span>
    
  </a>
</div>
        @endforeach

</div>


      </div>
    </div>
  </div>



  </section>

</main>





@include('Include.footer')