<?php
namespace models;

use models\base\SQL;
use utils\SessionHelpers;

class AccountModel extends SQL
{
    public function __construct()
    {
        parent::__construct('inscrit', 'IDINSCRIT');
    }

    public function login($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM inscrit WHERE EMAILINSCRIT = :mail LIMIT 1");
        $stmt->bindParam(':mail', $username);
        $stmt->execute();
        $inscrit = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($inscrit !== false && password_verify($password, $inscrit['MOTPASSEINSCRIT'])) {
            SessionHelpers::login(array("username" => "{$inscrit["PRENOMINSCRIT"]} {$inscrit["NOMINSCRIT"]}", "email" => $inscrit["EMAILINSCRIT"], "prenom" => $inscrit["PRENOMINSCRIT"], "nom" => $inscrit["NOMINSCRIT"], "id" => $inscrit["IDINSCRIT"]));
            return true;
        } else {
            SessionHelpers::logout();
            return false;
        }
    }

    // Requête qui vérifie que chaque utilisateur est différent (par son mail)
    public function verifMail($mail)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM inscrit WHERE EMAILINSCRIT = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $verif =$stmt->fetch(\PDO::FETCH_ASSOC);
        if (empty($verif)) {
            return true;
        }
    }

    public function register($nom, $prenom, $mail, $mdp, $iddiplome)
    {

        // -> À faire, récupération des paramètres & création du mot de passe
        // -> Ajouter en base de données l'utilisateur.
        $mdp = password_hash($mdp, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->pdo->prepare("INSERT INTO inscrit VALUES (NULL, :nom, :prenom, :mail, :mdp, :iddiplome)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->bindParam(':iddiplome', $iddiplome);
        if ($stmt->execute()) {
            return true;
        }

    }
}