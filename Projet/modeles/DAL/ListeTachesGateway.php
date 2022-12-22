<?php


class ListeTachesGateway {

    protected Connection $con;

    public function __construct(Connection $con)
    {
       $this->con=$con;
    }

    public function getPublicLists(): array
    {
        $query = "SELECT * FROM listetaches WHERE type='1' ";

        $this->con->executeQuery($query);

        return $this->con->getResults();
    }

    public function getAdminLists(): array
    {
        $query = "SELECT * FROM listetaches ";

        $this->con->executeQuery($query);

        return $this->con->getResults();
    }

    public function getPriveeLists($idUtilisateur): array
    {
        // $query = "SELECT * FROM `listetaches` WHERE type='0' AND `idutilisateur`=$idUtilisateur ";
        $query = "SELECT * FROM `listetaches` WHERE type='0' AND `idutilisateur`=:idU ";
        
        $this->con->executeQuery($query, array(':idU' => array($idUtilisateur,PDO::PARAM_INT)));

        return $this->con->getResults();
    }

    public function ajoutListePublic($nom): void
    {
        $query = "INSERT INTO `listetaches` (`name`,`type`) VALUES(:nom,'1')";
       
        $this->con->executeQuery($query,array(':nom' => array($nom,PDO::PARAM_STR_CHAR)) );
    }

    public function ajoutListePrivee($nom,$id): void
    {
        $query = "INSERT INTO `listetaches` (`name`,`type`,`idUtilisateur`) VALUES(:nom,'0',:id)";

        $this->con->executeQuery($query,array(':nom' => array($nom,PDO::PARAM_STR_CHAR), ':id'=> array($id,PDO::PARAM_INT) ) );
    }


    public function supprimerListePublic($id): void 
    {
        $query = "DELETE FROM listetaches WHERE `id`=:id ";

        $this->con->executeQuery($query, array(':id' => array($id,PDO::PARAM_INT)));
    }

    public function rendrePublique($id): void 
    {
        $query = "UPDATE `listetaches` SET `type`='1' WHERE id=:id";

        $this->con->executeQuery($query,array(':id' => array($id,PDO::PARAM_INT)) );
    }

    public function rendrePrivée($id): void 
    {
        $query = "UPDATE `listetaches` SET `type`='0' WHERE id=:id";

        $this->con->executeQuery($query, array(':id' => array($id,PDO::PARAM_INT)));
    }

}