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


    // settype($_GET('idVoiture'),'string');
    
 
  
 
 $sql = "DELETE FROM product WHERE idProduct=$idProduct";
 $sth = $pdo->prepare($sql);
 $sth->execute();
 $count = $sth->rowCount();
 print('Effacement de ' .$count. ' entrées.');
 } 
 catch(PDOException $e){
 echo "Erreur : " . $e->getMessage();
 }
 header("location:../index.php")
 ?>
