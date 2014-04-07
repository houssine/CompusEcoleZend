<?php

class Application_Form_insprof extends Zend_Form {

    public function init() {
	
	 $nom = new Zend_Form_Element_Text("nom");
      $nom->setLabel("Nom :")
                ->setRequired(true);
	$prenom = new Zend_Form_Element_Text("prenom");
      $prenom->setLabel("Prenom :")
                ->setRequired(true);
	$mail = new Zend_Form_Element_Text("mail");
      $mail->setLabel("Mail :")
                ->setRequired(true);
	$password = new Zend_Form_Element_Password("password");
    $password->setLabel("Veuillez saisir le mot de passe :")
                ->setRequired(true);
 
		
		
		
	     // le bouton Enregistrer
        $valider = new Zend_Form_Element_Submit("Valider");
		$valider->setLabel("Valider");
		$annuler = new Zend_Form_Element_Reset("Annuler");
		$annuler->setLabel("Annuler");
		
	 //pour afficher tous les elements;
        $this->addElements(array($nom,$prenom,$mail,$password,$valider,$annuler));
	

    }

}