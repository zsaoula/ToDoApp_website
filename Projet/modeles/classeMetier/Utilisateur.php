<?php
class Utilisateur{
    private int $id;
    private string $pseudo;
    private string $mail;
    
    public function __construct(int $id,string $pseudo, string $mail){
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
    }

    public function getPseudo(){
        return $this->pseudo;
    }

    public function __toString(){
        return "Pseudo: " . $this->pseudo;
    }
}
?>
