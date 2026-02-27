(function () {
    var COOKIE_PREFIX = 'info_popup_seen_';
    var STORAGE_PREFIX = 'info_popup_seen_';
    var COOKIE_MAX_AGE = 60 * 60 * 24 * 365;

    function getCookie(name) {
        var prefix = name + '=';
        var cookies = document.cookie ? document.cookie.split(';') : [];

        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.indexOf(prefix) === 0) {
                return decodeURIComponent(cookie.substring(prefix.length));
            }
        }

        return null;
    }

    function setCookie(name, value, maxAge) {
        document.cookie = name + '=' + encodeURIComponent(value) + '; path=/; max-age=' + maxAge + '; SameSite=Lax';
    }

    function getCookieKey(popupId) {
        return COOKIE_PREFIX + popupId;
    }

    function getStorageKey(popupId) {
        return STORAGE_PREFIX + popupId;
    }

    function hasSeenPopup(popupId) {
        var cookieKey = getCookieKey(popupId);
        if (getCookie(cookieKey) === '1') {
            return true;
        }

        try {
            return window.localStorage.getItem(getStorageKey(popupId)) === '1';
        } catch (error) {
            return false;
        }
    }

    function rememberPopup(popupId) {
        setCookie(getCookieKey(popupId), '1', COOKIE_MAX_AGE);

        try {
            window.localStorage.setItem(getStorageKey(popupId), '1');
        } catch (error) {
            // Ignore localStorage errors (private mode / blocked storage).
        }
    }

    function getPopupId(popup) {
        return popup.getAttribute('data-popup-id') || '';
    }

    function showPopup(popup, onClose) {
        var closeButton = popup.querySelector('.js-once-popup-close');
        var card = popup.querySelector('.info-popup-card');
        if (!closeButton) {
            onClose();
            return;
        }

        popup.hidden = false;
        document.body.classList.add('info-popup-open');
        if (card) {
            card.focus();
        } else {
            closeButton.focus();
        }

        closeButton.addEventListener('click', function () {
            popup.hidden = true;
            onClose();
        }, { once: true });
    }

    function initPopup() {
        var popups = Array.prototype.slice.call(document.querySelectorAll('.js-once-popup[data-popup-id]'));
        if (!popups.length) {
            return;
        }

        var unseenPopups = popups.filter(function (popup) {
            var popupId = getPopupId(popup);
            if (!popupId) {
                return false;
            }
            return !hasSeenPopup(popupId);
        });

        if (!unseenPopups.length) {
            return;
        }

        var currentIndex = 0;

        function openNextPopup() {
            if (currentIndex >= unseenPopups.length) {
                document.body.classList.remove('info-popup-open');
                return;
            }

            var popup = unseenPopups[currentIndex];
            var popupId = getPopupId(popup);

            showPopup(popup, function () {
                rememberPopup(popupId);
                currentIndex += 1;
                openNextPopup();
            });
        }

        openNextPopup();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPopup);
    } else {
        initPopup();
    }
})();
