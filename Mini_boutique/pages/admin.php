<?php 
session_start();
$pdo = new PDO(
    'mysql:host=localhost;dbname=pop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$req1 = $pdo->prepare("SELECT * FROM product RIGHT JOIN category ON product.idCategory = Category.idCategory

");
$req1->execute();
$category = $req1->fetchAll(PDO::FETCH_ASSOC);

$req2 = $pdo->prepare("SELECT * FROM  category

");
$req2->execute();
$category2 = $req2->fetchAll(PDO::FETCH_ASSOC);



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
include '../header/header.php'
?>
<section>

   
 <h1>Admin</h1>
   
    

<h2>
<?php
    echo 'Bonjour '.$_SESSION['identifiant'] ;
    ?>
</h2>
    <h4>  <a href="../connexion/deconnexionAdmin.php">Se déconnecter du comte admin</a></h4>
    <h4>  <a href="../create/createAdmin.php">Ajouter un compte admin</a></h4>
  <h3>ajouter un produit :</h3>
    
    
    <form action="../create/createProduct.php" method="post" enctype="multipart/form-data">
 <label>nom :</label><input type="text" name="name">
 <label>prix :</label><input type="number" name="price">
 <label>description :</label><input type="text" name="description">
 <label>photo :</label> <input type="file" name="photo" id="image">
 <label>categorie :</label>
 <select name="idCategory" >
 <option disabled> --Choisissez une categorie--</option>
 <?php
 foreach ($category2 as $key => $value) { ?>
 <option value="<?php echo $value['idCategory']?>"><?php echo $value['nameCategory']?></option>
 <?php 
 }
 ?>
 </select>
 <input type="submit" value="Ajouter un Produit">
 </form>
    </article>
    <article>



<h3>ajouter une catégorie :</h3>


<form action="../create/createCategory.php" method="post" >
 <label>nouvelle categorie :</label><input type="text" name="nameCategory">
 <input type="submit" value="Ajouter la catégorie">
</form>

<?php 
foreach ($category2 as  $key => $value) {
    ?>
    <ul>
        <li> <a href="../delete/deleteCategory.php?idCategory=<?php echo $value['idCategory'] ?>"><img src="../images/delete.png" height="25px" ></a><?php echo  $value['nameCategory'] ?></li>
        
    </ul>
        
<?php
}
?>
    </article>

</section>
</body>
</html>