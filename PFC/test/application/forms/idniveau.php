<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_idniveau extends Zend_Form {

	public 
	
	function init() {
		
		$id_niveau = new Zend_Form_Element_Text("id_niveau");
		$id_niveau->setLabel("Entrer l'id du niveau :")->setRequired(true) 
		->style = "width: 200px;";
		$id_niveau->setAttrib("placeholder", "Id niveau")->setOptions(array (
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
			$id_niveau,
			$modifier,
			$annuler
		));

	}

}
?>

