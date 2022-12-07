<?php
class ListeTaches{
    private int $id;
    private string $name;
    private bool $type;
    private $taches = array();
    
    public function __construct(int $id, int $name, bool $type, array $taches){
        $this->id = $id;
        $this->name =$name;
        $this->type = $type;
        $this->taches = $taches;
    }

    public function getNom() : string {
        return $name;
    }

    public function getType() : bool {
        return $type;
    }

    public function getTaches() : array {
        return $taches;
    }
    
}
?>