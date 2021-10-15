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
        $stmt = $this->pdo->prepare("SELECT * FROM inscrit WHERE EMAILINSCRIT=? LIMIT 1");
        $stmt->execute([$username]);
        $inscrit = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($inscrit !== false && password_verify($password, $inscrit['MOTPASSEINSCRIT'])) {
            SessionHelpers::login(array("username" => "{$inscrit["NOMINSCRIT"]} {$inscrit["PRENOMINSCRIT"]}", "email" => $inscrit["EMAILINSCRIT"]));
            return true;
        } else {
            SessionHelpers::logout();
            return false;
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
        $stmt->execute();

        //On renvoie l'utilisateur vers la page de remerciement
        SessionHelpers::login(array("username" => "{$inscrit["NOMINSCRIT"]} {$inscrit["PRENOMINSCRIT"]}", "email" => $inscrit["EMAILINSCRIT"]));
        return true;
    }
}