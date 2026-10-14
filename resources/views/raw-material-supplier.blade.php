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


.supplier-directory-card {
    overflow: hidden;
    transition: box-shadow .2s ease, transform .2s ease;
}

.supplier-directory-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(38, 59, 58, .08);
}

.supplier-avatar {
    width: 68px;
    height: 68px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    /* background: #f1f5f3; */
    border-radius: 10px;
    overflow: hidden;
}

.supplier-avatar img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.supplier-name {
    color: #263b3a;
    font-size: 16px;
    overflow-wrap: anywhere;
}

.supplier-contact-row {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.supplier-contact-icon {
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

.supplier-contact-link {
    color: #263b3a;
    font-size: 13px;
    text-decoration: none;
    overflow-wrap: anywhere;
}

.supplier-contact-link:hover {
    color: #2DAC92;
}

.supplier-primary-btn {
    background: #2DAC92;
    color: #fff;
    border: 1px solid #2DAC92;
    font-size: 13px;
    padding: 9px 8px;
}

.supplier-primary-btn:hover {
    background: #248f7b;
    color: #fff;
}

.supplier-secondary-btn {
    background: #fff;
    color: #2DAC92;
    border: 1px solid #2DAC92;
    font-size: 13px;
    padding: 9px 8px;
}

.supplier-secondary-btn:hover {
    background: #e7f5ef;
    color: #248f7b;
}

@media (max-width: 575px) {
    .supplier-avatar {
        width: 58px;
        height: 58px;
    }

    .supplier-directory-card .p-3 {
        padding: 14px !important;
    }
}

  </style>

  

<!-- Supplier Page Header -->
<section class="banner inner-banner" style="background-image: url({{ asset('assets/images/breadcumb-banner.webp)')}};">
    <div class="container">
        <!-- <p class="mb-2" style="font-size:13px;color:#c4e4dc;">
            <a href="{{ route('home') }}" class="text-white text-decoration-none">
                <i class="fas fa-home me-1"></i> Home
            </a>
            / Raw Material Suppliers
        </p> -->

        <div class="d-flex flex-wrap justify-content-center align-items-center gap-3">
            <div>
                <h1 class="fw-bold mb-2 text-white" style="font-size:28px;">
                    Raw Material Suppliers
                </h1>
                <p class="mb-0" style="font-size:14px;color:#e0e9e7;">
                    Explore supplier contacts and connect with businesses for your material requirements.
                </p>
            </div>

            <!-- <div class="rounded-3 px-3 py-2"
                 style="background:rgba(255,255,255,.1);font-size:14px;">
                <i class="fas fa-building me-2"></i>
                {{ $suppliers->count() }} Suppliers
            </div> -->
        </div>
    </div>
</section>

<!-- Supplier Directory -->
<section class="py-5" style="background:#f6f8f7;">
    <div class="container">

        <!-- Directory Intro -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div>
                <h2 class="fw-bold mb-1" style="font-size:21px;color:#263b3a;">
                    Supplier Directory
                </h2>
                <p class="text-secondary mb-0" style="font-size:13px;">
                    Contact suppliers directly by phone or email.
                </p>
            </div>
        </div>

        <!-- Supplier Cards -->
        <div class="row g-4">

            @forelse($suppliers as $supplier)
                <div class="col-xl-4 col-md-6">

                    <div class="supplier-directory-card bg-white border rounded-3 h-100">

                        <!-- Card Header -->
                        <div class="d-flex align-items-center gap-3 p-3 border-bottom">

                            <div class="supplier-avatar">
                                <img
                                    src="{{ asset('public/images/default-user-profile.png') }}"
                                    alt="Supplier profile"
                                    class="img-fluid">
                            </div>

                            <div class="flex-grow-1 overflow-hidden">
                                <span class="badge rounded-pill mb-2"
                                      style="background:#e4f5ef;color:#248f7b;font-size:11px;">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Supplier
                                </span>

                                <h5 class="fw-bold mb-1 supplier-name">
                                    {{ $supplier->name }}
                                </h5>

                                <p class="text-secondary mb-0" style="font-size:13px;">
                                    Raw Material Supplier
                                </p>
                            </div>

                        </div>

                        <!-- Contact Information -->
                        <div class="p-3">

                            <p class="text-secondary mb-3" style="font-size:13px;">
                                <i class="fas fa-address-card me-2"
                                   style="color:#2DAC92;"></i>
                                Contact Information
                            </p>

                            <div class="supplier-contact-row mb-3">
                                <div class="supplier-contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <span class="d-block text-secondary mb-1"
                                          style="font-size:12px;">
                                        Phone Number
                                    </span>

                                    @if($supplier->phone)
                                        <a href="tel:{{ $supplier->phone }}"
                                           class="supplier-contact-link">
                                            {{ $supplier->phone }}
                                        </a>
                                    @else
                                        <span class="text-secondary"
                                              style="font-size:13px;">Not provided</span>
                                    @endif
                                </div>
                            </div>

                            <div class="supplier-contact-row mb-3">
                                <div class="supplier-contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <span class="d-block text-secondary mb-1"
                                          style="font-size:12px;">
                                        Email Address
                                    </span>

                                    @if($supplier->email)
                                        <a href="mailto:{{ $supplier->email }}"
                                           class="supplier-contact-link">
                                            {{ $supplier->email }}
                                        </a>
                                    @else
                                        <span class="text-secondary"
                                              style="font-size:13px;">Not provided</span>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex gap-2 pt-3 border-top">

                                @if($supplier->phone)
                                    <a href="tel:{{ $supplier->phone }}"
                                       class="btn supplier-primary-btn flex-fill">
                                        <i class="fas fa-phone me-1"></i>
                                        Call Supplier
                                    </a>
                                @endif

                                @if($supplier->email)
                                    <a href="mailto:{{ $supplier->email }}"
                                       class="btn supplier-secondary-btn flex-fill">
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
                        <i class="fas fa-building mb-3"
                           style="font-size:32px;color:#2DAC92;"></i>

                        <h5 class="fw-bold" style="font-size:18px;">
                            No Suppliers Available
                        </h5>

                        <p class="text-secondary mb-0" style="font-size:14px;">
                            Supplier information will appear here when available.
                        </p>
                    </div>
                </div>
            @endforelse

        </div>

        <!-- Pagination: enable if the controller uses paginate() -->
        @if(method_exists($suppliers, 'links') && $suppliers->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $suppliers->links() }}
            </div>
        @endif

    </div>
</section>

</main>



@include('Include.footer')