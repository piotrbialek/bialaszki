<?php
// Dodawaj tutaj kolejne popupy.
// Wazne: kazdy popup musi miec unikalne "id", bo na jego podstawie zapisujemy osobne ciasteczko.
$infoPopups = [
    // Wyłączony popup o potwierdzeniu obecności.
    // [
    //     'id' => 'rsvp-reminder-2026-02',
    //     'title' => 'Kochani ❤️',
    //     'message' => "Pamiętajcie by potwierdzić swoją obecność!\nNapiszcie do nas jeżeli potrzebujecie noclegu.",
    //     'button' => 'Wszystko jasne!',
    // ],
    [
        'id' => 'preparty-reminder-2026-04',
        'title' => 'Zapraszamy na koronę! 🎉',
        'message' => "Zgodnie z tradycją koronę wije się przed ślubem.\nZapraszamy 30 maja 2026 (sobota) \ndo Łaz na ulicę Folwarczną 1 \n Dokładny adres i pinezka na dole strony!",
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
