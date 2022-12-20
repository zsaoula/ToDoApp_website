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

    public function getProgress() : float {
        $cpt=0;
        if(empty($this->taches)){
            return 0;
        }
        foreach($this->taches as $tache){
            if(($tache->getChecked())==true){
                $cpt++;
            }     
        }
        if($cpt == 0){
            return 0;
        }
        return number_format(($cpt/(count($this->taches)))*100,0);
    }
    
}
?>