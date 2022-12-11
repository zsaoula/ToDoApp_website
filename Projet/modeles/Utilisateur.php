<?php
class Utilisateur{
    private string $pseudo;
    private string $mail;
    private int $motDePasse;
    
    public function __construct(string $pseudo, string $mail, string $motDePasse){
        $this->pseudo = $pseudo;
        $this->motSePasse =$motDePasse;
        $this->mail = $mail;
    }

    public function getPseudo(){
        return this->pseudo
    }

    public function __toString(){
        return "Pseudo: " . $this->pseudo;
    }
}
?>
