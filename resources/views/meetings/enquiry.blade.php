@if($role === 'user')
    @include('user.Include.header')
@elseif($role === 'supplier')
    @include('seller.Include.header')
@else
    @include('manufacturer.Include.header')
@endif

<style>
    .maseco-meetings-page { padding: 32px 0 48px; background: #f7f9f8; min-height: 65vh; }
    .maseco-meetings-page > .container { max-width: 1040px; }
    .maseco-meetings-page h3 { color: #173c32; letter-spacing: -.03em; }
    .maseco-meeting-card { border: 1px solid #e6ece8; border-radius: 16px; box-shadow: 0 12px 34px rgba(28,58,47,.07); }
    .maseco-meeting-card .form-control { min-height: 44px; }
    .maseco-meeting-item { border: 1px solid #e6ece8; border-radius: 14px; background: #fff; padding: 18px; }
    @media(max-width:575.98px){.maseco-meetings-page{padding:18px 0 30px}.maseco-meeting-item{padding:14px}}
</style>

<main class="page-content maseco-meetings-page">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <a class="small text-success text-decoration-none" href="{{ $role === 'user' ? route('user.enquiries') : ($role === 'supplier' ? route('seller.enquiry') : route('manufacturer.enquiry')) }}">← Back to enquiries</a>
                <h3 class="fw-bold mt-2 mb-1">Meetings</h3>
                <div class="text-muted">{{ $enquiry->subject ?: ($enquiry->material?->name ?? 'RFQ') }} · RFQ #{{ $enquiry->id }}</div>
            </div>
            <div class="text-muted small">Shared with {{ $otherPartyName }}</div>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

        <div class="card maseco-meeting-card mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Schedule a meeting</h5>
                <p class="text-muted small mb-3">Choose a date and time. Paste a Google Meet or other video-call link if you already created one. The RFQ participants can view it here.</p>
                <form method="POST" action="{{ route('enquiry.meetings.store', $enquiry) }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-5"><label class="form-label">Meeting title</label><input class="form-control" name="title" maxlength="180" value="{{ old('title') }}" placeholder="e.g. Cotton sourcing discussion" required></div>
                        <div class="col-md-3"><label class="form-label">Date and time</label><input class="form-control" type="datetime-local" name="starts_at" value="{{ old('starts_at') }}" min="{{ now()->format('Y-m-d\TH:i') }}" required></div>
                        <div class="col-md-4"><label class="form-label">Meeting URL <span class="text-muted">(optional)</span></label><input class="form-control" type="url" name="meeting_url" maxlength="1000" value="{{ old('meeting_url') }}" placeholder="https://meet.google.com/..." ></div>
                        <div class="col-12"><button class="btn btn-success px-4"><i class="fa-regular fa-calendar-plus me-1"></i> Schedule meeting</button></div>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3"><h5 class="fw-bold mb-0">Scheduled meetings</h5><button type="button" class="btn btn-sm btn-outline-success" data-copy-text="{{ route('enquiry.meetings.index', $enquiry) }}"><i class="fa-regular fa-copy me-1"></i>Copy meeting page link</button></div>
        @forelse($meetings as $meeting)
            <article class="maseco-meeting-item mb-3">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                    <div>
                        <h6 class="fw-bold mb-1">{{ $meeting->title }}</h6>
                        <div class="text-muted"><i class="fa-regular fa-clock me-1"></i>{{ $meeting->starts_at->format('D, d M Y · h:i A') }}</div>
                        <small class="text-muted">Scheduled by {{ ucfirst($meeting->created_by_type) }} · {{ $meeting->created_at->format('d M Y') }}</small>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        @if($meeting->meeting_url)
                            <a class="btn btn-sm btn-success" href="{{ $meeting->meeting_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-video me-1"></i>Join meeting</a>
                            <button type="button" class="btn btn-sm btn-outline-success" data-copy-text="{{ $meeting->meeting_url }}"><i class="fa-regular fa-copy me-1"></i>Copy link</button>
                        @else
                            <span class="badge bg-light text-secondary border">Meeting link not added</span>
                        @endif
                    </div>
                </div>
            </article>
        @empty
            <div class="card maseco-meeting-card"><div class="card-body text-center text-muted py-5"><i class="fa-regular fa-calendar fa-2x mb-2"></i><div>No meetings scheduled for this RFQ yet.</div></div></div>
        @endforelse
    </div>
</main>

<script>
document.querySelectorAll('[data-copy-text]').forEach((button) => {
    button.addEventListener('click', async () => {
        const original = button.innerHTML;
        try {
            await navigator.clipboard.writeText(button.dataset.copyText);
            button.innerHTML = '<i class="fa-solid fa-check me-1"></i>Copied';
        } catch (error) {
            const input = document.createElement('textarea');
            input.value = button.dataset.copyText;
            input.style.position = 'fixed'; input.style.opacity = '0';
            document.body.appendChild(input); input.select();
            const copied = document.execCommand('copy'); input.remove();
            button.innerHTML = copied ? '<i class="fa-solid fa-check me-1"></i>Copied' : original;
        }
        window.setTimeout(() => { button.innerHTML = original; }, 1800);
    });
});
</script>

@if($role === 'user')
    @include('user.Include.footer')
@elseif($role === 'supplier')
    @include('seller.Include.footer')
@else
    @include('manufacturer.Include.footer')
@endif
