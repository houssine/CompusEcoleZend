<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_ajoutermatiere extends Zend_Form {

	public function init() {

		$id_matiere = new Zend_Form_Element_Text("id_matiere");
		$id_matiere->setLabel("ID de la matiere :")->setRequired(true)->style = "width: 200px;";
		$id_matiere->setAttrib("placeholder", "ID de la matière")->setOptions(array (
			'class' => 'text-input'
		));

		$id_prof = new Zend_Form_Element_Text("id_prof");
		$id_prof->setLabel("ID du professeur :")->setRequired(true)->style = "width: 200px;";
		$id_prof->setAttrib("placeholder", "ID du professeur")->setOptions(array (
			'class' => 'text-input'
		));

		$id_module = new Zend_Form_Element_Text("id_module");
		$id_module->setLabel("ID du module :")->setRequired(true)->style = "width: 200px;";
		$id_module->setAttrib("placeholder", "ID du module")->setOptions(array (
			'class' => 'text-input'
		));

		$nom = new Zend_Form_Element_Text("nom_matiere");
		$nom->setLabel("Nom de la matière :")->setRequired(true)->style = "width: 200px;";
		$nom_matiere->setAttrib("placeholder", "nom de la matière")->setOptions(array (
			'class' => 'text-input'
		));

		$volume = new Zend_Form_Element_Text("volume_horaire");
		$volume->setLabel("Volume horaire :")->setRequired(true)->style = "width: 200px;";
		$volume->setAttrib("placeholder", "volume horaire")->setOptions(array (
			'class' => 'text-input'
		));

		$coef = new Zend_Form_Element_Text("coefficient");
		$coef->setLabel("Coefficient:")->setRequired(true)->style = "width: 200px;";
		$coef->setAttrib("placeholder", "Coefficient")->setOptions(array (
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
			$id_matiere,
			$id_prof,
			$id_module,
			$nom,
			$volume,
			$coef,
			$ajouter,
			$annuler
		));

	}

}