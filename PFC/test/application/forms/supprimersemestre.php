<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_supprimersemestre extends Zend_Form {

	public function init() {

		$id_semestre = new Zend_Form_Element_Text("id_semestre");
		$id_semestre->setLabel("Entrer l'id du semestre à supprimer :")->setRequired(true)->style = "width: 200px;";
		$id_semestre->setAttrib("placeholder", "Id du semestre")->setOptions(array (
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
			$id_semestre,
			$supprimer,
			$annuler
		));

	}

}
?>
