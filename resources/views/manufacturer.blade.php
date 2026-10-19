@include('Include.header')

<main>

  



    <!-- Manufacturer Page Header -->
    <section class="banner inner-banner py-3 py-md-5" style="background-image: url({{ asset('assets/images/homepage-banner.webp') }});">
        <div class="container">
            <div class="row">
                <div class="inner-banner-heading position-relative z-1 text-center text-white">

                    <h1>Manufacturer</h1>
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