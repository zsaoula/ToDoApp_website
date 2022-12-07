<?php

//gen
$rep=__DIR__.'/../';

// liste des modules à inclure

//$dConfig['includes']= array('controleur/Validation.php');



//BD

$dsn="mysql:host=localhost;dname=dbnorandon";
$username="norandon";
$password="achanger";

//Vues

$vues['erreur']='vues/erreur.php';
$vues['vueConnexion']='vues/connexion.php';
$vues['vueInscription']='vues/inscription.php';
$vues['vueAfficherTaches']='vues/afficherTaches.php';

?>