<?php
try{
$pdo = new PDO('mysql:host=localhost;port=3306','root','');
$sql = "CREATE DATABASE IF NOT EXISTS `pop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$pdo->exec($sql);

$pdo = new PDO('mysql:host=localhost;dbname=pop;port=3306','root','',
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$req1 = "CREATE TABLE IF NOT EXISTS `pop`.`admins` (
    `idAdmin` INT NOT NULL AUTO_INCREMENT ,
    `identifiant` VARCHAR(50) NOT NULL,
    `adminPass` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`idAdmin`)
);";
$pdo->exec($req1);

$req2 = "CREATE TABLE IF NOT EXISTS `pop`.`category`(
    `idCategory` INT NOT NULL AUTO_INCREMENT,
    `nameCategory` VARCHAR(50) NOT NULL,
    
    PRIMARY KEY(idCategory)
    );";
    
    $pdo->exec($req2);



$req3 = "CREATE TABLE IF NOT EXISTS `pop`.`product` (
    `idProduct` INT NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(50) NOT NULL,
    `photo` VARCHAR(50) NOT NULL ,
    `price` INT(8) NOT NULL ,
    `description` VARCHAR(50) NOT NULL ,
    `idCategory` VARCHAR(50) NOT NULL ,
    PRIMARY KEY (`idProduct`) , FOREIGN KEY(`idCategory`) REFERENCES `category` (`idCategory`)
);";
$pdo->exec($req3);

// $req4 = "CREATE TABLE IF NOT EXISTS `pop`.`basket`(
//     `idBasket` INT NOT NULL AUTO_INCREMENT,
//     `idProduct` INT(7) NOT NULL,
    
//     PRIMARY KEY(idBasket) , FOREIGN KEY(`idProduct`) REFERENCES `product` (`idProduct`)
//     );";
    
//     $pdo->exec($req4);

    
$req5 = "CREATE TABLE IF NOT EXISTS `pop`.`user` (
    `idUser` INT NOT NULL AUTO_INCREMENT ,
    `lastName` VARCHAR(50) NOT NULL,
    `firstName` VARCHAR(50) NOT NULL ,
    `pseudo` VARCHAR(50) NOT NULL ,
    `userPass` VARCHAR(255) NOT NULL ,
    `address` VARCHAR(50) NOT NULL ,
    `postalCode` VARCHAR(50) NOT NULL ,
    `city` VARCHAR(50) NOT NULL ,
    -- `idBasket` INT(11)  ,
   PRIMARY KEY (`idUser`) -- , FOREIGN KEY(`idBasket`) REFERENCES `basket` (`idBasket`) 
);";
$pdo->exec($req5);


}
catch (PDOException $e){
print "Erreur !: " . $e->getMessage() . "<br/>";
die();
}