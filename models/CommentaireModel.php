<?php
namespace models;

use models\base\SQL;


class CommentaireModel extends SQL
{
    public function __construct()
    {
        parent::__construct('commentaire', 'IDCOMMENTAIRE');
    }

    public function insCommentaire($nom, $prenom, $mail, $mdp, $iddiplome)
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