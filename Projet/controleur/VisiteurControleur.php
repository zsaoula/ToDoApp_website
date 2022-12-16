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
                        require ($rep.$vues['vueConnexion']);
                        break;
            }

        }
         catch (PDOException $e)
		{
			//si erreur BD, pas le cas ici
			$dVueEreur[] =	"Erreur inattendue!!! ";
			require ($rep.$vues['erreur']);
		}
		catch (Exception $e2)
		{
			$dVueEreur[] =	"Erreur inattendue!!! ";
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
    
    function ValidationFormulaire(array $dVueEreur) {
        global $rep,$vues;
    
    
        //si exception, ca remonte !!!
        //$nom=$_POST['nom']; // txtNom = nom du champ texte dans le formulaire
        $email=$_POST['email'];
        $mdp=$_POST['mdp'];
        //Validation::val_form($nom,$email,$mdp,$dVueEreur);
        $model = new ModelVisiteur();
        $data=$model->verifier_connexion($email,$mdp);
    
        //require ($rep.$vues['vueConnexion']);
        
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
}
?>