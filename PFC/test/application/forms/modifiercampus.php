<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_modifiercampus extends Zend_Form {

	public function init() {
		
		$id_campus = new Zend_Form_Element_Text("id_campus");
		$id_campus->setLabel("Entrer l'id du Campus :")->setRequired(true) 
		->style = "width: 200px;";
		$id_campus->setAttrib("placeholder", "Id du campus")->setOptions(array (
			'class' => 'text-input'
		));
		$id_admin = new Zend_Form_Element_Text("id_admin");
		$id_admin->setLabel("Id Admin :")->setRequired(true)->style = "width: 200px;";
		$id_admin->setAttrib("placeholder", "Id de l'admin")->setOptions(array (
				'class' => 'text-input'
		));
		
		$arr = new Zend_Form_Element_Text("arr");
		$arr->setLabel("Arrondissement :")->setRequired(true)->style = "width: 200px;";
		$arr->setAttrib("placeholder", "Arrondissement")->setOptions(array (
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
			$id_campus,
			$id_admin,
		    $arr,
			$modifier,
			$annuler
		));

	}

}
?>