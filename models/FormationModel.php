<?php

namespace models;

use models\base\SQL;

class FormationModel extends SQL
{
    public function __construct()
    {
        parent::__construct('formation', "IDFORMATION");
    }

    function getPublicVideos()
    {
        $stmt = $this->pdo->query("SELECT * FROM formation where (VISIBILITEPUBLIC = 1) AND (DATEVISIBILITE<= current_date)");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getPublicVideosComp($competenceID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM formation INNER JOIN developper d ON formation.IDFORMATION = d.IDFORMATION where (VISIBILITEPUBLIC = 1) AND (DATEVISIBILITE<= CURRENT_DATE) AND d.IDCOMPETENCE = ?");
        $stmt->execute([$competenceID]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getVideosComp($competenceID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM formation INNER JOIN developper d ON formation.IDFORMATION = d.IDFORMATION where (DATEVISIBILITE<= CURRENT_DATE) AND d.IDCOMPETENCE = ?");
        $stmt->execute([$competenceID]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getVideos()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM formation where (DATEVISIBILITE <= current_date)");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getByVideoId($videoId)
    {
        // Utilisation d'une query a la place d'un simple getOne car la requête
        // est réalisé sur un champs différent que l'ID de la table.

        $stmt = $this->pdo->prepare("SELECT * FROM formation INNER JOIN utilisateur ON formation.IDUTILISATEUR = utilisateur.IDUTILISATEUR WHERE IDENTIFIANTVIDEO = ?");
        $stmt->execute([$videoId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function competencesFormation($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM competence LEFT JOIN developper d on competence.IDCOMPETENCE = d.IDCOMPETENCE WHERE d.IDFORMATION = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getQuestionById($videoId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM formation WHERE IDENTIFIANTVIDEO = ?");
        $stmt->execute([$videoId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    function verifReponse($idForm, $reponse)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM formation WHERE IDFORMATION = :idForm AND REPONSE = :reponse");
        $stmt->bindParam(':idForm', $idForm);
        $stmt->bindParam(':reponse', $reponse);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    function insertionCertification($idForm)
    {
        $stmt = $this->pdo->prepare("INSERT INTO certification VALUES (NULL, :idForm)");
        $stmt->bindParam(':idForm', $idForm);

        if ($stmt->execute()) {
            return true;
        }
    }

    function getCertificationById($idForm)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM certification WHERE IDFORMATION = ?");
        $stmt->execute([$idForm]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    function dateObtentionCertification($idCertif, $idInscrit)
    {
        $stmt = $this->pdo->prepare("INSERT INTO dateobtentioncertif VALUES (:idCertif, :idInscrit, CURRENT_DATE)");
        $stmt->bindParam(':idCertif', $idCertif);
        $stmt->bindParam(':idInscrit', $idInscrit);
        if ($stmt->execute()) {
            return true;
        }
    }
}