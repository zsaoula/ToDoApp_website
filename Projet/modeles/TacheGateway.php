<?php

//require_once "config/Connection.php";

class TacheGateway {

    protected Connection $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }



    /*public function saveTask(): void
    {
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $content = $_POST['content'];
            $finish = $_POST['finish'];
            $idList = $_POST['idList'];

            $query = "SELECT id FROM listeTaches WHERE id=$id";
            $this->con->executeQuery($query);
            $result = $this->con->getResults();

            if (empty($result)){
                $query= "INSERT INTO tache(id,author,content,idList) VALUES ($id,$content,$finish,$idList)";
                $this->con->executeQuery($query);
                echo "Insert Completed";
            }else{
                echo "This list didn't exist yet";
            }

        }
    }*/


    public function getTaches(int $noListe): array
    {
        $query = "SELECT * FROM tache WHERE noListe=$noListe";
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }


    public function ajouterTache(string $name, string $creationDate, int $noListe) : void
    {

        $query = "INSERT INTO `tache`(`name`, `creationDate`, `finish`, `noListe`) VALUES ('$name', '$creationDate', '0', '$noListe');";

        $this->con->executeQuery($query);

    }

    public function supprimerTacheIdListe($idListe)
    {
        $query = "DELETE FROM `tache` where `noListe`=$idListe";

        $this->con->executeQuery($query);
    }

    public function supprimerTache($idTache)
    {

        $query = "DELETE FROM `tache` where id=$idTache";

        $this->con->executeQuery($query);
    }

    public function checkerTaches($listeTache,$taches){
        $tachesUncheck=array();
        $tachesListe=array();
        $query = "SELECT id FROM tache WHERE noListe=$listeTache";
        $this->con->executeQuery($query);
        $tachesListe=$this->con->getResults();
        // for ($i=0)
            foreach($tachesListe as $tache){
                var_dump($tache['id']);
            if (in_array($tache['id'],$taches)==false){
                $tachesUncheck[] = $tache['id'];
            }
        
        }
        
        var_dump($tachesUncheck);

        foreach ($taches as $tache){
            $query = "UPDATE `tache` SET finish=1 WHERE noListe=$listeTache AND id=$tache";
            $this->con->executeQuery($query);
        }
        foreach ($tachesUncheck as $tache){
            $query = "UPDATE `tache` SET finish=0 WHERE noListe=$listeTache AND id=$tache";
            $this->con->executeQuery($query);
        }
    }

}