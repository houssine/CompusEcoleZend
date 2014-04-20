<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_supprimerprof extends Zend_Form {

	public function init() {

		$id_prof = new Zend_Form_Element_Text("id_prof");
		$id_prof->setLabel("Entrer l'id du professeur à supprimer :")->setRequired(true)->style = "width: 200px;";
		$id_prof->setAttrib("placeholder", "Id du professeur")->setOptions(array (
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
			$id_prof,
			$supprimer,
			$annuler
		));

	}

}
?>
