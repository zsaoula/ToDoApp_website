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

				case "deconnexion":
					$this->Deconnexion();
				break;

				case "ajoutListeTache":
					$this->AjouterListeTache();
				break;
				case "ajoutListeTachePrivee":
					$this->AjouterListeTachePrivee();
				break;

				case "supprimerListeTache":
					$this->SupprimerListeTache();
				break;

				case 'afficherTachesPrivee':
					$this->AfficherTachesPrivee();
				break;

				case "ajoutTache":
					$this->AjouterTachePublique();
				break;

				case "ajoutTachePrivee":
					$this->AjouterTachePrivee();
				break;

				case "supprimerTache":
					$this->SupprimerTache();
				break;
				case "checkTache":
					$this->CheckTache();
				break;
				case "editerTache":
					$this->EditerTache();

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

function Deconnexion() {
	global $rep,$vues; // nécessaire pour utiliser variables globales

	$model = new ModelUtilisateur();
	$model->deconnexion();

	$this->Connexion();
}

function ValidationFormulaire(array $dVueEreur) {
	global $rep,$vues;


	//si exception, ca remonte !!!
	//$nom=$_POST['nom']; // txtNom = nom du champ texte dans le formulaire
	$email=$_POST['email'];
	$mdp=$_POST['mdp'];
	//Validation::val_form($nom,$email,$mdp,$dVueEreur);
	$model = new Model();
	$data=$model->verifier_connexion($email,$mdp);

	//require ($rep.$vues['vueConnexion']);
	
	if($data!=NULL){
		$this->AfficherTaches();
	}

	// $dVue = array (
	// 	'nom' => $nom,
	// 	'email' => $email,
	// 	'mdp' => $mdp,
	// 	'data' => $data,
	// );
	// require ($rep.$vues['vueConnexion']);
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

function AjouterListeTachePrivee(){
	global $rep,$vues;
	$mdl = new Model();

	$nom = $_POST['nomTache'];
	$id = (int)$_SESSION['id'];
	$mdl->ajoutListePrivee($nom, $id);

	

	$this->AfficherTachesPrivee();

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

function AjouterTachePublique(){
	global $rep,$vues;
	$mdl = new Model();

	$nameTache = $_POST['nameTache'];
	$dateTache = date('Y-m-d', time());
	$typePriorite = $_POST['ajoutPriorite'];
	$listeTache = $_POST['listeTache'];
	$mdl->ajouterTache($nameTache,$dateTache,$typePriorite,$listeTache);

	$this->AfficherTaches();
	//require ($rep.$vues['vueAfficherTaches']);
}


function SupprimerTache(){
	global $rep,$vues;
	$mdl = new Model();

	$idTache = $_REQUEST['idTache'];
	$mdl->supprimerTache($idTache);

	$this->AfficherTaches();
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

function CheckTache(){
	global $rep,$vues;
	$mdl = new Model();

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

	$this->AfficherTaches();
	//require ($rep.$vues['vueAfficherTaches']);
}

function EditerTache(){
	global $rep,$vues;
	$mdl = new Model();

	$nameTache = $_POST['nameTache'];
	$typePriorite = $_POST['editPriorite'];
	$idTache = $_POST['idTache'];
	// var_dump($nameTache);
	// var_dump($typePriorite);
	// var_dump($idTache);
	$mdl->editerTache($nameTache,$idTache,$typePriorite);

	$this->AfficherTaches();
	//require ($rep.$vues['vueAfficherTaches']);
}

}//fin class

?>
