<?php


namespace controllers;


use controllers\base\Web;
use models\AccountModel;
use models\DiplomeModel;
use utils\SessionHelpers;

class Account extends Web
{
    protected $accountModel;
    private $diplomeModel;

    public function __construct()
    {
        $this->accountModel = new AccountModel();
        $this->diplomeModel = new DiplomeModel();
    }

    // Méthode de connexion. Prise des paramètres en POST
    function login()
    {
        $error = false;
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $username = strip_tags($_POST['login']);
            $password = strip_tags($_POST['password']);
            if ($this->accountModel->login($username, $password)) {
                $this->redirect("me");
            } else {
                // Connexion impossible avec les identifiants fournis
                $error = true;
            }
        }

        $this->header();
        include("views/account/login.php");
        $this->footer();
    }

    // Méthode d'inscription. Prise des paramètres en POST
    function register()
    {
        $error = false;
        $diplomes = $this->diplomeModel->getDiplomes();
        if (isset($_POST['nom']) && strlen($_POST['nom']) <= 20 && isset($_POST['prenom']) && strlen($_POST['prenom']) <= 20 && isset($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && isset($_POST['mdp']) && isset($_POST['filterDiplome'])) {
            $nom = strip_tags($_POST["nom"]);
            $prenom = strip_tags($_POST["prenom"]);
            $username = strip_tags($_POST["mail"]);
            $password = strip_tags($_POST["mdp"]);
            if ($this->accountModel->verifMail($username)) {
                if ($this->accountModel->register($nom, $prenom, $username, $password, $_POST['filterDiplome'])) {
                    $this->accountModel->login($username, $password);
                    $this->redirect("me");
                } else {
                    // Connexion impossible avec les identifiants fourni.
                    $error = true;
                }
            }
        }

        $this->header();
        include("views/account/register.php");
        $this->footer();
    }

    function modifInfos()
    {
        $errorMail = false;
        $error = false;
        if (isset($_POST['nomModif']) && strlen($_POST['nomModif']) <= 20 && isset($_POST['prenomModif']) && strlen($_POST['prenomModif']) <= 20 && isset($_POST['mailModif']) && filter_var($_POST['mailModif'], FILTER_VALIDATE_EMAIL) && isset($_POST['mdpModif'])) {
            $nomModif = strip_tags($_POST["nomModif"]);
            $prenomModif = strip_tags($_POST["prenomModif"]);
            $mailModif = strip_tags($_POST["mailModif"]);
            $mdpModif = strip_tags($_POST["mdpModif"]);
            $idInscrit = $_SESSION['USER']['id'];
            if ($this->accountModel->loginVerif($mailModif, $mdpModif)) {
                if ($this->accountModel->verifMail($mailModif)) {
                    if ($this->accountModel->modifInfos($nomModif, $prenomModif, $mailModif, $mdpModif, $idInscrit)) {
                        SessionHelpers::logout();
                        $this->redirect("login");
                    }
                } else {
                    // Connexion impossible avec les identifiants fourni.
                    $errorMail = true;
                }
            } else {
                // Connexion impossible avec les identifiants fourni.
                $error = true;
            }
        }
        $this->header();
        include("views/account/gestionProfil.php");
        $this->footer();
    }

    function modifDiplome()
    {
        $error = false;
        if (isset($_POST['mdpModifDiplome']) && isset($_POST['filterModifDiplome'])) {
            $mailModif = $_SESSION['USER']['email'];
            $mdpModifDiplome = strip_tags($_POST["mdpModifDiplome"]);
            $diplomeModif = $_POST['filterModifDiplome'];
            $idInscrit = $_SESSION['USER']['id'];
            if ($this->accountModel->loginVerif($mailModif, $mdpModifDiplome)) {
                if ($this->accountModel->modifDiplome($mdpModifDiplome, $diplomeModif, $idInscrit)) {
                    SessionHelpers::logout();
                    $this->redirect("login");
                }
            } else {
                // Connexion impossible avec les identifiants fourni.
                $error = true;
            }
        }
        $this->header();
        include("views/account/gestionProfil.php");
        $this->footer();
    }

    function modifMdp()
    {
        $error = false;
        if (isset($_POST['mdpModifMdp']) && isset($_POST['NouvMdp'])) {
            $mailModif = $_SESSION['USER']['email'];
            $mdpModifMdp = strip_tags($_POST['mdpModifMdp']);
            $NouvMdp = strip_tags($_POST['NouvMdp']);
            $idInscrit = $_SESSION['USER']['id'];
            if ($this->accountModel->loginVerif($mailModif, $mdpModifMdp)) {
                if ($this->accountModel->modifMdp($mdpModifMdp, $NouvMdp, $idInscrit)) {
                    SessionHelpers::logout();
                    $this->redirect("login");
                }
            } else {
                // Connexion impossible avec les identifiants fourni.
                $error = true;
            }
        }
        $this->header();
        include("views/account/gestionProfil.php");
        $this->footer();
    }

    function gestionProfil()
    {
        $diplomes = $this->diplomeModel->getDiplomes();
        $this->header();
        include("views/account/gestionProfil.php");
        $this->footer();
    }

    function voirCertification()
    {
        $idInscrit = $_SESSION['USER']['id'];
        $certifications = $this->accountModel->getCertifByIdUt($idInscrit);
        var_dump($certifications);

        $this->header();
        include("views/account/voirCertification.php");
        $this->footer();
    }

// Déconnexion et suppression de la SESSION.
    function logout()
    {
        SessionHelpers::logout();
        $this->redirect("./");
    }

// Affiche l'utilisateur actuellement connecté.
    function me()
    {
        $this->header();
        include("views/account/me.php");
        $this->footer();
    }

    function gestionCommentaire()
    {
        $this->header();
        include("views/account/gestionCommentaire.php");
        $this->footer();
    }
}