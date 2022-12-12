<?php

require_once "config/Connection.php";

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

    public function getPrivateLists(): array
    {
        $query = "SELECT * FROM listetaches WHERE type='0' ";

        $this->con->executeQuery($query);

        return $this->con->getResults();
    }

    public function ajoutListePublic($nom): void
    {
        $query = "INSERT INTO `listetaches` (`name`,`type`) VALUES('$nom','1')";

        $this->con->executeQuery($query);
    }

    public function supprimerListePublic($id): void 
    {
        $query = "DELETE FROM listetaches WHERE `id`=$id ";

        $this->con->executeQuery($query);
    }

}