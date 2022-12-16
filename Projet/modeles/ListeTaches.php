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

    public function getId() : int {
        return $this->id;
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

    public function getProgress() : int {
        $cpt=0;
        if(empty($this->taches)){
            return 0;
        }
        foreach((array)$this->$taches as $tache){
            $cpt++;
        }
        if($cpt == 0){
            return 0;
        }
        return $cpt/count($this->$taches);
    }
    
}
?>