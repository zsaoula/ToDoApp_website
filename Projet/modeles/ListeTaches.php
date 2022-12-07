<?php
class ListeTaches{
    private int $id;
    private string $name;
    private bool $type;
    private $taches = array();
    
    public function __construct(int $id, string $name, bool $type, array $taches){
        $this->id = $id;
        $this->name =$name;
        $this->type = $type;
        $this->taches = $taches;
    }

    public function getNom() : string {
        return $this->name;
    }

    public function getType() : bool {
        return $this->type;
    }

    public function getTaches() : array {
        return $this->taches;
    }
    
}
?>