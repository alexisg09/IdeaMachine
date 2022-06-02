<?php

$db = new SQLite3('users.db');

$query = "CREATE TABLE IF NOT EXISTS users ( email STRING, password STRING)";
$db->exec($query);

$query = "CREATE TABLE IF NOT EXISTS ideas (idUser INT ,title STRING, description STRING, image STRING, date DATETIME DEFAULT CURRENT_TIMESTAMP)";
$db->exec($query);

$query = "CREATE TABLE IF NOT EXISTS likes ( idUser INT, idIdea INT, vote INT)";
$db->exec($query);

?>
