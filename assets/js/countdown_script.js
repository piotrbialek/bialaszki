const targetDate = '2026-06-04';
const weddingTime = '13:30:00';

function getTimeZoneOffsetMs(date, timeZone) {
    const dtf = new Intl.DateTimeFormat('en-US', {
        timeZone,
        hour12: false,
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    const parts = dtf.formatToParts(date);
    const map = {};
    parts.forEach((part) => {
        if (part.type !== 'literal') {
            map[part.type] = part.value;
        }
    });
    const asUtc = Date.UTC(
        Number(map.year),
        Number(map.month) - 1,
        Number(map.day),
        Number(map.hour),
        Number(map.minute),
        Number(map.second)
    );
    return asUtc - date.getTime();
}

function parseWarsawDateTime(dateString, timeString) {
    const [year, month, day] = dateString.split('-').map(Number);
    const [hour, minute, second] = timeString.split(':').map(Number);
    const naiveUtc = Date.UTC(year, month - 1, day, hour, minute, second);
    const offsetMs = getTimeZoneOffsetMs(new Date(naiveUtc), 'Europe/Warsaw');
    return new Date(naiveUtc - offsetMs);
}

const targetDateTime = parseWarsawDateTime(targetDate, weddingTime);

const countdownEl = document.getElementById('countdown');

function updateCountdown() {
    const diff = targetDateTime.getTime() - Date.now();

    if (diff <= 0) {
        countdownEl.textContent = "👰❤️🤵‍";
        return;
    }

    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
    const minutes = Math.floor((diff / (1000 * 60)) % 60);
    const seconds = Math.floor((diff / 1000) % 60);

    const units = [];

    units.push('<span class="countdown-number">👰</span>')
    if (days > 0) {
        units.push('<span class="countdown-number">' + days + '</span><span class="countdown-label">dni</span>');
    }
    if (hours > 0) {
        units.push('<span class="countdown-number">' + hours.toString().padStart(2, '0') + '</span><span class="countdown-label">godzin</span>');
    }
    if (minutes > 0) {
        units.push('<span class="countdown-number">' + minutes.toString().padStart(2, '0') + '</span><span class="countdown-label">minut</span>');
    }

    units.push('<span class="countdown-number">' + seconds.toString().padStart(2, '0') + '</span><span class="countdown-label">sekund</span>');
    units.push('<span class="countdown-number">🤵</span>');

    countdownEl.innerHTML = units.join(' ');


}

updateCountdown();
setInterval(updateCountdown, 1000);
