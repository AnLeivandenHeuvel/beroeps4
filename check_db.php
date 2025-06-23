<?php
require 'db3.php';

echo "<h2>Podia</h2>";
foreach ($db->query("SELECT * FROM podia") as $row) {
    echo "ID: {$row['id']} | Naam: {$row['naam']}<br>";
}

echo "<h2>Optredens</h2>";
foreach ($db->query("SELECT * FROM optreden") as $row) {
    echo "ID: {$row['id']} | Artiest ID: {$row['artiest_id']} | Podium ID: {$row['podium_id']} | Begin: {$row['begin_tijd']} | Eind: {$row['eind_tijd']}<br>";
}
?> 