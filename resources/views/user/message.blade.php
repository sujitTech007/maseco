
@include('user.Include.header')

<div class="page-content">
    <div class="container py-3">

        {{-- Page Heading --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
               <h1 class="fw-bold mb-1 dashboard_title">Messages</h1>
                <p class="text-muted mb-0">
                    Chat with suppliers, sellers and the Maseco support team.
                </p>
            </div>

            <span class="badge bg-success rounded-pill p-2">
                <i class="fa-solid fa-comments me-1"></i> My Messages
            </span>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="row g-0">

                {{-- Conversation List --}}
                <div class="col-12 col-lg-4 col-xl-3 border-end">

                    <div class="p-3 border-bottom">
                        <h5 class="fw-bold mb-3">Conversations</h5>

                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fa-solid fa-search"></i>
                            </span>
                            <input type="search"
                                   id="conversationSearch"
                                   class="form-control"
                                   placeholder="Search conversations...">
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <button type="button"
                                    class="btn btn-success btn-sm rounded-pill chat-filter"
                                    data-filter="all">
                                All
                            </button>
                            <button type="button"
                                    class="btn btn-outline-success btn-sm rounded-pill chat-filter"
                                    data-filter="unread">
                                Unread
                            </button>
                        </div>
                    </div>

                    <div id="conversationList" class="list-group list-group-flush">

                        {{-- Conversation 1 --}}
                        <button type="button"
                                class="list-group-item list-group-item-action active conversation"
                                data-chat="supplier"
                                data-name="Green Earth Supplies"
                                data-role="Supplier"
                                data-initials="GE"
                                data-color="success"
                                data-email="supplier@example.com"
                                data-preview="Your material quotation is ready."
                                data-unread="1">

                            <div class="d-flex align-items-center gap-3">
                                <span class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                      style="width:45px;height:45px;">GE</span>

                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex justify-content-between gap-2">
                                        <strong>Green Earth Supplies</strong>
                                        <small>10:30 AM</small>
                                    </div>
                                    <small class="d-block">Supplier</small>
                                    <small class="d-block text-truncate">
                                        Your material quotation is ready.
                                    </small>
                                </div>

                                <span class="badge bg-danger unread-badge">1</span>
                            </div>
                        </button>

                        {{-- Conversation 2 --}}
                        <button type="button"
                                class="list-group-item list-group-item-action conversation"
                                data-chat="manufacturer"
                                data-name="Eco Manufacturing"
                                data-role="Manufacturer"
                                data-initials="EM"
                                data-color="primary"
                                data-email="manufacturer@example.com"
                                data-preview="We can fulfil your order."
                                data-unread="0">

                            <div class="d-flex align-items-center gap-3">
                                <span class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                      style="width:45px;height:45px;">EM</span>

                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex justify-content-between gap-2">
                                        <strong>Eco Manufacturing</strong>
                                        <small class="text-muted">Yesterday</small>
                                    </div>
                                    <small class="text-muted d-block">Manufacturer</small>
                                    <small class="text-muted d-block text-truncate">
                                        We can fulfil your order.
                                    </small>
                                </div>
                            </div>
                        </button>

                        {{-- Conversation 3 --}}
                        <button type="button"
                                class="list-group-item list-group-item-action conversation"
                                data-chat="support"
                                data-name="Maseco Support"
                                data-role="Support Team"
                                data-initials="MS"
                                data-color="warning"
                                data-email="connect@maseco.ca"
                                data-preview="How can we help you today?"
                                data-unread="0">

                            <div class="d-flex align-items-center gap-3">
                                <span class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                      style="width:45px;height:45px;">MS</span>

                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex justify-content-between gap-2">
                                        <strong>Maseco Support</strong>
                                        <small class="text-muted">Yesterday</small>
                                    </div>
                                    <small class="text-muted d-block">Support Team</small>
                                    <small class="text-muted d-block text-truncate">
                                        How can we help you today?
                                    </small>
                                </div>
                            </div>
                        </button>

                        <div id="noConversations"
                             class="text-center text-muted p-4 d-none">
                            No conversations found.
                        </div>
                    </div>
                </div>

                {{-- Chat Window --}}
                <div class="col-12 col-lg-8 col-xl-9">

                    <div class="d-flex flex-column">

                        {{-- Chat Header --}}
                        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                <span id="activeInitials"
                                      class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                      style="width:45px;height:45px;">GE</span>

                                <div>
                                    <h6 id="activeName" class="fw-bold mb-1">
                                        Green Earth Supplies
                                    </h6>
                                    <small id="activeRole" class="text-muted">
                                        Supplier
                                    </small>
                                </div>
                            </div>

                            <a id="emailUser"
                               href="mailto:supplier@example.com"
                               class="btn btn-outline-success btn-sm"
                               title="Email contact">
                                <i class="fa-solid fa-envelope"></i>
                            </a>
                        </div>

                        {{-- Messages --}}
                        <div id="messageArea"
                             class="bg-light p-3 p-md-4 overflow-auto"
                             style="height:420px;">

                            <div class="text-center mb-4">
                                <span class="badge bg-secondary-subtle text-secondary rounded-pill">
                                    Today
                                </span>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="bg-white border rounded-3 p-3 shadow-sm"
                                     style="max-width:80%;">
                                    Hello! We have received your enquiry about sustainable materials.
                                    <small class="text-muted d-block text-end mt-2">10:25 AM</small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mb-3">
                                <div class="bg-success text-white rounded-3 p-3 shadow-sm"
                                     style="max-width:80%;">
                                    Thank you. Could you please share the quotation?
                                    <small class="text-white-50 d-block text-end mt-2">10:28 AM</small>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="bg-white border rounded-3 p-3 shadow-sm"
                                     style="max-width:80%;">
                                    Your material quotation is ready.
                                    <small class="text-muted d-block text-end mt-2">10:30 AM</small>
                                </div>
                            </div>
                        </div>

                        {{-- Message Composer --}}
                        <form id="chatForm" class="p-3 border-top">
                            @csrf

                            <div class="input-group">
                                <textarea id="messageInput"
                                          class="form-control"
                                          rows="1"
                                          maxlength="2000"
                                          placeholder="Write your message..."
                                          aria-label="Write your message"
                                          required></textarea>

                                <button type="submit" class="btn btn-success px-3">
                                    <i class="fa-solid fa-paper-plane me-1"></i>
                                    Send
                                </button>
                            </div>

                            <small id="chatNotice" class="text-muted d-block mt-2">
                                Press Enter to send. Use Shift + Enter for a new line.
                            </small>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const conversationItems = document.querySelectorAll('.conversation');
    const searchInput = document.getElementById('conversationSearch');
    const messageArea = document.getElementById('messageArea');
    const messageInput = document.getElementById('messageInput');
    const chatForm = document.getElementById('chatForm');
    const chatNotice = document.getElementById('chatNotice');

    let activeChat = 'supplier';
    let activeFilter = 'all';

    // Demo messages only. Replace with messages from your database.
    const messages = {
        supplier: [
            {
                type: 'received',
                text: 'Hello! We have received your enquiry about sustainable materials.',
                time: '10:25 AM'
            },
            {
                type: 'sent',
                text: 'Thank you. Could you please share the quotation?',
                time: '10:28 AM'
            },
            {
                type: 'received',
                text: 'Your material quotation is ready.',
                time: '10:30 AM'
            }
        ],

        manufacturer: [
            {
                type: 'received',
                text: 'Hello! We can fulfil your order.',
                time: 'Yesterday'
            },
            {
                type: 'sent',
                text: 'Thank you. Please share the expected delivery date.',
                time: 'Yesterday'
            }
        ],

        support: [
            {
                type: 'received',
                text: 'Welcome to Maseco Support. How can we help you today?',
                time: 'Yesterday'
            }
        ]
    };

    function renderMessages() {
        messageArea.replaceChildren();

        const dateLabel = document.createElement('div');
        dateLabel.className = 'text-center mb-4';

        const badge = document.createElement('span');
        badge.className = 'badge bg-secondary-subtle text-secondary rounded-pill';
        badge.textContent = 'Conversation';

        dateLabel.appendChild(badge);
        messageArea.appendChild(dateLabel);

        (messages[activeChat] || []).forEach(function (message) {
            const row = document.createElement('div');

            row.className = 'd-flex mb-3' +
                (message.type === 'sent' ? ' justify-content-end' : '');

            const bubble = document.createElement('div');

            bubble.className = message.type === 'sent'
                ? 'bg-success text-white rounded-3 p-3 shadow-sm'
                : 'bg-white border rounded-3 p-3 shadow-sm';

            bubble.style.maxWidth = '80%';
            bubble.style.whiteSpace = 'pre-wrap';
            bubble.style.overflowWrap = 'anywhere';

            bubble.appendChild(document.createTextNode(message.text));

            const time = document.createElement('small');

            time.className = message.type === 'sent'
                ? 'text-white-50 d-block text-end mt-2'
                : 'text-muted d-block text-end mt-2';

            time.textContent = message.time;

            bubble.appendChild(time);
            row.appendChild(bubble);
            messageArea.appendChild(row);
        });

        messageArea.scrollTop = messageArea.scrollHeight;
    }

    function filterConversations() {
        const term = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        conversationItems.forEach(function (item) {
            const searchableText = [
                item.dataset.name,
                item.dataset.role,
                item.dataset.preview
            ].join(' ').toLowerCase();

            const matchesSearch = searchableText.includes(term);

            const matchesFilter =
                activeFilter === 'all' || item.dataset.unread === '1';

            const visible = matchesSearch && matchesFilter;

            item.classList.toggle('d-none', !visible);

            if (visible) visibleCount++;
        });

        document.getElementById('noConversations')
            .classList.toggle('d-none', visibleCount > 0);
    }

    conversationItems.forEach(function (item) {
        item.addEventListener('click', function () {
            conversationItems.forEach(function (conversation) {
                conversation.classList.remove('active');
            });

            item.classList.add('active');
            activeChat = item.dataset.chat;

            document.getElementById('activeName').textContent =
                item.dataset.name;

            document.getElementById('activeRole').textContent =
                item.dataset.role;

            const avatar = document.getElementById('activeInitials');

            avatar.textContent = item.dataset.initials;
            avatar.className =
                'rounded-circle text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0 bg-' +
                item.dataset.color;

            if (item.dataset.color === 'warning') {
                avatar.classList.remove('text-white');
                avatar.classList.add('text-dark');
            }

            document.getElementById('emailUser').href =
                'mailto:' + item.dataset.email;

            item.dataset.unread = '0';

            const unreadBadge = item.querySelector('.unread-badge');
            if (unreadBadge) unreadBadge.remove();

            chatNotice.textContent = '';
            renderMessages();
            filterConversations();
        });
    });

    searchInput.addEventListener('input', filterConversations);

    document.querySelectorAll('.chat-filter').forEach(function (button) {
        button.addEventListener('click', function () {
            activeFilter = button.dataset.filter;

            document.querySelectorAll('.chat-filter').forEach(function (filter) {
                filter.classList.remove('btn-success');
                filter.classList.add('btn-outline-success');
            });

            button.classList.remove('btn-outline-success');
            button.classList.add('btn-success');

            filterConversations();
        });
    });

    chatForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const text = messageInput.value.trim();
        if (!text) return;

        messages[activeChat].push({
            type: 'sent',
            text: text,
            time: new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            })
        });

        const activeItem = Array.from(conversationItems).find(function (item) {
            return item.dataset.chat === activeChat;
        });

        if (activeItem) {
            activeItem.dataset.preview = text;

            const preview = activeItem.querySelector('.text-truncate');
            if (preview) preview.textContent = text;
        }

        messageInput.value = '';
        chatNotice.textContent =
            'Demo message added locally. It has not been sent to a real user.';

        renderMessages();
    });

    messageInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            chatForm.requestSubmit();
        }
    });

    filterConversations();
    renderMessages();
});
</script>

@include('user.Include.footer')
