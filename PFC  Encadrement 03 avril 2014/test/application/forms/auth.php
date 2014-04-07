<?php


class Application_Form_auth extends Zend_Form {

    public function init() {
    	//Déclarer les champs d'un formulaire
   $compte = new Zend_Form_Element_Select("compte"); 
   $compte->setLabel("Choisir un compte:")
          ->setRequired(true); // champs obligatoire
   $compte->addMultiOptions(array(
		        'Admin'	=>'Administrateur',
        		'Etudiant'	=>'Etudiant',
        		'Professeur'	=>'Professeur'));
        		
   $mail = new Zend_Form_Element_Text("mail");
   $mail->setLabel("Adresse mail :")
        ->setRequired(true)
        ->setAttrib("placeholder", "yourname@email.com"); //le message qui s'affiche en gris et quand on place le curseur il disparait
         
   $password = new  Zend_Form_Element_Password("password");
   $password->setLabel("Password :")
            ->setRequired(true);
   //les boutons
   $seconnecter = new Zend_Form_Element_Submit("seconnecter");
   $seconnecter->setLabel("Se connecter");
   $annuler = new Zend_Form_Element_Reset("annuler");
   $annuler->setLabel("Annuler");
		
	  
	//Afficher tous les éléments;
        $this->addElements(array($compte,$mail,$password,$seconnecter,$annuler));
	

    }

}
?>
