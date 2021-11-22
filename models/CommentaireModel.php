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
    public function supprimerCommentaire($idCommentaire) {
        $stmt = $this->pdo->prepare("DELETE FROM commentaire WHERE IDCOMMENTAIRE = :idCommentaire");
        if ($stmt->execute([$idCommentaire])) {
            return true;
        }
    }

    //requête pour récupérer les commentaires
    public function Commentaire($id_utilisateur) {
        $stmt = $this->pdo->prepare("SELECT IDCOMMENTAIRE, IDENTIFIANTVIDEO, NOTECOM, formation.IDFORMATION, LIBELLE, IMAGE, LIBELLECOM, DATE_FORMAT(DATECOM, '%d/%m/%Y') AS DATECOM FROM commentaire INNER JOIN formation ON commentaire.IDFORMATION = formation.IDFORMATION WHERE STATUTCOM = 1 AND IDINSCRIT = :idUtilisateur ORDER BY DATECOM DESC");
        $stmt->bindParam(':idUtilisateur',$id_utilisateur, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}