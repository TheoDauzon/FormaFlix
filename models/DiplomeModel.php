<?php


namespace models;

use models\base\SQL;

class DiplomeModel extends SQL
{
    public function __construct()
    {
        parent::__construct("diplome", "IDDIPLOME");
    }
    function getDiplomes()
    {
        $stmt = $this->pdo->query("SELECT * FROM diplome");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Requête modification de "termine"
    function modifDiplome($idNouveauDiplome, $id) {
        $stmt = $this->pdo->prepare('UPDATE inscrit SET IDDIPLOME = :idNouveauDiplome WHERE IDINSCRIT = :id');
        $stmt->bindParam(':idNouveauDiplome', $idNouveauDiplome);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
    }
}