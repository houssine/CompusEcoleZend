<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_modifieretudiant extends Zend_Form {

	public function init() {

		$id_etudiant = new Zend_Form_Element_Text("id_etudiant");
		$id_etudiant->setLabel(" Entrer l'id de l'étudiant :")->setRequired(true)->style = "width: 200px;";
		$id_etudiant->setAttrib("placeholder", "ID de l'étudiant")->setOptions(array (
			'class' => 'text-input'
		));

		$id_groupe = new Zend_Form_Element_Text("id_groupe");
		$id_groupe->setLabel("ID du groupe :")->setRequired(true)->style = "width: 200px;";
		$id_groupe->setAttrib("placeholder", "ID du groupe")->setOptions(array (
			'class' => 'text-input'
		));
		$id_campus = new Zend_Form_Element_Text("id_campus");
		$id_campus->setLabel("ID du campus :")->setRequired(true)->style = "width: 200px;";
		$id_campus->setAttrib("placeholder", "ID du campus")->setOptions(array (
			'class' => 'text-input'
		));

		$nom = new Zend_Form_Element_Text("nom");
		$nom->setLabel("Nom :")->setRequired(true)->style = "width: 200px;";
		$nom->setAttrib("placeholder", "nom de l'étudiant")->setOptions(array (
			'class' => 'text-input'
		));
		$prenom = new Zend_Form_Element_Text("prenom");
		$prenom->setLabel("Prénom :")->setRequired(true)->style = "width: 200px;";
		$prenom->setAttrib("placeholder", "prénom de l'étudiant")->setOptions(array (
			'class' => 'text-input'
		));
		$sexe = new Zend_Form_Element_Radio("sexe");
		$sexe->setLabel("Sexe :");
		$sexe->setRequired(true);
		$sexe->addMultiOptions(array (
			'1' => 'F',
			'2' => 'M',

			
		));
		$date = new Zend_Form_Element_Text("date");
		$date->setLabel("Date de naissance :")->setRequired(true)->style = "width: 200px;";
		$date->setAttrib("placeholder", "date de naissance")->setOptions(array (
			'class' => 'text-input'
		));

		$mail = new Zend_Form_Element_Text("mail");
		$mail->setLabel("Mail :")->setRequired(true)->style = "width: 200px;";
		$mail->setAttrib("placeholder", "mail de l'étudiant")->setOptions(array (
			'class' => 'text-input'
		));
		$password = new Zend_Form_Element_Password("password");
		$password->setLabel("Veuillez saisir le mot de passe :")->setRequired(true)->style = "width: 200px;";
		$password->setAttrib("placeholder", "mot de passe")->setOptions(array (
			'class' => 'text-input'
		));

		//
		$modifier = new Zend_Form_Element_Submit("modifier");
		$modifier->setLabel("Modifier")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));

		$annuler = new Zend_Form_Element_Reset("Annuler");
		$annuler->setLabel("Annuler")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));

		$this->addElements(array (
			$id_etudiant,
			$id_groupe,
			$id_campus,
			$nom,
			$prenom,
			$sexe,
			$date,
			$mail,
			$password,
			$modifier,
			$annuler
		));

	}

}