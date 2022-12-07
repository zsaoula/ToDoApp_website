<?php

class Controleur {

	function __construct() {
		global $rep,$vues; // nécessaire pour utiliser variables globales
		
		// on démarre ou reprend la session si necessaire (préférez utiliser un modèle pour gérer vos session ou cookies)
		session_start();

		//on initialise un tableau d'erreur
		$dVueEreur = array ();

		try{
			if (empty($_REQUEST['action'])) {
                $action = NULL;
            } else {
                $action = $_REQUEST['action'];
            }

			switch($action) {

				//pas d'action, on r�initialise 1er appel
				case NULL:
					$this->Connexion();
					break;


				case "validationFormulaire":
					$this->ValidationFormulaire($dVueEreur);
				break;

				case "afficherTaches":
					$this->AfficherTaches();
				break;

				case "validationFormulaireInscription":
					$this->ValidationFormulaire($dVueEreur);
				break;

				case "inscription":
					$this->Inscription();
				break;

				//mauvaise action
				default:
				$dVueEreur[] =	"Erreur d'appel php";
				require ($rep.$vues['vueConnexion']);
				break;
			}
		} catch (PDOException $e)
		{
			//si erreur BD, pas le cas ici
			$dVueEreur[] =	"Erreur inattendue!!! ";
			require ($rep.$vues['vueConnexion']);
		}
		catch (Exception $e2)
		{
			$dVueEreur[] =	"Erreur inattendue!!! ";
			require ($rep.$vues['erreur']);
		}
	
		exit(0);
	}//fin constructeur


function AfficherTaches() {
	global $rep,$vues; // nécessaire pour utiliser variables globales
	$mdl = new Model();
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

}//fin class

?>
