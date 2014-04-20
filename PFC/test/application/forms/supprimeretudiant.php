<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_supprimeretudiant extends Zend_Form {

	public function init() {

		$id_etudiant = new Zend_Form_Element_Text("id_etudiant");
		$id_etudiant->setLabel("Entrer l'id de l'étudiant à supprimer :")->setRequired(true)->style = "width: 200px;";
		$id_etudiant->setAttrib("placeholder", "Id étudiant")->setOptions(array (
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
			$id_etudiant,
			$supprimer,
			$annuler
		));

	}

}
?>
