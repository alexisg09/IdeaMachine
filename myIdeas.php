<!DOCTYPE html>
<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Idea Machine</title>
</head>
<body>
<?php
if (isset($_SESSION['email'])) {
    echo "
        <a href='/logout.php'>Se déconnecter</a>
        <a href='/createIdea.php'>Créer une nouvelle idée</a>
        <a href='/index.php'>Accueil</a>
    ";

} else {
    header('location: index.php');
}
?>

<table>
    <thead>
    <th>Titre</th>
    <th>Description</th>
    <th>Image</th>
    <th>Date</th>
    </thead>
    <tbody>
    <?php
    include __DIR__ . '/dbconfig.php';

    $sql = "SELECT rowid, * FROM ideas where idUser ='" . $_SESSION['idUser'] . "';";
    $query = $db->query($sql);

    while ($row = $query->fetchArray()) {
        echo "
					<tr>
						<td>" . $row['title'] . "</td>
						<td>" . $row['description'] . "</td>
						<td> <img src='" . $row['image'] . "' style='width: 20%'/></td>
						<td>" . $row['date'] . "</td>
					<td>
							<a href='editIdea.php?id=" . $row['rowid'] . "'>Edit</a>
							<a href='deleteIdea.php?id=" . $row['rowid'] . "'>Delete</a>
						</td>
					</tr>
				";
    }
    ?>
    </tbody>
</table>
</body>
</html>
