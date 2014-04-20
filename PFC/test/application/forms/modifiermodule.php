<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_modifiermodule extends Zend_Form {

	public function init() {

		$id_module = new Zend_Form_Element_Text("id_module");
		$id_module->setLabel("Entrer l'id du module :")->setRequired(true)->style = "width: 200px;";
		$id_module->setAttrib("placeholder", "Id du module")->setOptions(array (
			'class' => 'text-input'
		));

		$id_semestre = new Zend_Form_Element_Text("id_semestre");
		$id_semestre->setLabel("Entrer l'id du semestre :")->setRequired(true)->style = "width: 200px;";
		$id_semestre->setAttrib("placeholder", "Id du semestre")->setOptions(array (
			'class' => 'text-input'
		));

		$modifier = new Zend_Form_Element_Submit("modifier");
		$modifier->setLabel("Modifier")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));
		$annuler = new Zend_Form_Element_Reset("annuler");
		$annuler->setLabel("Annuler")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));

		$this->addElements(array (
			$id_module,
			$id_semestre,
			$modifier,
			$annuler
		));

	}

}
?>
