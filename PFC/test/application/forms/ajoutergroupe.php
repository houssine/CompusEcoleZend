<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_ajoutergroupe extends Zend_Form {

	public function init() {
		//Déclarer les champs d'un formulaire
		$id_groupe = new Zend_Form_Element_Text("id_groupe");
		$id_groupe->setLabel("Id Groupe :")->setRequired(true) // champs obligatoire
		->style = "width: 200px;";
		$id_groupe->setAttrib("placeholder", "ID du groupe")->setOptions(array (
			'class' => 'text-input'
		));
		$id_niveau = new Zend_Form_Element_Text("id_niveau");
		$id_niveau->setLabel("Id Niveau :")->setRequired(true)->style = "width: 200px;";
		$id_niveau->setAttrib("placeholder", "ID du niveau")->setOptions(array (
			'class' => 'text-input'
		));

		$nom_groupe = new Zend_Form_Element_Text("nom_groupe");
		$nom_groupe->setLabel("Nom du groupe :")->setRequired(true)->style = "width: 200px;";
		$nom_groupe->setAttrib("placeholder", "nom du groupe")->setOptions(array (
			'class' => 'text-input'
		));

		$effectif = new Zend_Form_Element_Text("effectif");
		$effectif->setLabel("Nombre d'étudiants :")->setRequired(true)->style = "width: 200px;";
		$effectif->setAttrib("placeholder", "effectif")->setOptions(array (
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
			$id_groupe,
			$id_niveau,
			$nom_groupe,
			$effectif,
			$ajouter,
			$annuler
		));

	}

}
?>
