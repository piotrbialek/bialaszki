(function () {
    const mobileMaxWidth = 768;
    const scaleClass = 'mobile-scroll-scaled';
    const iconScaleClass = 'calendar-icon-scaled';
    const resetDelayMs = 350;

    let ticking = false;
    let resetTimerId = null;
    let linkTargets = [];
    let rsvpTargets = [];
    let calendarIconTargets = [];

    function collectTargets() {
        linkTargets = Array.from(document.querySelectorAll('a')).filter((anchor) => {
            const isMapOverlay = anchor.classList.contains('link-overlay');
            const wrapsCalendarIcon = Boolean(anchor.querySelector('.calendar-icon'));
            const insideRsvpCard = Boolean(anchor.closest('.rsvp-left, .rsvp-right'));
            return !isMapOverlay && !wrapsCalendarIcon && !insideRsvpCard;
        });

        rsvpTargets = Array.from(document.querySelectorAll('.rsvp-left, .rsvp-right'));
        calendarIconTargets = Array.from(document.querySelectorAll('.calendar-icon'));
    }

    function toggleScale(shouldScale) {
        const method = shouldScale ? 'add' : 'remove';

        linkTargets.forEach((target) => target.classList[method](scaleClass));
        rsvpTargets.forEach((target) => target.classList[method](scaleClass));
        calendarIconTargets.forEach((icon) => icon.classList[method](iconScaleClass));
    }

    function resetScale() {
        toggleScale(false);
    }

    function onScroll() {
        if (window.innerWidth > mobileMaxWidth) {
            return;
        }

        if (ticking) {
            return;
        }

        ticking = true;
        window.requestAnimationFrame(function () {
            toggleScale(true);
            clearTimeout(resetTimerId);
            resetTimerId = window.setTimeout(resetScale, resetDelayMs);
            ticking = false;
        });
    }

    function onResize() {
        if (window.innerWidth <= mobileMaxWidth) {
            return;
        }

        clearTimeout(resetTimerId);
        resetScale();
    }

    document.addEventListener('DOMContentLoaded', function () {
        collectTargets();

        if (!linkTargets.length && !rsvpTargets.length && !calendarIconTargets.length) {
            return;
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onResize, { passive: true });
    });
})();
