<!doctype html>
<?php
session_start();

?>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Créer une nouvelle idée</title>
</head>

<body>
<h1>Créer une nouvelle idée</h1>
<div>
    <form method="post" enctype="multipart/form-data">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title">
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
        <label for="file">Image</label>
        <input type="file" name="attachment" id="attachment">


        <button type="submit" name="submit" style="width: 100%">Créer</button>
    </form>
</div>
</body>

</html>


<?php

if (isset($_POST['submit'])) {
    $tmp_name = $_FILES["attachment"]["tmp_name"];

    if (is_uploaded_file($tmp_name)) {
        $trueName = $_FILES["attachment"]["name"];
        $name = $_SESSION['idUser'] . '_' . $trueName;
        move_uploaded_file($tmp_name, "./uploadedFiles/" . $name);
    }
    $pathFileToShow = "uploadedFiles/" . $trueName;
    $location = "uploadedFiles/" . $name;

    include __DIR__ . '/dbconfig.php';
    $sql = "INSERT INTO ideas (idUser, title, description, image) VALUES ('" . $_SESSION['idUser'] . "', '" . $_POST['title'] . "',  '" . $_POST['description'] . "',  '" . $location . "')";
    $query = $db->query($sql);

    header('location: index.php');

}
?>
