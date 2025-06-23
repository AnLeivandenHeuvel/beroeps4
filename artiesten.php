<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'db3.php';

// Haal alle artiesten op
$stmt = $db->query("SELECT * FROM artiesten");
$artiesten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artiesten</title>
    <link rel="stylesheet" href="artiesten.css">
</head>
<body>
    <nav>
        <a href="index.php">home</a>
        <a href="informatie.php">informatie</a>
        <a href="artiesten.php">artiesten</a>
        <a href="timetable.php">tijdschema</a>
        <a href="plattegrond.php">plattegrond</a>
        <a href="bestellen.php">bestellen</a>
    </nav>
    <h1>Artiesten</h1>
    <div class="artiesten-grid">
        <?php foreach ($artiesten as $index => $artiest): ?>
            <div class="artiest-card<?= $index > 3 ? ' hidden' : '' ?>">
                <img src="img/<?= htmlspecialchars($artiest['foto']) ?>" alt="<?= htmlspecialchars($artiest['naam']) ?>">
                <div class="artiest-info">
                    <h2><?= htmlspecialchars($artiest['naam']) ?></h2>
                    <p>Genre: <?= htmlspecialchars($artiest['genre']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="view-more" onclick="showAllArtiesten()">VIEW MORE</button>
    <div class="footer">
        &copy; 2025 Goldenvoice
        <div class="footer-icons">
            <img src="img/facebook.png" alt="Facebook">
            <img src="img/tiktok.png" alt="TikTok">
            <img src="img/spotify.png" alt="Spotify">
            <img src="img/youtube.png" alt="YouTube">
        </div>
    </div>
    <script>
    function showAllArtiesten() {
        document.querySelectorAll('.artiest-card.hidden').forEach(card => {
            card.classList.remove('hidden');
        });
        document.querySelector('.view-more').style.display = 'none';
    }
    </script>
</body>
</html> 