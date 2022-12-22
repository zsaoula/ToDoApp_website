<?php

class UtilisateurControleur{

    function __construct() {
        global $rep,$vues; // nécessaire pour utiliser variables globales

        $dVueEreur = array ();
        $action = $_REQUEST['action'] ?? null;

        try{

            switch($action) {
                case "ajoutListeTachePrivee":
                    $this->AjouterListeTachePrivee();
                    break;

                case "deconnexion":
                    $this->Deconnexion();
                    break;

                case "ajouterTachePrivee":
                    $this->AjouterTachePrivee();
                    break;

                case "afficherTachesPrivee":
                    $this->AfficherTachesPrivee();
                    break;

                case "supprimerListeTachePrivee":
                    $this->SupprimerListeTache();
                    break;
                
                case "ajoutTachePrivee":
                    $this->AjouterTachePrivee();
                    break;
                
                case "supprimerTachePrivee":
                    $this->SupprimerTache();
                    break;
                
                case "editerTachePrivee":
                    $this->EditerTache();
                    break;
                
                case "checkTachePrivee":
                    $this->CheckTache();
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
			$dVueEreur[] =	"Erreur inattendue dans le controleur Utilisateur! ";
			require ($rep.$vues['erreur']);
		}

        
        exit(0);
    }

    function Deconnexion() {
        global $rep,$vues; // nécessaire pour utiliser variables globales

        $model = new ModelUtilisateur();
        $model->deconnexion();

        $action = "connexion";

        VisiteurControleur::Connexion();
    }

    function AjouterListeTachePrivee(){
        global $rep,$vues;
        $mdl = new ModelUtilisateur();
        $dVueEreur = array();
        $nom = $_POST['nomTache'];
        $id = (int)$_SESSION['id'];
        Validation::val_form_ajout($nom,$dVueEreur);

        if(empty($dVueEreur))
        {
            $mdl->ajoutListePrivee($nom, $id);
        }
        $this->AfficherTachesPrivee($dVueEreur);
    }

    static function AfficherTachesPrivee(array $dVueEreur= array()){
        global $rep,$vues; // nécessaire pour utiliser variables globales
        $mdl = new ModelUtilisateur();
        $listesTachesPrivee = array();
        $id = (int)$_SESSION['id'];
        $listesTachesPrivee = $mdl->getListesPrivee($id);
        
        require ($rep.$vues['vueAfficherTachesPrivee']);
    }

    function AjouterTachePrivee(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $mdlU = new ModelUtilisateur();


        $nameTache = $_POST['nameTache'];
        $dateTache = date('Y-m-d', time());
        $typePriorite = $_POST['ajoutPriorite'];
        $listeTache = (int)$_POST['listeTache'];
        $mdl->ajouterTache($nameTache,$dateTache,$typePriorite,$listeTache);

        $this->AfficherTachesPrivee();   
    }

    function SupprimerListeTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $id = $_REQUEST['id'];
        $mdl->supprimerListePublic($id);
        $this->AfficherTachesPrivee();
    }

    function SupprimerTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $idTache = $_POST['idTache'];
        $mdl->supprimerTache($idTache);

        $this->AfficherTachesPrivee();
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

        $this->AfficherTachesPrivee();
    }

    function EditerTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $mdlUtilisateur = new ModelUtilisateur();
        $dVueEreur = array();
        $nameTache = $_POST['nameTache'];
        if(!isset($_POST['editPriorite'])){
            $typePriorite = "Faible";
        }
        else {
            $typePriorite = $_POST['editPriorite'];
        }
        $idTache = $_POST['idTache'];
        Validation::val_form_ajout_tache($nameTache,$typePriorite,$dVueEreur);
        $mdl->editerTache($nameTache,$idTache,$typePriorite);
    
        $this->AfficherTachesPrivee();
    }
}
?>