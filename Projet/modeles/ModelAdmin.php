<?php

class ModelAdmin
{
    function connexion($email,$mdp) 
    {
        global $dsn, $username, $password;
        //$email = Validation::clearString($email);
        //$mdp = Validation::clearString($mdp);

        $gwUtilisateur = new UtilisateurGateway(new Connection($dsn,$username,$password));
        $hash = $gwUtilisateur->getCredentiale($email);
        $nom = $hash[0]['nom'];
        if(password_verify($mdp,$hash[0]['mdp'])){
               $_SESSION['role']='admin';
               $_SESSION['login']=$hash[0]['nom'];
               return new Admin($nom,$email,$mdp);
        }
        // return new Utilisateur($hash['nom'],$email,$mdp);
        return NULL;
    }

    function isAdmin()
    {
        if(isset $_SESSION['login'] && isset $_SESSION['role']){
            $login = Nettoyer::nettoyer_string($_SESSION['login'])
            $role = Nettoyer::nettoyer_string($_SESSION['role'])
            return new Admin($login,$role)
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