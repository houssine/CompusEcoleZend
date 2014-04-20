<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_supprimerfiliere extends Zend_Form {

	public function init() {

		$id_filiere = new Zend_Form_Element_Text("id_filiere");
		$id_filiere->setLabel("Entrer l'id de la filière à supprimer :")->setRequired(true)->style = "width: 200px;";
		$id_filiere->setAttrib("placeholder", "Id filière")->setOptions(array (
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
			$id_filiere,
			$supprimer,
			$annuler
		));

	}

}
?>
