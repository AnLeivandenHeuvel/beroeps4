<?php
require 'db3.php';

$optredens = [
// Vrijdag
[1, '2026-04-10 13:00', '2026-04-10 13:45', 1, 1, 1],   // Taylor Swift, Main Stage
[2, '2026-04-10 13:50', '2026-04-10 14:35', 1, 2, 1],   // Travis Scott, Main Stage
[3, '2026-04-10 14:40', '2026-04-10 15:25', 2, 3, 1],   // Dua Lipa, Sahara tent
[4, '2026-04-10 14:40', '2026-04-10 15:25', 5, 5, 1],   // Olivia Rodrigo, Outdoor theatre
[5, '2026-04-10 15:30', '2026-04-10 16:15', 2, 4, 1],   // Bad Bunny, Sahara tent
[6, '2026-04-10 15:30', '2026-04-10 16:15', 3, 50, 1],  // Fred again.., Yuma tent
[7, '2026-04-10 16:20', '2026-04-10 17:05', 4, 7, 1],   // SZA, Mojave stage
[8, '2026-04-10 17:10', '2026-04-10 17:55', 1, 8, 1],   // Billie Eilish, Main Stage
[9, '2026-04-10 18:00', '2026-04-10 18:45', 1, 9, 1],   // Tyler, The Creator, Main Stage
[10, '2026-04-10 18:50', '2026-04-10 19:35', 2, 10, 1], // RAYE, Sahara tent
[11, '2026-04-10 18:50', '2026-04-10 19:35', 5, 11, 1], // Peso Pluma, Outdoor theatre
[12, '2026-04-10 19:40', '2026-04-10 20:25', 3, 12, 1], // Kaytranada, Yuma tent
[13, '2026-04-10 20:30', '2026-04-10 21:15', 1, 13, 1], // Jung Kook, Main Stage
[14, '2026-04-10 21:20', '2026-04-10 22:05', 2, 14, 1], // Rema, Sahara tent
[15, '2026-04-10 22:10', '2026-04-10 22:55', 4, 15, 1], // Ice Spice, Mojave stage
[16, '2026-04-10 23:00', '2026-04-10 23:45', 5, 16, 1], // Zach Bryan, Outdoor theatre
[17, '2026-04-11 00:40', '2026-04-11 01:25', 3, 17, 1], // Tyla, Yuma tent
// Zaterdag
[18, '2026-04-11 13:00', '2026-04-11 13:45', 3, 18, 1], // Skrillex, Yuma tent
[19, '2026-04-11 13:00', '2026-04-11 13:45', 5, 23, 1], // Paramore, Outdoor theatre
[20, '2026-04-11 13:50', '2026-04-11 14:35', 3, 19, 1], // Bicep, Yuma tent
[21, '2026-04-11 13:50', '2026-04-11 14:35', 4, 25, 1], // Phoebe Bridgers, Mojave stage
[22, '2026-04-11 14:40', '2026-04-11 15:25', 2, 20, 1], // Rosalía, Sahara tent
[23, '2026-04-11 14:40', '2026-04-11 15:25', 5, 27, 1], // Jungle, Outdoor theatre
[24, '2026-04-11 15:30', '2026-04-11 16:15', 1, 21, 1], // Doja Cat, Main Stage
[25, '2026-04-11 16:20', '2026-04-11 17:05', 1, 22, 1], // The Weeknd, Main Stage
[26, '2026-04-11 17:10', '2026-04-11 17:55', 2, 26, 1], // Karol G, Sahara tent
[27, '2026-04-11 17:10', '2026-04-11 17:55', 3, 28, 1], // Arca, Yuma tent
[28, '2026-04-11 18:00', '2026-04-11 18:45', 1, 24, 1], // Calvin Harris, Main Stage
[29, '2026-04-11 18:50', '2026-04-11 19:35', 5, 29, 1], // Dominic Fike, Outdoor theatre
[30, '2026-04-11 19:40', '2026-04-11 20:25', 2, 30, 1], // Tame Impala, Sahara tent
[31, '2026-04-11 20:30', '2026-04-11 21:15', 4, 31, 1], // Grimes, Mojave stage
[32, '2026-04-11 21:20', '2026-04-11 22:05', 3, 32, 1], // Peggy Gou, Yuma tent
[33, '2026-04-11 22:10', '2026-04-11 22:55', 1, 33, 1], // The 1975, Main Stage
[34, '2026-04-11 23:00', '2026-04-11 23:45', 4, 34, 1], // Charli XCX, Mojave stage
// Zondag
[35, '2026-04-12 13:00', '2026-04-12 13:45', 1, 37, 1], // Lil Nas X, Main Stage
[36, '2026-04-12 13:50', '2026-04-12 14:35', 4, 41, 1], // Steve Lacy, Mojave stage
[37, '2026-04-12 14:40', '2026-04-12 15:25', 1, 42, 1], // Megan Thee Stallion, Main Stage
[38, '2026-04-12 14:40', '2026-04-12 15:25', 5, 46, 1], // Laufey, Outdoor theatre
[39, '2026-04-12 15:30', '2026-04-12 16:15', 3, 45, 1], // Jamie xx, Yuma tent
[40, '2026-04-12 16:20', '2026-04-12 17:05', 2, 47, 1], // FKA twigs, Sahara tent
[41, '2026-04-12 17:10', '2026-04-12 17:55', 3, 48, 1], // Girl in Red, Yuma tent
[42, '2026-04-12 18:00', '2026-04-12 18:45', 2, 49, 1], // Becky G, Sahara tent
[43, '2026-04-12 18:50', '2026-04-12 19:35', 5, 39, 1], // PinkPantheress, Outdoor theatre
[44, '2026-04-12 19:40', '2026-04-12 20:25', 1, 6, 1],  // Trisha Paytas, Main Stage
[45, '2026-04-12 20:30', '2026-04-12 21:15', 3, 35, 1], // Black Coffee, Yuma tent
[46, '2026-04-12 21:20', '2026-04-12 22:05', 1, 36, 1], // Burna Boy, Main Stage
[47, '2026-04-12 22:10', '2026-04-12 22:55', 2, 38, 1], // Sampha, Sahara tent
[48, '2026-04-12 23:00', '2026-04-12 23:45', 4, 40, 1], // Caroline Polachek, Mojave stage
[49, '2026-04-12 23:50', '2026-04-12 00:35', 5, 43, 1], // Yves Tumor, Outdoor theatre
[50, '2026-04-13 01:30', '2026-04-13 02:15', 1, 44, 1], // The Strokes, Main Stage
];

$stmt = $db->prepare("INSERT OR IGNORE INTO optreden (id, begin_tijd, eind_tijd, podium_id, artiest_id, festival_id) VALUES (?, ?, ?, ?, ?, ?)");
$count = 0;
foreach ($optredens as $optreden) {
    if ($stmt->execute($optreden)) {
        $count++;
    }
}
echo "$count optredens toegevoegd aan database.db."; 