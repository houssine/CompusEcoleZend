<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_supprimercampus extends Zend_Form {

	public function init() {

		$id_campus = new Zend_Form_Element_Text("id_campus");
		$id_campus->setLabel("Entrer l'id du Campus à supprimer :")->setRequired(true)->style = "width: 200px;";
		$id_campus->setAttrib("placeholder", "Id du campus")->setOptions(array (
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
			$id_campus,
			$supprimer,
			$annuler
		));

	}

}
?>
