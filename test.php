<?php
require 'db.php';

try {
    $result = $db->query("SELECT name FROM sqlite_master WHERE type='table'");
    if ($result) {
        echo "Database connectie gelukt!<br>";
        echo "Tabellen in de database:<br>";
        foreach ($result as $row) {
            echo htmlspecialchars($row['name']) . "<br>";
        }
    } else {
        echo "Connectie gelukt, maar geen tabellen gevonden.";
    }
} catch (PDOException $e) {
    echo "Fout bij het uitvoeren van de query: " . $e->getMessage();
}
?>