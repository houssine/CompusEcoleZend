<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_AjouterFiliere extends Zend_Form {

	public function init() {

		$id_filiere = new Zend_Form_Element_Text("id_filiere");
		$id_filiere->setLabel("ID de la filière :")->setRequired(true)->style = "width: 200px;";
		$id_filiere->setAttrib("placeholder", "ID de la filière")->setOptions(array (
			'class' => 'text-input'
		));

		$nom = new Zend_Form_Element_Text("nom_filiere");
		$nom->setLabel("Nom de la filiere :")->setRequired(true)->style = "width: 200px;";
		$nom->setAttrib("placeholder", "nom de la filière")->setOptions(array (
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

		$this->addElements(array (
			$id_filiere,
			$nom,
			$ajouter,
			$annuler
		));

	}

}