<?php
session_start();

include 'create/createDB.php';

$pdo = new PDO(
    'mysql:host=localhost;dbname=pop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$req1 = $pdo->prepare("SELECT * FROM product 

");
$req1->execute();
$product = $req1->fetchAll(PDO::FETCH_ASSOC);

$req2 = $pdo->prepare("SELECT * FROM product RIGHT JOIN category ON product.idCategory = Category.idCategory

");
$req2->execute();
$category = $req2->fetchAll(PDO::FETCH_ASSOC);

$req3 = $pdo->prepare("SELECT * FROM  category

");
$req3->execute();
$category2 = $req3->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST['filtre'])) { 



    $req4 = $pdo->prepare("SELECT * FROM product WHERE idCategory = $_POST[filtre]
 ");
    $req4->execute();
    $product = $req4->fetchAll(PDO::FETCH_ASSOC);
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
    <link href="style/style.css" rel="stylesheet">
    <!--    *** Appel librairie jQuery ***-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body class="index" >

<header id="Header">
        <div id='navigation' class="navigation">
            <div class="menu">
                <nav class="topnav" id="myTopnav">
                <?php
                    if (!empty($_SESSION['pseudo'])){
                        ?>
                        <a class="menu-hover" href="update/updateUser.php" >
                        <?php echo $_SESSION['pseudo']?></a>
                        <?php
                    }
                    ?>
                    <a class="menu-hover" href="index.php">Boutique</a>
                    <a class="menu-hover" href="connexion/connexion.php">Admin</a>
                   <?php
if (!empty($_SESSION['idUser']) && !empty($_SESSION['pseudo'])){
    ?>
    <a  class="menu-hover" href="connexion/deconnexionUser.php">déconnexion</a>
   <?php
}
else{ ?>
                    <a class="menu-hover" href="connexion/connexionUser.php">Connexion</a>
                    <?php
}
?>

                    <a class="menu-hover" href="pages/shop.php">Panier -<?php if  (!empty($_SESSION['number'])) {  echo $_SESSION['number']; }?></a>

                </nav>
            </div>
            <!-- Début bouton burger -->
            <div id="nav-icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="responsive">
            </div>
        </div>


            <!-- Fin bouton burger -->

            <div class="intro">
                <h1>Boutique de pop</h1>

            </div>





    </header>
    
    <section>
        <?php
    if (!empty($_SESSION['idAdmin'])){
                    ?>
                    <h1>Admin</h1>
                    <?php
    }
    ?>
        <h2>Nos Produits</h2>

        <div class="filtre">
        <h3>filtre</h3>
<?php
foreach ($category2 as $key => $value) {
    ?>


        <form action="#" method="POST">
                    <input type="hidden" name="filtre" value=" <?php echo $value['idCategory'] ?> ">
                    <input type="submit" value="<?php echo $value['nameCategory'] ?>">
                </form>
               
                
<?php
}
?>
               
            

        </div>

    <div class="pop">
       
            <?php

            foreach ($product as  $key => $value) {
            ?>
            <article class="articlePop">
                <a href="pages/affichage.php?idProduct=<?php echo $value['idProduct'] ?>">
                    <h3><?php echo $value['name'] ?></h3></a>
                    <a href="pages/affichage.php?idProduct=<?php echo $value['idProduct'] ?>">
                    <img src="<?php echo $value['photo'] ?>" width=150 height=200>
                </a>
                <h4><?php echo $value['price'] ?>€</h4>
                <p><?php echo $value['description'] ?></p>
                <div class="ico" >

                <?php 
                if (!empty($_SESSION['idAdmin'])){
                    ?>

                <a href="delete/deleteProduct.php?idProduct=<?php echo $value['idProduct'] ?>"><img src="images/delete.png" alt="" height="50" width="50"></a>
                <a href="update/updateProduct.php?idProduct=<?php echo $value['idProduct'] ?>"><img src="images/update.png" alt="" height="50" width="50"></a>

                <?php
                }
                ?>
                </div>
                </article>

            <?php
            }
            ?>

        
    </div>



    </section>

<?php
include "footer/footer.php";
include "script/script.php";
?>
    </body>
</html>