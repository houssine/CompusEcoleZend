<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_supprimermatiere extends Zend_Form {

	public function init() {

		$id_matiere = new Zend_Form_Element_Text("id_matiere");
		$id_matiere->setLabel("Entrer l'id de la matière à supprimer :")->setRequired(true)->style = "width: 200px;";
		$id_matiere->setAttrib("placeholder", "Id matière")->setOptions(array (
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
			$id_matiere,
			$supprimer,
			$annuler
		));

	}

}
?>
