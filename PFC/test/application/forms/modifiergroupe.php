<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_modifiergroupe extends Zend_Form {

	public function init() {

		$id_groupe = new Zend_Form_Element_Text("id_groupe");
		$id_groupe->setLabel("Id du groupe  :")->setRequired(true)->style = "width: 200px;";
		$id_groupe->setAttrib("placeholder", "ID du groupe ")->setOptions(array (
			'class' => 'text-input'
		));

		$id_niveau = new Zend_Form_Element_Text("id_niveau");
		$id_niveau->setLabel("Id du niveau  :")->setRequired(true)->style = "width: 200px;";
		$id_niveau->setAttrib("placeholder", "ID du niveau ")->setOptions(array (
			'class' => 'text-input'
		));

		$nom = new Zend_Form_Element_Text("nom");
		$nom->setLabel("Nom :")->setRequired(true)->style = "width: 200px;";
		$nom->setAttrib("placeholder", "nom du groupe ")->setOptions(array (
			'class' => 'text-input'
		));
		$effectif = new Zend_Form_Element_Text("effectif");
		$effectif->setLabel("Effectif:")->setRequired(true)->style = "width: 200px;";
		$effectif->setAttrib("placeholder", "effectif du groupe")->setOptions(array (
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
			$id_groupe,
			$id_niveau,
			$nom,
			$effectif,
			$modifier,
			$annuler
		));

	}

}