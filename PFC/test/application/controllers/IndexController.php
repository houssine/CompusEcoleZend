<?php
header('Content-type: text/html; charset=UTF-8');
//Chaque page déclarée dans views (.phtml) son action doit figurée dans le fichier IndexController.php
class IndexController extends Zend_Controller_Action {

	public function init() {
		
	}

	public function indexAction() {

	}
    //Action relative à la rubrique apropos
	public function aproposAction() {

	}
	//Action de l'authentification de : Administrateur/Professeur/Etudiant
	public function authAction() {
		//Les espaces de noms sont utilisés pour isoler toutes les données de session.L'instance
		//que nous avons crée orrespond à une entrée dans le tableau de la superglobale $_SESSION,
		// où l'espace de noms 'Utilisateur' est utilisée comme une clé.
		$sess = new Zend_Session_Namespace('Utilisateur');
		//On stocke la valeur de la session dans une variable $user (où on teste sur le type de compte)
		$user = $sess->user;
		//Si la valeur est non null
		if ($user != null) {
			//et si la valeur contient le compte Admin, l'utilisateur sera toujours dirigé vers sa page
			if ($user = "Admin") {
				$this->_redirect("index/choix");
			} else // Même traitement s'il est Etudiant ou Professeur
				if ($user = "Etudiant") {
					$this->_redirect("index/infoetudiant");
				} else
					if ($user = "Professeur") {
						$this->_redirect("index/infoprof");
					}
		}
        //On instancie le formulaire de l'authentificationcet on teste la validité du formualire
		$form = new Application_Form_auth();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["seconnecter"])) {
					//Récupérer le type compte, login et le mot de passe
					$typecompte = $this->getRequest()->getParam("compte");
					$login = $this->getRequest()->getParam("mail");
					$password = $this->getRequest()->getParam("password");
					//La variable $sess déclarée auparavant contiendra la valeur du type compte
					//Si on ne le fait pas, elle aura une valeur par défaut.
					$sess->user = $typecompte;
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
							//Si le login et mot de passe sont corrects, rediriger le professeur vers sa page
							$this->_redirect("index/infoprof");

						} else {
							//sinon afficher un message d'erreur
							echo "<script>alert('Login ou mot de passe incorrect');</script>";
						}

					}
					elseif ($typecompte == "Etudiant") {
						$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
						$query = $db->select()->from('etudiant', 'count(id_etudiant)')->where('mot_passe_etudiant = ?', $password)->where('mail_etudiant= ?', $login);
						$count = ($db->fetchOne($query));
						if ($count == 1) {
							$this->_redirect("index/infoetudiant");

						} else {
							echo "<script>alert('Login ou mot de passe incorrect');</script>";

						}

					}
				}
			}
		}

		$this->view->form = $form;
	}
	//Action du choix dédiée à un administrateur
	public function choixAction() {

	}
	// Les actions suivantes sont les actions qu'un administrateur peut faire et ce sont :
	//Ajouter, Modifier et Supprimer 
	//Etudiant, Professeur, Semestre, Filière, Niveau, Groupe, Module, Matière et campus
	//Le même traitement se répète pour chaque action, du coup un seul exemple sera commenté : Etudiant
	public function ajouteretudiantAction() {
		//instancier un objet de type formulaire ajouteretudiant que nous avions crée
		$form = new Application_Form_ajouteretudiant();
		//instancier un objet de type student que nous avons crée dans le modèle
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
	
	//Traitement pour la modification d'un étudiant
	public function idetudiantAction() {
		//Ici, on veut récupérer l'id de l'étudiant puis tester s'il existe rediriger l'admin vers la page
		//de modification , sinon afficher un message d'erreur.
		$form = new Application_Form_idetudiant();
		$student = new Application_Model_student();
		$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["modifier"])) {
					//récupérer l'id saisi
					$idetudiant = $this->getRequest()->getParam("id_etudiant");
                    //sélectionner celui de la base de données et le comparer avec celui saisi
					$query = $db->select()->from('etudiant', 'count(id_etudiant)')->where('id_etudiant = ?', $idetudiant);

					$count = ($db->fetchOne($query));
                    // S'ils sont égaux faire la redirection
					if ($count == 1) {

						$this->_redirect("index/modifieretudiant");
                       //Sinon message d'erreur
					} else {
						echo "<script>alert('Etudiant non trouvé !');</script>";
					}
				}
			}
		}
		$this->view->form = $form;
	}
	//Traiement de modification
	public function modifieretudiantAction() {
		//Instancier le formulaire de modification
		$form = new Application_Form_modifieretudiant();
		$student = new Application_Model_student();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$donne = $this->getRequest()->getPost();
			if ($form->isValid($donne)) {
				if (isset ($_POST["modifier"])) {
                    //récupérer l'id 
					$id_etudiant = $this->getRequest()->getParam("id_etudiant");
					//déclarer une variable qui teste l'égalité des id
					$where = $db->quoteInto('id_etudiant = ?', $id_etudiant);
                   //déclarer un tableau où stocker les données saisies dans le formulaire
                   // que update le prend comme paramètre
                   //il faut noter que l'id ne doit pas être changé !
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
					//affecter le résultat de modification à une variable qui retourne 0 en cas d'échec
					// et 1 dans le cas de succès
					$resultat = $student->update($data, $where);

				}
				//Si succès afficher message de succès
				if ($resultat == 1) {
					echo "<script>alert('Etudiant modifié avec succès');</script>";
				} else { // Sinon message d'erreur
					echo "<script>alert('Etudiant non modifié ! Veuillez réessayer !');</script>";
				}

			}
		}

		$this->view->form = $form;

	}
	//Traitement de suppression
	public function supprimeretudiantAction() {
		//Instancier un formulaire de suppression
		$form = new Application_Form_supprimeretudiant();
		$student = new Application_Model_student();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["supprimer"])) {
                    //la même logique que la modification, sauf delete ne prend pas un tableau de données
					$id_etudiant = $this->getRequest()->getParam("id_etudiant");
					$db = Zend_Db_Table :: getDefaultAdapter();
					$where = $db->quoteInto('id_etudiant = ?', $id_etudiant);
					$resultat = $db->delete('etudiant', $where);
                    //Tester les 2 cas 0 et 1 
					if ($resultat == 1) {
						echo "<script>alert('Etudiant supprimé avec succès');</script>";
					} else {
						echo "<script>alert('Etudiant non trouvé. Veuillez saisir une valeur correcte !');</script>";
					}

				}

			}
		}
		$this->view->form = $form;
	}
	public function ajouterprofAction() {
		$form = new Application_Form_ajouterprof();
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
	public function idprofAction() {
		$form = new Application_Form_idprof();
		$professeur = new Application_Model_professeur();
		$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["modifier"])) {
					$idprof = $this->getRequest()->getParam("id_prof");

					$query = $db->select()->from('professeur', 'count(id_prof)')->where('id_prof = ?', $idprof);

					$count = ($db->fetchOne($query));

					if ($count == 1) {

						$this->_redirect("index/modifierprof");

					} else {
						echo "<script>alert('Professeur non trouvé !');</script>";
					}
				}
			}
		}
		$this->view->form = $form;
	}
	public function modifierprofAction() {
		$form = new Application_Form_modifierprof();
		$professeur = new Application_Model_professeur();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$donne = $this->getRequest()->getPost();
			if ($form->isValid($donne)) {
				if (isset ($_POST["modifier"])) {

					$id_prof = $this->getRequest()->getParam("id_prof");
					$where = $db->quoteInto('id_prof = ?', $id_prof);

					$data = array (
						"id_prof" => $this->getRequest()->getParam("id_prof"),
						"nom_prof" => $this->getRequest()->getParam("nom"),
						"prenom_prof" => $this->getRequest()->getParam("prenom"),
						"mail_prof" => $this->getRequest()->getParam("mail"),
						"mot_passe_prof" => $this->getRequest()->getParam("password")
					);
					$resultat = $professeur->update($data, $where);

				}
				if ($resultat == 1) {
					echo "<script>alert('Professeur modifié avec succès');</script>";
				} else {
					echo "<script>alert('Professeur non modifié ! Veuillez réessayer !');</script>";
				}

			}
		}

		$this->view->form = $form;

	}
	public function supprimerprofAction() {
		$form = new Application_Form_supprimerprof();
		$professeur = new Application_Model_professeur();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["supprimer"])) {

					$id_prof = $this->getRequest()->getParam("id_prof");
					$db = Zend_Db_Table :: getDefaultAdapter();
					$where = $db->quoteInto('id_prof = ?', $id_prof);
					$resultat = $db->delete('professeur', $where);

					if ($resultat == 1) {
						echo "<script>alert('Professeur supprimé avec succès');</script>";
					} else {
						echo "<script>alert('Professeur non trouvée. Veuillez saisir une valeur correcte !');</script>";
					}

				}

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
	public function idsemestreAction() {
		$form = new Application_Form_idsemestre();
		$semestre = new Application_Model_semestre();
		$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["modifier"])) {
					$idsemestre = $this->getRequest()->getParam("id_semestre");

					$query = $db->select()->from('semestre', 'count(id_semestre)')->where('id_semestre = ?', $idsemestre);

					$count = ($db->fetchOne($query));

					if ($count == 1) {

						$this->_redirect("index/modifiersemestre");

					} else {
						echo "<script>alert('Semestre non trouvé !');</script>";
					}
				}
			}
		}
		$this->view->form = $form;
	}
	public function modifiersemestreAction() {
		$form = new Application_Form_modifiersemestre();
		$semestre = new Application_Model_semestre();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$donne = $this->getRequest()->getPost();
			if ($form->isValid($donne)) {
				if (isset ($_POST["modifier"])) {

					$id_semestre = $this->getRequest()->getParam("id_semestre");
					$where = $db->quoteInto('id_semestre = ?', $id_semestre);

					$data = array (
						"id_semestre" => $this->getRequest()->getParam("id_semestre")
					);
					$resultat = $semestre->update($data, $where);

				}
				if ($resultat == 1) {
					echo "<script>alert('Semestre modifié avec succès');</script>";
				} else {
					echo "<script>alert('Semestre non modifié ! Veuillez réessayer !');</script>";
				}

			}
		}

		$this->view->form = $form;

	}

	public function supprimersemestreAction() {
		$form = new Application_Form_supprimersemestre();
		$semestre = new Application_Model_semestre();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["supprimer"])) {

					$id_semestre = $this->getRequest()->getParam("id_semestre");
					$db = Zend_Db_Table :: getDefaultAdapter();
					$where = $db->quoteInto('id_semestre = ?', $id_semestre);
					$resultat = $db->delete('semestre', $where);

					if ($resultat == 1) {
						echo "<script>alert('Semestre supprimé avec succès');</script>";
					} else {
						echo "<script>alert('Semestre non trouvé. Veuillez saisir une valeur correcte !');</script>";
					}

				}

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
	public function idfiliereAction() {
		$form = new Application_Form_idfiliere();
		$filiere = new Application_Model_filiere();
		$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["modifier"])) {
					$idfiliere = $this->getRequest()->getParam("id_filiere");

					$query = $db->select()->from('filiere', 'count(id_filiere)')->where('id_filiere = ?', $idfiliere);

					$count = ($db->fetchOne($query));

					if ($count == 1) {

						$this->_redirect("index/modifierfiliere");

					} else {
						echo "<script>alert('filière non trouvée !');</script>";
					}
				}
			}
		}
		$this->view->form = $form;
	}
	public function modifierfiliereAction() {
		$form = new Application_Form_modifierfiliere();
		$filiere = new Application_Model_filiere();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$donne = $this->getRequest()->getPost();
			if ($form->isValid($donne)) {
				if (isset ($_POST["modifier"])) {

					$id_filiere = $this->getRequest()->getParam("id_filiere");
					$where = $db->quoteInto('id_filiere = ?', $id_filiere);

					$data = array (
						"id_filiere" => $this->getRequest()->getParam("id_filiere"),
						"nom_filiere" => $this->getRequest()->getParam("nom"),

						
					);
					$resultat = $filiere->update($data, $where);

				}
				if ($resultat == 1) {
					echo "<script>alert('filière modifiée avec succès');</script>";
				} else {
					echo "<script>alert('filière non modifiée ! Veuillez réessayer !');</script>";
				}

			}
		}

		$this->view->form = $form;

	}
	public function supprimerfiliereAction() {
		$form = new Application_Form_supprimerfiliere();
		$filiere = new Application_Model_filiere();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["supprimer"])) {

					$id_filiere = $this->getRequest()->getParam("id_filiere");
					$db = Zend_Db_Table :: getDefaultAdapter();
					$where = $db->quoteInto('id_filiere = ?', $id_filiere);
					$resultat = $db->delete('etudiant', $where);

					if ($resultat == 1) {
						echo "<script>alert('Filière supprimée avec succès');</script>";
					} else {
						echo "<script>alert('Filière non trouvée. Veuillez saisir une valeur correcte !');</script>";
					}

				}

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
	public function idniveauAction() {
		$form = new Application_Form_idniveau();
		$niveau = new Application_Model_niveau();
		$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["modifier"])) {
					$idniveau = $this->getRequest()->getParam("id_niveau");

					$query = $db->select()->from('niveau', 'count(id_niveau)')->where('id_niveau = ?', $idniveau);

					$count = ($db->fetchOne($query));

					if ($count == 1) {

						$this->_redirect("index/modifierniveau");

					} else {
						echo "<script>alert('Niveau non trouvé !');</script>";
					}
				}
			}
		}
		$this->view->form = $form;
	}
	public function modifierniveauAction() {
		$form = new Application_Form_modifierniveau();
		$niveau = new Application_Model_niveau();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$donne = $this->getRequest()->getPost();
			if ($form->isValid($donne)) {
				if (isset ($_POST["modifier"])) {

					$id_niveau = $this->getRequest()->getParam("id_niveau");
					$where = $db->quoteInto('id_niveau = ?', $id_niveau);

					$data = array (
						"id_niveau" => $this->getRequest()->getParam("id_niveau"),
						"id_filiere" => $this->getRequest()->getParam("id_filiere"),
						"nom_niveau" => $this->getRequest()->getParam("nom_niveau")
					);
					$resultat = $niveau->update($data, $where);

				}
				if ($resultat == 1) {
					echo "<script>alert('Niveau modifié avec succès');</script>";
				} else {
					echo "<script>alert('Niveau non modifié ! Veuillez réessayer !');</script>";
				}

			}
		}

		$this->view->form = $form;

	}
	public function supprimerniveauAction() {
		$form = new Application_Form_supprimerniveau();
		$niveau = new Application_Model_niveau();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["supprimer"])) {

					$id_niveau = $this->getRequest()->getParam("id_niveau");
					$db = Zend_Db_Table :: getDefaultAdapter();
					$where = $db->quoteInto('id_niveau = ?', $id_niveau);
					$resultat = $db->delete('niveau', $where);

					if ($resultat == 1) {
						echo "<script>alert('Niveau supprimé avec succès');</script>";
					} else {
						echo "<script>alert('Niveau non trouvé. Veuillez saisir une valeur correcte !');</script>";
					}

				}

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
	public function idgroupeAction() {
		$form = new Application_Form_idgroupe();
		$groupe = new Application_Model_groupe();
		$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["modifier"])) {
					$idgroupe = $this->getRequest()->getParam("id_groupe");

					$query = $db->select()->from('groupe', 'count(id_groupe)')->where('id_groupe = ?', $idgroupe);

					$count = ($db->fetchOne($query));

					if ($count == 1) {

						$this->_redirect("index/modifiergroupe");

					} else {
						echo "<script>alert('Groupe non trouvé !');</script>";
					}
				}
			}
		}
		$this->view->form = $form;
	}
	public function modifiergroupeAction() {
		$form = new Application_Form_modifiergroupe();
		$groupe = new Application_Model_groupe();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$donne = $this->getRequest()->getPost();
			if ($form->isValid($donne)) {
				if (isset ($_POST["modifier"])) {

					$id_groupe = $this->getRequest()->getParam("id_groupe");
					$where = $db->quoteInto('id_groupe = ?', $id_groupe);

					$data = array (
						"id_groupe" => $this->getRequest()->getParam("id_groupe"),
						"id_niveau" => $this->getRequest()->getParam("id_niveau"),
						"nom_groupe" => $this->getRequest()->getParam("nom"),
						"effectif" => $this->getRequest()->getParam("effectif")
					);
					$resultat = $groupe->update($data, $where);

				}
				if ($resultat == 1) {
					echo "<script>alert('Groupe modifié avec succès');</script>";
				} else {
					echo "<script>alert('Groupe non modifié ! Veuillez réessayer !');</script>";
				}

			}
		}

		$this->view->form = $form;

	}
	public function supprimergroupeAction() {
		$form = new Application_Form_supprimergroupe();
		$groupe = new Application_Model_groupe();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["supprimer"])) {

					$id_groupe = $this->getRequest()->getParam("id_groupe");
					$db = Zend_Db_Table :: getDefaultAdapter();
					$where = $db->quoteInto('id_groupe = ?', $id_groupe);
					$resultat = $db->delete('groupe', $where);

					if ($resultat == 1) {
						echo "<script>alert('Groupe supprimée avec succès');</script>";
					} else {
						echo "<script>alert('Groupe non trouvé. Veuillez saisir une valeur correcte !');</script>";
					}

				}

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
                    "id_semestre" => $this->getRequest()->getParam("id_semestre"),				
				);

				$module->insert($data);
				echo "<script>alert('Module ajouté avec succès !');</script>";

			}

		}
		$this->view->form = $form;

	}
	public function idmoduleAction() {
		$form = new Application_Form_idmodule();
		$module = new Application_Model_module();
		$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["modifier"])) {
					$idmodule = $this->getRequest()->getParam("id_module");

					$query = $db->select()->from('module', 'count(id_module)')->where('id_module = ?', $idmodule);

					$count = ($db->fetchOne($query));

					if ($count == 1) {

						$this->_redirect("index/modifiermodule");

					} else {
						echo "<script>alert('Module non trouvé !');</script>";
					}
				}
			}
		}
		$this->view->form = $form;
	}
	public function modifiermoduleAction() {
		$form = new Application_Form_modifiermodule();
		$module = new Application_Model_module();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$donne = $this->getRequest()->getPost();
			if ($form->isValid($donne)) {
				if (isset ($_POST["modifier"])) {

					$id_module = $this->getRequest()->getParam("id_module");
					$where = $db->quoteInto('id_module = ?', $id_module);

					$data = array (
						"id_module" => $this->getRequest()->getParam("id_module"),
						"id_semestre" => $this->getRequest()->getParam("id_semestre")
					);
					$resultat = $module->update($data, $where);

				}
				if ($resultat == 1) {
					echo "<script>alert('Module modifié avec succès');</script>";
				} else {
					echo "<script>alert('Module non modifié ! Veuillez réessayer !');</script>";
				}

			}
		}

		$this->view->form = $form;

	}
	public function supprimermoduleAction() {
		$form = new Application_Form_supprimermodule();
		$module = new Application_Model_module();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["supprimer"])) {

					$id_module = $this->getRequest()->getParam("id_module");
					$db = Zend_Db_Table :: getDefaultAdapter();
					$where = $db->quoteInto('id_module = ?', $id_module);
					$resultat = $db->delete('module', $where);

					if ($resultat == 1) {
						echo "<script>alert('Module supprimé avec succès');</script>";
					} else {
						echo "<script>alert('Module non trouvé. Veuillez saisir une valeur correcte !');</script>";
					}

				}

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
					"id_prof" => $this->getRequest()->getParam("id_prof"),
					"id_module" => $this->getRequest()->getParam("id_module"),
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
	public function idmatiereAction() {
		$form = new Application_Form_idmatiere();
		$matiere = new Application_Model_matiere();
		$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["modifier"])) {
					$idmatiere = $this->getRequest()->getParam("id_matiere");

					$query = $db->select()->from('matiere', 'count(id_matiere)')->where('id_matiere = ?', $idmatiere);

					$count = ($db->fetchOne($query));

					if ($count == 1) {

						$this->_redirect("index/modifiermatiere");

					} else {
						echo "<script>alert('Matière non trouvée !');</script>";
					}
				}
			}
		}
		$this->view->form = $form;
	}
	public function modifiermatiereAction() {
		$form = new Application_Form_modifiermatiere();
		$matiere = new Application_Model_matiere();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$donne = $this->getRequest()->getPost();
			if ($form->isValid($donne)) {
				if (isset ($_POST["modifier"])) {

					$id_matiere = $this->getRequest()->getParam("id_matiere");
					$where = $db->quoteInto('id_matiere = ?', $id_matiere);

					$data = array (
						"id_matiere" => $this->getRequest()->getParam("id_matiere"),
						"id_prof" => $this->getRequest()->getParam("id_prof"),
						"id_module" => $this->getRequest()->getParam("id_module"),
						"nom_matiere" => $this->getRequest()->getParam("nom"),
						"volume_horaire" => $this->getRequest()->getParam("volume"),
						"coefficient" => $this->getRequest()->getParam("coeff"),

						
					);
					$resultat = $matiere->update($data, $where);

				}
				if ($resultat == 1) {
					echo "<script>alert('Matière modifiée avec succès');</script>";
				} else {
					echo "<script>alert('Matière non modifiée ! Veuillez réessayer !');</script>";
				}

			}
		}

		$this->view->form = $form;

	}

	public function supprimermatiereAction() {
		$form = new Application_Form_supprimermatiere();
		$matiere = new Application_Model_matiere();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["supprimer"])) {

					$id_matiere = $this->getRequest()->getParam("id_matiere");
					$db = Zend_Db_Table :: getDefaultAdapter();
					$where = $db->quoteInto('id_matiere = ?', $id_matiere);
					$resultat = $db->delete('matiere', $where);

					if ($resultat == 1) {
						echo "<script>alert('Matière supprimée avec succès');</script>";
					} else {
						echo "<script>alert('Matière non trouvée. Veuillez saisir une valeur correcte !');</script>";
					}

				}

			}
		}
		$this->view->form = $form;
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

	public function idcampusAction() {
		$form = new Application_Form_idcampus();
		$campus = new Application_Model_campus();
		$db = Zend_Db_Table_Abstract :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["modifier"])) {
					$idcampus = $this->getRequest()->getParam("id_campus");

					$query = $db->select()->from('campus', 'count(id_campus)')->where('id_campus = ?', $idcampus);

					$count = ($db->fetchOne($query));

					if ($count == 1) {

						$this->_redirect("index/modifiercampus");

					} else {
						echo "<script>alert('Campus non trouvé !');</script>";
					}
				}
			}
		}
		$this->view->form = $form;
	}
	public function modifiercampusAction() {
		$form = new Application_Form_modifiercampus();
		$campus = new Application_Model_campus();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$donne = $this->getRequest()->getPost();
			if ($form->isValid($donne)) {
				if (isset ($_POST["modifier"])) {

					$id_campus = $this->getRequest()->getParam("id_campus");
					$where = $db->quoteInto('id_campus = ?', $id_campus);

					$data = array (
						"id_campus" => $this->getRequest()->getParam("id_campus"),
						"id_admin" => $this->getRequest()->getParam("id_admin"),
						"arrondissement_campus" => $this->getRequest()->getParam("arr")
					);
					$resultat = $campus->update($data, $where);

				}
				if ($resultat == 1) {
					echo "<script>alert('Campus modifié avec succès');</script>";
				} else {
					echo "<script>alert('Campus non modifié ! Veuillez réessayer !');</script>";
				}

			}
		}

		$this->view->form = $form;

	}
	public function supprimercampusAction() {
		$form = new Application_Form_supprimercampus();
		$campus = new Application_Model_campus();
		$db = Zend_Db_Table :: getDefaultAdapter();
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if ($form->isValid($data)) {
				if (isset ($_POST["supprimer"])) {

					$id_campus = $this->getRequest()->getParam("id_campus");
					$db = Zend_Db_Table :: getDefaultAdapter();
					$where = $db->quoteInto('id_campus = ?', $id_campus);
					$resultat = $db->delete('campus', $where);

					if ($resultat == 1) {
						echo "<script>alert('Campus supprimé avec succès');</script>";
					} else {
						echo "<script>alert('Campus non trouvé. Veuillez saisir une valeur correcte !');</script>";
					}

				}

			}
		}
		$this->view->form = $form;
	}
	
    //Actions des professeurs et étudiants
	public function infoetudiantAction() {

	}
	public function programmeAction() {

	}
	public function listeetudiantAction() {

	}
	public function infoprofAction() {

	}
	public function listegroupeAction() {

	}
	public function listefiliereAction() {

	}
	public function listematiereAction() {

	}
	//Action de la rubrique campus
	public function campusAction() {

	}
    //Action du formulaire de la rubrique contactez-nous
	public function contactAction() {
		//On teste sur les champs du formulaire, s'ils sont vides, afficher des messages d'erreur
		if (empty ($_POST['name'])) {
			echo "<script>alert('champs vide. Veuillez le renseigner pour continuer !');</script>";
		} else
			if (empty ($_POST['email'])) {
				echo "<script>alert('champs vide. Veuillez le renseigner pour continuer !');</script>";
			} else
				if (empty ($_POST['msg'])) {
					echo "<script>alert('champs vide. Veuillez le renseigner pour continuer !');</script>";
				} else { //Sinon afficher message de succès
					echo "<script>alert('Votre message est envoyé. Merci!');</script>";
				}
	}
  //Action de la rubrique aide
	public function aideAction() {

	}
	//Action de déconnexion (EXIT)
	public function logoutAction() {
		//Ici, on doit détruire la session et rediriger vers la page d'authentification
		$sess = new Zend_Session_Namespace('Utilisateur');
		//il y a plusieurs manières de détruire la session, la plus simple et recommendée est destroy.
		Zend_Session :: destroy(true);
		$this->_redirect("index/auth");

	}

}