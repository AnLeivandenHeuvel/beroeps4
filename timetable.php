<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'db3.php';

// Week 1 en week 2 dagen
$week1_dagen = [
    '2026-04-10', // vrijdag
    '2026-04-11', // zaterdag
    '2026-04-12', // zondag
];
$week2_dagen = [
    '2026-04-17', // vrijdag
    '2026-04-18', // zaterdag
    '2026-04-19', // zondag
];

// Haal alle podia op
$podia = [];
$stmt = $db->query("SELECT id, naam FROM podia ORDER BY id");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $podia[$row['id']] = $row['naam'];
}

function get_optredens_per_dag($db, $dag) {
    $sql = "SELECT o.*, a.naam AS artiest_naam, a.genre, p.naam AS podium_naam
            FROM optreden o
            JOIN artiesten a ON o.artiest_id = a.id
            JOIN podia p ON o.podium_id = p.id
            WHERE date(o.begin_tijd) = ?
            ORDER BY o.begin_tijd, o.podium_id";
    $stmt = $db->prepare($sql);
    $stmt->execute([$dag]);
    $optredens = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $tijdslot = date('H:i', strtotime($row['begin_tijd'])) . ' – ' . date('H:i', strtotime($row['eind_tijd']));
        $row['tijdslot'] = $tijdslot;
        $optredens[] = $row;
    }
    return $optredens;
}

function get_tijdslots($optredens) {
    $tijdslots = [];
    foreach ($optredens as $optreden) {
        if (!in_array($optreden['tijdslot'], $tijdslots)) {
            $tijdslots[] = $optreden['tijdslot'];
        }
    }
    return $tijdslots;
}

// Haal optredens van week 1 één keer op (voor week 2 hergebruik)
$optredens_week1 = [];
foreach ($week1_dagen as $dag) {
    $optredens_week1[$dag] = get_optredens_per_dag($db, $dag);
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Tijdschema</title>
    <style>
        body {
            background: linear-gradient(180deg, #ffe08a 0%, #b6cfae 30%, #7ec8c9 50%, #e48c8c 100%);
            font-family: Arial, sans-serif;
        }
        .timetable-grid {
            display: grid;
            grid-template-columns: 100px repeat(<?php echo count($podia); ?>, 1fr);
            grid-auto-rows: 50px;
            gap: 2px;
            background: #b6cfae;
            border-radius: 16px;
            margin: 40px auto;
            width: 90%;
            max-width: 1200px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .timetable-header {
            background: #ffb6c1;
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
            font-size: 1.1em;
        }
        .timetable-time {
            background: #fffbe6;
            text-align: right;
            padding: 10px;
            font-weight: bold;
        }
        .timetable-act {
            background: #ffe08a;
            border-radius: 8px;
            text-align: center;
            font-size: 1em;
            padding: 6px 2px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        .timetable-act.pop { background: #ffe08a; }
        .timetable-act.hiphop { background: #b6cfae; }
        .timetable-act.electronic { background: #7ec8c9; }
        .timetable-act.rock { background: #e48c8c; }
        .timetable-act.other { background: #f3e6ff; }
        .timetable-title {
            text-align: center;
            font-size: 2em;
            margin-top: 40px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .timetable-date {
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .timetable-week2 {
            text-align: center;
            font-size: 1.5em;
            margin: 50px 0 30px 0;
            font-weight: bold;
            background: #fffbe6;
            border: 2px dashed #7ec8c9;
            border-radius: 12px;
            padding: 18px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .footer {
            background: #f48c8c;
            padding: 30px 0 10px 0;
            text-align: center;
            margin-top: 60px;
        }
        .footer-icons {
            margin-top: 10px;
        }
        .footer-icons img {
            width: 36px;
            margin: 0 8px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <nav style="background: #ffe08a; padding: 20px 0 10px 0; text-align: center;">
        <a href="index.php" style="margin: 0 30px; text-decoration: none; color: #222; font-size: 1.3em; font-weight: 500;">home</a>
        <a href="informatie.php" style="margin: 0 30px; text-decoration: none; color: #222; font-size: 1.3em; font-weight: 500;">informatie</a>
        <a href="artiesten.php" style="margin: 0 30px; text-decoration: none; color: #222; font-size: 1.3em; font-weight: 500;">artiesten</a>
        <a href="timetable.php" style="margin: 0 30px; text-decoration: none; color: #222; font-size: 1.3em; font-weight: 500;">tijdschema</a>
        <a href="plattegrond.php" style="margin: 0 30px; text-decoration: none; color: #222; font-size: 1.3em; font-weight: 500;">plattegrond</a>
        <a href="bestellen.html" style="margin: 0 30px; text-decoration: none; color: #222; font-size: 1.3em; font-weight: 500;">bestellen</a>
    </nav>
    <h1 class="timetable-title">Tijdschema</h1>
    <div class="timetable-date">
        Hieronder vind je het tijdschema van Coachella.<br>
        1: vrijdag 10 t/m zondag 12 april 2026<br>
        2: vrijdag 17 t/m zondag 19 april 2026
    </div>

    <!-- Week 1 timetable -->
    <div class="timetable-title" style="font-size:1.5em; margin-top:30px; margin-bottom:0;">Week 1: vrijdag 10 t/m zondag 12 april 2026</div>
    <?php foreach ($week1_dagen as $i => $dag): ?>
        <div class="timetable-title" style="font-size:1.2em; margin-top:20px; margin-bottom:0;"> <?= date('l d-m-Y', strtotime($dag)) ?> </div>
        <?php
        $optredens = $optredens_week1[$dag];
        $tijdslots = get_tijdslots($optredens);
        ?>
        <div class="timetable-grid">
            <div class="timetable-header"></div>
            <?php foreach ($podia as $podium): ?>
                <div class="timetable-header"><?= htmlspecialchars($podium) ?></div>
            <?php endforeach; ?>
            <?php foreach ($tijdslots as $tijdslot): ?>
                <div class="timetable-time"><?= $tijdslot ?></div>
                <?php foreach ($podia as $podium_id => $podium_naam): ?>
                    <?php
                    $act = '';
                    foreach ($optredens as $optreden) {
                        if ($optreden['tijdslot'] === $tijdslot && $optreden['podium_id'] == $podium_id) {
                            $genre = strtolower($optreden['genre']);
                            $genre_class = 'other';
                            if (strpos($genre, 'pop') !== false) $genre_class = 'pop';
                            if (strpos($genre, 'hip-hop') !== false || strpos($genre, 'hiphop') !== false) $genre_class = 'hiphop';
                            if (strpos($genre, 'electro') !== false || strpos($genre, 'electronic') !== false) $genre_class = 'electronic';
                            if (strpos($genre, 'rock') !== false) $genre_class = 'rock';
                            $act = "<div class='timetable-act $genre_class'><strong>" . htmlspecialchars($optreden['artiest_naam']) . "</strong><br><span style='font-size:0.9em;'>" . htmlspecialchars($optreden['genre']) . "</span></div>";
                        }
                    }
                    echo $act ?: "<div></div>";
                    ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <!-- Week 2 timetable -->
    <div class="timetable-title" style="font-size:1.5em; margin-top:50px; margin-bottom:0;">Week 2: vrijdag 17 t/m zondag 19 april 2026</div>
    <?php foreach ($week2_dagen as $i => $dag): ?>
        <div class="timetable-title" style="font-size:1.2em; margin-top:20px; margin-bottom:0;"> <?= date('l d-m-Y', strtotime($dag)) ?> </div>
        <?php
        // Gebruik optredens van week 1 voor dezelfde dag van de week
        $optredens = $optredens_week1[$week1_dagen[$i]];
        $tijdslots = get_tijdslots($optredens);
        ?>
        <div class="timetable-grid">
            <div class="timetable-header"></div>
            <?php foreach ($podia as $podium): ?>
                <div class="timetable-header"><?= htmlspecialchars($podium) ?></div>
            <?php endforeach; ?>
            <?php foreach ($tijdslots as $tijdslot): ?>
                <div class="timetable-time"><?= $tijdslot ?></div>
                <?php foreach ($podia as $podium_id => $podium_naam): ?>
                    <?php
                    $act = '';
                    foreach ($optredens as $optreden) {
                        if ($optreden['tijdslot'] === $tijdslot && $optreden['podium_id'] == $podium_id) {
                            $genre = strtolower($optreden['genre']);
                            $genre_class = 'other';
                            if (strpos($genre, 'pop') !== false) $genre_class = 'pop';
                            if (strpos($genre, 'hip-hop') !== false || strpos($genre, 'hiphop') !== false) $genre_class = 'hiphop';
                            if (strpos($genre, 'electro') !== false || strpos($genre, 'electronic') !== false) $genre_class = 'electronic';
                            if (strpos($genre, 'rock') !== false) $genre_class = 'rock';
                            $act = "<div class='timetable-act $genre_class'><strong>" . htmlspecialchars($optreden['artiest_naam']) . "</strong><br><span style='font-size:0.9em;'>" . htmlspecialchars($optreden['genre']) . "</span></div>";
                        }
                    }
                    echo $act ?: "<div></div>";
                    ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    <div class="footer">
        &copy; 2025 Goldenvoice
        <div class="footer-icons">
            <img src="img/facebook.png" alt="Facebook">
            <img src="img/tiktok.png" alt="TikTok">
            <img src="img/spotify.png" alt="Spotify">
            <img src="img/youtube.png" alt="YouTube">
        </div>
    </div>
</body>
</html> 