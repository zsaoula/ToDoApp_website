<?php

class Model
{
    function get_data() : string
    {
    return "Mon modèle ne fait rien";
    }

    function verifier_connexion($email,$mdp) 
    {
        global $dsn, $username, $password;
        //$email = Validation::clearString($email);
        //$mdp = Validation::clearString($mdp);

        $gwUtilisateur = new UtilisateurGateway(new Connection($dsn,$username,$password));
        $hash = $gwUtilisateur->getCredentiale($email);
        //password_verify($mdp,$hash[0]['mdp'])
        $nom = $hash[0]['nom'];
        if($mdp == $hash[0]['mdp']){
               $_SESSION['role']='utilisateur';
               $_SESSION['login']=$hash[0]['nom'];
               return new Utilisateur($nom,$email,$mdp);
        }
        // return new Utilisateur($hash['nom'],$email,$mdp);
        return NULL;
    }

    function inscription($nom,$email,$mdp) : void {
        global $dsn, $username, $password;
        $gwInscription = new UtilisateurGateway(new Connection($dsn,$username,$password));
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

    function ajouterTache(string $name, string $creationDate, int $noListe) : void {
        global $dsn, $username, $password;
        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));
        $gwTache->ajouterTache($name, $creationDate, $noListe);
    }

    function supprimerTache(string $idTache) : void {
        global $dsn, $username, $password;
        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));
        $gwTache->supprimerTache($idTache);
    }

    public function getListesPublic(): array {
        global $dsn, $username, $password;

        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));
        $gwListeTache = new ListeTachesGateway(new Connection($dsn,$username,$password));

        $listePublic = $gwListeTache->getPublicLists();
        
        foreach($listePublic as $listTaches)
        {
            $taches = $gwTache->getTaches($listTaches['id']);
            $tache = array();
            foreach($taches as $tacheAdd)
            {
                #$time_input = strtotime($tacheAdd['creationDate']); 
                #$newformat = date('Y-m-d',$time_input);
                $tache[] = new Tache($tacheAdd['id'],$tacheAdd['name'],$tacheAdd['creationDate'],$tacheAdd['finish'],$tacheAdd['noListe']);
            }

            $listeTacheTableau[] = new ListeTaches($listTaches['id'],$listTaches['name'],$listTaches['type'],$tache);
        }
        return $listeTacheTableau;
    }
}
?> 