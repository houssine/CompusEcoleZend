<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_insprof extends Zend_Form {

	public function init() {
		$id_prof = new Zend_Form_Element_Text("id_prof");
		$id_prof->setLabel("ID du professeur :")->setRequired(true)->style = "width: 200px;";
		$id_prof->setAttrib("placeholder", "ID du professeur")->setOptions(array (
			'class' => 'text-input'
		));
		$nom = new Zend_Form_Element_Text("nom");
		$nom->setLabel("Nom :")->setRequired(true)->style = "width: 200px;";
		$nom->setAttrib("placeholder", "nom du professeur")->setOptions(array (
			'class' => 'text-input'
		));
		$prenom = new Zend_Form_Element_Text("prenom");
		$prenom->setLabel("Prénom :")->setRequired(true)->style = "width: 200px;";
		$prenom->setAttrib("placeholder", "prénom du professeur")->setOptions(array (
			'class' => 'text-input'
		));
		$mail = new Zend_Form_Element_Text("mail");
		$mail->setLabel("Mail :")->setRequired(true)->style = "width: 200px;";
		$mail->setAttrib("placeholder", "mail du professeur")->setOptions(array (
			'class' => 'text-input'
		));
		$password = new Zend_Form_Element_Password("password");
		$password->setLabel("Veuillez saisir le mot de passe :")->setRequired(true)->style = "width: 200px;";
		$password->setAttrib("placeholder", "Mot de passe")->setOptions(array (
			'class' => 'text-input'
		));

		$ajouter = new Zend_Form_Element_Submit("Ajouter");
		$ajouter->setLabel("Ajouter")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));

		$annuler = new Zend_Form_Element_Reset("Annuler");
		$annuler->setLabel("Annuler")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));

		//pour afficher tous les elements;
		$this->addElements(array (
			$id_prof,
			$nom,
			$prenom,
			$mail,
			$password,
			$ajouter,
			$annuler
		));

	}

}