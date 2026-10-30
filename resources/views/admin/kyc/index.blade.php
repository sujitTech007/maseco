@include('admin.Include.header')

<div class="page-content">
  <div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
      <div>
        <div class="text-muted small mb-1"><a href="{{ route('admin.dashboard') }}">Dashboard</a> / KYC Verification</div>
        <h1 class="h3 mb-0">KYC Verification</h1>
        <p class="text-muted mb-0">Review and approve buyer, supplier &amp; manufacturer documents.</p>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- Stat cards --}}
    <div class="row g-3 mb-4">
      @php
        $statCards = [
          ['label'=>'Total Submissions', 'value'=>$stats['total'],    'color'=>'primary', 'icon'=>'fas fa-file-alt'],
          ['label'=>'Pending Review',    'value'=>$stats['pending'],  'color'=>'warning', 'icon'=>'fas fa-clock'],
          ['label'=>'Approved',          'value'=>$stats['approved'], 'color'=>'success', 'icon'=>'fas fa-check-circle'],
          ['label'=>'Rejected',          'value'=>$stats['rejected'], 'color'=>'danger',  'icon'=>'fas fa-times-circle'],
        ];
      @endphp
      @foreach($statCards as $card)
        <div class="col-6 col-md-3">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-3">
              <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 bg-{{ $card['color'] }} bg-opacity-10 text-{{ $card['color'] }}"
                   style="width:48px;height:48px;font-size:1.3rem">
                <i class="{{ $card['icon'] }}"></i>
              </div>
              <div>
                <div class="text-muted small">{{ $card['label'] }}</div>
                <div class="h4 mb-0 fw-bold">{{ $card['value'] }}</div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Filters --}}
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-body p-3">
        <form method="GET" class="row g-2 align-items-end">
          <div class="col-12 col-md-4 col-lg-3">
            <label class="form-label small text-muted mb-1">Account type</label>
            <select name="type" class="form-select form-select-sm">
              <option value="">All types</option>
              <option value="user"         {{ request('type')==='user'         ? 'selected':'' }}>Buyer</option>
              <option value="supplier"     {{ request('type')==='supplier'     ? 'selected':'' }}>Supplier</option>
              <option value="manufacturer" {{ request('type')==='manufacturer' ? 'selected':'' }}>Manufacturer</option>
            </select>
          </div>
          <div class="col-12 col-md-4 col-lg-3">
            <label class="form-label small text-muted mb-1">KYC status</label>
            <select name="status" class="form-select form-select-sm">
              <option value="">All statuses</option>
              <option value="pending"  {{ request('status')==='pending'  ? 'selected':'' }}>Pending</option>
              <option value="approved" {{ request('status')==='approved' ? 'selected':'' }}>Approved</option>
              <option value="rejected" {{ request('status')==='rejected' ? 'selected':'' }}>Rejected</option>
            </select>
          </div>
          <div class="col-auto">
            <button class="btn btn-sm btn-primary px-3">Filter</button>
            <a href="{{ route('admin.kyc.index') }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
          </div>
        </form>
      </div>
    </div>

    {{-- Submissions list --}}
    @forelse($submissions as $kyc)
      @php
        $account    = $kyc->account();
        $typeName   = $kyc->account_type === 'user' ? 'Buyer' : ucfirst($kyc->account_type);
        $statusMap  = ['pending'=>'warning','approved'=>'success','rejected'=>'danger','incomplete'=>'secondary'];
        $statusBadge= $statusMap[$kyc->status] ?? 'secondary';
        $detailRoute= match($kyc->account_type) {
          'supplier'     => route('admin.seller.show',       $kyc->account_id),
          'manufacturer' => route('admin.manufacturer.show', $kyc->account_id),
          default        => route('admin.buyer.show',        $kyc->account_id),
        };
      @endphp

      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body p-4">

          {{-- Header row --}}
          <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-3">
            <div class="d-flex align-items-center gap-3">
              <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0"
                   style="width:44px;height:44px;font-size:1.1rem">
                <i class="fas fa-user"></i>
              </div>
              <div>
                <h5 class="mb-0">{{ $account->name ?? 'Account unavailable' }}
                  <span class="badge bg-secondary ms-1">{{ $typeName }}</span>
                  <span class="badge bg-{{ $statusBadge }} ms-1">{{ ucfirst($kyc->status) }}</span>
                </h5>
                <div class="small text-muted">
                  {{ $account->email ?? '' }}
                  @if($account->company_name ?? null) &middot; {{ $account->company_name }} @endif
                </div>
                <div class="small text-muted">
                  Submitted: {{ optional($kyc->submitted_at)->format('M j, Y g:i A') ?? '—' }}
                  @if($kyc->reviewed_at) &middot; Reviewed: {{ $kyc->reviewed_at->format('M j, Y g:i A') }} @endif
                </div>
              </div>
            </div>
            <a href="{{ $detailRoute }}" class="btn btn-sm btn-outline-secondary">
              <i class="fas fa-external-link-alt me-1"></i>View profile
            </a>
          </div>

          {{-- Admin note (if any) --}}
          @if($kyc->admin_note)
            <div class="alert alert-warning py-2 mb-3">
              <strong>Admin note:</strong> {{ $kyc->admin_note }}
            </div>
          @endif

          @if($kyc->form_data)
            <div class="row g-2 small mb-3">
              @foreach(['name'=>'Full name','email'=>'Email','phone'=>'Mobile','country'=>'Country','city'=>'City','address'=>'Address','company_name'=>'Company','business_type'=>'Business type','company_registration_number'=>'Registration number','business_tax_id'=>'Business tax ID','gst_number'=>'GST number','business_address'=>'Business address'] as $field => $label)
                @if(!empty($kyc->form_data[$field]))
                  <div class="col-12 col-md-6"><strong>{{ $label }}:</strong> {{ $kyc->form_data[$field] }}</div>
                @endif
              @endforeach
              @if($kyc->document_type)<div class="col-12 col-md-6"><strong>Document type:</strong> {{ $kyc->document_type }}</div>@endif
              @if($kyc->document_number)<div class="col-12 col-md-6"><strong>Document number:</strong> {{ $kyc->document_number }}</div>@endif
            </div>
          @endif

          {{-- Document download buttons --}}
          <div class="d-flex flex-wrap gap-2 mb-3">
            @foreach(['identity_document'=>'Identity front','document_back'=>'Identity back','selfie_document'=>'Selfie','profile_photo'=>'Profile photo','address_document'=>'Address proof','business_document'=>'Business certificate','tax_document'=>'Tax document'] as $field => $label)
              @if($kyc->$field)
                <a href="{{ route('admin.kyc.document', [$kyc, $field]) }}"
                   class="btn btn-sm btn-outline-primary" target="_blank">
                  <i class="fas fa-file-download me-1"></i>{{ $label }}
                </a>
              @endif
            @endforeach
            @if(!$kyc->identity_document && !$kyc->document_back && !$kyc->selfie_document && !$kyc->profile_photo && !$kyc->address_document && !$kyc->business_document && !$kyc->tax_document)
              <span class="text-muted small">No documents uploaded yet.</span>
            @endif
          </div>

          {{-- Approve / Reject form --}}
          @if($kyc->status !== 'approved')
            <form method="POST" action="{{ route('admin.kyc.decision', $kyc) }}" class="row g-2 align-items-end border-top pt-3">
              @csrf
              <input type="hidden" name="redirect_to" value="{{ route('admin.kyc.index', request()->query()) }}">
              <div class="col-12 col-md-7">
                <label class="form-label small text-muted mb-1" for="note-{{ $kyc->id }}">
                  Admin note <span class="text-muted">(required when rejecting)</span>
                </label>
                <input id="note-{{ $kyc->id }}" class="form-control form-control-sm"
                       name="admin_note" value="{{ old('admin_note', $kyc->admin_note) }}"
                       placeholder="Reason for rejection or notes...">
              </div>
              <div class="col-auto">
                <button class="btn btn-sm btn-success px-3" name="decision" value="approved">
                  <i class="fa-regular fa-circle-check me-1"></i>Approve
                </button>
              </div>
              <div class="col-auto">
                <button class="btn btn-sm btn-outline-danger px-3" name="decision" value="rejected">
                  <i class="fa-regular fa-circle-xmark me-1"></i>Reject
                </button>
              </div>
            </form>
          @else
            <div class="border-top pt-3 d-flex align-items-center gap-2 text-success small">
            <i class="fa-solid fa-circle-check"></i>
              <span>KYC approved on {{ optional($kyc->reviewed_at)->format('M j, Y') }}. Account is active.</span>
              {{-- Allow re-rejection in edge cases --}}
              <form method="POST" action="{{ route('admin.kyc.decision', $kyc) }}" class="ms-auto d-flex gap-2 align-items-center">
                @csrf
                <input type="hidden" name="redirect_to" value="{{ route('admin.kyc.index', request()->query()) }}">
                <input class="form-control form-control-sm" name="admin_note" placeholder="Reason for revocation" style="width:220px">
                <button class="btn btn-sm btn-outline-danger" name="decision" value="rejected">Revoke</button>
              </form>
            </div>
          @endif

        </div>
      </div>
    @empty
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5 text-muted">
          <i class="fa-solid fa-shield-check" style="font-size:2.5rem;opacity:.35"></i>
          <p class="mt-2 mb-0">No KYC submissions match the current filters.</p>
        </div>
      </div>
    @endforelse

    <div class="mt-3">{{ $submissions->links() }}</div>

  </div>
</div>

@include('admin.Include.footer')
