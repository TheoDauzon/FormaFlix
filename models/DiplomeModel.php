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

    function modifDiplome($iddiplome)
    {
        $stmt = $this->pdo->query("SELECT * FROM diplome");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}