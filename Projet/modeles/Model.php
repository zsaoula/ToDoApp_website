<?php

class Model
{
    function get_data() : string
    {
    return "Mon modèle ne fait rien";
    }

    function verifier_connexion($nom,$email,$mdp) : bool
    {
        global $dsn, $username, $password;

        $gwUtilisateur = new UtilisateurGateway(new Connection($dsn,$username,$password));

        $utilisateur = $gwUtilisateur->connexion($nom,$email,$mdp);

        if(empty($utilisateur)){
            return false;
        }
        return true;
    }

    function inscription($nom,$email,$mdp) : void {
        global $dsn, $username, $password;
        $gwInscription = new UtilisateurGateway(new Connection($dsn,$username,$password));
        $gwInscription->ajoutUtilisateur($nom,$email,$mdp);
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