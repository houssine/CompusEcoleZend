<?php
header('Content-type: text/html; charset=UTF-8');
class Application_Form_auth extends Zend_Form {

	public function init() {

		$compte = new Zend_Form_Element_Select("compte");
		$compte->setLabel("Choisir un compte:")->setRequired(true);
		$compte->addMultiOptions(array (
			'Admin' => 'Administrateur',
			'Etudiant' => 'Etudiant',
			'Professeur' => 'Professeur'
		));

		$mail = new Zend_Form_Element_Text("mail");
		$mail->setLabel("Adresse mail :")->setRequired(true)->setAttrib("placeholder", "yourname@email.com/login"); //le message qui s'affiche en gris et quand on place le curseur il disparait
		$mail->style = "width: 200px;";
		$mail->setOptions(array (
			'class' => 'text-input'
		));

		$password = new Zend_Form_Element_Password("password");
		$password->setLabel("Password :")->setRequired(true);
		$password->style = "width: 200px;";
		$password->setAttrib("placeholder", "mot de passe");
		$password->setOptions(array (
			'class' => 'text-input'
		));

		$seconnecter = new Zend_Form_Element_Submit("seconnecter");
		$seconnecter->setLabel("Se connecter")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));
		$annuler = new Zend_Form_Element_Reset("annuler");
		$annuler->setLabel("Annuler")->setAttribs(array (
			'style' => 'width:100px;',
			'width' => '100'
		));

		$this->addElements(array (
			$compte,
			$mail,
			$password,
			$seconnecter,
			$annuler
		));

	}

}
?>
