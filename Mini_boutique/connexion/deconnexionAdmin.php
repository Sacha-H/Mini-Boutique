<?php 
session_start();

// Suppression des variables de session et de la session


$_SESSION['idAdmin'] = array();
$_SESSION['identifiant'] = array();


// Suppression des cookies de connexion automatique
setcookie('idUsers', '');
setcookie('pseudo', '');

header("location:../index.php");