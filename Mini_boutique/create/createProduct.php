<?php
var_dump($_FILES);
$target_dir = "../uploads/";
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
//---------------------FIN SYSTEME D'UPLOAD D'IMAGES------------------------------


try{
 $pdo = new PDO('mysql:host=localhost;dbname=pop;port=3306','root','',
 array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 if ($_POST) {
 $name = $_POST['name'];
 $price = $_POST['price'];
 $description = $_POST['description'];
 $idCategory = $_POST['idCategory'];
 $photo = "uploads/".$_FILES["photo"]["name"];
 if ($name != ""  && $price != "" && $description != "" && $idCategory != "" && $photo != "") {
 $req1 = $pdo->prepare("
 INSERT INTO product(name,price,description,idCategory,photo)
 VALUES (:name,:price,:description,:idCategory,:photo)
 ");
 
 $req1->execute(array(
 ':name' => $name,
 ':price' => $price,
 ':description' => $description,
 ':idCategory' => $idCategory,
 ':photo' => $photo
 ));
 }
 }
 header("location:../index.php");
}
catch (PDOException $e){
print "Erreur !: " . $e->getMessage() . "<br/>";
die();
}
?>