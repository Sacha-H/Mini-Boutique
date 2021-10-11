<?php
session_start();

$pdo = new PDO(
    'mysql:host=localhost;dbname=pop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$idUser = $_SESSION['idUser'];

$req1 = $pdo->prepare("SELECT * FROM user WHERE idUser = $idUser

");
$req1->execute();
$product = $req1->fetch(PDO::FETCH_ASSOC);





?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- fonts -->
       <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- link -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
    <!--    *** Appel librairie jQuery ***-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
</head>

<body class="admin">
<?php
include('../header/header.php');
?>

<section>
    <h2> Votre commande n°  <?php echo rand(1,10000)?>  à bien été pris en comte.</h2>
    <h3>prix :  <?php echo $_SESSION['price'] ?> </h3>
    <h3>commandé par :<?php echo $product['lastName'].' '.$product['firstName']?> </h3>
    <h3>adresse de livraison : <?php echo $product['address'].' '.$product['postalCode'].' '.$product['city']?></h3>
    <h3>durée de la livraison : <?php echo rand(1,5)?> jours</h5>
</section>

<?php
$_SESSION['number'] = 0;
$_SESSION['price'] = 0;
include "../footer/footer.php";
include "../script/script.php";
?>
</body>
</html>