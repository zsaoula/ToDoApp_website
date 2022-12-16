<?php

class Validation {

    static function nettoyer_string($string){
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    static function val_form_connexion(string &$email, string &$mdp, array &$dVueEreur) {
        if (!isset($email)||$email==="") {
            $dVueEreur[] =	"Email manquant.";
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $dVueEreur[] =	"Email invalide.";
        }

        if (!isset($mdp)||$mdp==="") {
            $dVueEreur[] =	"Mot de passe manquant.";
        }

        $mdp = $this->nettoyer_string($mdp);
        if(!$mdp){
            $dVueEreur[] =	"Mot de passe invalide.";
        }
    }

    static function val_form_inscription(string &$nom, string &$email, string &$mdp, string &$mdpS, array &$dVueEreur) {
        if (!isset($nom)||$nom==="") {
            $dVueEreur[] =	"Nom manquant.";
        }

        $nom = $this->nettoyer_string($nom);
        if(!$nom){
            $dVueEreur[] =	"Nom invalide.";
        }
        
        if (!isset($email)||$email==="") {
            $dVueEreur[] =	"Email manquant.";
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $dVueEreur[] =	"Email invalide.";
        }

        if (!isset($mdp)||$mdp==="") {
            $dVueEreur[] =	"Mot de passe manquant.";
        }

        $mdp = $this->nettoyer_string($mdp);
        if(!$mdp){
            $dVueEreur[] =	"Mot de passe invalide.";
        }

        if (strlen($mdp)<6) {
            $dVueEreur[] =	"Le mot de passe doit faire au moins 6 caractères.";
        }

        if (!isset($mdpS)||$mdpS==="") {
            $dVueEreur[] =	"Mot de passe manquant.";
        }

        $mdp = $this->nettoyer_string($mdpS);
        if(!$mdpS){
            $dVueEreur[] =	"Mot de passe invalide.";
        }

        if($mdp !== $mdpS){
            $dVueEreur[] =	"Les mots de passe différent.";
        }

    }

    static function val_form_ajout(string &$nom, array &$dVueEreur) {
        if (!isset($nom)||$nom=="") {
            $dVueEreur[] =	"Le nom de tache est manquant.";
        }

        $nom = $this->nettoyer_string($nom);
        if(!$nom){
            $dVueEreur[] =	"Le nom de tache est invalide.";
        }
    }
}
?>

        