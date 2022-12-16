<? 

class UtilisateurControleur{

    function __construct() {
        global $rep,$vues; // nécessaire pour utiliser variables globales

        $dVueEreur = array ();
        $action = $_REQUEST['action']??null;

        try{

            switch($action) {

            case NULL:
                //$this->;
                break;

            case "ajoutListeTachePrivee":
                $this->AjouterListeTachePrivee();
				break;

            case "ajoutTachePrivee":
                $this->AjouterTachePrivee();
				break;

            case "deconnexion":
                $this->Deconnexion();
				break;

            case "afficherTachesPrivee":
                $this->AfficherTachesPrivee();
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

    function Deconnexion() {
        global $rep,$vues; // nécessaire pour utiliser variables globales

        $model = new ModelUtilisateur();
        $model->deconnexion();

        $connexion = new VisiteurControleur();
    }

    function AjouterListeTachePrivee(){
        global $rep,$vues;
        $mdl = new Model();

        $nom = $_POST['nomTache'];
        $id = (int)$_SESSION['id'];
        $mdl->ajoutListePrivee($nom, $id);

        $this->AfficherTachesPrivee();
    }

    function AjouterTachePrivee(){
        global $rep,$vues;
        $mdl = new Model();

        $nameTache = $_POST['nameTache'];
        $dateTache = date('m-d-Y', time());
        $typePriorite = "Important";
        $listeTache = $_POST['listeTache'];
        $mdl->ajouterTache($nameTache,$dateTache,$typePriorite,$listeTache);

        $this->AfficherTachesPrivee();
        //require ($rep.$vues['vueAfficherTaches']);
    }

    function AfficherTachesPrivee(){
        global $rep,$vues; // nécessaire pour utiliser variables globales
        $mdl = new Model();
        $listesTachesPrivee = array();
        $id = (int)$_SESSION['id'];
        $listesTachesPrivee = $mdl->getListesPrivee($id);
        require ($rep.$vues['vueAfficherTachesPrivee']);
    }
}
?>