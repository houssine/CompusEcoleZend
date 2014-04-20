<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_modifiermatiere extends Zend_Form {

	public function init() {

		$id_matiere = new Zend_Form_Element_Text("id_matiere");
		$id_matiere->setLabel("Id de la matière  :")->setRequired(true)->style = "width: 200px;";
		$id_matiere->setAttrib("placeholder", "ID de la matière ")->setOptions(array (
			'class' => 'text-input'
		));

		$id_prof = new Zend_Form_Element_Text("id_prof");
		$id_prof->setLabel("Id du professeur  :")->setRequired(true)->style = "width: 200px;";
		$id_prof->setAttrib("placeholder", "ID du professeur ")->setOptions(array (
			'class' => 'text-input'
		));

		$id_module = new Zend_Form_Element_Text("id_module");
		$id_module->setLabel("Id du module  :")->setRequired(true)->style = "width: 200px;";
		$id_module->setAttrib("placeholder", "ID du module ")->setOptions(array (
			'class' => 'text-input'
		));

		$nom = new Zend_Form_Element_Text("nom");
		$nom->setLabel("Nom :")->setRequired(true)->style = "width: 200px;";
		$nom->setAttrib("placeholder", "nom de la matière ")->setOptions(array (
			'class' => 'text-input'
		));
		$volume = new Zend_Form_Element_Text("volume");
		$volume->setLabel("Volume horaire:")->setRequired(true)->style = "width: 200px;";
		$volume->setAttrib("placeholder", "volume horaire")->setOptions(array (
			'class' => 'text-input'
		));
		$coeff = new Zend_Form_Element_Text("coeff");
		$coeff->setLabel("Coefficient:")->setRequired(true)->style = "width: 200px;";
		$coeff->setAttrib("placeholder", "Coefficient")->setOptions(array (
			'class' => 'text-input'
		));

		//
		$modifier = new Zend_Form_Element_Submit("modifier");
		$modifier->setLabel("Modifier")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));

		$annuler = new Zend_Form_Element_Reset("Annuler");
		$annuler->setLabel("Annuler")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));

		$this->addElements(array (
			$id_matiere,
			$id_prof,
			$id_module,
			$nom,
			$volume,
			$coeff,
			$modifier,
			$annuler
		));

	}

}