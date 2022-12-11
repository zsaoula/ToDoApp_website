<? 

class VisiteurControleur{

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
                $this->Connexion();
                break;

            case "inscription":
                $this->Inscription();
                break;

            case "connection":
                $this->Connexion();
                break;
            case "validationFormulaireConnexion":
				$this->ValidationFormulaireConnexion($dVueEreur);
			    break;
            
            case "validationFormulaireInscription":
                $this->ValidationFormulaireInscription($dVueEreur);
            break;

			case "afficherTachesPubliques":
				$this->AfficherTachesPubliques();
			    break;
            
            case "afficherListePublique":

            case "creerTachePublique":

            case "supprimerTachePublique":

            case "checkTachePublique":

            case "uncheckTachePublique":

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

    function AfficherTachesPubliques() {
        global $rep,$vues; // nécessaire pour utiliser variables globales
        $mdl = new Model();
        $listesTachesPublic = array();
        $listesTachesPublic = $mdl->getListesPublic();
        require ($rep.$vues['vueAfficherTaches']);
    }

    function AfficherListePublique() {
        global $rep,$vues; // nécessaire pour utiliser variables globales
        $mdl = new Model();
        $listesTachesPublic = array();
        $listesTachesPublic = $mdl->getListesPublic();
        require ($rep.$vues['vueAfficherListePublique']);
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
    
    function ValidationFormulaireConnexion(array $dVueEreur) {
        global $rep,$vues;
    
    
        //si exception, ca remonte !!!
        $nom=$_POST['txtNom']; // txtNom = nom du champ texte dans le formulaire
        $email=$_POST['txtEmail'];
        $mdp=$_POST['txtMdp'];
        Validation::val_form($nom,$email,$mdp,$dVueEreur);
    
        $model = new Model();
        $data=$model->verifierConnexion();
    
        $dVue = array (
            'nom' => $nom,
            'email' => $email,
            'mdp' => $mdp,
            'data' => $data,
        );
        require ($rep.$vues['vueConnexion']);
    }
    
    function ValidationFormulaireInscription(array $dVueEreur) {
        global $rep,$vues;
    
        //si exception, ca remonte !!!
        $nom=$_POST['txtNom']; // txtNom = nom du champ texte dans le formulaire
        $email=$_POST['txtEmail'];
        $mdp=$_POST['txtMdp'];
        Validation::val_form($nom,$email,$mdp,$dVueEreur);
    
        $model = new Model();
        $data=$model->verifierConnexion();
    
        $dVue = array (
            'nom' => $nom,
            'email' => $email,
            'mdp' => $mdp,
            'data' => $data,
        );
        require ($rep.$vues['vueConnexion']);
    }
}
?>