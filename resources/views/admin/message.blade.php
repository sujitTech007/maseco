
@include('admin.Include.header')

<div class="page-content">
    <div class="page-container container-fluid py-3">

        {{-- Page Header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div>
                <h4 class="fw-bold mb-1">Messages</h4>
                <p class="text-muted mb-0">
                    Manage conversations with buyers, sellers and manufacturers.
                </p>
            </div>

            <span class="badge bg-primary rounded-pill p-2">
                <i class="fa-solid fa-comments me-1"></i> Admin Chat
            </span>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="row g-0">

                {{-- Conversation List --}}
                <div class="col-lg-4 col-xl-3 border-end">

                    <div class="p-3 border-bottom">
                        <h5 class="fw-bold mb-3">Conversations</h5>

                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fa-solid fa-search"></i>
                            </span>
                            <input type="text"
                                   id="searchConversation"
                                   class="form-control"
                                   placeholder="Search conversations...">
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <button class="btn btn-primary btn-sm rounded-pill chat-filter"
                                    data-filter="all" type="button">
                                All
                            </button>
                            <button class="btn btn-outline-secondary btn-sm rounded-pill chat-filter"
                                    data-filter="unread" type="button">
                                Unread
                            </button>
                        </div>
                    </div>

                    <div id="conversationList" class="list-group list-group-flush">

                        <button type="button"
                                class="list-group-item list-group-item-action active conversation"
                                data-name="Rahul Sharma"
                                data-role="Buyer"
                                data-initials="RS"
                                data-email="rahul@example.com"
                                data-chat="rahul"
                                data-unread="1"
                                data-preview="I need an update on my order.">

                            <div class="d-flex align-items-center gap-3">
                                <span class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                      style="width:45px;height:45px;">RS</span>

                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex justify-content-between gap-2">
                                        <strong>Rahul Sharma</strong>
                                        <small>10:30 AM</small>
                                    </div>
                                    <small class="d-block">Buyer</small>
                                    <small class="d-block text-truncate">
                                        I need an update on my order.
                                    </small>
                                </div>

                                <span class="badge bg-danger unread-badge">1</span>
                            </div>
                        </button>

                        <button type="button"
                                class="list-group-item list-group-item-action conversation"
                                data-name="Priya Verma"
                                data-role="Seller"
                                data-initials="PV"
                                data-email="priya@example.com"
                                data-chat="priya"
                                data-unread="0"
                                data-preview="The payment has been confirmed.">

                            <div class="d-flex align-items-center gap-3">
                                <span class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                      style="width:45px;height:45px;">PV</span>

                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex justify-content-between gap-2">
                                        <strong>Priya Verma</strong>
                                        <small class="text-muted">Yesterday</small>
                                    </div>
                                    <small class="text-muted d-block">Seller</small>
                                    <small class="text-muted d-block text-truncate">
                                        The payment has been confirmed.
                                    </small>
                                </div>
                            </div>
                        </button>

                        <button type="button"
                                class="list-group-item list-group-item-action conversation"
                                data-name="Amit Industries"
                                data-role="Manufacturer"
                                data-initials="AI"
                                data-email="amit@example.com"
                                data-chat="amit"
                                data-unread="1"
                                data-preview="Please review the product details.">

                            <div class="d-flex align-items-center gap-3">
                                <span class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                      style="width:45px;height:45px;">AI</span>

                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex justify-content-between gap-2">
                                        <strong>Amit Industries</strong>
                                        <small class="text-muted">Yesterday</small>
                                    </div>
                                    <small class="text-muted d-block">Manufacturer</small>
                                    <small class="text-muted d-block text-truncate">
                                        Please review the product details.
                                    </small>
                                </div>

                                <span class="badge bg-danger unread-badge">1</span>
                            </div>
                        </button>

                        <div id="noConversations"
                             class="text-center text-muted p-4 d-none">
                            No conversations found.
                        </div>
                    </div>
                </div>

                {{-- Chat Section --}}
                <div class="col-lg-8 col-xl-9">

                    <div class="d-flex flex-column">

                        {{-- Chat Header --}}
                        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                <span id="activeInitials"
                                      class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                                      style="width:45px;height:45px;">RS</span>

                                <div>
                                    <h6 id="activeName" class="fw-bold mb-1">
                                        Rahul Sharma
                                    </h6>
                                    <small id="activeRole" class="text-muted">
                                        Buyer
                                    </small>
                                </div>
                            </div>

                            <a id="emailUser"
                               href="mailto:rahul@example.com"
                               class="btn btn-outline-primary btn-sm"
                               title="Email user">
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
                                     style="max-width:75%;">
                                    Hello Admin, could you please provide an update on my order?
                                    <small class="text-muted d-block text-end mt-2">10:25 AM</small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mb-3">
                                <div class="bg-primary text-white rounded-3 p-3 shadow-sm"
                                     style="max-width:75%;">
                                    Hello Rahul, thanks for reaching out. I'll check the order status for you.
                                    <small class="text-white-50 d-block text-end mt-2">10:28 AM</small>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="bg-white border rounded-3 p-3 shadow-sm"
                                     style="max-width:75%;">
                                    I need an update on my order.
                                    <small class="text-muted d-block text-end mt-2">10:30 AM</small>
                                </div>
                            </div>
                        </div>

                        {{-- Message Input --}}
                        <form id="chatForm" class="p-3 border-top">
                            @csrf

                            <div class="input-group">
                                <textarea id="messageInput"
                                          class="form-control"
                                          rows="1"
                                          maxlength="2000"
                                          placeholder="Type your message..."
                                          aria-label="Type your message"
                                          required></textarea>

                                <button type="submit" class="btn btn-primary px-3">
                                    <i class="fa-solid fa-paper-plane me-1"></i>
                                    Send
                                </button>
                            </div>

                            <small id="chatNotice" class="text-muted d-block mt-2">
                                Press Enter to send. Shift + Enter for a new line.
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
    const conversations = document.querySelectorAll('.conversation');
    const search = document.getElementById('searchConversation');
    const messageArea = document.getElementById('messageArea');
    const messageInput = document.getElementById('messageInput');
    const chatForm = document.getElementById('chatForm');
    const chatNotice = document.getElementById('chatNotice');

    let activeChat = 'rahul';
    let activeFilter = 'all';

    // Sample messages for UI demonstration.
    const messages = {
        rahul: [
            { type: 'received', text: 'Hello Admin, could you please provide an update on my order?', time: '10:25 AM' },
            { type: 'sent', text: "Hello Rahul, thanks for reaching out. I'll check the order status for you.", time: '10:28 AM' },
            { type: 'received', text: 'I need an update on my order.', time: '10:30 AM' }
        ],
        priya: [
            { type: 'received', text: 'Hello Admin, the payment has been confirmed.', time: 'Yesterday' },
            { type: 'sent', text: 'Thank you for the update, Priya.', time: 'Yesterday' }
        ],
        amit: [
            { type: 'received', text: 'Please review the product details.', time: 'Yesterday' },
            { type: 'sent', text: 'Thanks. I will review the details and get back to you.', time: 'Yesterday' }
        ]
    };

    function escapeHtml(text) {
        const element = document.createElement('div');
        element.textContent = text;
        return element.innerHTML;
    }

    function renderMessages() {
        const currentMessages = messages[activeChat] || [];

        messageArea.innerHTML =
            '<div class="text-center mb-4"><span class="badge bg-secondary-subtle text-secondary rounded-pill">Conversation</span></div>';

        currentMessages.forEach(function (message) {
            const row = document.createElement('div');
            row.className = 'd-flex mb-3 ' +
                (message.type === 'sent' ? 'justify-content-end' : '');

            const bubble = document.createElement('div');
            bubble.className = message.type === 'sent'
                ? 'bg-primary text-white rounded-3 p-3 shadow-sm'
                : 'bg-white border rounded-3 p-3 shadow-sm';

            bubble.style.maxWidth = '75%';
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
        const term = search.value.toLowerCase().trim();
        let visibleCount = 0;

        conversations.forEach(function (item) {
            const text = (
                item.dataset.name + ' ' +
                item.dataset.role + ' ' +
                item.dataset.preview
            ).toLowerCase();

            const matchesSearch = text.includes(term);
            const matchesFilter =
                activeFilter === 'all' || item.dataset.unread === '1';

            const visible = matchesSearch && matchesFilter;
            item.classList.toggle('d-none', !visible);

            if (visible) visibleCount++;
        });

        document.getElementById('noConversations')
            .classList.toggle('d-none', visibleCount > 0);
    }

    conversations.forEach(function (item) {
        item.addEventListener('click', function () {
            conversations.forEach(function (conversation) {
                conversation.classList.remove('active');
            });

            item.classList.add('active');
            activeChat = item.dataset.chat;

            document.getElementById('activeName').textContent = item.dataset.name;
            document.getElementById('activeRole').textContent = item.dataset.role;
            document.getElementById('activeInitials').textContent = item.dataset.initials;
            document.getElementById('emailUser').href = 'mailto:' + item.dataset.email;

            item.dataset.unread = '0';
            const unreadBadge = item.querySelector('.unread-badge');
            if (unreadBadge) unreadBadge.remove();

            chatNotice.textContent = '';
            renderMessages();
            filterConversations();
        });
    });

    search.addEventListener('input', filterConversations);

    document.querySelectorAll('.chat-filter').forEach(function (button) {
        button.addEventListener('click', function () {
            activeFilter = button.dataset.filter;

            document.querySelectorAll('.chat-filter').forEach(function (filter) {
                filter.classList.remove('btn-primary');
                filter.classList.add('btn-outline-secondary');
            });

            button.classList.remove('btn-outline-secondary');
            button.classList.add('btn-primary');

            filterConversations();
        });
    });

    function sendMessage() {
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

        const activeItem = Array.from(conversations).find(function (item) {
            return item.dataset.chat === activeChat;
        });

        if (activeItem) {
            activeItem.dataset.preview = text;
            const preview = activeItem.querySelector('.text-truncate');
            if (preview) preview.textContent = text;
        }

        messageInput.value = '';
        chatNotice.textContent = 'Demo message added locally; it has not been sent to a real user.';
        renderMessages();
    }

    chatForm.addEventListener('submit', function (event) {
        event.preventDefault();
        sendMessage();
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

@include('admin.Include.footer')
