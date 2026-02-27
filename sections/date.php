<?php
require_once __DIR__ . '/../GoogleCalendarEvent.php';
require_once __DIR__ . '/../AppleCalendarEvent.php';

// Parametry wydarzenia
$title = "BiaŁaszki biorą ślub! 👰🤵‍♂️"; // TODO: emotikonki jak się da
$description = "Wiktoria Łach i Piotr Białek serdecznie zapraszają na uroczystość zaślubin oraz przyjęcie weselne.

👰🤵‍♂️ ŚLUB 💍⛪ 
Bazylika Matki Bożej Pokornej w Rudach,
Rzymskokatolicka Parafia Wniebowzięcia NMP
ul. Cysterska 1,
47-430 Rudy
            
🥂🍾 WESELE 💃🕺
Rudy Las,
ul. Szkolna 8,
47-430 Rudy";


$location = "Bazylika Matki Bożej Pokornej w Rudach, Rzymskokatolicka Parafia Wniebowzięcia NMP ul. Cysterska 1, 47-430 Rudy";
$startDateTime = "2026-06-04 13:30:00";
$endDateTime = "2026-06-05 05:00:00";
$timezone = "Europe/Warsaw";

$googleEvent = new \GoogleCalendarEvent();
$appleEvent = new \AppleCalendarEvent();

$googleCalendarLink = $googleEvent->createGoogleCalendarLink(
    $title,
    $description,
    $location,
    $startDateTime,
    $endDateTime,
    $timezone
);

$appleCalendarLink = $appleEvent->createAppleCalendarLink(
    $title,
    $description,
    $location,
    $startDateTime,
    $endDateTime,
    $timezone
);

?>

<div id="date">
    <div class="container">
        <div class="mt-8 text-center">

<!--            TODO: super gdyby ikonki miały wewnątrz faktycznie datę 4 VI-->
            <div id="calendar-icons" class="mt-4 flex justify-center gap-4">
                <span class="calendar-tooltip">
                    <a href="<?php echo $googleCalendarLink ?>" target="_blank">
                        <img src="/assets/images/google_calendar_icon2.png" alt="Google Calendar Icon" class="calendar-icon">
                    </a>
                    <span class="tooltip-text">Zapisz w Kalendarzu Google</span>
                </span>
                <span class="paris-script-style click-text">Kliknij i zapisz w kalendarzu!</span>
                <span class="calendar-tooltip">
                    <a href="<?php echo $appleCalendarLink; ?>" download="event.ics">
                        <img src="/assets/images/4czerwcaApple.png" alt="Apple Calendar Icon" class="calendar-icon">
                    </a>
                    <span class="tooltip-text">Zapisz w Kalendarzu Apple</span>
                </span>
            </div>
        </div>
    </div>
</div>
<script>
// Mobile scroll effect for calendar icons
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
</script>
