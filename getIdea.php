<?php

function getIdea($id) {
    include __DIR__ . '/dbconfig.php';

    $sql = "SELECT rowid, * from ideas where rowid ='" . $id . "';";
    $query = $db->query($sql);
    $result = $query->fetchArray();
    return $result;
}
