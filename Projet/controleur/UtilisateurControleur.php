<?php

class UtilisateurControleur{

    function __construct() {
        global $rep,$vues; // nécessaire pour utiliser variables globales

        $dVueEreur = array ();
        $action = $_REQUEST['action']??null;

        try{

            switch($action) {
                case "ajoutListeTachePrivee":
                    $this->AjouterListeTachePrivee();
                    break;

                case "deconnexion":
                    $this->Deconnexion();
                    break;

                case "afficherTachesPrivee":
                    $this->AfficherTachesPrivee();
                    break;
                
                case "rendrePublique":
                    $this->RendrePublique();
                    break;
                
                case "rendrePrivee":
                    $this->RendrePrivée();
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

    // function Redirection(){
    //     global $rep,$vues;
    //     $mdlVisiteur = new ModelVisiteur();
    //     $mdlUtilisateur = new ModelUtilisateur();
    //     $mdlAdmin = new ModelAdmin();

    //     if($_SESSION['role']=='utilisateur'){
    //         var_dump("zz");
    //         require ($rep.$vues['vueAfficherTachesPrivee']);
           
    //     }
    //     // elseif($mdlAdmin->isAdmin()==NULL){
    //     //     require ($rep.$vues['vueAfficherTaches']);
    //     // }
    //     else {
    //         require ($rep.$vues['vueAfficherTaches']);
    //     }

    // }

    function Deconnexion() {
        global $rep,$vues; // nécessaire pour utiliser variables globales

        $model = new ModelUtilisateur();
        $model->deconnexion();

        $connexion = new VisiteurControleur();
    }

    function AjouterListeTachePrivee(){
        global $rep,$vues;
        $mdl = new ModelUtilisateur();

        $nom = $_POST['nomTache'];
        $id = (int)$_SESSION['id'];
        $mdl->ajoutListePrivee($nom, $id);

        $this->AfficherTachesPrivee();
    }

    function AfficherTachesPrivee(){
        global $rep,$vues; // nécessaire pour utiliser variables globales
        $mdl = new ModelUtilisateur();
        $listesTachesPrivee = array();
        $id = (int)$_SESSION['id'];
        $listesTachesPrivee = $mdl->getListesPrivee($id);
        // var_dump("zz");
        
        require ($rep.$vues['vueAfficherTachesPrivee']);
    }

    function RendrePublique(){
        global $rep,$vues; // nécessaire pour utiliser variables globales
        $mdl = new ModelUtilisateur();
        $idListe = (int)$_SESSION['idListe'];
        var_dump($idListe);
        $mdl->rendrePublique($id);
        require ($rep.$vues['vueAfficherTachesPrivee']);
    }

    function RendrePrivée(){
        global $rep,$vues; // nécessaire pour utiliser variables globales
        $mdl = new ModelUtilisateur();
        $idListe = (int)$_SESSION['idListe'];
        var_dump($idListe);
        $mdl->rendrePrivée($id);
        require ($rep.$vues['vueAfficherTachesPrivee']);
    }

    
}
?>