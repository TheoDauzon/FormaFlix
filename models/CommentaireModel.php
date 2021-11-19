<?php
namespace models;

use models\base\SQL;

class CommentaireModel extends SQL
{
    public function __construct()
    {
        parent::__construct('commentaire', 'IDCOMMENTAIRE');
    }

    public function getCommentaireById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM commentaire WHERE idformation = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insCommentaire($libcomm, $idnote, $idStatut, $idForm, $idInscrit)
    {
        // -> Insérer dans la bdd la note et le commentaire
        $stmt = $this->pdo->prepare("INSERT INTO commentaire VALUES (NULL, :libcomm, :idnote, :idStatut, :idForm, :idinscrit, CURRENT_DATE )");
        $stmt->bindParam(':libcomm', $libcomm);
        $stmt->bindParam(':idnote', $idnote);
        $stmt->bindParam(':idStatut', $idStatut);
        $stmt->bindParam(':idForm', $idForm);
        $stmt->bindParam(':idinscrit', $idInscrit);

        if ($stmt->execute()) {
            return true;
        }
    }

    // Requête supression d'un commentaire
    function supprimerCommentaire($id) {
        $stmt = $this->pdo->prepare("DELETE FROM commentaire WHERE id = :idCommentaire");
        $stmt->bindParam(':id', $id);
        $stmt->execute([$id]);
    }

    //requête pour récupérer les commentaires
    function listeCommentaire($id_utilisateur) {
        $stmt = $this->pdo->prepare("SELECT * FROM commentaire WHERE  =1 AND id_utilisateur=:id_utilisateur");
        $stmt->bindParam(':id_utilisateur',$id_utilisateur, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}