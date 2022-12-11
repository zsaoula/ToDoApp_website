<?php

class FrontControleur{
    public function __construct(){
        session_start();
        $liste_actions_utilisateur = array('','');
        $liste_actions_visiteur = array('','');
        $liste_actions_admin = array('','');
        global $rep,$vues;
        try{
            $admin = mdlAdmin.isAdmin();
            $utilisateur = mdlUtilisateur.isUtilisateur();

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
    }
}
?>