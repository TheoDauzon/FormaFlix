<?php

namespace models;

use models\base\SQL;

class CompetenceModel extends SQL
{
    public function __construct()
    {
        parent::__construct("competence", "IDCOMPETENCE");
    }
    function getCompetences()
    {
        $stmt = $this->pdo->query("SELECT * FROM competence");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}