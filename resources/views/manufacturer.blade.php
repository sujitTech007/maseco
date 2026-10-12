@include('Include.header')

<main>

  <style>

    .agent-box {

      background: #2dac92;

      color: #fff;
          margin: 0px 0px 40px;

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

      font-size: 15px;

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
font-size:20px;
      text-transform: capitalize;

    }



    .agent-box .agent-title a {

      color: #fff

    }



    .agent-info li {

      padding: 5px 0

    }



    .agent-info li a {

      color: #fff;
          font-family: var(--font-rajdhani);


    }



    .btn-text {

      font-size: 16px;

      color: #fff;

      padding-bottom: 10px;

      display: block;

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


@media screen and (max-width: 767px) {
.agent-box .label {
    display: inline-block;
    padding: 8px 14px;
    color: #fff;
    font-size: 14px !important;
    border-radius: 3px 3px 0 0;
    background: #607D8B;
    font-weight: 600;
}
}

  </style>


  <section class="banner inner-banner" style="background-image: url({{ asset('assets/images/inner-banner.jpg)')}};">

    <div class="container">

      <div class="row">

        <div class="inner-banner-heading" data-aos="zoom-in">

          <h1>Manufacturer </h1>

        </div>

        <div class="breadcrumb-container">

          <ol class="breadcrumb" data-aos="fade-up">

            <li class="breadcrumb-item">

              <a href="{{ route('home') }}"><i class="fas fa-home mr-2"></i>Home</a>

            </li>

            <li class="breadcrumb-item active">Manufacturer  </li>

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

            @foreach($manufacturers as $manufacturer)

            <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

              <div class="agent-box radius-md mb-30">

                <div class="agent-img">

                  <figure>

                    <a href="#">

                      <img class=" ls-is-cached lazyloaded"

                        src="http://realimate.ca/assets/img/admins/66693d3c45263.png"

                        data-src="http://realimate.ca/assets/img/admins/66693d3c45263.png">

                    </a>

                  </figure>

                  <div class="agent-ratings d-flex align-items-center justify-content-between">

                    <div class="ratings">



                    </div>

                    <span class="label">Manufacturer</span>

                  </div>



                </div>

                <div class="agent-details text-center">

                  <h4 class="agent-title"><a href="#">{{ $manufacturer->name }}</a>

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

                        {{$manufacturer->phone}}</a>

                    </li>



                    <li class="icon-start font-sm pb-3">

                      <a href="mailto:admin@example.com"> <i class="fas fa-envelope"></i>

                      {{$manufacturer->email}}</a>

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