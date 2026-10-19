@include('seller.Include.header')

@php
  // Inline SVG icon helper (Lucide-style, stroke icons). Size is set inline so theme SVG rules can't resize them.
  $ico = function (string $name, int $size = 24, string $class = '', float $stroke = 1.8, bool $solid = false) {
    $paths = [
      'chat' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M13 8H7"/><path d="M17 12H7"/>',
      'bag' => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/>',
      'card' => '<rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/><path d="M6 15h4"/>',
      'check' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',
      'headset' => '<path d="M3 11h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5Zm0 0a9 9 0 1 1 18 0m0 0v5a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3Z"/><path d="M21 16v2a4 4 0 0 1-4 4h-5"/>',
      'mail' => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
      'arrow' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
      'calendar' => '<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>',
      'chevron' => '<path d="m6 9 6 6 6-6"/>',
      'handshake' => '<path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3 1 11h-2"/><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"/><path d="M3 4h8"/>',
    ];

    return '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="' . ($solid ? 'currentColor' : 'none') . '" stroke="currentColor" stroke-width="' . $stroke . '" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 ' . $class . '" style="width:' . $size . 'px;height:' . $size . 'px" aria-hidden="true">' . $paths[$name] . '</svg>';
  };
@endphp

<!-- Begin page -->
<div class="wrapper active">

  <div class="page-content mt-3">

    <div class="page-container p-1">
      <div class="container py-1">

        {{-- Page heading + date range --}}
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3 mb-4">
          <div>
            <h2 class="fw-bold mb-1 fs-bold">My Dashboard</h2>
            <p class="text-muted mb-0">Overview of your orders, payments and buyer enquiries with Maseco.</p>
          </div>

          <div
            class="d-inline-flex align-items-center gap-2 bg-white border rounded-3 px-3 py-2 text-muted align-self-start">
            {!! $ico('calendar', 18) !!}
            <span>{{ now()->subDays(7)->format('M d, Y') }} - {{ now()->format('M d, Y') }}</span>
            {!! $ico('chevron', 16) !!}
          </div>
        </div>

        {{-- Welcome banner --}}
        <div class="position-relative overflow-hidden rounded-4 bg-success shadow-sm mb-4">

          {{-- Banner image: place your warehouse photo at public/assets/images/warehouse-banner.jpg --}}
          <img src="{{ asset('assets/images/warehouse-banner.jpg') }}" alt=""
            class="position-absolute top-0 end-0 h-100 w-50 d-none d-lg-block" style="object-fit: cover;"
            onerror="this.remove()">

          {{-- Dark green overlay --}}
          <div class="position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-50"></div>

          {{-- Soft decorative circles --}}
          <div
            class="position-absolute top-0 end-0 translate-middle-y ratio ratio-1x1 w-25 rounded-circle bg-white bg-opacity-10 d-none d-md-block">
          </div>
          <div
            class="position-absolute bottom-0 end-0 translate-middle-x ratio ratio-1x1 w-25 rounded-circle bg-white bg-opacity-10 d-none d-md-block">
          </div>

          <div class="row align-items-center g-3 g-md-4 p-4 position-relative">
            <div class="col-auto">
              <span
                class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle bg-success text-white border border-2 border-white border-opacity-25">
                {!! $ico('handshake', 36, '', 1.6) !!}
              </span>
            </div>
            <div class="col-12 col-sm col-lg-7 text-white">
              <h3 class="fs-3 fw-bold text-white mb-2">Welcome back.</h3>
              <p class="mb-0 opacity-75 fs-6">Keep track of the orders, payments and buyer enquiries
                coming through your Maseco supplier account.</p>
            </div>
          </div>
        </div>

        {{-- Stat cards --}}
        <div class="row g-3 g-xl-4 mb-3 align-items-center">

          {{-- Total Orders (orange: Bootstrap orange variable) --}}
          <div class="col-12 col-md-6 col-xl-3">
            <div class="card h-100 position-relative overflow-hidden rounded-4 shadow-sm border"
              style="background-color: rgba(var(--bs-orange-rgb, 253, 126, 20), .1); border-color: rgba(var(--bs-orange-rgb, 253, 126, 20), .25) !important;">
              <span class="position-absolute end-0 top-50 translate-middle-y me-0 opacity-25" style="color: var(--bs-orange, #fd7e14);">
                {{-- {!! $ico('bag', 90, '', 1.8, true) !!} --}}
              </span>
              <div class=" card-body position-relative p-3 p-xl-4 d-flex flex-column">
                <div class="d-flex align-items-center gap-2 mb-3">
                  <span
                    class="d-inline-flex align-items-center justify-content-center p-2 rounded-4 text-white align-self-start mb-0"
                    style="background-color: var(--bs-orange, #fd7e14);">
                    {!! $ico('bag', 30) !!}
                  </span>
                  <h3 class="h4 fw-bold mb-0">Total Orders</h3>
                </div>

                <p class="fs-1 fw-bold lh-1 mb-2">{{ $ordersCount }}</p>
                <p class="text-muted small mb-0">All orders placed with you.</p>
            </div>
          </div>
        </div>

        {{-- Completed Orders --}}
        <div class="col-12 col-md-6 col-xl-3">
          <div
            class="card h-100 position-relative overflow-hidden rounded-4 shadow-sm bg-success bg-opacity-10 border border-success border-opacity-25">
            {{-- {!! $ico('check', 90, 'text-success opacity-25 position-absolute end-0 top-50 translate-middle-y
            me-0', 1.8, true) !!} --}}
            <div class="card-body position-relative p-3 p-xl-4 d-flex flex-column">
              <div class="d-flex align-items-center gap-2 mb-3">
                <span
                  class="d-inline-flex align-items-center justify-content-center p-2 rounded-4 bg-success text-white align-self-start mb-0">
                  {!! $ico('check', 30) !!}
                </span>
                <h3 class="h4 fw-bold mb-0">Completed Orders</h3>
              </div>

              <p class="fs-1 fw-bold lh-1 mb-2">{{ $paidOrdersCount }}</p>
              <p class="text-muted small mb-0">Orders that have been paid.</p>
            </div>
          </div>
        </div>

        {{-- Payments Received (purple: Bootstrap purple variable) --}}
        <div class="col-12 col-md-6 col-xl-3">
          <div class="card h-100 position-relative overflow-hidden rounded-4 shadow-sm border"
            style="background-color: rgba(var(--bs-purple-rgb, 111, 66, 193), .1); border-color: rgba(var(--bs-purple-rgb, 111, 66, 193), .25) !important;">
            <span class="position-absolute end-0 top-50 translate-middle-y me-0 opacity-25"      style="color:
              var(--bs-purple, #6f42c1);">
              {{-- {!! $ico('card', 90, '', 1.8, true) !!} --}}
            </span>
            <div class="card-body position-relative p-3 p-xl-4 d-flex flex-column">
              <div class="d-flex align-items-center gap-2 mb-3">
                <span
                  class="d-inline-flex align-items-center justify-content-center p-2 rounded-4 text-white align-self-start mb-0"
                  style="background-color: var(--bs-purple, #6f42c1);">
                  {!! $ico('card', 30) !!}
                </span>
                <h3 class="h4 fw-bold mb-0">Payments Received</h3>
              </div>

              <p class="fs-1 fw-bold lh-1 mb-2 text-break">${{ number_format($paymentsTotal, 2) }}</p>
              <p class="text-muted small mb-0">Total received from your orders.</p>
            </div>
          </div>
        </div>

        {{-- Enquiries --}}
        <div class="col-12 col-md-6 col-xl-3">
          <div
            class="card h-100 position-relative overflow-hidden rounded-4 shadow-sm bg-primary bg-opacity-10 border border-primary border-opacity-25">
            {{-- {!! $ico('chat', 90, 'text-primary opacity-25 position-absolute end-0 top-50 translate-middle-y
            me-0', 1.8, true) !!} --}}
            <div class="card-body position-relative p-3 p-xl-4 d-flex flex-column">
              <div class="d-flex align-items-center gap-2 mb-3">
                <span
                  class="d-inline-flex align-items-center justify-content-center p-2 rounded-4 bg-primary text-white align-self-start mb-0">
                  {!! $ico('chat', 30) !!}
                </span>
                <h3 class="h4 fw-bold mb-0">Enquiries</h3>
              </div>

              <p class="fs-1 fw-bold lh-1 mb-2">{{ $enquiriesCount }}</p>
              <p class="text-muted small mb-0">Requests from buyers.</p>
            </div>
          </div>
        </div>

      </div>

      {{-- Need help --}}
      <div class="card rounded-4 shadow-sm bg-success bg-opacity-10 border border-success border-opacity-25 mb-4">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center g-3 g-xl-4">

            <div class="col-12 col-lg">
              <div class="d-flex align-items-start gap-3">
                <span
                  class="d-inline-flex align-items-center justify-content-center p-2 rounded-4 bg-success text-white flex-shrink-0">
                  {!! $ico('headset', 28) !!}
                </span>
                <div>
                  <h3 class="h4 fw-bold mb-1">Need help?</h3>
                  <p class="text-muted mb-2">Questions about your orders, payments or listings?
                    Our team is happy to help.</p>
                  <p class="mb-0 d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-success d-inline-flex">{!! $ico('mail', 18) !!}</span>
                    <span>Email: <a href="mailto:connect@maseco.ca"
                        class="text-success fw-semibold text-decoration-none">connect@maseco.ca</a></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-auto">
              <a href="{{ url('contact-us') }}"
                class="btn btn-sm fw-bold rounded-pill px-3 py-2 align-self-start mt-0 d-inline-flex align-items-center gap-2 bg-success text-white">
                Contact us {!! $ico('arrow', 18) !!}
              </a>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

</div>
</div>

@include('seller.Include.footer')