document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.notification-btn');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-target');
            const isActive = button.classList.contains('active');

            if (isActive) {
                buttons.forEach(btn => btn.classList.remove('active'));
                showNotification(null);
            } else {
                buttons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                showNotification(targetId);
            }
        });
    });
});

function showNotification(id) {
    const notifications = document.querySelectorAll('.notification-content');
    notifications.forEach(notification => {
        notification.classList.remove('active');
    });
    if (id) {
        const selectedNotification = document.getElementById(id);
        if (selectedNotification) {
            selectedNotification.classList.add('active');
        }
    }
}
