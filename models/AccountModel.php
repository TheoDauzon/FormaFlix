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

    public function register($nom,$prenom,$email,$mdp){

        // -> À faire, récupération des paramètres & création du mot de passe
        // -> Ajouter en base de données l'utilisateur.
        // password_hash($password, PASSWORD_BCRYPT, ['cost' => 12])
        $stmt = $this->pdo->prepare("INSERT INTO (prenom, mail, age, sexe, pays) VALUES (:prenom, :mail, :age, :sexe, :pays)");
        $stmt->bindParam(':prenom',$prenom);
        $stmt->bindParam(':mail',$mail);
        $stmt->bindParam(':age',$age);
        $stmt->bindParam(':sexe',$sexe);
        $stmt->bindParam(':pays',$pays);
        $stmt->execute();
        //On renvoie l'utilisateur vers la page de remerciement
        header("Location:form-merci.html");

    }
}