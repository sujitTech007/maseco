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
                const conversationsByEnquiry = new Map(conversations.map(function (conversation) {
                    return [String(conversation.enquiry_id), conversation];
                }));

                links.forEach(function (link) {
                    const badge = link.querySelector('[data-chat-unread-count]');
                    const count = Number(data.unread_count || 0);
                    if (badge) {
                        badge.textContent = count > 99 ? '99+' : String(count);
                        badge.hidden = count === 0;
                    }
                    link.title = 'Open chats';
                    link.setAttribute('aria-label', count > 0
                        ? 'Open chats. ' + count + ' unread messages.'
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
                    link.title = 'Open chat';
                    link.setAttribute('aria-label', count > 0
                        ? 'Open chat. ' + count + ' unread messages.'
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
