<?php
session_start();

if (!empty($_SESSION['idAdmin']) && !empty($_SESSION['identifiant'])){
    header('location:../pages/admin.php');
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
    if (!empty($_POST['identifiant']) && !empty($_POST['adminPass'])) {

$identifiant = $_POST['identifiant'];
$req = $pdo->prepare('SELECT idAdmin, adminPass FROM admins WHERE identifiant = :identifiant');
$req->execute(array(
    ':identifiant' => $identifiant,
));
$resultat = $req->fetch();
$pass_hache = password_hash($_POST['adminPass'], PASSWORD_DEFAULT);
if ($identifiant != "" && $pass_hache != "") {
    $req1 = $pdo->prepare("
INSERT INTO admins(identifiant,adminPass)
VALUES (:identifiant,:adminPass)
");
    $req1->execute(array(
        ':identifiant' => $identifiant,
        ':adminPass' => $pass_hache



    ));
}
$isPasswordCorrect = password_verify($_POST['adminPass'], $resultat['adminPass']);

if (!$resultat) {
    echo 'Mauvais identifiant ou mot de passe !';
} else {
    if ($isPasswordCorrect) {
        $_SESSION['idAdmin'] = $resultat['idAdmin'];
        $_SESSION['identifiant'] = $identifiant;

        if (!empty($_POST['stay_connect']) && $_POST['stay_connect'] == "ok") {
            setcookie('idAdmin', $resultat['idAdmin'], time() + 365 * 24 * 3600, null, null, false, true);
            setcookie('identifiant', $identifiant, time() + 365 * 24 * 3600, null, null, false, true);
        }
        header('location:../pages/admin.php');
    } else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}
} else {
echo "Tous les champs n'ont pas été remplis";
}
?>


    <form action="#" method="POST">
        <label>identifiant :</label><input type="text" name="identifiant">
        <label>pass :</label><input type="password" name="adminPass">
        <label>rester connecter <input type="checkbox" name="stay_connect" value="ok"></label>
        <input type="submit" value="se connecter">
    </form>
    

    </section>
    <?php
include "../footer/footer.php";
include "../script/script.php";
?>
</body>

</html>