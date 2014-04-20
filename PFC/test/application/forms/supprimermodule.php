<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_supprimermodule extends Zend_Form {

	public function init() {

		$id_module = new Zend_Form_Element_Text("id_module");
		$id_module->setLabel("Entrer l'id du module à supprimer :")->setRequired(true)->style = "width: 200px;";
		$id_module->setAttrib("placeholder", "Id du module")->setOptions(array (
			'class' => 'text-input'
		));

		$supprimer = new Zend_Form_Element_Submit("supprimer");
		$supprimer->setLabel("Supprimer")->setAttribs(array (
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
			$supprimer,
			$annuler
		));

	}

}
?>
