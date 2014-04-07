<?php
class Application_Form_contact extends Zend_Form {

    public function init() {
	
	   // $emailvalid = new Application_Form_EmailAddress();
	    $name = new Zend_Form_Element_Text("name");

          $name ->setRequired(true)
	      ->setAttrib("placeholder", "Name");
   $mail = new Zend_Form_Element_Text("mail");
     $mail->setRequired(true);
         $mail->setAttrib("placeholder", "yourname@email.com");
 $texte = new Zend_Form_Element_Textarea("texte");
     $texte->setRequired(true);
         $texte->setAttrib("placeholder", "Message");
               
               
     $send = new Zend_Form_Element_Submit("Send");
     $send->setLabel("Send");
     $clear = new Zend_Form_Element_Reset("Clear");
	 $clear->setLabel("Clear");
	 //pour afficher tous les elements;
        $this->addElements(array($name,$mail,$texte,$send,$clear));
	

    }

}
?>
