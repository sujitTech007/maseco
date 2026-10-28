<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KYC verification | Maseco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5" style="max-width:760px">
    <div class="card border-0 shadow-sm"><div class="card-body p-4 p-md-5">
        <h1 class="h3">Verify your account</h1>
        <p class="text-muted">{{ ucfirst($type === 'user' ? 'buyer' : $type) }} account for {{ $account->name }}. Upload clear PDF, JPG, or PNG documents (up to 10 MB each). Dashboard access starts after admin approval.</p>
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(session('info'))<div class="alert alert-info">{{ session('info') }}</div>@endif
        @if($kyc)
            <div class="alert alert-{{ $kyc->status === 'approved' ? 'success' : ($kyc->status === 'rejected' ? 'warning' : 'secondary') }}">
                Status: <strong>{{ ucfirst($kyc->status) }}</strong>
                @if($kyc->admin_note)<div class="mt-1">Admin note: {{ $kyc->admin_note }}</div>@endif
            </div>
        @endif
        @if(!$kyc || $kyc->status !== 'approved')
        <form method="POST" action="{{ route('kyc.submit') }}" enctype="multipart/form-data" class="vstack gap-3">
            @csrf
            <div><label class="form-label">Government identity document <span class="text-danger">*</span></label><input class="form-control" type="file" name="identity_document" accept=".pdf,.jpg,.jpeg,.png" required>@error('identity_document')<div class="text-danger small">{{ $message }}</div>@enderror</div>
            <div><label class="form-label">Proof of residential/business address <span class="text-danger">*</span></label><input class="form-control" type="file" name="address_document" accept=".pdf,.jpg,.jpeg,.png" required>@error('address_document')<div class="text-danger small">{{ $message }}</div>@enderror</div>
            @if($type !== 'user')
                <div><label class="form-label">Business registration / incorporation document <span class="text-danger">*</span></label><input class="form-control" type="file" name="business_document" accept=".pdf,.jpg,.jpeg,.png" required>@error('business_document')<div class="text-danger small">{{ $message }}</div>@enderror</div>
                <div><label class="form-label">Tax registration document <span class="text-danger">*</span></label><input class="form-control" type="file" name="tax_document" accept=".pdf,.jpg,.jpeg,.png" required>@error('tax_document')<div class="text-danger small">{{ $message }}</div>@enderror</div>
            @endif
            <button class="btn btn-primary">{{ $kyc?->status === 'rejected' ? 'Resubmit KYC' : 'Submit KYC' }}</button>
        </form>
        @endif
        <a class="btn btn-link px-0 mt-3" href="{{ route('login') }}">Return to login</a>
    </div></div>
</main>
</body></html>
