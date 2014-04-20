<?php
class Application_Form_modifiersemestre extends Zend_Form {

	public function init() {

		$id_semestre = new Zend_Form_Element_Text("id_semestre");
		$id_semestre->setLabel("ID du semestre :")->setRequired(true)->style = "width: 200px;";
		$id_semestre->setAttrib("placeholder", "ID du semestre")->setOptions(array (
			'class' => 'text-input'
		));

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
			$id_semestre,
			$modifier,
			$annuler
		));

	}

}