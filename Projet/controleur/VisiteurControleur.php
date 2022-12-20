<?php

class VisiteurControleur{

    function __construct() {
        global $rep,$vues; // nécessaire pour utiliser variables globales

        //debut

        //on initialise un tableau d'erreur
        $dVueEreur = array ();
        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : NULL;
        try{

            switch($action) {
                case NULL:
                    $this->Connexion();
                     break;

                case "validationFormulaire":
                    $this->ValidationFormulaire($dVueEreur);
                    break;

                case "afficherTaches":
                    $this->AfficherTaches();
                    break;

                case "validationFormulaireI":
                    $this->ValidationFormulaireInscription($dVueEreur);
                    break;

                case "inscription":
                    $this->Inscription();
                    break;

                case "ajoutListeTache":
                    $this->AjouterListeTache();
                    break;

                case "supprimerListeTache":
                    $this->SupprimerListeTache();
                    break;

                case "ajoutTache":
                    $this->AjouterTachePublique();
                    break;

                case "supprimerTache":
                    $this->SupprimerTache();
                    break;
                    
                case "checkTache":
                    $this->CheckTache();
                    break;

                case "editerTache":
                    $this->EditerTache();
                    break;
                
                case "connexion":
                    $this->Connexion();
                     break;

                //mauvaise action
                default:
                        $dVueEreur[] =	"Erreur d'appel php";
                        require ($rep.$vues['erreur']);
                        break;
            }

        }
        catch (PDOException $e)
        {
            $dVueEreur[] =	"Erreur liée à la base de donnée! ";
            require ($rep.$vues['erreur']);
        }
        catch (Exception $e2)
        {
            $dVueEreur[] =	"Erreur inattendue dans le controleur Visiteur! ";
            require ($rep.$vues['erreur']);
        }

        
        exit(0);
    }

    function AfficherTaches(array $dVueEreur = array()) {
        global $rep,$vues; 
        $mdl = new ModelVisiteur();
        $listesTachesPublic = array();
        $listesTachesPublic = $mdl->getListesPublic();
        require ($rep.$vues['vueAfficherTaches']);
    }
    
    function Inscription() {
        global $rep,$vues; 
        require ($rep.$vues['vueInscription']);
    }
    
    static function Connexion() {
        global $rep,$vues; 
        require ($rep.$vues['vueConnexion']);
    }
    
    function ValidationFormulaire() {
        global $rep,$vues;
        $dVueEreur = array();
        $email=$_POST['email'];
        $mdp=$_POST['mdp'];
        
        Validation::val_form_connexion($email,$mdp,$dVueEreur);
        $model = new ModelVisiteur();
        if(!empty($dVueEreur)){
            
            require ($rep.$vues['vueConnexion']);
        }
        else{
            $data=$model->connexion($email,$mdp);
            if($data!=NULL){
                $this->AfficherTaches();
            }
            else{
                $dVueEreur['all2'] = "Mot de passe ou adresse mail incorrect!";
                require ($rep.$vues['vueConnexion']);
            }
        }
    }
    
    function ValidationFormulaireInscription() {
        global $rep,$vues;
        $model = new ModelVisiteur();
        $dVueEreur = array();

        $nom=$_POST['nom']; 
        $email=$_POST['email'];
        $mdp=$_POST['mdp'];
        $mdp2=$_POST['mdp2'];
        Validation::val_form_inscription($nom,$email,$mdp,$mdp2,$dVueEreur);
        if(!empty($dVueEreur)){
            require ($rep.$vues['vueInscription']);
        }
        else{
            $model->inscription($nom,$email,$mdp);
            $this->Connexion();
        }
    }
    
    function AjouterListeTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $dVueEreur = array();
        $nom = $_POST['nomTache'];
        Validation::val_form_ajout($nom,$dVueEreur);

        if(empty($dVueEreur))
        {
            $mdl->ajoutListePublic($nom);
        }
        $this->AfficherTaches($dVueEreur);
    }

    function SupprimerListeTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $mdlUtilisateur = new ModelUtilisateur();
        $id = $_POST['id'];
        $mdl->supprimerListePublic($id);
        if($mdlUtilisateur->isUtilisateur()){
            UtilisateurControleur::AfficherTachesPrivee();
        }
        else{
            $this->AfficherTaches();
        }
    }
    
    function AjouterTachePublique(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $mdlU = new ModelUtilisateur();
        $dVueEreur = array ();

        $nameTache = $_POST['nameTache'];
        $dateTache = date('Y-m-d', time());
        if(!isset($_POST['ajoutPriorite'])){
            $typePriorite = "Faible";
        }
        else {
            $typePriorite = $_POST['ajoutPriorite'];
        }
        $listeTache = (int)$_POST['listeTache'];
        Validation::val_form_ajout_tache($nameTache,$typePriorite,$dVueEreur);
        $mdl->ajouterTache($nameTache,$dateTache,$typePriorite,$listeTache);

        $this->AfficherTaches();   
    }
    
    
    function SupprimerTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $mdlUtilisateur = new ModelUtilisateur();
        $idTache = $_POST['idTache'];
        $mdl->supprimerTache($idTache);

        if($mdlUtilisateur->isUtilisateur()){
            UtilisateurControleur::AfficherTachesPrivee();
        }
        else{
            $this->AfficherTaches();
        }
    }
    
    function CheckTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $mdlUtilisateur = new ModelUtilisateur();
    
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

        if($mdlUtilisateur->isUtilisateur()){
            UtilisateurControleur::AfficherTachesPrivee();
        }
        else{
            $this->AfficherTaches();
        }
    }

    function EditerTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $mdlUtilisateur = new ModelUtilisateur();
    
        $nameTache = $_POST['nameTache'];
        $typePriorite = $_POST['editPriorite'];
        $idTache = $_POST['idTache'];
        $mdl->editerTache($nameTache,$idTache,$typePriorite);
    
        if($mdlUtilisateur->isUtilisateur()){
            UtilisateurControleur::AfficherTachesPrivee();
        }
        else{
            $this->AfficherTaches();
        }
    }
}
?>