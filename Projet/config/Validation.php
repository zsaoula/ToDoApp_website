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
        if ((!isset($nom)||$nom==="") && (!isset($email)||$email==="") && (!isset($mdp)||$mdp==="")) {
            $dVueEreur["all"] =	"Remplissez les champs.";
            return;
        }
        if (!isset($nom)||$nom==="") {
            $dVueEreur["nom"] =	"Nom manquant.";
            return;
        }

        $nom = Validation::nettoyer_string($nom);
        if(!$nom){
            $dVueEreur["nom"] =	"Nom invalide.";
            return;
        }
        
        if (!isset($email)||$email==="") {
            $dVueEreur["email"] =	"Email manquant.";
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $dVueEreur["email"] =	"Email invalide.";
            return;
        }

        if (!isset($mdp)||$mdp==="") {
            $dVueEreur["mdp1"] = "Mot de passe manquant.";
            return;
        }

        $mdp = Validation::nettoyer_string($mdp);
        if(!$mdp){
            $dVueEreur["mdp1"] =	"Mot de passe invalide.";
            return;
        }

        if (strlen($mdp)<6) {
            $dVueEreur["mdp1"] =	"Le mot de passe doit faire au moins 6 caractères.";
            return;
        }

        if (!isset($mdpS)||$mdpS==="") {
            $dVueEreur["mdp2"] =	"Mot de passe manquant.";
            return;
        }

        $mdp = Validation::nettoyer_string($mdpS);
        if(!$mdpS){
            $dVueEreur["mdp2"] =	"Mot de passe invalide.";
            return;
        }

        if($mdp !== $mdpS){
            $dVueEreur["mdp1"] =	"Les mots de passe différent.";
            return;
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

        