<? 

class UtilisateurControleur{

    function __construct($action) {
        global $rep,$vues; // nécessaire pour utiliser variables globales

        // on démarre ou reprend la session si necessaire (préférez utiliser un modèle pour gérer vos session ou cookies)
        session_start();

        //debut

        //on initialise un tableau d'erreur
        $dVueEreur = array ();

        try{

            switch($action) {

            case NULL:
                //$this->;
                break;

            case "ajouterListePrive":

            case "supprimerListePrive":
            
            case "afficherListePrive":
            
            case "deconnecter":

            case "creerTachePrive":

            case "supprimerTachePrive":

            case "afficherTachesPrivees":

            case "checkTachePrive":

            case "uncheckTachePrive":

            //mauvaise action
            default:
                    $dVueEreur[] =	"Erreur d'appel php";
                    require ($rep.$vues['erreur']);
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
}
?>