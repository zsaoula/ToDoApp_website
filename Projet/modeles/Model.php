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
        $gwListeTache = new ListeTacheGateway(new Connection($dsn,$username,$password));

        $listePublic = $gwListeTache->getPublicLists();
        
        foreach($listePublic as $listTaches)
        {
            $taches = $gwTache->getTaches($listTache['id']);
            $tache = array();
            foreach($taches as $tacheAdd)
            {
                $tache[] = new Tache($tacheAdd['id'],$tacheAdd['name'],$tacheAdd['creationDate'],$tacheAdd['finish'],$tacheAdd['idList']);
            }

            $listeTacheTableau[] = new ListeTache($listTache['id'],$listTache['name'],$listTache['type'],$taches);
        }
        return $listeTacheTableau;
    }
}
?> 