<?php
$faqFile = __DIR__ . '/faq.json';
$faqData = [];
if (file_exists($faqFile)) {
    $json = file_get_contents($faqFile);
    $faqData = json_decode($json, true);
}

/**
 * Keep FAQ answer safe while allowing minimal inline formatting.
 */
$sanitizeFaqAnswer = static function (string $rawAnswer): string {
    $decoded = htmlspecialchars_decode($rawAnswer, ENT_QUOTES);
    return strip_tags($decoded, '<b><br>');
};

/**
 * Normalize location links from JSON.
 *
 * Expected schema:
 * [
 *   { "href": "...", "label": "...", "cta": "Prowadź do" }
 * ]
 */
$normalizeLocationLinks = static function ($rawLinks): array {
    if (!is_array($rawLinks)) {
        return [];
    }

    $links = [];
    foreach ($rawLinks as $rawLink) {
        if (!is_array($rawLink)) {
            continue;
        }

        $href = trim((string)($rawLink['href'] ?? ''));
        $label = trim((string)($rawLink['label'] ?? ''));
        if ($href === '' || $label === '') {
            continue;
        }

        $cta = trim((string)($rawLink['cta'] ?? 'Prowadź do'));
        if ($cta === '') {
            $cta = 'Prowadź do';
        }

        $links[] = [
            'href' => $href,
            'label' => $label,
            'cta' => $cta,
        ];
    }

    return $links;
};
?>
<section class="faq-section w-full py-8">
    <h2 class="seasons-style questions-text text-2xl font-bold mb-6 text-center">Pytania?</h2>
    <div class="max-w-screen-md mx-auto">
        <?php if (!empty($faqData)): ?>
            <?php foreach ($faqData as $item): ?>
                <div class="faq-item border rounded bg-white/80">
                    <div class="seasons-style faq-question font-semibold text-lg mb-2">
                        <?= htmlspecialchars($item['q']) ?>
                    </div>
                    <div class="century-gothic-style faq-answer text-gray-700">
                        <?php
                        $answer = $sanitizeFaqAnswer((string)($item['a'] ?? ''));
                        echo $answer;

                        $locationLinks = $normalizeLocationLinks($item['links'] ?? null);
                        if (!empty($locationLinks)) {
                            echo '<div class="faq-location-links">';
                            foreach ($locationLinks as $link) {
                                $safeHref = htmlspecialchars($link['href'], ENT_QUOTES);
                                $safeLabel = htmlspecialchars($link['label'], ENT_QUOTES);
                                $safeCta = htmlspecialchars($link['cta'], ENT_QUOTES);
                                echo '<a href="' . $safeHref . '" target="_blank" rel="noopener" class="faq-location-card">';
                                echo '<span class="faq-location-card__pin" aria-hidden="true">📍</span>';
                                echo '<span class="faq-location-card__label">' . $safeLabel . '</span>';
                                echo '<span class="faq-location-card__cta">' . $safeCta . '</span>';
                                echo '</a>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-gray-500">Brak pytań w FAQ.</p>
        <?php endif; ?>
    </div>
</section>
