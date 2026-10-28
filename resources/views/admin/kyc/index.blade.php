@include('admin.Include.header')
<main class="page-content"><div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4"><div><h1 class="h3 mb-1">KYC review</h1><p class="text-muted mb-0">Review buyer, supplier, and manufacturer verification documents.</p></div><a class="btn btn-outline-secondary" href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @foreach($submissions as $kyc)
        @php($account = $kyc->account())
        <section class="card border-0 shadow-sm mb-3"><div class="card-body">
            <div class="d-flex flex-wrap justify-content-between gap-3"><div><h2 class="h5 mb-1">{{ $account->name ?? 'Account unavailable' }} <span class="badge bg-secondary">{{ ucfirst($kyc->account_type) }}</span></h2><div class="text-muted">{{ $account->email ?? '' }} · {{ $account->company_name ?? '' }}</div><div class="small text-muted">Submitted {{ optional($kyc->submitted_at)->format('M j, Y g:i A') }} · {{ ucfirst($kyc->status) }}</div></div></div>
            <div class="d-flex flex-wrap gap-2 my-3">
                @foreach(['identity_document'=>'Identity','address_document'=>'Address','business_document'=>'Business registration','tax_document'=>'Tax registration'] as $field=>$label)
                    @if($kyc->$field)<a class="btn btn-sm btn-outline-primary" href="{{ route('admin.kyc.document', [$kyc, $field]) }}">{{ $label }} document</a>@endif
                @endforeach
            </div>
            <form method="POST" action="{{ route('admin.kyc.decision', $kyc) }}" class="row g-2 align-items-end">@csrf
                <div class="col-md-8"><label class="form-label" for="note-{{ $kyc->id }}">Admin note (required when rejecting)</label><input id="note-{{ $kyc->id }}" class="form-control" name="admin_note" value="{{ $kyc->admin_note }}"></div>
                <div class="col-auto"><button class="btn btn-success" name="decision" value="approved">Approve</button></div>
                <div class="col-auto"><button class="btn btn-outline-danger" name="decision" value="rejected">Return for updates</button></div>
            </form>
        </div></section>
    @endforeach
    @if($submissions->isEmpty())<div class="alert alert-light border">No KYC submissions are waiting for review.</div>@endif
    {{ $submissions->links() }}
</div></main>
@include('admin.Include.footer')
