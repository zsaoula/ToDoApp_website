<?php

    class AdminGateway {
        protected Connection $con;

        public function __construct(Connection $con)
        {
            $this->con=$con;
        }


        //pas utiliser pour le moment, le but est qu'un administrateur puisse faire d'un utilisateur un administrateur
        public function ajoutUtilisateur($nom,$email,$mdp): void{
            $query = "INSERT INTO `utilisateur` (`nom`, `mail`, `mdp`,`role`) VALUES('$nom', '$email', '$mdp','Admin')";
            $this->con->executeQuery($query);
        }
    }
?>