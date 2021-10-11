<?php
session_start();
$idProduct = $_GET['idProduct'];

$pdo = new PDO(
    'mysql:host=localhost;dbname=pop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$req1 = $pdo->prepare("SELECT * FROM product WHERE idProduct = $idProduct

");
$req1->execute();
$product = $req1->fetchAll(PDO::FETCH_ASSOC);
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

<body class="affichage">

<?php
include('../header/header.php');
?>
    <section class="sectionAffichage">
<?php

        foreach ($product as $key => $value) {
            ?>
<article class="articleAffichage">


    <h1><?php echo $value['name'] ?></h1>
    
    <img src="../<?php echo $value['photo'] ?>" width=300 height=500>

<h3><?php echo $value['price'] ?>€</h3>
<h4><?php echo $value['description'] ?></h4>
<h1><a href="shop.php?idProduct=<?php echo $value['idProduct'] ?>">ajouter au panier</h1></a>
</article>

<?php
        }
        ?>
    </section>
    <?php
include "../footer/footer.php";
include "../script/script.php";
?>
</body>
</html>
