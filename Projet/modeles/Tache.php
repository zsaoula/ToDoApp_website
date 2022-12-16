<?php
class Tache{
    private int $id;
    private string $name;
    private string $creationDate;
    private bool $finish;
    private string $priorite;
    private int $noList;

    public function __construct(int $id, string $name, string $creationDate, bool $finish, string $priorite, int $noList){
        $this->id = $id;
        $this->name =$name;
        $this->creationDate = $creationDate;
        $this->finish = $finish;
        $this->priorite = $priorite;
        $this->noList = $noList;
    }
    public function getId() : string {
        return $this->id;
    }

    public function getNom() : string {
        return $this->name;
    }

    public function getTerminer() : bool {
        return $this->finish;
    }

    public function getPriorite() : string {
        return $this->priorite;
    }

    public function getCouleur() : string {
        if($this->priorite == "Faible"){
            return "bg-success";
        }
        elseif($this->priorite == "Moyen"){
            return "bg-warning";
        }
        else{
            return "bg-danger";
        }
    }

    public function getCreationTache() : string {
        return $this->creationDate;
    }

    public function getChecked() : bool {
        return $this->finish;
    }
}
?>