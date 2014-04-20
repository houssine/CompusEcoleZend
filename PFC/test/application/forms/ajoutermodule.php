<<?php
class Application_Form_AjouterModule extends Zend_Form {

	public function init() {

		$id_module = new Zend_Form_Element_Text("id_module");
		$id_module->setLabel("ID du module :")->setRequired(true)->style = "width: 200px;";
		$id_module->setAttrib("placeholder", "ID du module")->setOptions(array (
			'class' => 'text-input'
		));

		$id_semestre = new Zend_Form_Element_Text("id_semestre");
		$id_semestre->setLabel("Entrer l'id du semestre :")->setRequired(true)->style = "width: 200px;";
		$id_semestre->setAttrib("placeholder", "Id du semestre")->setOptions(array (
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
			$id_module,
			$id_semestre,
			$ajouter,
			$annuler
		));

	}

}