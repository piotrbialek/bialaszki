<?php
$popupId = isset($popupId) ? trim((string)$popupId) : '';
if ($popupId === '') {
    return;
}

$popupTitle = isset($popupTitle) ? (string)$popupTitle : '';
$popupMessage = isset($popupMessage) ? (string)$popupMessage : '';
$popupButtonText = isset($popupButtonText) ? (string)$popupButtonText : 'Rozumiem';

$safeId = preg_replace('/[^a-zA-Z0-9_-]/', '', $popupId);
$titleId = 'info-popup-title-' . $safeId;
$messageId = 'info-popup-message-' . $safeId;
?>

<div
        class="info-popup-overlay js-once-popup"
        data-popup-id="<?= htmlspecialchars($popupId, ENT_QUOTES, 'UTF-8') ?>"
        role="dialog"
        aria-modal="true"
        aria-labelledby="<?= htmlspecialchars($titleId, ENT_QUOTES, 'UTF-8') ?>"
        aria-describedby="<?= htmlspecialchars($messageId, ENT_QUOTES, 'UTF-8') ?>"
        hidden
>
    <div class="info-popup-card" tabindex="-1">
        <h2 id="<?= htmlspecialchars($titleId, ENT_QUOTES, 'UTF-8') ?>" class="info-popup-title seasons-style main-color">
            <?= htmlspecialchars($popupTitle, ENT_QUOTES, 'UTF-8') ?>
        </h2>
        <p id="<?= htmlspecialchars($messageId, ENT_QUOTES, 'UTF-8') ?>" class="info-popup-message century-gothic-style main-color">
            <?= nl2br(htmlspecialchars($popupMessage, ENT_QUOTES, 'UTF-8')) ?>
        </p>
        <button type="button" class="info-popup-button century-gothic-style js-once-popup-close">
            <?= htmlspecialchars($popupButtonText, ENT_QUOTES, 'UTF-8') ?>
        </button>
    </div>
</div>
