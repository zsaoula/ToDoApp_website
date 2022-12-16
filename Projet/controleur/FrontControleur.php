<?php

class FrontControleur{
    public function __construct(){
        session_start();
        $liste_actions_utilisateur = array('ajoutListeTachePrivee','ajoutTachePrivee','deconnexion','afficherTachesPrivee');
        $liste_actions_visiteur = array('validationFormulaire','afficherTaches','validationFormulaireI','inscription','ajoutListeTache','supprimerListeTache','ajoutTache','supprimerTache','checkTache');
        $liste_actions_admin = array();
        global $rep,$vues;
        try{
            //$admin = mdlAdmin.isAdmin();
            $MdlUtilisateur = new ModelUtilisateur();
            $admin= 'NULL';
            $utilisateur = $MdlUtilisateur->isUtilisateur();

            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;


            //verif action
            if( in_array($action,$liste_actions_admin)){
                if($admin == null){
                    //new UtilisateurControleur();
                }
                else{
                    new AdminControleur($action);
                }
            }
            elseif( in_array($action,$liste_actions_utilisateur)){
                if($utilisateur == null){
                    new VisiteurControleur($action);
                    //require ($rep.$vues['Connexion']);
                }
                else{
                    new UtilisateurControleur($action);
                }
            }
            else {
                new VisiteurControleur($action);
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