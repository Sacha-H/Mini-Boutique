<?php 
session_start();

// Suppression des variables de session et de la session

$_SESSION['idUser'] = array();
$_SESSION['pseudo'] = array();
$_SESSION['number'] = 0;
$_SESSION['price'] = 0;


// Suppression des cookies de connexion automatique
setcookie('idUsers', '');
setcookie('pseudo', '');

header("location:../index.php");