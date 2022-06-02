<!doctype html>



<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>S'inscrire</title>
</head>

<body>
<h1>Inscription</h1>
<div>
    <form action="signup.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button type="submit" name="submit" style="width: 100%">S'inscrire</button>
    </form>
</div>
</body>

</html>


<?php

if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])) {
    include __DIR__ . '/dbconfig.php';
    $sql = "SELECT * from users where email ='" . $_POST['email'] . "';";
    $query = $db->query($sql);
    $result = $query->fetchArray();

    if (is_array($result)) {
        echo 'Email déjà utilisé...';
    } else {
        $sql = "INSERT INTO users (email, password) VALUES ('" . $_POST['email'] . "', '" . password_hash($_POST["password"], PASSWORD_DEFAULT) . "')";
        $db->exec($sql);
        header('location: index.php');
    }
}
?>
