<?php

require_once "config/Connection.php";

class UtilisateurGateway {
    protected Connection $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function getCredentiale($email) {
        $query="SELECT * FROM `utilisateur` WHERE mail=:email ";
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR_CHAR)));
        return $this->con->getResults();
    }

    public function ajoutUtilisateur($nom,$email,$mdp): void{
        $query = "INSERT INTO `utilisateur` (`nom`, `mail`, `mdp`,`role`) VALUES(:nom, :email, :mdp,'Utilisateur')";
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR_CHAR), ':nom' => array($nom, PDO::PARAM_STR_CHAR), ':mdp' => array($mdp, PDO::PARAM_STR_CHAR)));
    }
}
?>