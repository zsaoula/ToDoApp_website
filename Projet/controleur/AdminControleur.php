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

    static function AfficherAdminTaches(){
        global $rep,$vues; // nécessaire pour utiliser variables globales
        $mdl = new ModelAdmin();
        $listesTachesAdmin = array();
        $listesTachesAdmin = $mdl->getListesAdmin();
        
        require ($rep.$vues['vueAfficherTachesAdmin']);
    }
}
?>