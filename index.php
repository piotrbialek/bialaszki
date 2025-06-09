<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>bialaszki</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        #countdown {
            font-size: 3em;
            font-weight: bold;
            color: #333;
            background: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
    </style>
</head>
<body>
<div id="countdown"></div>
<script>
    const targetDate = new Date('2026-06-04T00:00:00');
    const countdownEl = document.getElementById('countdown');

    function updateCountdown() {
        const now = new Date();
        const diff = targetDate - now;

        if (diff <= 0) {
            countdownEl.textContent = "The date has arrived!";
            return;
        }

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((diff / (1000 * 60)) % 60);
        const seconds = Math.floor((diff / 1000) % 60);

        countdownEl.innerHTML =
            days + " dni<br>" +
            hours.toString().padStart(2, '0') + " godzin<br>" +
            minutes.toString().padStart(2, '0') + " minut<br>" +
            seconds.toString().padStart(2, '0') + " sekund";
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
</script>
</body>
</html>