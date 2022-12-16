function AfficherTaches() {
        global $rep,$vues; // nécessaire pour utiliser variables globales
        $mdl = new ModelVisiteur();
        $listesTachesPublic = array();
        $listesTachesPublic = $mdl->getListesPublic();
        require ($rep.$vues['vueAfficherTaches']);
    }
    
    function Inscription() {
        global $rep,$vues; // nécessaire pour utiliser variables globales
    
        $dVue = array (
            'nom' => "",
            'email' => "",
            'mdp' => ""
        );
    
        require ($rep.$vues['vueInscription']);
    }
    
    function Connexion() {
        global $rep,$vues; // nécessaire pour utiliser variables globales
    
        $dVue = array (
            'nom' => "",
            'email' => "",
            'mdp' => ""
        );
        require ($rep.$vues['vueConnexion']);
    }
    
    function ValidationFormulaire() {
        global $rep,$vues;
        $dVueEreur = array();
        $email=$_POST['email'];
        $mdp=$_POST['mdp'];
        Validation::val_form($nom,$email,$mdp,$dVueEreur);
        $model = new ModelVisiteur();
        $data=$model->connexion($email,$mdp);

        try{
            
        }
        
        if($data!=NULL){
            $this->AfficherTaches();
        }
    
        // $dVue = array (
        // 	'nom' => $nom,
        // 	'email' => $email,
        // 	'mdp' => $mdp,
        // 	'data' => $data,
        // );
        // require ($rep.$vues['vueConnexion']);
    }
    
    function ValidationFormulaireInscription(array $dVueEreur) {
        global $rep,$vues;
    
    
        //si exception, ca remonte !!!
        $nom=$_POST['name']; 
        $email=$_POST['email'];
        $mdp=$_POST['mdp'];
        //Validation::val_form($nom,$email,$mdp,$dVueEreur);
        $model = new ModelVisiteur();
        var_dump($mdp);
        $data=$model->inscription($nom,$email,$mdp);
    
        $this->Connexion();
    }
    
    function AjouterListeTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
    
        $nom = $_POST['nomTache'];
        $mdl->ajoutListePublic($nom);
    
        
    
        $this->AfficherTaches();
    
        //require ($rep.$vues['vueAfficherTaches']);
    }
    function SupprimerListeTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
    
        $id = $_REQUEST['id'];
        $mdl->supprimerListePublic($id);
        
        $this->AfficherTaches();
        //require ($rep.$vues['vueAfficherTaches']);
    }
    
    function AjouterTachePublique(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();

        $nameTache = $_POST['nameTache'];
        $dateTache = date('Y-m-d', time());
        $typePriorite = $_POST['ajoutPriorite'];
        $listeTache = (int)$_POST['listeTache'];
        $mdl->ajouterTache($nameTache,$dateTache,$typePriorite,$listeTache);

        $this->AfficherTaches();
    }
    
    
    function SupprimerTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
    
        $idTache = $_REQUEST['idTache'];
        $mdl->supprimerTache($idTache);
    
        $this->AfficherTaches();
        //require ($rep.$vues['vueAfficherTaches']);
    }
    
    function CheckTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
    
        $tachesAChecker=array();
    
        foreach ($_POST as $key => $value) {
            if($key != 'action'){
                if ($key == 'listeTache'){
                $listeTache=$value;
                }
                else{
                $tachesAChecker[] = $value;
            }
        
        }
        }
    
        $mdl->checkerTaches($listeTache,$tachesAChecker);
    
        $this->AfficherTaches();
        //require ($rep.$vues['vueAfficherTaches']);
    }

    function EditerTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
    
        $nameTache = $_POST['nameTache'];
        $typePriorite = $_POST['editPriorite'];
        $idTache = $_POST['idTache'];
        // var_dump($nameTache);
        // var_dump($typePriorite);
        // var_dump($idTache);
        $mdl->editerTache($nameTache,$idTache,$typePriorite);
    
        $this->AfficherTaches();
        //require ($rep.$vues['vueAfficherTaches']);
    }

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
}

?>