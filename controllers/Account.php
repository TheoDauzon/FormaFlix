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
            if ($this->accountModel->login($_POST["login"], $_POST["password"])) {
                $this->redirect("me");
            } else {
                // Connexion impossible avec les identifiants fourni.
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
        function valid_donnees($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
        }

        $diplomes = $this->diplomeModel->getDiplomes();
        if (isset($_POST['nom']) && strlen($_POST['nom']) <= 20 && isset($_POST['prenom'])  && strlen($_POST['prenom']) <= 20 && isset($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && isset($_POST['mdp']) && isset($_POST['filterDiplome'])) {

            $nom = valid_donnees($_POST["nom"]);
            $prenom = valid_donnees($_POST["prenom"]);
            $mail = valid_donnees($_POST["mail"]);
            $mdp = valid_donnees($_POST["mdp"]);


            if ($this->accountModel->register($_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["mdp"], $_POST['filterDiplome'])) {
                $this->redirect("me");
            } else {
                // Connexion impossible avec les identifiants fourni.
                $error = true;
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
}