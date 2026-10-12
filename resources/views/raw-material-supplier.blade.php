@include('Include.header')

<main>

  <style>

    .agent-box {

      background: #2dac92;

      color: #fff

    }



    .agent-box .agent-ratings {

      position: absolute;

      left: 0;

      right: 0;

      bottom: 0;

      padding: 0 16px;

      z-index: 2;

    }



    .agent-box .agent-img {

      position: relative;

    }



    .agent-box .label {

      display: inline-block;

      padding: 8px 14px;

      color: #fff;

      font-size: 14px;

      border-radius: 3px 3px 0 0;

      background: #607D8B;
    font-weight: 600;

    }



    .agent-box .agent-title {

      margin-top: 5px;

      margin-bottom: 0;

      color: #fff;

      overflow: hidden;

      text-overflow: ellipsis;

      display: -webkit-box;

      -webkit-line-clamp: 1;

      -webkit-box-orient: vertical;

    }



    .agent-box .agent-title a {
    color: #fff;
    text-transform: capitalize;
    font-family: 'Rajdhani';
}



    .agent-info li {

      padding: 5px 0

    }



  .agent-info li a {
    color: #fff;
    font-family: var(--font-rajdhani);
}

i.fas.fa-envelope {
    background: white;
    padding: 7px;
    border-radius: 50%;
    color: #2dac92;
}
i.fas.fa-phone.fa-rotate-90 {
  background: white;
    padding: 7px;
    border-radius: 50%;
    color: #2dac92;
}


    .btn-text {

      font-size: 16px;

      color: #fff;

      padding-bottom: 10px;

      display: block;

    }

    b, strong {
    font-weight: bolder;
    color: #2dac92;
    font-size: 19px;
    padding: 0px 0px 5px;
    border-bottom: 2px solid green;
}

  </style>

  
  <section class="banner inner-banner" style="background-image: url({{ asset('assets/images/inner-banner.jpg)')}};">

    <div class="container">

      <div class="row">

        <div class="inner-banner-heading" data-aos="zoom-in">

          <h1>Raw Material Supplier</h1>

        </div>

        <div class="breadcrumb-container">

          <ol class="breadcrumb" data-aos="fade-up">

            <li class="breadcrumb-item">

              <a href="{{ route('home') }}"><i class="fas fa-home mr-2"></i>Home</a>

            </li>

            <li class="breadcrumb-item active">Raw Material Supplier </li>

          </ol>

        </div>

      </div>

    </div>

  </section>

  <div class="agent-grid pt-100 pb-70 mt-5 mb-5">

    <div class="container">

      <div class="row gx-xl-5">

        <div class="col-lg-9">

          <div class="row g-5">

            @foreach($suppliers as $supplier)

            <div class="col-lg-4 col-md-6 aos-init aos-animate" >

              <div class="agent-box radius-md mb-30 mb-5">

                <div class="agent-img">

                  <figure>

                    <a href="#">

                      <img class=" ls-is-cached lazyloaded"

                        src="{{ asset('public/images/default-user-profile.png') }}"

                        data-src="{{ asset('public/images/default-user-profile.png') }}">

                    </a>

                  </figure>

                  <div class="agent-ratings d-flex align-items-center justify-content-between">

                    <div class="ratings">



                    </div>

                    <span class="label">Supplier</span>

                  </div>



                </div>

                <div class="agent-details text-center">

                  <h4 class="agent-title"><a href="#">{{ $supplier->name }}</a>

                  </h4>

                  <!-- <span class="color-primary font-sm">5

                    Properties</span> |

                  <span class="color-primary font-sm">2

                    Agents</span> |

                  <span class="color-primary font-sm">3

                    Projects</span> -->







                  <ul class="agent-info list-unstyled p-0">



                    <li class="icon-start ">

                      <a href="tel:278964587"> <i class="fas fa-phone fa-rotate-90"></i>

                        {{$supplier->phone}}</a>

                    </li>



                    <li class="icon-start font-sm pb-3">

                      <a href="mailto:admin@example.com"> <i class="fas fa-envelope"></i>

                      {{$supplier->email}}</a>

                    </li>

                  </ul>

                  <!-- <a href="" class="btn-text">View Profile</a> -->

                </div>

              </div><!-- agent-default -->

            </div>

            @endforeach



            

        

      </div>

    </div>

  </div>

</main>



@include('Include.footer')