<?php

class ModelUtilisateur
{
    function connexion($email,$mdp) 
    {
        global $dsn, $username, $password;
        //$email = Validation::clearString($email);
        //$mdp = Validation::clearString($mdp);

        $gwUtilisateur = new UtilisateurGateway(new Connection($dsn,$username,$password));
        $hash = $gwUtilisateur->getCredentiale($email);
        //password_verify($mdp,$hash[0]['mdp'])
        $nom = $hash[0]['nom'];
        $mdpHash = $hash[0]['mdp'];
        var_dump($mdpHash);
        if(password_verify($mdp,$mdpHash)){
            var_dump("rr");
               $_SESSION['role']='utilisateur';
               $_SESSION['login']=$hash[0]['nom'];
               $_SESSION['id']=$hash[0]['id'];
               return new Utilisateur($hash[0]['id'],$nom,$email);
        }
        // return new Utilisateur($hash['nom'],$email,$mdp);
        return NULL;
    }

    function isUtilisateur()
    {
        if(isset($_SESSION['login']) && isset($_SESSION['role'])){
            $id = Validation::nettoyer_string($_SESSION['id']);
            $login = Validation::nettoyer_string($_SESSION['login']);
            $role = Validation::nettoyer_string($_SESSION['role']);
            return new Utilisateur($id,$login,$role);
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

    function ajoutListePrivee($nom,$id) : void {
        global $dsn, $username, $password;
        $gwListeTache = new ListeTachesGateway(new Connection($dsn,$username,$password));
        $gwListeTache->ajoutListePrivee($nom,$id);
    }

    public function getListesPrivee(int $id): array {
        global $dsn, $username, $password;

        $gwTache = new TacheGateway(new Connection($dsn,$username,$password));
        $gwListeTache = new ListeTachesGateway(new Connection($dsn,$username,$password));

        $listePublic = $gwListeTache->getPriveeLists($id);
        
        $listeTacheTableau = array();

        foreach($listePublic as $listTaches)
        {
            $taches = $gwTache->getTaches($listTaches['id']);
            $tache = array();
            foreach($taches as $tacheAdd)
            {
                #$time_input = strtotime($tacheAdd['creationDate']); 
                #$newformat = date('Y-m-d',$time_input);
                $tache[] = new Tache($tacheAdd['id'],$tacheAdd['name'],$tacheAdd['creationDate'],$tacheAdd['finish'],$tacheAdd['priorite'],$tacheAdd['noListe']);
            }

            $listeTacheTableau[] = new ListeTaches($listTaches['id'],$listTaches['name'],$listTaches['type'],$tache);
        }
        return $listeTacheTableau;
    }

    public function rendrePublique(int $id){
        global $dsn, $username, $password;
        $gwListeTache = new ListeTachesGateway(new Connection($dsn,$username,$password));
        $gwListeTache->rendrePublique($id);
    }

    public function rendrePrivée(int $id){
        global $dsn, $username, $password;
        $gwListeTache = new ListeTachesGateway(new Connection($dsn,$username,$password));
        $gwListeTache->rendrePrivée($id);
    }
}

?>