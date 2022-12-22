<?php

require_once "config/Connection.php";

class UtilisateurGateway {
    protected Connection $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function ajoutUtilisateur($nom,$email,$mdp): void{
        $query = "INSERT INTO `utilisateur` (`nom`, `mail`, `mdp`,`role`) VALUES('$nom', '$email', '$mdp','Admin')";
        $this->con->executeQuery($query);
    }
}
?>