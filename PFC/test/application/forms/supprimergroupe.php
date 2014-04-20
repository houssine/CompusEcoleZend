<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_supprimergroupe extends Zend_Form {

	public function init() {

		$id_groupe = new Zend_Form_Element_Text("id_groupe");
		$id_groupe->setLabel("Entrer l'id du Groupe à supprimer :")->setRequired(true)->style = "width: 200px;";
		$id_groupe->setAttrib("placeholder", "Id du groupe")->setOptions(array (
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
			$id_groupe,
			$supprimer,
			$annuler
		));

	}

}
?>
