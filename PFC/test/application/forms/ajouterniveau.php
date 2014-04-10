<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_ajouterniveau extends Zend_Form {

	public function init() {
		//D�clarer les champs d'un formulaire
		$id_niveau = new Zend_Form_Element_Text("id_niveau");
		$id_niveau->setLabel("Id Niveau :")->setRequired(true)->style = "width: 200px;";
		$id_niveau->setAttrib("placeholder", "ID du niveau")->setOptions(array (
			'class' => 'text-input'
		));

		$id_filiere = new Zend_Form_Element_Text("id_filiere");
		$id_filiere->setLabel("Id Filière :")->setRequired(true) // champs obligatoire
		->style = "width: 200px;";
		$id_filiere->setAttrib("placeholder", "ID de la filière")->setOptions(array (
			'class' => 'text-input'
		));

		$nom_niveau = new Zend_Form_Element_Text("nom_niveau");
		$nom_niveau->setLabel("Nom du Niveau :")->setRequired(true)->style = "width: 200px;";
		$nom_niveau->setAttrib("placeholder", "nom du niveau")->setOptions(array (
			'class' => 'text-input'
		));

		//les boutons
		$ajouter = new Zend_Form_Element_Submit("ajouter");
		$ajouter->setLabel("Ajouter")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));

		$annuler = new Zend_Form_Element_Reset("annuler");
		$annuler->setLabel("Annuler")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));

		//Afficher tous les �l�ments;
		$this->addElements(array (
			$id_niveau,
			$id_filiere,
			$nom_niveau,
			$ajouter,
			$annuler
		));

	}

}
?>
