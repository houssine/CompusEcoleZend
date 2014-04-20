<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_idfiliere extends Zend_Form {

	public 
	
	function init() {
		
		$id_filiere = new Zend_Form_Element_Text("id_filiere");
		$id_filiere->setLabel("Entrer l'id de la filière :")->setRequired(true) 
		->style = "width: 200px;";
		$id_filiere->setAttrib("placeholder", "Id filiere")->setOptions(array (
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
			$id_filiere,
			$modifier,
			$annuler
		));

	}

}
?>

