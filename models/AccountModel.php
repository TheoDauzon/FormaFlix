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

    public function register(){
        // -> À faire, récupération des paramètres & création du mot de passe
        // -> Ajouter en base de données l'utilisateur.
        // password_hash($password, PASSWORD_BCRYPT, ['cost' => 12])
    }
}