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
        <a href='/myIdeas.php'>Mes idées</a>
    ";

} else {
    echo "
    <a href='/login.php'>Se connecter</a>
    <a href='/signup.php'>S'inscrire</a>
    ";
}
?>

<?php

if (isset($_SESSION['email'])) {
    echo "
        <h1>Bienvenue " . $_SESSION['email'] . "</h1>

    ";

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

    $sql = "SELECT rowid,  * FROM ideas";
    $query = $db->query($sql);



    while ($row = $query->fetchArray()) {
        $sqlLike = "Select count from likes where idIdea = '" . $row['rowid'] . "'";
        $queryLike = $db->query($sql);
        $rowLike = $queryLike->fetchArray();
        echo "
					<tr>
						<td>" . $row['title'] . "</td>
						<td>" . $row['description'] . "</td>
						<td> <img src='" . $row['image'] . "' style='width: 20%'/></td>
						<td>" . $row['date'] . "</td>
						
						<td>
							<a href='upvoteIdea.php?id=" . $row['rowid'] . "'>+1</a>
							<a href='downvoteIdea.php?id=" . $row['rowid'] . "'>-1</a>
						</td>
					</tr>
				";
    }
    ?>
    </tbody>
</table>
</body>
</html>
