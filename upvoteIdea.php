<?php
session_start();

include __DIR__ . '/dbconfig.php';

$sql = "Select * from likes where idUser = '" . $_SESSION['idUser'] . "' and idIdea =  '" . $_GET['id'] . "'  ";
$query = $db->query($sql);

if ($query) {
    echo "<script>alert('Vous avez déjà voté pour cette idée !')</script>";
    header('location: index.php');

} else {
    $sql = "INSERT INTO likes (idUser, idIdea, vote) VALUES ('" . $_SESSION['idUser'] . "', '" . $_GET['id'] . "',  '1')";
    $query = $db->query($sql);
    header('location: index.php');

}


