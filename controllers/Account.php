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
            var_dump($nom);
            var_dump($prenom);
            var_dump($username);
            var_dump($password);
            var_dump($_POST['filterDiplome']);
            if ($this->accountModel->verifMail($username)) {
                if ($this->accountModel->register($nom, $prenom, $username, $password, $_POST['filterDiplome'])) {
                    $this->accountModel->login($username, $password);
                    $this->redirect("me");
                }
            }
        }

        $this->header();
        include("views/account/register.php");
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

// Affiche l'utilisateur actuellement connecté.
    function gestionProfil()
    {
        $this->header();
        include("views/account/gestionProfil.php");
        $this->footer();
    }

    function gestionCommentaire()
    {
        $this->header();
        include("views/account/gestionCommentaire.php");
        $this->footer();
    }
}