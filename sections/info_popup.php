<?php
// Dodawaj tutaj kolejne popupy.
// Wazne: kazdy popup musi miec unikalne "id", bo na jego podstawie zapisujemy osobne ciasteczko.
$infoPopups = [
    [
        'id' => 'rsvp-reminder-2026-02',
        'title' => 'Kochani ❤️',
        'message' => "Pamiętajcie by potwierdzić swoją obecność!\nNapiszcie do nas jeżeli potrzebujecie noclegu.",
        'button' => 'Wszystko jasne!',
    ],
];

foreach ($infoPopups as $popup) {
    $popupId = $popup['id'] ?? '';
    $popupTitle = $popup['title'] ?? '';
    $popupMessage = $popup['message'] ?? '';
    $popupButtonText = $popup['button'] ?? 'Rozumiem';
    include __DIR__ . '/components/once_popup.php';
}
