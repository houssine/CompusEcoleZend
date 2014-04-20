<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_idsemestre extends Zend_Form {

	public 
	
	function init() {
		
		$id_semestre = new Zend_Form_Element_Text("id_semestre");
		$id_semestre->setLabel("Entrer l'id du semestre :")->setRequired(true) 
		->style = "width: 200px;";
		$id_semestre->setAttrib("placeholder", "Id semestre")->setOptions(array (
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
			$id_semestre,
			$modifier,
			$annuler
		));

	}

}
?>

