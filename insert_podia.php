<?php
require 'db3.php';
$podia = [
    [1, 'Main Stage', 'Centraal veld'],
    [2, 'Sahara tent', 'Oostzijde'],
    [3, 'Yuma tent', 'Zuidzijde'],
    [4, 'Mojave stage', 'Noordveld'],
    [5, 'Outdoor theatre', 'Westzijde'],
];
$stmt = $db->prepare("INSERT OR IGNORE INTO podia (id, naam, locatie) VALUES (?, ?, ?)");
foreach ($podia as $podium) {
    $stmt->execute($podium);
}
echo "Podia toegevoegd!";
?> 