<?php
$faqFile = __DIR__ . '/faq.json';
$faqData = [];
if (file_exists($faqFile)) {
    $json = file_get_contents($faqFile);
    $faqData = json_decode($json, true);
}
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
                        $answer = $item['a'] ?? '';
                        // Dekoduj encje HTML i przepuść <a>, <b>, <br>
                        $answer = htmlspecialchars_decode($answer, ENT_QUOTES);
                        $answer = strip_tags($answer, '<a><b><br>');
                        echo $answer;
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-gray-500">Brak pytań w FAQ.</p>
        <?php endif; ?>
    </div>
</section>
