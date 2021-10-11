<?php
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

<body class="formulaire">
<?php
include('../header/header.php');
?>
    <section>
    <h1>Admin</h1>
    <?php
    
try {
    if ($_POST) {
        if ($_POST['pass'] == $_POST['pass2']){
        $identifiant = $_POST['identifiant'];
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        

        if ($identifiant != "" && $pass_hache != "") {
            $req1 = $pdo->prepare("
 INSERT INTO admins(identifiant,adminPass)
 VALUES (:identifiant,:adminPass)
 ");
            $req1->execute(array(
                ':identifiant' => $identifiant,
                ':adminPass' => $pass_hache,
                
                

            ));
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
        <label>identifiant :</label><input type="text" name="identifiant">
        <label>pass :</label><input type="password" name="pass">
        <label>pass :</label><input type="password" name="pass2">

        <input type="submit" value="ajouter un admin">
    </form>
    <table>
        <thead>
            
            <th>identifiant</th>
            


        </thead>
<?php
        $req1 = $pdo->prepare("SELECT * FROM admins ");
$req1->execute();
$admins = $req1->fetchAll(PDO::FETCH_ASSOC);
       
        foreach ($admins as $key => $value) {
        ?>
            <tr>
                
                <td><?php echo $value['identifiant'] ?></td>
                
            </tr>
        <?php
        }
        ?>


    </table>
    </section>
    <?php
include "../footer/footer.php";
include "../script/script.php";
?>
</body>

</html>