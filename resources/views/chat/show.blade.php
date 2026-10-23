@if($role === 'user')
    @include('user.Include.header')
@elseif($role === 'supplier')
    @include('seller.Include.header')
@else
    @include('manufacturer.Include.header')
@endif

<style>
    .maseco-chat-page { padding: 34px 0 52px; background: #f7f9f8; min-height: 65vh; }
    .maseco-chat-page > .container { max-width: 1040px; }
    .maseco-chat-page h3 { color: #173c32; letter-spacing: -.035em; font-size: 1.65rem; }
    .maseco-chat-page .text-muted { color: #75847f !important; }
    .maseco-chat-page > .container > .d-flex { margin-bottom: 20px !important; }
    .maseco-chat-page > .container > .d-flex .btn { border-radius: 10px; padding: 9px 14px; font-weight: 600; }
    .maseco-chat-shell { background: #fff; border: 1px solid #e6ece8; border-radius: 18px; overflow: hidden; box-shadow: 0 16px 44px rgba(28, 58, 47, .09); }
    .maseco-chat-head { min-height: 82px; padding: 17px 24px; background: #fff; border-bottom: 1px solid #edf1ee; display: flex; justify-content: space-between; align-items: center; gap: 12px; }
    .maseco-chat-head .rounded-circle { width: 48px !important; height: 48px !important; background: #eaf6f0 !important; color: #13834f !important; box-shadow: inset 0 0 0 1px #d7eee2; }
    .maseco-chat-head .fw-bold { color: #203c34; font-size: 1rem; }
    .maseco-chat-head .small { color: #15834f !important; font-size: .78rem; font-weight: 600; }
    .maseco-chat-head .badge { border: 0 !important; background: #f2f6f3 !important; color: #597068 !important; border-radius: 999px; padding: 8px 12px; font-size: .72rem; font-weight: 600; }
    .maseco-chat-messages { height: min(60vh, 590px); min-height: 340px; overflow-y: auto; padding: 28px clamp(16px, 5vw, 56px); background-color: #f5f8f6; background-image: radial-gradient(#dce8e1 0.7px, transparent 0.7px); background-size: 18px 18px; display: flex; flex-direction: column; gap: 14px; scroll-behavior: smooth; }
    .maseco-chat-messages::-webkit-scrollbar { width: 7px; }
    .maseco-chat-messages::-webkit-scrollbar-thumb { background: #cad8d0; border-radius: 8px; }
    .maseco-chat-row { display: flex; justify-content: flex-start; }
    .maseco-chat-row.is-mine { justify-content: flex-end; }
    .maseco-chat-bubble { max-width: min(76%, 590px); padding: 12px 15px 9px; background: #fff; border: 1px solid #e5ece7; border-radius: 5px 16px 16px 16px; color: #263b35; box-shadow: 0 2px 5px rgba(24, 54, 42, .045); white-space: pre-wrap; overflow-wrap: anywhere; line-height: 1.5; }
    .maseco-chat-row.is-mine .maseco-chat-bubble { background: #e4f5eb; border-color: #d4ecdd; border-radius: 16px 5px 16px 16px; }
    .maseco-chat-meta { display: flex; justify-content: space-between; gap: 18px; color: #82918a; font-size: 10px; margin-top: 7px; }
    .maseco-chat-meta span { font-weight: 600; color: #6a8176; }
    .maseco-chat-compose { display: flex; align-items: flex-end; gap: 11px; padding: 15px 18px; border-top: 1px solid #edf1ee; background: #fff; }
    .maseco-chat-compose textarea { resize: none; min-height: 46px; max-height: 120px; border: 1px solid #e2eae5; border-radius: 13px; padding: 11px 14px; background: #f8faf9; box-shadow: none; }
    .maseco-chat-compose textarea:focus { border-color: #83c5a1; background: #fff; box-shadow: 0 0 0 3px rgba(24, 144, 82, .1); }
    .maseco-chat-compose .btn { min-height: 46px; min-width: 48px; border-radius: 13px; background: #16834e; border-color: #16834e; box-shadow: 0 4px 10px rgba(22, 131, 78, .18); }
    .maseco-chat-compose .btn:hover { background: #116c40; border-color: #116c40; }
    #maseco-chat-error:not(:empty) { padding: 0 4px 8px; }
    @media (max-width: 575.98px) {
        .maseco-chat-page { padding: 18px 0 30px; min-height: 60vh; }
        .maseco-chat-page h3 { font-size: 1.4rem; }
        .maseco-chat-page > .container > .d-flex { align-items: flex-start !important; }
        .maseco-chat-page > .container > .d-flex .btn { font-size: .82rem; padding: 8px 10px; }
        .maseco-chat-shell { border-radius: 14px; }
        .maseco-chat-head { min-height: 72px; padding: 13px 14px; }
        .maseco-chat-head .rounded-circle { width: 42px !important; height: 42px !important; }
        .maseco-chat-head .badge { padding: 7px 9px; font-size: .64rem; }
        .maseco-chat-messages { height: 58vh; min-height: 280px; padding: 18px 12px; gap: 11px; }
        .maseco-chat-bubble { max-width: 88%; padding: 10px 12px 8px; }
        .maseco-chat-compose { gap: 8px; padding: 10px; }
        .maseco-chat-compose .btn { padding: 0 14px !important; }
    }
</style>

<div class="page-content maseco-chat-page">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h3 class="fw-bold mb-1">Chat</h3>
                <div class="text-muted">{{ $enquiry->material?->name ?? $enquiry->subject }} · Enquiry #{{ $enquiry->id }}</div>
            </div>
            <a class="btn btn-outline-success" href="{{ $role === 'user' ? route('user.enquiries') : ($role === 'supplier' ? route('seller.enquiry') : route('manufacturer.enquiry')) }}"><i class="fa-solid fa-arrow-left me-1"></i>Back to enquiries</a>
        </div>

        <div class="maseco-chat-shell" id="maseco-chat" data-messages-url="{{ route('chat.messages', $enquiry->id) }}" data-send-url="{{ route('chat.send', $enquiry->id) }}" data-last-id="{{ $lastMessageId }}" data-sender-type="{{ $role }}" data-sender-id="{{ $participant->id }}">
            <div class="maseco-chat-head">
                <div class="d-flex align-items-center gap-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success" style="width:44px;height:44px"><i class="fa-solid fa-user"></i></span>
                    <div><div class="fw-bold">{{ $otherPartyName }}</div><div class="small text-success"><span class="d-inline-block rounded-circle bg-success me-1" style="width:7px;height:7px"></span>Live chat</div></div>
                </div>
                <span class="badge bg-light text-dark border">{{ ucfirst($role) }} conversation</span>
            </div>

            <div class="maseco-chat-messages" id="maseco-chat-messages" aria-live="polite" aria-label="Conversation messages">
                @forelse($messages as $message)
                    @php $mine = $message->sender_type === $role && (int)$message->sender_id === (int)$participant->id; @endphp
                    <div class="maseco-chat-row {{ $mine ? 'is-mine' : '' }}" data-message-id="{{ $message->id }}">
                        <div class="maseco-chat-bubble">
                            <div>{{ $message->body }}</div>
                            <div class="maseco-chat-meta"><span>{{ $mine ? 'You' : ($message->sender_type === 'user' ? optional($enquiry->user)->name : $otherPartyName) }}</span><time>{{ $message->created_at?->format('d M, g:i A') }}</time></div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted my-auto" id="maseco-chat-empty"><i class="fa-regular fa-comments fa-2x mb-2"></i><p class="mb-0">No messages yet. Send a message to start the conversation.</p></div>
                @endforelse
            </div>

            <div class="px-3 pt-2"><div class="small text-danger" id="maseco-chat-error" role="alert"></div></div>
            <form class="maseco-chat-compose" id="maseco-chat-form">
                @csrf
                <textarea class="form-control" name="body" rows="1" maxlength="5000" placeholder="Type a message..." aria-label="Type a message" required></textarea>
                <button class="btn btn-success px-4" type="submit" aria-label="Send message"><i class="fa-solid fa-paper-plane"></i><span class="d-none d-sm-inline ms-2">Send</span></button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const chat = document.getElementById('maseco-chat');
    if (!chat) return;

    const list = document.getElementById('maseco-chat-messages');
    const form = document.getElementById('maseco-chat-form');
    const input = form.querySelector('textarea[name="body"]');
    const error = document.getElementById('maseco-chat-error');
    const token = form.querySelector('input[name="_token"]').value;
    let lastId = Number(chat.dataset.lastId || 0);
    let polling = false;

    function appendMessage(message) {
        if (list.querySelector('[data-message-id="' + message.id + '"]')) return;
        const mine = message.sender_type === chat.dataset.senderType && String(message.sender_id) === chat.dataset.senderId;
        const row = document.createElement('div');
        row.className = 'maseco-chat-row' + (mine ? ' is-mine' : '');
        row.dataset.messageId = message.id;
        const bubble = document.createElement('div');
        bubble.className = 'maseco-chat-bubble';
        const body = document.createElement('div');
        body.textContent = message.body;
        const meta = document.createElement('div');
        meta.className = 'maseco-chat-meta';
        const sender = document.createElement('span');
        sender.textContent = mine ? 'You' : @json($otherPartyName);
        const time = document.createElement('time');
        const date = new Date(message.created_at);
        time.textContent = date.toLocaleDateString([], {day: '2-digit', month: 'short'}) + ', ' + date.toLocaleTimeString([], {hour: 'numeric', minute: '2-digit'});
        meta.append(sender, time);
        bubble.append(body, meta);
        row.appendChild(bubble);
        document.getElementById('maseco-chat-empty')?.remove();
        list.appendChild(row);
        lastId = Math.max(lastId, Number(message.id));
        list.scrollTop = list.scrollHeight;
    }

    async function pollMessages() {
        if (polling || document.hidden) return;
        polling = true;
        try {
            const response = await fetch(chat.dataset.messagesUrl + '?after=' + lastId, {headers: {'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest'}, credentials: 'same-origin'});
            if (!response.ok) throw new Error('Could not refresh messages. Please reload this page.');
            const data = await response.json();
            data.messages.forEach(appendMessage);
            error.textContent = '';
        } catch (exception) {
            error.textContent = exception.message;
        } finally {
            polling = false;
        }
    }

    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        const body = input.value.trim();
        if (!body) return;
        const button = form.querySelector('button[type="submit"]');
        button.disabled = true;
        error.textContent = '';
        try {
            const response = await fetch(chat.dataset.sendUrl, {
                method: 'POST',
                headers: {'Accept': 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest'},
                credentials: 'same-origin',
                body: JSON.stringify({body: body})
            });
            const data = await response.json();
            if (!response.ok) throw new Error(data.message || Object.values(data.errors || {}).flat()[0] || 'Message could not be sent. Please try again.');
            appendMessage(data.message);
            input.value = '';
            input.focus();
        } catch (exception) {
            error.textContent = exception.message;
        } finally {
            button.disabled = false;
        }
    });

    input.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            form.requestSubmit();
        }
    });

    list.scrollTop = list.scrollHeight;
    window.setInterval(pollMessages, 2000);
});
</script>

@if($role === 'user')
    @include('user.Include.footer')
@elseif($role === 'supplier')
    @include('seller.Include.footer')
@else
    @include('manufacturer.Include.footer')
@endif
