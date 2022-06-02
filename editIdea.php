<!doctype html>
<?php
session_start();
include __DIR__ . '/dbconfig.php';
include_once 'getIdea.php';


$result = getIdea($_GET['id']);

?>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Modifier une idée</title>
</head>

<body>
<h1>Modifier une idée <?php echo $_GET['id']; ?></h1>
<div>
    <form action="editIdea.php" method="post" enctype="multipart/form-data">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" value="<?php echo $result['title']; ?>">
        <label for="description">Description</label>
        <input type="description" name="description" id="description" value="<?php echo $result['description']; ?>">
        <img src="<?php echo $result['image']; ?>">
        <label for="file">Image</label>
        <input type="file" name="attachment" id="attachment" value="<?php echo $result['image']; ?>">

        <button type="submit" name="submit" style="width: 100%">Modifier</button>
    </form>
</div>
</body>

</html>


<?php

if (isset($_POST['submit'])) {
    include __DIR__ . '/dbconfig.php';

    $tmp_name = $_FILES["attachment"]["tmp_name"];

    if (is_uploaded_file($tmp_name)) {
        $trueName = $_FILES["attachment"]["name"];
        $name = $_SESSION['idUser'] . '_' . $trueName;
        $location = "uploadedFiles/" . $name;
        move_uploaded_file($tmp_name, "./uploadedFiles/" . $name);
    }

    $idUser = $_SESSION['idUser'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $idIdea = $_GET['id'];

    $sql = "UPDATE ideas SET title ='" . $title . "', description = '" . $description . "', image = '" . $location . "'  where rowid = '" . intval($idIdea) . "';";
    $db->exec($sql);

    header("Location: myIdeas.php");
}
?>
