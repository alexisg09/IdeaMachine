<!doctype html>
<?php
session_start();
?>


<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Se Connecter</title>
</head>
<body>
<h1>Connexion</h1>
<div>
    <form action="login.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button type="submit" style="width: 100%">Se connecter</button>
    </form>
    <a href="signup.php">Ou s'inscrire</a>

</div>
</body>
</html>


<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    include __DIR__ . '/dbconfig.php';
    $sql = "SELECT rowid, * from users where email ='" . $_POST['email'] . "';";
    var_dump($sql);
    $query = $db->query($sql);
    $result = $query->fetchArray();
    if (is_array($result)) {
        if (password_verify($_POST['password'], $result['password'])) {
            echo 'Mot de passe correct';
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['idUser'] = $result['rowid'];
            header('location: index.php');
        }
    } else {
        echo 'Email ou mot de passe incorrect';
    }
}
?>


