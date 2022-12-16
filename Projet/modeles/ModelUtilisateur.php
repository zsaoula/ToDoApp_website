<?php

class ModelUtilisateur
{
    function connexion($email,$mdp) 
    {
        global $dsn, $username, $password;
        //$email = Validation::clearString($email);
        //$mdp = Validation::clearString($mdp);

        $gwUtilisateur = new UtilisateurGateway(new Connection($dsn,$username,$password));
        $hash = $gwUtilisateur->getCredentiale($email);
        //password_verify($mdp,$hash[0]['mdp'])
        $nom = $hash[0]['nom'];
        if(strcmp($mdp,$hash[0]['mdp'])){
               $_SESSION['role']='utilisateur';
               $_SESSION['login']=$hash[0]['nom'];
               $_SESSION['id']=$hash[0]['id'];
               return new Utilisateur($hash[0]['id'],$nom,$email);
        }
        // return new Utilisateur($hash['nom'],$email,$mdp);
        return NULL;
    }

    function isUtilisateur()
    {
        if(isset($_SESSION['login']) && isset($_SESSION['role'])){
            $id = Validation::nettoyer_string($_SESSION['id']);
            $login = Validation::nettoyer_string($_SESSION['login']);
            $role = Validation::nettoyer_string($_SESSION['role']);
            return new Utilisateur($id,$login,$role);
        }
        else
            return NULL;
    }

    function deconnexion() 
    {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }
}

?>