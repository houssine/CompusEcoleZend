<?php
header('Content-type: text/html; charset=UTF-8');
//Chaque page déclarée dans views (.phtml) son action doit figurée dans le fichier IndexController.php
class IndexController extends Zend_Controller_Action {

	public function init() {
		/* Initialize action controller here */
	}

	public function indexAction() {

	}
	public function ajoutercampusAction() {
		$form = new Application_Form_ajoutercampus();
		$campus = new Application_Model_campus();
		if ($this->getRequest()->isPost()) {
			if (isset ($_POST["Ajouter"])) {
				$data = array (
					"id_campus" => $this->getRequest()->getParam("id_campus"),
					"id_admin" => $this->getRequest()->getParam("id_admin"),
					"arrondissement_campus" => $this->getRequest()->getParam("arr")
				);

				$campus->insert($data);
				echo "<script>alert('Campus ajouté avec succès !');</script>";

			}

		}
		$this->view->form = $form;

	}
	public function ajoutergroupeAction() {
		$form = new Application_Form_ajoutergroupe();
		$groupe = new Application_Model_groupe();
		if ($this->getRequest()->isPost()) {
			if (isset ($_POST["Ajouter"])) {
				$data = array (
					"id_groupe" => $this->getRequest()->getParam("id_groupe"),
					"id_niveau" => $this->getRequest()->getParam("id_niveau"),
					"nom_groupe" => $this->getRequest()->getParam("nom_groupe"),
					"effectif" => $this->getRequest()->getParam("effectif")
				);

				$groupe->insert($data);
				echo "<script>alert('Groupe ajouté avec succès !');</script>";

			}

		}
		$this->view->form = $form;

	}
	public function ajouterniveauAction() {
		$form = new Application_Form_ajouterniveau();
		$niveau = new Application_Model_niveau();
		if ($this->getRequest()->isPost()) {
			if (isset ($_POST["Ajouter"])) {
				$data = array (
					"id_niveau" => $this->getRequest()->getParam("id_niveau"),
					"id_filiere" => $this->getRequest()->getParam("id_filiere"),
					"nom_niveau" => $this->getRequest()->getParam("nom_niveau")
				);

				$niveau->insert($data);
				echo "<script>alert('Niveau ajouté avec succès !');</script>";

			}

		}
		$this->view->form = $form;

	}
	public function ajoutermatiereAction() {
		$form = new Application_Form_ajoutermatiere();
		$matiere = new Application_Model_matiere();
		if ($this->getRequest()->isPost()) {
			if (isset ($_POST["Ajouter"])) {
				$data = array (
					"id_matiere" => $this->getRequest()->getParam("id_matiere"),
					"nom_matiere" => $this->getRequest()->getParam("nom_matiere"),
					"volume_horaire" => $this->getRequest()->getParam("volume_horaire"),
					"coefficient" => $this->getRequest()->getParam("coefficient"),
					
				);

				$matiere->insert($data);
				echo "<script>alert('Matière ajoutée avec succès !');</script>";

			}

		}
		$this->view->form = $form;

	}
	public function ajouterfiliereAction() {
		$form = new Application_Form_ajouterfiliere();
		$filiere = new Application_Model_filiere();
		if ($this->getRequest()->isPost()) {
			if (isset ($_POST["Ajouter"])) {
				$data = array (
					"id_filiere" => $this->getRequest()->getParam("id_filiere"),
					"nom_filiere" => $this->getRequest()->getParam("nom_filiere"),
					
				);

				$filiere->insert($data);
				echo "<script>alert('Filière ajoutée avec succès !');</script>";

			}

		}
		$this->view->form = $form;

	}
	public function ajoutermoduleAction() {
		$form = new Application_Form_ajoutermodule();
		$module = new Application_Model_module();
		if ($this->getRequest()->isPost()) {
			if (isset ($_POST["Ajouter"])) {
				$data = array (
					"id_module" => $this->getRequest()->getParam("id_module"),

					
				);

				$module->insert($data);
				echo "<script>alert('Module ajouté avec succès !');</script>";

			}

		}
		$this->view->form = $form;

	}
	public function ajoutersemestreAction() {
		$form = new Application_Form_ajoutersemestre();
		$semestre = new Application_Model_semestre();
		if ($this->getRequest()->isPost()) {
			if (isset ($_POST["Ajouter"])) {
				$data = array (
					"id_semestre" => $this->getRequest()->getParam("id_semestre"),

					
				);

				$semestre->insert($data);
				echo "<script>alert('Semestre ajouté avec succès !');</script>";

			}

		}
		$this->view->form = $form;

	}

	//traitement à faire pour le formulaire d inscription d'un étudiant
	public function insetudiantAction() {
		//instancier un objet de type formulaire insetudiant que nous avions crée
		$form = new Application_Form_insetudiant();
		//instancier un pbjet de type student que nous avons crée dans le modèle
		$student = new Application_Model_student();
		//Tester le bouton valider : Si utilisateur (ici admin) clique sur valider voilà les traitements à faire
		if ($this->getRequest()->isPost()) {
			if (isset ($_POST["Ajouter"])) {
				//déclarer une variable de type array (tableau) et y stocker les données saisies dans le formulaire
				$data = array (
					"id_etudiant" => $this->getRequest()->getParam("id_etudiant"),
					"id_groupe" => $this->getRequest()->getParam("id_groupe"),
					"id_campus" => $this->getRequest()->getParam("id_campus"),
					"nom_etudiant" => $this->getRequest()->getParam("nom"),
					"prenom_etudiant" => $this->getRequest()->getParam("prenom"),
					"sexe" => $this->getRequest()->getParam("sexe"),
					"date_naissance" => $this->getRequest()->getParam("date"),
					"mail_etudiant" => $this->getRequest()->getParam("mail"),
					"mot_passe_etudiant" => $this->getRequest()->getParam("password")
				);
				//Insérer ces données dans la table étudiant dans la base de données
				$student->insert($data);
				echo "<script>alert('Etudiant ajouté avec succès !');</script>";
			}
		}
		//Afficher le formulaire
		$this->view->form = $form;
	}
	//Même traitement pour l'inscription d'un professeur à la différence 
	//des classes à instancier et les données à récupérer depuis le formulaire
	public function insprofAction() {
		$form = new Application_Form_insprof();
		$prof = new Application_Model_professeur();
		if ($this->getRequest()->isPost()) {
			if (isset ($_POST["Ajouter"])) {
				$data = array (
					"id_prof" => $this->getRequest()->getParam("id_prof"),
					"nom_prof" => $this->getRequest()->getParam("nom"),
					"prenom_prof" => $this->getRequest()->getParam("prenom"),
					"mail_prof" => $this->getRequest()->getParam("mail"),
					"mot_passe_prof" => $this->getRequest()->getParam("password")
				);

				$prof->insert($data);
				echo "<script>alert('Professeur ajouté avec succès !');</script>";

			}

		}
		$this->view->form = $form;
	}

	//Traitement de l'authentification de : Etudiant/Professeur/Administrateur
	public function authAction() {
		//manipuler les données de session dans Zend Framework. 
		//Les espaces de noms sont utilisés pour isoler toutes les données de session, bien qu'un espace de noms par défaut existe 
		//pour ceux qui veulent juste un endroit pour stocker toutes leurs données de session. 
		$sess = new Zend_Session_Namespace('User');
		$form = new Application_Form_auth();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["seconnecter"])) {
					//Récupérer le type compte, login et le mot de passe
					$typecompte = $this->getRequest()->getParam("compte");
					$login = $this->getRequest()->getParam("mail");
					$password = $this->getRequest()->getParam("password");
					//la session prend la valeur de type compte
					$sess->typecompte = $typecompte;
					//Maintenant, nous traitons chaque cas à part et nous commençons par l'administrateur    
					if ($typecompte == "Admin") {
						//Zend_Db_Table fait référence aux tables de la base de données aussi déclarées dans le dossier models
						$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
						//On séléctionne depuis la table admin le nombre d'id qui ont le même mot de passe et le même login 
						$query = $db->select()->from('admin', 'count(id_admin)')->where('mot_passe_admin = ?', $password)->where('id_admin= ?', $login);
						//Puis on délcare une variable $count qui va retourner soit 1 soit 0
						//puisque on ne peut avoir q'un seul admin qui respecte ces critères ou aucun
						$count = ($db->fetchOne($query));
						//Et on teste sur le résultat retourné, si 1
						if ($count == 1) {
							//rediriger vers la page de choix dédiée à l'administrateur uniquement
							$this->_redirect("index/choix");
							//stocker la valeur de login de l'administrateur dans la variable session           
							$sess->login = $login;
						}
						// Sinon si la variable retourne 0 ou autre valeur(c'est impossible) on affiche un message d'erreur
						else {
							echo "<script>alert('Login ou mot de passe incorrect');</script>";

						}
						//même traitement pour Professeur et étudiant	
					}
					elseif ($typecompte == "Professeur") {
						$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
						$query = $db->select()->from('professeur', 'count(id_prof)')->where('mot_passe_prof = ?', $password)->where('mail_prof= ?', $login);
						$count = ($db->fetchOne($query));

						if ($count == 1) {
							//rediriger vers la page accueil par exemple (nous n'avons pas crée une page pour le professeur)
							//on le redirige temporairement vers la page index(accueil)
							$this->_redirect("index/infoprof");
							$sess->login = $login;
						} else {
							echo "<script>alert('Login ou mot de passe incorrect');</script>";
						}

					}
					elseif ($typecompte == "Etudiant") {
						$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
						$query = $db->select()->from('etudiant', 'count(id_etudiant)')->where('mot_passe_etudiant = ?', $password)->where('mail_etudiant= ?', $login);
						$count = ($db->fetchOne($query));
						if ($count == 1) {
							$this->_redirect("index/infoetudiant");
							$sess->login = $login;
						} else {
							echo "<script>alert('Login ou mot de passe incorrect');</script>";

						}

					}
				}
			}
		}

		$this->view->form = $form;
	}

	public function aproposAction() {

	}

	public function aideAction() {

	}

	public function choixAction() {

		$sess = new Zend_Session_Namespace('User');
		//on fait le test par exemple si le type compte n'est pas admin on redirige automatiquement vers index
		//si on est sur la page de choix de l'adminitrateur
		if ($sess->typecompte != "Admin") {
			$this->_redirect("index");
			//	echo $sess->login;
		}

	}
	public function contactAction() {
		if (empty ($_POST['name'])) {
			echo "<script>alert('champs vide. Veuillez le renseigner pour continuer !');</script>";
		} else
			if (empty ($_POST['email'])) {
				echo "<script>alert('champs vide. Veuillez le renseigner pour continuer !');</script>";
			} else
				if (empty ($_POST['msg'])) {
					echo "<script>alert('champs vide. Veuillez le renseigner pour continuer !');</script>";
				} else {
					echo "<script>alert('Votre message est envoyé. Merci!');</script>";
				}
	}

	public function campusAction() {
		
		 
	}
	public function infoetudiantAction(){
		
	}
	public function programmeAction(){
		
	}
	public function listeetudiantAction(){
		
	}
	public function infoprofAction(){
	
	}
	public function listegroupeAction(){
	
	}
	public function listefiliereAction(){
	
	}
	public function listematiereAction(){
	
	}
	
	}
	
	
