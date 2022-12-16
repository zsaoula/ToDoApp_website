<?php

class ModelVisiteur
{

    function inscription($nom,$email,$mdp) : void {
        global $dsn, $username, $password;
        $gwInscription = new UtilisateurGateway(new Connection($dsn,$username,$password));
        $mdp = password_hash($mdp,PASSWORD_DEFAULT);
        $gwInscription->ajoutUtilisateur($nom,$email,$mdp);
    }

    function ajoutListePublic($nom) : void {
        global $dsn, $username, $password;
        $gwListeTache = new ListeTachesGateway(new Connection($dsn,$username,$password));
        $gwListeTache->ajoutListePublic($nom);
    }

    function supprimerListePublic($id) : void {
        global $dsn, $username, $password;
        $gwListeTache = new ListeTachesGateway(new Connection($dsn,$username,$password));
        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));

        $gwTache->supprimerTacheIdListe($id);
        $gwListeTache->supprimerListePublic($id);
    }

    function checkerTaches($listeTache,$taches): void {
        global $dsn, $username, $password;
        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));
        $gwTache->checkerTaches($listeTache,$taches);
    }

    function ajouterTache(string $name, string $creationDate, string $priorite, int $noListe ) : void {
        global $dsn, $username, $password;
        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));
        $gwTache->ajouterTache($name,$creationDate,$priorite, $noListe);
    }

    function supprimerTache(string $idTache) : void {
        global $dsn, $username, $password;
        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));
        $gwTache->supprimerTache($idTache);
    }

    function editerTache(string $nameTache,string $idTache,string $typePriorite) : void {
        global $dsn, $username, $password;
        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));
        $gwTache->editerTache($nameTache,$idTache,$typePriorite);
    }

    public function getListesPublic(): array {
        global $dsn, $username, $password;

        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));
        $gwListeTache = new ListeTachesGateway(new Connection($dsn,$username,$password));

        $listePublic = $gwListeTache->getPublicLists();

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
    function connexion($email,$mdp) 
    {
        global $dsn, $username, $password;
        $gwUtilisateur = new UtilisateurGateway(new Connection($dsn,$username,$password));
        $hash = $gwUtilisateur->getCredentiale($email);
        $nom = $hash[0]['nom'];
        $mdpHash = $hash[0]['mdp'];
        if(password_verify($mdp,$mdpHash)){
            $_SESSION['role']='utilisateur';
            $_SESSION['login']=$hash[0]['nom'];
            $_SESSION['id']=$hash[0]['id'];
            return new Utilisateur($hash[0]['id'],$nom,$email);
        }
        return NULL;
    }
}

?>