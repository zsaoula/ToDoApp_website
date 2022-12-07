<?php

class Validation {

static function val_action($action) {

if (!isset($action)) {
    throw new Exception('pas d\'action');
    //on pourrait aussi utiliser
//$action = $_GET['action'] ?? 'no';
    // This is equivalent to:
    //$action =  if (isset($_GET['action'])) $action=$_GET['action']  else $action='no';
}
}

    static function val_form(string &$nom, string &$email, string &$mdp, array &$dVueEreur) {

        if (!isset($nom)||$nom=="") {
            $dVueEreur[] =	"pas de nom";
            $nom="";
        }

        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING))
        {
            $dVueEreur[] =	"testative d'injection de code (attaque sécurité)";
            $nom="";

        }
    }

}
?>

        