<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_idgroupe extends Zend_Form {

	public 
	
	function init() {
		
		$id_groupe = new Zend_Form_Element_Text("id_groupe");
		$id_groupe->setLabel("Entrer l'id du groupe :")->setRequired(true) 
		->style = "width: 200px;";
		$id_groupe->setAttrib("placeholder", "Id groupe")->setOptions(array (
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
			$id_groupe,
			$modifier,
			$annuler
		));

	}

}
?>

