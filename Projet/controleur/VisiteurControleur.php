<?php

class VisiteurControleur{

    function __construct() {
        global $rep,$vues; // nécessaire pour utiliser variables globales

        //debut

        //on initialise un tableau d'erreur
        $dVueEreur = array ();
        $action = $_REQUEST['action']??null;

        try{

            switch($action) {
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
        
        Validation::val_form_connexion($email,$mdp,$dVueEreur);
        $model = new ModelVisiteur();
        var_dump($dVueEreur);
        if(!empty($dVueEreur)){
            
            require ($rep.$vues['vueConnexion']);
        }
        else{
            $data=$model->connexion($email,$mdp);
            if($data!=NULL){
                $this->AfficherTaches();
            }
            else{
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
            var_dump($dVueEreur);
            $this->Connexion();
        }
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
    
        // $this->Redirection();
        require ($rep.$vues['vueAfficherTaches']);
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
}
?>