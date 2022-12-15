<?php

//gen
$rep=__DIR__.'/../';

// liste des modules à inclure

//$dConfig['includes']= array('controleur/Validation.php');



//BD

// $dsn="mysql:host=localhost;dbname=dbnorandon;port=3308;";
// $username="norandon";
// $password="achanger";

$dsn="mysql:host=localhost;dbname=dbnorandon;port=3306;";
$username="root";
$password="";

//Vues

$vues['erreur']='vues/erreur.php';
$vues['vueConnexion']='vues/connexion.php';
$vues['vueInscription']='vues/inscription.php';
$vues['vueAfficherTaches']='vues/afficherTaches.php';
$vues['vueAfficherTachesPrivee']='vues/afficherTachesPrivee.php';
?>