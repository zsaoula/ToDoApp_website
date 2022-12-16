<?php

require_once "config/Connection.php";

class UtilisateurGateway {
    protected Connection $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function getCredentiale($email) {
        $query="SELECT * FROM `utilisateur` WHERE mail='$email' ";
        $this->con->executeQuery($query);
        return $this->con->getResults();
        // if($this->con->getResults() != 0){
        //     return $this->con->getResults();
        // }
        // else{
        //     throw new ErrorException("Erreur connexion bdd");
        // }
    }

    public function ajoutUtilisateur($nom,$email,$mdp): void{
        $query = "INSERT INTO `utilisateur` (`nom`, `mail`, `mdp`,`role`) VALUES('$nom', '$email', '$mdp','NULL')";
        $this->con->executeQuery($query);
    }
}
?>