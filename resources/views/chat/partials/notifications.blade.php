<script>
document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('[data-chat-notifications]');
    const enquiryLinks = document.querySelectorAll('[data-chat-enquiry]');
    if (!links.length && !enquiryLinks.length) return;

    const endpoint = @json(route('chat.unread'));
    const refreshUnreadChats = function () {
        fetch(endpoint, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' })
            .then(function (response) {
                if (!response.ok) throw new Error('Unable to load unread messages');
                return response.json();
            })
            .then(function (data) {
                const conversations = Array.isArray(data.conversations) ? data.conversations : [];
                const names = [...new Set(conversations.map(function (conversation) { return conversation.sender_name; }))];
                const conversationsByEnquiry = new Map(conversations.map(function (conversation) {
                    return [String(conversation.enquiry_id), conversation];
                }));
                const senderMessage = names.length === 0 ? '' : (names.length === 1
                    ? 'New from ' + names[0]
                    : 'New from ' + names[0] + ' +' + (names.length - 1));

                links.forEach(function (link) {
                    const badge = link.querySelector('[data-chat-unread-count]');
                    const sender = link.querySelector('[data-chat-unread-sender]')
                        || link.parentElement.querySelector('[data-chat-unread-sender]');
                    const count = Number(data.unread_count || 0);
                    if (badge) {
                        badge.textContent = count > 99 ? '99+' : String(count);
                        badge.hidden = count === 0;
                    }
                    if (sender) {
                        sender.textContent = senderMessage;
                        sender.hidden = !senderMessage;
                    }
                    link.title = senderMessage || 'Open chats';
                    link.setAttribute('aria-label', count > 0
                        ? 'Open chats. ' + count + ' unread messages. ' + senderMessage
                        : 'Open chats');
                });

                enquiryLinks.forEach(function (link) {
                    const conversation = conversationsByEnquiry.get(String(link.dataset.chatEnquiry));
                    const count = conversation ? Number(conversation.unread_count || 0) : 0;
                    const badge = link.querySelector('[data-chat-unread-count]');
                    if (badge) {
                        badge.textContent = count > 99 ? '99+' : String(count);
                        badge.hidden = count === 0;
                    }
                    const sender = link.parentElement.querySelector('[data-chat-unread-sender]');
                    if (sender) {
                        sender.textContent = conversation ? 'New from ' + conversation.sender_name : '';
                        sender.hidden = !conversation;
                    }
                    const notice = conversation
                        ? 'New message from ' + conversation.sender_name + ' in this chat'
                        : 'Open chat';
                    link.title = notice;
                    link.setAttribute('aria-label', count > 0
                        ? 'Open chat. ' + count + ' unread messages. ' + notice
                        : 'Open chat');
                });
            })
            .catch(function () { /* Keep the dashboard usable if notifications are temporarily unavailable. */ });
    };

    refreshUnreadChats();
    window.setInterval(function () {
        if (!document.hidden) refreshUnreadChats();
    }, 7000);
    document.addEventListener('visibilitychange', function () {
        if (!document.hidden) refreshUnreadChats();
    });
});
</script>
