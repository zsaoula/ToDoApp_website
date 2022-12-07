<?php

require_once "config/Connection.php";

class UtilisateurGateway {
    protected Connection $con;

    public function __construct(Connexion $con)
    {
        $this->con=$con;
    }

    public function connexion($nom,$email,$mdp): array{
        $query="SELECT * FROM user WHERE nom=$nom AND email=$email AND mdp=$mdp";
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function ajoutUtilisateur($nom,$email,$mdp): void{
        $query = "INSERT INTO `user`(`nom`, `name`, `mdp`) VALUES ('$nom', '$email', '$mdp');";
        $this->con->executeQuery($query);
    }
}
?>