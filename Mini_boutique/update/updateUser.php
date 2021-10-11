
<?php
session_start();
$idUser = $_SESSION['idUser'];
try{
    $pdo = new PDO(
        'mysql:host=localhost;dbname=pop;port=3306',
        'root',
        '',
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req1 = $pdo->prepare("SELECT * FROM user WHERE idUser = $idUser");
$req1->execute();
$user = $req1->fetch();





    if ($_POST) {
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $pseudo = $_POST['pseudo'];
        $userPass = $_POST['userPass'];
        $address = $_POST['address'];
        $postalCode = $_POST['postalCode']; 
        $city = $_POST['city'];
        
        
    
        $req1 = $pdo->prepare("UPDATE `user` 
                            SET `lastName`= :lastName ,`firstName`= :firstName,`pseudo`= :pseudo,`userPass`= :userPass,  `address`= :address ,`postalCode`= :postalCode,`city`= :city
                            WHERE idUser = $idUser");
    
    $req1->execute(array(
        ':lastName' => $lastName,
        ':firstName' => $firstName,
        ':pseudo' => $pseudo,
        ':userPass' => $userPass,
        ':address' => $address,
        ':postalCode' => $postalCode,
        ':city' => $city,


        ));

        
        $_SESSION['pseudo'] = $pseudo;
        header('location:../index.php');
    }
} 
catch(PDOException $e){
echo "Erreur : " . $e->getMessage();
}
    ?>

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
    <body>
        <?php
        include '../header/header.php'
        ?>

        <section>
            <h3>modifier vos information</h3>
    <form action="#" method="post"  enctype="multipart/form-data">
 <label>nom :</label><input type="text" name="lastName" value="<?php echo $user['lastName']?>">
 <label>prénom :</label><input type="text" name="firstName" value="<?php echo $user['firstName']?>">
 <label>Pseudo :</label><input type="text" name="pseudo" value="<?php echo $user['pseudo']?>">
 <label>Pass :</label><input type="pass" name="userPass" value="<?php echo $user['userPass']?>">
 <label>Adresse :</label><input type="text" name="address" value="<?php echo $user['address']?>">
 <label>Code postal :</label><input type="text" name="postalCode" value="<?php echo $user['postalCode']?>">
 <label>Ville :</label><input type="text" name="city" value="<?php echo $user['city']?>">
 
 <input type="submit" value="modifier le produit">
 </form>
        </section>

                
    </body>
    <?php
include "../footer/footer.php";
include "../script/script.php";
?>
    </html>