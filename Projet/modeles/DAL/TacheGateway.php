<?php

//require_once "config/Connection.php";

class TacheGateway {

    protected Connection $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }


    public function getTaches(int $noListe): array
    {
        $query = "SELECT * FROM tache WHERE noListe=:noListe";
        $this->con->executeQuery($query, array(':noListe' => array($noListe, PDO::PARAM_INT)));
        return $this->con->getResults();
    }


    public function ajouterTache(string $name, string $creationDate, string $priorite, int $noListe) : void
    {

        $query = "INSERT INTO `tache`(`name`, `creationDate`, `finish`, `priorite`, `noListe`) VALUES (:name, :date, '0', :priorite, :noListe);";

        $this->con->executeQuery($query, array(':noListe' => array($noListe, PDO::PARAM_INT), ':name' => array($name, PDO::PARAM_STR_CHAR), ':date' => array($creationDate, PDO::PARAM_STR_CHAR) , ':priorite' => array($priorite, PDO::PARAM_STR_CHAR) ));

    }

    public function editerTache(string $nameTache,string $idTache,string $typePriorite) : void
    {
        
        $query = "UPDATE `tache` SET `name`=:nameTache, `priorite`=:typePriorite WHERE id=:idTache";

        
        $this->con->executeQuery($query, array(':nameTache' => array($nameTache, PDO::PARAM_STR_CHAR), ':idTache' => array($idTache, PDO::PARAM_INT), ':typePriorite' => array($typePriorite, PDO::PARAM_STR_CHAR)));
    }

    public function supprimerTacheIdListe($idListe)
    {
        $query = "DELETE FROM `tache` where `noListe`=:idListe";

        $this->con->executeQuery($query,array(':idListe' => array($idListe, PDO::PARAM_INT)) );
    }

    public function supprimerTache($idTache)
    {

        $query = "DELETE FROM `tache` where id=:idTache";

        $this->con->executeQuery($query, array(':idTache' => array($idTache, PDO::PARAM_INT)));
    }

    public function checkerTaches($listeTache,$taches){
        $tachesUncheck=array();
        $tachesListe=array();
        $query = "SELECT id FROM tache WHERE noListe=:listeTache";
        $this->con->executeQuery($query, array(':listeTache' => array($listeTache, PDO::PARAM_INT)));
        $tachesListe=$this->con->getResults();
            foreach($tachesListe as $tache){
            if (in_array($tache['id'],$taches)==false){
                $tachesUncheck[] = $tache['id'];
            }
        
        }

        foreach ($taches as $tache){
            $query = "UPDATE `tache` SET finish=1 WHERE noListe=:listeTache AND id=:tache";
            $this->con->executeQuery($query, array(':listeTache' => array($listeTache, PDO::PARAM_INT),':tache' => array($tache, PDO::PARAM_INT)));
        }
        foreach ($tachesUncheck as $tache){
            $query = "UPDATE `tache` SET finish=0 WHERE noListe=:listeTache AND id=:tache";
            $this->con->executeQuery($query, array(':listeTache' => array($listeTache, PDO::PARAM_INT),':tache' => array($tache, PDO::PARAM_INT)));
        }
    }

}