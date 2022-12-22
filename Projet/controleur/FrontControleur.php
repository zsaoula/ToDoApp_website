<?php

class FrontControleur{
    public function __construct(){
        session_start();
        $liste_actions_admin = array('afficherTachesAdmin');
        $liste_actions_utilisateur = array('ajouterTachePrivee','ajoutListeTachePrivee','deconnexion','afficherTachesPrivee','supprimerListeTachePrivee','ajoutTachePrivee','supprimerTachePrivee','checkTachePrivee','editerTachePrivee');
        $liste_actions_visiteur = array('validationFormulaire','editerTache','afficherTaches','validationFormulaireI','connexion','inscription','ajoutListeTache','supprimerListeTache','ajoutTache','supprimerTache','checkTache');
        global $rep,$vues;
        try{
            $MdlUtilisateur = new ModelUtilisateur();
            $utilisateur = $MdlUtilisateur->isUtilisateur();

            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
            
            //verif action
            if( in_array($action,$liste_actions_admin)){
                if($utilisateur == null){
                    new VisiteurControleur();
                }
                else{
                    new AdminControleur();
                }
            }
            elseif( in_array($action,$liste_actions_utilisateur)){
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