import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebarCloseBtn = document.getElementById('sidebar-close-btn');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    function closeSidebar() {
        if (sidebar) {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
        }
        if (sidebarOverlay) {
            sidebarOverlay.classList.add('opacity-0');
            sidebarOverlay.classList.add('pointer-events-none');
        }
    }

    function openSidebar() {
        if (sidebar) {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
        }
        if (sidebarOverlay) {
            sidebarOverlay.classList.remove('opacity-0');
            sidebarOverlay.classList.remove('pointer-events-none');
        }
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            if (sidebar.classList.contains('-translate-x-full')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });
    }

    if (sidebarCloseBtn) {
        sidebarCloseBtn.addEventListener('click', closeSidebar);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }
});
