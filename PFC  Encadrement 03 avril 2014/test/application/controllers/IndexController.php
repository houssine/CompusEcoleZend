<?php
//Chaque page d�clar�e dans views (.phtml) son action doit figur�e dans le fichier IndexController.php
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
     
   
    }
    //traitement � faire pour le formulaire d inscription d un �tudiant
	public function insetudiantAction()
    {
    	//instancier un objet de type formulaire insetudiant que nous avons cr�e
	    $form = new Application_Form_insetudiant();
	    //instancier un pbjet de type student qque nous avons cr�e dans le mod�le
	    $student = new Application_Model_student();
        //Tester le bouton valider : Si utilisateur (ici admin) clique sur valider voil� les traitements � faire
        if ($this->getRequest()->isPost()) {
               if (isset($_POST["Valider"])) {
               	//d�clarer une variable de type array (tableau) et y stocker les donn�es saisies dans le formulaire
                     $data = array(
					"id_groupe" => $this->getRequest()->getParam("id_groupe"),
					"id_campus" => $this->getRequest()->getParam("id_campus"),
                    "nom_etudiant" => $this->getRequest()->getParam("nom"),
					"prenom_etudiant" => $this->getRequest()->getParam("prenom"),
					"sexe" => $this->getRequest()->getParam("sexe"),
					"date_naissance" => $this->getRequest()->getParam("date"),
					"mail_etudiant" => $this->getRequest()->getParam("mail"),
					"mot_passe_etudiant" => $this->getRequest()->getParam("password")
                );
                //Ins�rer ces donn�es dans la table �tudiant dans la base de donn�es
				 $student->insert($data);	
	}
}
               //Afficher le formulaire
               $this->view->form = $form;
}
//M�me traitement pour l'inscription d'un professeur � la diff�rence 
//des classes � instancier et les donn�es � r�cup�rer depuis le formulaire
public function insprofAction()
    {
	$form = new Application_Form_insprof();
	$prof = new Application_Model_professeur();
    if ($this->getRequest()->isPost()) {
             if (isset($_POST["Valider"])) {
                    $data = array(
                    "nom_prof" => $this->getRequest()->getParam("nom"),
					"prenom_prof" => $this->getRequest()->getParam("prenom"),
					"mail_prof" => $this->getRequest()->getParam("mail"),
					"mot_passe_prof" => $this->getRequest()->getParam("password")
                );

				 $prof->insert($data);
				 
	
	}


}
$this->view->form = $form;
}

//Traite�ent de l'authentification de : Etudiant/Professeur/Administrateur
public function authAction()
    {
    	//manipuler les donn�es de session dans Zend Framework. 
    	//Les espaces de noms sont utilis�s pour isoler toutes les donn�es de session, bien qu'un espace de noms par d�faut existe 
    	//pour ceux qui veulent juste un endroit pour stocker toutes leurs donn�es de session. 
    	$sess = new Zend_Session_Namespace('User');
    	$form = new Application_Form_auth();
        if ($this->getRequest()->isPost()) {
 	    	$data = $this->getRequest()->getPost();
    		if($form->isValid($data)){
                 if (isset($_POST["seconnecter"])) {
                 	//R�cup�rer le type compte, login et le mot de passe
                   $typecompte=$this->getRequest()->getParam("compte");
                   $login=$this->getRequest()->getParam("mail");
                   $password=$this->getRequest()->getParam("password");
                   //la session prend la valeur de type compte
                   $sess->typecompte=$typecompte; 
            //Maintenant, nous traitons chaque cas � part et nous commen�ons par l'administrateur    
            if($typecompte=="Admin"){
            //Zend_Db_Table fait r�f�rence aux tables de la base de donn�es aussi d�clar�es dans le dossier models
	           $db = Zend_Db_Table_Abstract::getDefaultAdapter();
	         //On s�l�ctionne depuis la table admin le nombre d'id qui ont le m�me mot de passe et le m�me login 
	           $query = $db->select()
	                  ->from('admin','count(id_admin)')
                      ->where('mot_passe_admin = ?',$password)
                      ->where('id_admin= ?',$login);
            //Puis on d�lcare une variable $count qui va retourner soit 1 soit 0
            //puisque on ne peut avoir q'un seul admin qui respecte ces crit�res ou aucun
          $count= ($db->fetchOne($query));
          //Et on teste sur le r�sultat retourn�, si 1
          if ($count == 1) {
         //rediriger vers la page de choix d�di�e � l'administrateur uniquement
           $this->_redirect("index/choix");
          //stocker la valeur de login de l'administrateur dans la variable session           
           $sess->login=$login;        
         }
         // Sinon si la variable retourne 0 ou autre valeur(c'est impossible) on affiche un message d'erreur
          else {
          	$this->view->errors = array(0 => array('err' => 'Combinaison Email/Mot de passe non valide'));
          }
//m�me traitement pour Professeur et �tudiant	
}elseif ( $typecompte=="Professeur" ) {
	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
	$query = $db->select()
           ->from('professeur','count(id_prof)')
           ->where('mot_passe_prof = ?',$password)
           ->where('mail_prof= ?',$login);
    $count= ($db->fetchOne($query));

    if ($count == 1) {
    //rediriger vers la page accueil par exemple (nous n'avons pas cr�� une page pour le professeur)
    //on le redirige temporairement vers la page index(accueil)
              $this->_redirect("index");
              $sess->login=$login;
         }
    else {
    	$this->view->errors = array(0 => array('err' => 'Combinaison Email/Mot de passe non valid'));
          }
	
}elseif ( $typecompte=="Etudiant" ) {
	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
	$query = $db->select()
	       ->from('etudiant','count(id_etudiant)')
           ->where('mot_passe_etudiant = ?',$password)
           ->where('mail_etudiant= ?',$login);
    $count= ($db->fetchOne($query));
    if ($count == 1) {
              $this->_redirect("index");
              $sess->login=$login;
         }
    else {
         $this->view->errors = array(0 => array('err' => 'Combinaison Email/Mot de passe non valid'));
          }
         
		 }    
  }
	}
    		}
	
	 $this->view->form = $form;
	}
	
public function aproposAction(){
	
}

public function aideAction(){
	
}

public function choixAction(){
	
	$sess = new Zend_Session_Namespace('User');
	//on fait le test par exemple si le type compte n'est pas admin on redirige automatiquement vers index
	//si on est sur la page de choix de l'adminitrateur
	if(  $sess->typecompte!="Admin"){
		  $this->_redirect("index");
		//	echo $sess->login;
	}
	

}
public function contactAction(){
	$form = new Application_Form_contact();
	$this->view->form = $form;
	//nous n'avons pas encore fait de traitement pour le formulaire de contact
	
}
public function campusAction(){
	
}

}

