// assets/notification.js
document.addEventListener('DOMContentLoaded', () => {
    console.log('✅ Notification script loaded!');

    const notificationBtn = document.getElementById('notification-btn');
    const notificationModal = document.getElementById('notification-modal');
    const notificationList = document.getElementById('notification-list');
    const notificationCount = document.getElementById('notification-count');

    if (!notificationBtn || !notificationModal) {
        console.error('❌ Notification elements not found!');
        return;
    }

    // Load notifications when page loads
    loadNotifications();

    // Toggle modal visibility
    notificationBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        notificationModal.style.display = notificationModal.style.display === 'block' ? 'none' : 'block';
    });

    // Close modal when clicking outside
    document.addEventListener('click', (event) => {
        if (!notificationBtn.contains(event.target) && !notificationModal.contains(event.target)) {
            notificationModal.style.display = 'none';
        }
    });

    // Function to load notifications
    async function loadNotifications() {
        try {
            const response = await fetch('/events/upcoming');
            if (!response.ok) throw new Error('Network response was not ok');
            
            const events = await response.json();
            updateNotificationUI(events);
        } catch (error) {
            console.error('Error loading notifications:', error);
        }
    }

    // Update UI with notifications
    function updateNotificationUI(events) {
        if (events.length === 0) {
            notificationList.innerHTML = '<div class="notification-item">No upcoming events</div>';
            notificationCount.textContent = '0';
            return;
        }

        notificationCount.textContent = events.length.toString();
        notificationList.innerHTML = '';

        events.forEach(event => {
            const eventDate = new Date(event.date);
            const formattedDate = eventDate.toLocaleDateString('en-US', { 
                weekday: 'short', 
                month: 'short', 
                day: 'numeric' 
            });

            const notificationItem = document.createElement('div');
            notificationItem.className = 'notification-item';
            notificationItem.innerHTML = `
                <div class="notification-title">${event.name}</div>
                <div class="notification-date">${formattedDate} • ${event.location || 'No location'}</div>
                <a href="/event/${event.id}" class="notification-link">View Details</a>
            `;
            
            notificationList.appendChild(notificationItem);
        });
    }
});