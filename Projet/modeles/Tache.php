<?php
class Tache{
    private int $id;
    private string $name;
    private date $creationDate
    private bool $finish;
    private int $noList;

    public function __construct(int $id, string $name, date $creationDate, bool $finish, int $noList){
        $this->id = $id;
        $this->name =$name;
        $this->creationDate = $creationDate;
        $this->finish = $finish;
        $this->noListe = $noListe;
    }

    public function getNom() : string {
        return $name;
    }

    public function getTerminer() : bool {
        return $finish;
    }

    public function getDateCreation() : date {
        return $creationDate;
    }
}
?>