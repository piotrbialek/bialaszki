(function() {
    const iconsContainer = document.getElementById('calendar-icons');
    if (!iconsContainer) return;
    function scaleIcons(scale) {
        iconsContainer.querySelectorAll('.calendar-icon').forEach(icon => {
            if (scale) {
                icon.classList.add('calendar-icon-scaled');
            } else {
                icon.classList.remove('calendar-icon-scaled');
            }
        });
    }
    let ticking = false;
    window.addEventListener('scroll', function() {
        if (window.innerWidth > 768) return;
        if (!ticking) {
            window.requestAnimationFrame(function() {
                scaleIcons(true);
                clearTimeout(window._calendarIconTimeout);
                window._calendarIconTimeout = setTimeout(() => scaleIcons(false), 350);
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
})();
