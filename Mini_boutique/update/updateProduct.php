<?php
$idProduct=$_GET['idProduct'];


try{
    $pdo = new PDO(
        'mysql:host=localhost;dbname=pop;port=3306',
        'root',
        '',
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req1 = $pdo->prepare("SELECT * FROM product WHERE idProduct = $idProduct");
$req1->execute();
$product = $req1->fetch();









    if ($_POST) {




        var_dump($_FILES);
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // On vérifie si le fichier image est une image réelle ou une fausse image
        if(isset($_POST["submit"])) {
         $check = getimagesize($_FILES["photo"]["tmp_name"]);
         if($check !== false) {
         echo "File is an image - " . $check["mime"] . ".";
         $uploadOk = 1;
         } else {
         echo "File is not an image.";
         $uploadOk = 0;
         }
        }
        // On vérifie si le fichier existe déjà
        if (file_exists($target_file)) {
         echo "Désolé, ce fichier existe déjà.";
         $uploadOk = 0;
         }
        // On vérifie la taille de l'image
        if ($_FILES["photo"]["size"] > 500000) {
         echo "Désolé, ce fichier dépasse la limite de taille autorisée.";
         $uploadOk = 0;
         }
        // On vérifie le type de fichier
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
         echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
         $uploadOk = 0;
        }
        // On vérifie si $uploadOk est à 0 à cause d'une erreur
        if ($uploadOk == 0) {
         echo "Désolé, votre fichier n'a pas été uploader";
         // Si tout est ok on essaye d'uploader le fichier
         } else {
         if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
         echo "Le fichier ". basename( $_FILES["photo"]["name"]). " a bien été uploader."
        ;
         } else {
         echo "Sorry, there was an error uploading your file.";
         }
         }
        // ---------------------FIN SYSTEME D'UPLOAD D'IMAGES------------------------------



        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $photo = "uploads/".$_FILES["photo"]["name"];
        
    
        $req1 = $pdo->prepare("UPDATE `product` 
                            SET `name`= :name ,`price`= :price,`description`= :description,`photo`= :photo
                            WHERE idProduct = $idProduct");
    
    $req1->execute(array(
        ':name' => $name,
        ':price' => $price,
        ':description' => $description,
        ':photo' => $photo,

        ));

        
        
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
            <h1>Admin</h1>
            <h3>modifier un produit</h3>
    <form action="#" method="post"  enctype="multipart/form-data">
 <label for="">nom :</label><input type="text" name="name" value="<?php echo $product['name']?>">
 <label>prix :</label><input type="number" name="price" value="<?php echo $product['price']?>">
 <label>description :</label><input type="text" name="description" value="<?php echo $product['description']?>">
 <label>photo :</label><input type="file" name="photo" value="">
 <input type="submit" value="modifier le produit">
 </form>
        </section>

                
    </body>
    <?php
include "../footer/footer.php";
include "../script/script.php";
?>
    </html>