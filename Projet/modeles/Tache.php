<?php
class Tache{
    private int $id;
    private string $name;
    private string $creationDate;
    private bool $finish;
    private int $noList;

    public function __construct(int $id, string $name, string $creationDate, bool $finish, int $noList){
        $this->id = $id;
        $this->name =$name;
        $this->creationDate = $creationDate;
        $this->finish = $finish;
        $this->noList = $noList;
    }

    public function getNom() : string {
        return $this->name;
    }

    public function getTerminer() : bool {
        return $this->finish;
    }

    public function getCreationTache() : string {
        return $this->creationDate;
    }
}
?>