<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_modifierfiliere extends Zend_Form {

	public function init() {

		$id_filiere = new Zend_Form_Element_Text("id_filiere");
		$id_filiere->setLabel("Id de la filière  :")->setRequired(true)->style = "width: 200px;";
		$id_filiere->setAttrib("placeholder", "ID de la filière ")->setOptions(array (
			'class' => 'text-input'
		));

		$nom = new Zend_Form_Element_Text("nom");
		$nom->setLabel("Nom :")->setRequired(true)->style = "width: 200px;";
		$nom->setAttrib("placeholder", "nom de la filière ")->setOptions(array (
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
			$id_filiere,
			$nom,
			$modifier,
			$annuler
		));

	}

}