<?php

class Application_Form_insetudiant extends Zend_Form {
//Avant d'ajouter des étudiants il faut d'abord ajouter un groupe, campus etc pour ne pas avoir une injection SQL
    public function init() {
    	//Il manque les validateurs!
	
	$id_groupe = new Zend_Form_Element_Text("id_groupe");
    $id_groupe->setLabel("ID du groupe :")
               ->setRequired(true);
	$id_campus = new Zend_Form_Element_Text("id_campus");
    $id_campus->setLabel("ID du campus :")
              ->setRequired(true);
	
	$nom = new Zend_Form_Element_Text("nom");
    $nom->setLabel("Nom :")
        ->setRequired(true);
	$prenom = new Zend_Form_Element_Text("prenom");
    $prenom->setLabel("Prenom :")
                ->setRequired(true);
	$sexe = new Zend_Form_Element_Radio("sexe");
    $sexe->setLabel("Sexe :");
    $sexe->setRequired(true);
    $sexe->addMultiOptions(array(
          '1' => 'F',
          '2' => 'M',
      ));
	  $date = new Zend_Form_Element_Text("date");
      $date->setLabel("Date de naissance :")
                ->setRequired(true)
                ->setAttrib("placeholder", "AAAA-MM-JJ");
	  $mail = new Zend_Form_Element_Text("mail");
      $mail->setLabel("Mail :")
                ->setRequired(true);
	  $password = new Zend_Form_Element_Password("password");
     $password->setLabel("Veuillez saisir le mot de passe :")
                ->setRequired(true);
    
              
   
		
		
		
	     // 
        $valider = new Zend_Form_Element_Submit("Valider");
		$valider->setLabel("Valider");
		$annuler = new Zend_Form_Element_Reset("Annuler");
		$annuler->setLabel("Annuler");
		
	 //pour afficher tous les elements;
        $this->addElements(array($id_groupe,$id_campus,$nom,$prenom,$sexe,$date,$mail,$password,$valider,$annuler));
	

    }

}
