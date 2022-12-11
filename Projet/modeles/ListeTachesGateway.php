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

}