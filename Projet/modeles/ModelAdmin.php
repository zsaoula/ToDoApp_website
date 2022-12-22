<?php

class ModelAdmin extends ModelUtilisateur
{

    function isAdmin()
    {
        if(isset($_SESSION['login']) && isset($_SESSION['role'])){
            $id = Validation::nettoyer_string($_SESSION['id']);
            $login = Validation::nettoyer_string($_SESSION['login']);
            $role = Validation::nettoyer_string($_SESSION['role']);
            return new Admin($id,$login,$role);
        }
        else
            return NULL;
    }

    function deconnexion() 
    {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public function getListesAdmin(): array {
        global $dsn, $username, $password;

        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));
        $gwListeTache = new ListeTachesGateway(new Connection($dsn,$username,$password));

        $listePublic = $gwListeTache->getAdminLists();
        
        $listeTacheTableau = array();

        foreach($listePublic as $listTaches)
        {
            $taches = $gwTache->getTaches($listTaches['id']);
            $tache = array();
            foreach($taches as $tacheAdd)
            {
                $tache[] = new Tache($tacheAdd['id'],$tacheAdd['name'],$tacheAdd['creationDate'],$tacheAdd['finish'],$tacheAdd['priorite'],$tacheAdd['noListe']);
            }

            $listeTacheTableau[] = new ListeTaches($listTaches['id'],$listTaches['name'],$listTaches['type'],$tache);
        }
        return $listeTacheTableau;
    }
}

?>