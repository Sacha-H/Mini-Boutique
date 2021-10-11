<?php
session_start();

if (!empty($_SESSION['idUser']) && !empty($_SESSION['pseudo'])){
    header('location:../index.php');
}


$pdo = new PDO(
    'mysql:host=localhost;dbname=pop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);








?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- link -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
    <!--    *** Appel librairie jQuery ***-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body  class="formulaire">
<?php
include('../header/header.php');
?>
    <section>
    
    <?php

    if (!empty($_POST['pseudo']) && !empty($_POST['userPass'])) {

$pseudo = $_POST['pseudo'];

$req = $pdo->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
$req->execute(array(
    ':pseudo' => $pseudo,
));
$resultat = $req->fetch();


$lastName = $resultat['lastName'];
$firstName = $resultat['firstName'];
$address = $resultat['address'];
$postalCode = $resultat['postalCode'];
$city = $resultat['city'];
$pass_hache = password_hash($_POST['userPass'], PASSWORD_DEFAULT);
if ($pseudo != "" && $pass_hache != "") {
    $req1 = $pdo->prepare("
INSERT INTO user(pseudo,userPass,lastName,firstName,address,postalCode,city)
VALUES (:pseudo,:userPass,:lastName,:firstName,:address,:postalCode,:city)
");
    $req1->execute(array(
        ':pseudo' => $pseudo,
        ':userPass' => $pass_hache,
        ':lastName' => $lastName,
        ':firstName' => $firstName,
        ':address' => $address,
        ':postalCode' => $postalCode,
        ':city' => $city



    ));
}
$isPasswordCorrect = password_verify($_POST['userPass'], $resultat['userPass']);

if (!$resultat) {
    echo 'Mauvais identifiant ou mot de passe !';
} else {
    if ($isPasswordCorrect) {
        $_SESSION['idUser'] = $resultat['idUser'];
        $_SESSION['pseudo'] = $pseudo;

        if (!empty($_POST['stay_connect']) && $_POST['stay_connect'] == "ok") {
            setcookie('idUser', $resultat['idUser'], time() + 365 * 24 * 3600, null, null, false, true);
            setcookie('pseudo', $pseudo, time() + 365 * 24 * 3600, null, null, false, true);
        }
        header('location:../index.php');
    } else {
        echo 'Mauvais pseuso ou mot de passe !';
    }
}
} else {
echo "Tous les champs n'ont pas été remplis";
}
?>
    <form action="connexionUser.php" method="POST">
        <label>pseudo :</label><input type="text" name="pseudo">
        <label>pass :</label><input type="password" name="userPass">
        <label>rester connecter <input type="checkbox" name="stay_connect" value="ok"></label>
        <input type="submit" value="se connecter">
    </form>
    <h3><a href="../create/createUsers.php">inscrivez-vous</a></h3>
    </section>

   


    <?php
include "../footer/footer.php";
include "../script/script.php";
?>
</body>

</html>