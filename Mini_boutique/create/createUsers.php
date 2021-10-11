<?php
session_start();



$pdo = new PDO(
    'mysql:host=localhost;dbname=pop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$req1 = $pdo->prepare("SELECT pseudo FROM user

");
$req1->execute();
$tabpseudo = $req1->fetchAll(PDO::FETCH_ASSOC);



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
    <link href="../style/style" rel="stylesheet">
    <!--    *** Appel librairie jQuery ***-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body  class="formulaire">
<?php
include('../header/header.php');
?>
    <section>
    <?php
    try {
    if ($_POST) {


        if ($_POST['pass'] == $_POST['pass2']){
        $pseudo = $_POST['pseudo'];
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $address = $_POST['address'];
        $postalCode = $_POST['postalCode'];
        $city = $_POST['city'];
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        

        if ($pseudo != "" && $pass_hache != "" && $lastName != "" && $firstName != "" && $address != "" && $postalCode != "" && $city != "") {
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
                ':city' => $city,
                
                

            ));
            header('location:../connexion/connexionUser.php');
        }
        
    }
   

else{
    echo "Les deux mots de pass de correspondent pas ! recommencer";
}

            
    }
    else {
        echo "Tous les champs n'ont pas été remplis";
    }
    
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
    <form action="#" method="POST">
        <label>Pseudo :<input type="text" name="pseudo"></label>
        <label>Nom :<input type="text" name="lastName"></label>
        <label>Prénom :<input type="text" name="firstName"></label>
        <label>Adresse :<input type="text" name="address"></label>
        <label>Code postal :<input type="number" name="postalCode"></label>
        <label>Ville :<input type="text" name="city"></label>
        <label>pass :<input type="password" name="pass"></label>
        <label>pass :<input type="password" name="pass2"></label>

        <input type="submit" value="s'inscrire">
    </form>
    <table>
        <thead>
            



    </table>
    </section>
    <?php
include "../footer/footer.php";
include "../script/script.php";
?>
</body>

</html>