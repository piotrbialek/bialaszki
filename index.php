<?php
$rootDir = __DIR__;
$sectionsDir = $rootDir . '/sections/';
?><!DOCTYPE html>
<html lang="pl">
<?php require_once $rootDir . '/includes/head.php'; ?>
<body class="min-h-screen">
<div class="page-content-shell">
<?php require_once $sectionsDir . 'upper.php'; ?>
<?php require_once $sectionsDir . 'info_popup.php'; ?>

<div class="information w-full max-w-screen-md mx-auto flex flex-col items-center justify-center space-y-8 py-8 main-bg">
    <h2 class="text-3xl font-extrabold text-center text-primary sm:text-4xl mb-8 seasons-style">BiaŁaszki biorą ślub!</h2>
    <div class="seasons-style text-center">
        Przed nami wyjątkowy dzień, w którym nie może Was zabraknąć! <br>Marzymy, byście byli z nami! <br>
        Chcemy wspólnie z Wami rozpocząć nowy rozdział naszej wspólnej historii. <br>
        Do zobaczenia na parkiecie! <br>Szczegóły znajdziecie poniżej. ❤️
    </div>
    <?php require_once $sectionsDir . 'confirm.php'; ?>
    <?php require_once $sectionsDir . 'photos.php'; ?>
    <?php require_once $sectionsDir . 'faq.php'; ?>
    <?php require_once $sectionsDir . 'guests_photos.php'; ?>
    <!-- <?php //require_once $sectionsDir . 'countdown_view.php'; ?> -->
</div>
<?php require_once $sectionsDir . 'video_bg.php'; ?>
<?php require_once $sectionsDir . 'footer.php'; ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.3.9/jquery.mb.YTPlayer.min.js"></script>
<script src="assets/js/video_bg_script.js"></script>
</body>
<link rel="stylesheet" href="assets/css/video_bg_style.css">
</html>
