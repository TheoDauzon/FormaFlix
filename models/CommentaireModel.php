<?php
namespace models;

use models\base\SQL;
use utils\SessionHelpers;



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

    public function getNoteCommentaire($idform, $idcomm){
        $stmt = $this->pdo->prepare("SELECT IDCOMMENTAIRE, LIBELLECOM, NOTECOM, STATUTCOM, commentaire.IDINSCRIT, commentaire.IDFORMATION, LIBELLE, NOMINSCRIT, PRENOMINSCRIT FROM commentaire RIGHT JOIN formation f ON commentaire.IDFORMATION=f.IDFORMATION RIGHT JOIN inscrit i ON commentaire.IDINSCRIT=i.IDINSCRIT WHERE idformation = ? AND idcommentaire = ?");
        $stmt->execute([$idform, $idcomm]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insCommentaire($libcomm, $idnote, $idformation, $idinscrit)
    {
        // -> Insérer dans la bdd la note et le commentaire
        $stmt = $this->pdo->prepare("INSERT INTO commentaire VALUES (NULL, :libcomm, :idnote, 1, :idformation, :idinscrit)");
        $stmt->bindParam(':libcomm', $libcomm);
        $stmt->bindParam(':idnote', $idnote);
        $stmt->bindParam(':idformation', $idformation);
        $stmt->bindParam(':idinscrit', $idinscrit);

        if ($stmt->execute()) {
            return true;
        }
    }
}