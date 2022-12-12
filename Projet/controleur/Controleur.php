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

				case "ajoutListeTache":
					$this->AjouterListeTache();
				break;

				case "supprimerListeTache":
					$this->SupprimerListeTache();
				break;
				case "ajoutTache":
					$this->AjouterTachePublique();

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

function AjouterListeTache(){
	global $rep,$vues;
	$mdl = new Model();

	$nom = $_POST['nomTache'];
	$mdl->ajoutListePublic($nom);

	$this->AfficherTaches();

	//require ($rep.$vues['vueAfficherTaches']);
}

function SupprimerListeTache(){
	global $rep,$vues;
	$mdl = new Model();

	$id = $_REQUEST['id'];
	$mdl->supprimerListePublic($id);

	$this->AfficherTaches();
	//require ($rep.$vues['vueAfficherTaches']);
}

function AjouterTachePublique(){
	global $rep,$vues;
	$mdl = new Model();

	$nameTache = $_POST['nameTache'];
	$dateTache = $_POST['dateTache'];
	$listeTache = $_POST['listeTache'];
	$mdl->ajouterTache($nameTache,$dateTache,$listeTache);

	$this->AfficherTaches();
	//require ($rep.$vues['vueAfficherTaches']);
}

}//fin class

?>
