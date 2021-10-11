<?php
session_start();



$pdo = new PDO(
    'mysql:host=localhost;dbname=pop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$req2 = $pdo->prepare("SELECT * FROM product RIGHT JOIN category ON product.idCategory = Category.idCategory

");
$req2->execute();
$category = $req2->fetchAll(PDO::FETCH_ASSOC);


if (!empty($_GET['idProduct'])) {
    $idProduct = $_GET['idProduct'];
    

$req1 = $pdo->prepare("SELECT * FROM product WHERE idProduct=$idProduct

");
$req1->execute();
$product = $req1->fetch(PDO::FETCH_ASSOC);

}




if (!empty($_SESSION['pseudo']) && (!empty($_GET['idProduct']))) {

    if (empty($_SESSION['number']) && empty($_SESSION['price']) ){
        $_SESSION['number'] = 0;
        $_SESSION['price'] = 0 ;
    }

   
        $_SESSION['number'] +=1;
        $_SESSION['price'] += $product['price'];
        
        
}

if (empty($_SESSION['pseudo'])) {

    header('location:../connexion/connexionUser.php');
}
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
<body class="shop">
<?php
include('../header/header.php');
?>

        <section>
        <h2>panier</h2>
        <h3>Vous avez <?php echo $_SESSION['number']?> article dans votre panier</h3>
        <h3>Pour un total de<strong> <?php echo $_SESSION['price']?>€</strong></h3>
        <h1><a href="commande.php" class="commande">payer</a></h1>
        
       
    
    

        </section>
        
    <?php
    include "../footer/footer.php";
    include "../script/script.php";
    ?>
</body>
</html>