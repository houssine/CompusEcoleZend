<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_idetudiant extends Zend_Form {

	public 
	
	function init() {
		
		$id_etudiant = new Zend_Form_Element_Text("id_etudiant");
		$id_etudiant->setLabel("Id de l'étudiant")->setRequired(true) 
		->style = "width: 200px;";
		$id_etudiant->setAttrib("placeholder", "Id étudiant")->setOptions(array (
			'class' => 'text-input'
		));
		
		$modifier = new Zend_Form_Element_Submit("modifier");
		$modifier->setLabel("Modifier")->setAttribs(array (
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
			$modifier,
			$annuler
		));

	}

}
?>
