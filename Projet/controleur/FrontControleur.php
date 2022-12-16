<?php

class FrontControleur{
    public function __construct(){
        session_start();
        $liste_actions_utilisateur = array('ajoutListeTachePrivee','deconnexion','afficherTachesPrivee','rendrePublique','rendrePrivee');
        $liste_actions_visiteur = array('validationFormulaire','afficherTaches','validationFormulaireI','inscription','ajoutListeTache','supprimerListeTache','ajoutTache','supprimerTache','checkTache');
        global $rep,$vues;
        try{
            $MdlUtilisateur = new ModelUtilisateur();
            $admin= 'NULL';
            $utilisateur = $MdlUtilisateur->isUtilisateur();

            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;


            //verif action
            if( in_array($action,$liste_actions_utilisateur)){
                if($utilisateur == null){
                    new VisiteurControleur();
                }
                else{
                    new UtilisateurControleur();
                }
            }
            else {
                new VisiteurControleur();
            }
        }
        catch (PDOException $e)
		{
			$dVueEreur[] =	"Erreur inattendue!!! ";
			require ($rep.$vues['erreur']);
		}
    }
}
?>