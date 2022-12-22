<?php

class AdminControleur{

    function __construct() {
        global $rep,$vues; // nécessaire pour utiliser variables globales

        $dVueEreur = array ();
        $action = $_REQUEST['action'] ?? null;

        try{

            switch($action) {
                case "afficherTachesAdmin":
                    $this->AfficherAdminTaches();
                    break;
                
                case "supprimerListeTacheAdmin":
                    $this->SupprimerListeTache();
                    break;
                
                case "supprimerTacheAdmin":
                    $this->SupprimerTache();
                    break;
                
                case "editerTacheAdmin":
                    $this->EditerTache();
                    break;

                //mauvaise action
                default:
                        $dVueEreur[] =	"Erreur d'appel php (admin)";
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
			$dVueEreur[] =	"Erreur inattendue dans le controleur Admin! ";
			require ($rep.$vues['erreur']);
		}

        
        exit(0);
    }

    function AfficherAdminTaches(){
        global $rep,$vues; // nécessaire pour utiliser variables globales
        $mdl = new ModelAdmin();
        $listesTachesAdmin = array();
        $listesTachesAdmin = $mdl->getListesAdmin();
        
        require ($rep.$vues['vueAfficherTachesAdmin']);
    }

    function SupprimerListeTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $id = $_REQUEST['id'];
        $mdl->supprimerListePublic($id);
        $this->AfficherAdminTaches();
    }

    function SupprimerTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
        $idTache = $_POST['idTache'];
        $mdl->supprimerTache($idTache);

        $this->AfficherAdminTaches();
    }

    function EditerTache(){
        global $rep,$vues;
        $mdl = new ModelVisiteur();
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
    
        $this->AfficherAdminTaches();
    }
}
?>