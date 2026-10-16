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

.manufacturer-card {
    overflow: hidden;
    transition: box-shadow .2s ease, transform .2s ease;
}

.manufacturer-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(38, 59, 58, .08);
}

.manufacturer-avatar {
    width: 68px;
    height: 68px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f3;
    border-radius: 10px;
    overflow: hidden;
}

.manufacturer-avatar img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.manufacturer-name {
    color: #263b3a;
    font-size: 16px;
    overflow-wrap: anywhere;
}

.manufacturer-contact-row {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.manufacturer-contact-icon {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #248f7b;
    background: #e7f5ef;
    border-radius: 8px;
}

.manufacturer-contact-link {
    color: #263b3a;
    font-size: 13px;
    text-decoration: none;
    overflow-wrap: anywhere;
}

.manufacturer-contact-link:hover {
    color: #2DAC92;
}

.manufacturer-primary-btn {
    background: #2DAC92;
    color: #fff;
    border: 1px solid #2DAC92;
    font-size: 13px;
    padding: 15px 0px;
}

.manufacturer-primary-btn:hover {
    background: #248f7b;
    color: #fff;
}

.manufacturer-secondary-btn {
    background: #fff;
    color: #2DAC92;
    border: 1px solid #2DAC92;
    font-size: 13px;
    padding: 9px 8px;
}

.manufacturer-secondary-btn:hover {
    background: #e7f5ef;
    color: #248f7b;
}

@media (max-width: 575px) {
    .manufacturer-avatar {
        width: 58px;
        height: 58px;
    }

    .manufacturer-card .p-3 {
        padding: 14px !important;
    }
}


  </style>


  
<!-- Manufacturer Page Header -->
<section class="py-4 text-white" style="background:#263b3a;">
    <div class="container">
        <!-- <p class="mb-2" style="font-size:13px;color:#c4e4dc;">
            <a href="{{ route('home') }}" class="text-white text-decoration-none">
                <i class="fas fa-home me-1"></i> Home
            </a>
            / Manufacturers
        </p> -->

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h1 class="fw-bold mb-2 text-white" style="font-size:28px;">
                    Manufacturers
                </h1>
                <p class="mb-0" style="font-size:14px;color:#e0e9e7;">
                    Explore manufacturers and connect directly with businesses.
                </p>
            </div>

            <div class="rounded-3 px-3 py-2"
                 style="background:rgba(255,255,255,.1);font-size:14px;">
                <i class="fas fa-industry me-2"></i>
                {{ $manufacturers->count() }} Manufacturers
            </div>
        </div>
    </div>
</section>

<!-- Manufacturer Directory -->
<section class="py-5" style="background:#f6f8f7;">
    <div class="container">

        <div class="mb-4">
            <h2 class="fw-bold mb-1" style="font-size:21px;color:#263b3a;">
                Manufacturer Directory
            </h2>
            <p class="text-secondary mb-0" style="font-size:13px;">
                Find contact details for manufacturers in the Maseco network.
            </p>
        </div>

        <div class="row g-4">

            @forelse($manufacturers as $manufacturer)
                <div class="col-xl-4 col-md-6">

                    <div class="manufacturer-card bg-white border rounded-3 h-100">

                        <!-- Manufacturer Information -->
                        <div class="d-flex align-items-center gap-3 p-3 border-bottom">

                            <div class="supplier-avatar">
                                <img
                                    src="{{ asset('public/images/default-user-profile.png') }}"
                                    alt="Manufacturer profile"
                                    class="img-fluid">
                            </div>

                            <div class="flex-grow-1 overflow-hidden">
                                <span class="badge rounded-pill mb-2"
                                      style="background:#e4f5ef;color:#248f7b;font-size:11px;">
                                    <i class="fas fa-industry me-1"></i>
                                    Manufacturer
                                </span>

                                <h5 class="manufacturer-name fw-bold mb-1">
                                    {{ $manufacturer->name }}
                                </h5>

                                <p class="text-secondary mb-0" style="font-size:13px;">
                                    Manufacturing Business
                                </p>
                            </div>

                        </div>

                        <!-- Contact Details -->
                        <div class="p-3">

                            <p class="text-secondary mb-3" style="font-size:13px;">
                                <i class="fas fa-address-card me-2"
                                   style="color:#2DAC92;"></i>
                                Contact Information
                            </p>

                            <div class="manufacturer-contact-row mb-3">
                                <div class="manufacturer-contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <span class="d-block text-secondary mb-1"
                                          style="font-size:12px;">
                                        Phone Number
                                    </span>

                                    @if($manufacturer->phone)
                                        <a href="tel:{{ $manufacturer->phone }}"
                                           class="manufacturer-contact-link">
                                            {{ $manufacturer->phone }}
                                        </a>
                                    @else
                                        <span class="text-secondary"
                                              style="font-size:13px;">
                                            Not provided
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="manufacturer-contact-row mb-3">
                                <div class="manufacturer-contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <span class="d-block text-secondary mb-1"
                                          style="font-size:12px;">
                                        Email Address
                                    </span>

                                    @if($manufacturer->email)
                                        <a href="mailto:{{ $manufacturer->email }}"
                                           class="manufacturer-contact-link">
                                            {{ $manufacturer->email }}
                                        </a>
                                    @else
                                        <span class="text-secondary"
                                              style="font-size:13px;">
                                            Not provided
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 pt-3 border-top">

                                @if($manufacturer->phone)
                                    <a href="tel:{{ $manufacturer->phone }}"
                                       class="btn manufacturer-primary-btn flex-fill">
                                        <i class="fas fa-phone me-1"></i>
                                        Call Manufacturer
                                    </a>
                                @endif

                                @if($manufacturer->email)
                                    <a href="mailto:{{ $manufacturer->email }}"
                                       class="btn manufacturer-secondary-btn flex-fill">
                                        <i class="fas fa-envelope me-1"></i>
                                        Email
                                    </a>
                                @endif

                            </div>

                        </div>
                    </div>

                </div>
            @empty
                <div class="col-12">
                    <div class="bg-white border rounded-3 text-center p-5">
                        <i class="fas fa-industry mb-3"
                           style="font-size:32px;color:#2DAC92;"></i>

                        <h5 class="fw-bold" style="font-size:18px;">
                            No Manufacturers Available
                        </h5>

                        <p class="text-secondary mb-0" style="font-size:14px;">
                            Manufacturer information will appear here when available.
                        </p>
                    </div>
                </div>
            @endforelse

        </div>

        <!-- Pagination: works when using Laravel paginate() -->
        @if(method_exists($manufacturers, 'links') && $manufacturers->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $manufacturers->links() }}
            </div>
        @endif

    </div>
</section>


</main>



@include('Include.footer')