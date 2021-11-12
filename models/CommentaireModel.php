<?php
namespace models;

use models\base\SQL;


class CommentaireModel extends SQL
{
    public function __construct()
    {
        parent::__construct('commentaire', 'IDCOMMENTAIRE');
    }

    public function insCommentaire($libcomm, $idnote, $idformation, $idinscrit)
    {
        // -> Ajouter en base de données la note et le commentaire
        $stmt = $this->pdo->prepare("INSERT INTO commentaire VALUES (NULL, :libcomm, :idnote, 1, :idformation, :idinscrit)");
        $stmt->bindParam(':libcomm', $libcomm);
        $stmt->bindParam(':idnote', $idnote);
        $stmt->bindParam(':idformation', $idformation);
        $stmt->bindParam(':idinscrit', $idinscrit);

        if ($stmt->execute()) {
            return true;
        }
    }
    public function getNoteCommentaire($idform, $idcomm){
        $stmt = $this->pdo->prepare("SELECT * FROM commentaire WHERE idformation = ? AND idcommentaire = ?");
        $stmt->execute([$idform, $idcomm]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}