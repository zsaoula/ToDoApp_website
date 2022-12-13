<?php
class Utilisateur{
    private string $pseudo;
    private string $mail;
    private string $motDePasse;
    
    public function __construct(string $pseudo, string $mail, string $motDePasse){
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->motDePasse =$motDePasse;
    }

    public function getPseudo(){
        return $this->pseudo;
    }

    public function __toString(){
        return "Pseudo: " . $this->pseudo;
    }
}
?>
