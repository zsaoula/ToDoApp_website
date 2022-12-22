<?php
class Admin extends Utilisateur{
    public function __construct(int $id,string $pseudo, string $mail){
        parent::__construct($id,$pseudo,$mail);
    }
}
?>