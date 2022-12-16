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
        
        require ($rep.$vues['vueAfficherTachesPrivee']);
    }
}
?>