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
        $stmt = $this->pdo->prepare("SELECT * FROM inscrit WHERE EMAILINSCRIT = :mail LIMIT 1");
        $stmt->bindParam(':mail', $username);
        $stmt->execute();
        $inscrit = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($inscrit !== false && password_verify($password, $inscrit['MOTPASSEINSCRIT'])) {
            SessionHelpers::login(array("username" => "{$inscrit["PRENOMINSCRIT"]} {$inscrit["NOMINSCRIT"]}", "email" => $inscrit["EMAILINSCRIT"], "prenom" => $inscrit["PRENOMINSCRIT"], "nom" => $inscrit["NOMINSCRIT"], "id" => $inscrit["IDINSCRIT"]));
            return true;
        } else {
            SessionHelpers::logout();
            return false;
        }
    }

    public function loginVerif($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM inscrit WHERE EMAILINSCRIT = :mail LIMIT 1");
        $stmt->bindParam(':mail', $username);
        $stmt->execute();
        $inscrit = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($inscrit !== false && password_verify($password, $inscrit['MOTPASSEINSCRIT'])) {
            return true;
        } else {
            return false;
        }
    }

    // Requête qui vérifie que chaque utilisateur est différent (par son mail)
    public function verifMail($mail)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM inscrit WHERE EMAILINSCRIT = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $verif = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (empty($verif)) {
            return true;
        }
    }

    public function modifInfos($nomModif, $prenomModif, $mailModif, $mdp, $idInscrit)
    {
        $stmt = $this->pdo->prepare("UPDATE inscrit SET NOMINSCRIT = :nomModif, PRENOMINSCRIT = :prenomModif, EMAILINSCRIT = :mailModif WHERE IDINSCRIT = :idInscrit");
        $stmt->bindParam(':nomModif', $nomModif);
        $stmt->bindParam(':prenomModif', $prenomModif);
        $stmt->bindParam(':mailModif', $mailModif);
        $stmt->bindParam(':idInscrit', $idInscrit);
        $stmt->execute();
        $modifInfos = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (empty($modifInfos)) {
            return true;
        }
        if ($modifInfos !== false && password_verify($mdp, $modifInfos['MOTPASSEINSCRIT'])) {
            return true;
        }
    }

    public function modifDiplome($mdpModifDiplome, $diplomeModif, $idInscrit)
    {
        $stmt = $this->pdo->prepare("UPDATE inscrit SET IDDIPLOME = :diplomeModif WHERE IDINSCRIT = :idInscrit");
        $stmt->bindParam(':diplomeModif', $diplomeModif);
        $stmt->bindParam(':idInscrit', $idInscrit);
        $stmt->execute();
        $modifDiplome = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (empty($modifDiplome)) {
            return true;
        }
        if ($modifDiplome !== false && password_verify($mdpModifDiplome, $modifDiplome['MOTPASSEINSCRIT'])) {
            return true;
        }
    }

    public function modifMdp($mdpModifMdp, $NouvMdp, $idInscrit)
    {
        $NewMdp = password_hash($NouvMdp, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->pdo->prepare("UPDATE inscrit SET MOTPASSEINSCRIT = :NouvMdp WHERE IDINSCRIT = :idInscrit");
        $stmt->bindParam(':NouvMdp', $NewMdp);
        $stmt->bindParam(':idInscrit', $idInscrit);
        $stmt->execute();
        $modifMdp = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (empty($modifMdp)) {
            return true;
        }
        if ($modifMdp !== false && password_verify($mdpModifMdp, $modifMdp['MOTPASSEINSCRIT'])) {
            return true;
        }
    }

    public function register($nom, $prenom, $mail, $mdp, $iddiplome)
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
    public function certif($id_utilisateur)
    {
        $stmt = $this -> pdo -> prepare ("SELECT formation.IDFORMATION, formation.LIBELLE, certification.IDCERTIFICATION, dateobtentioncertif.IDINSCRIT, DATE_FORMAT(DATEOBTENTION, '%d/%m/%y') AS DATEOBTENTION FROM formation INNER JOIN certification ON formation.IDFORMATION=certification.IDCERTIFICATION INNER JOIN dateobtentioncertif ON certification.IDCERTIFICATION=dateobtentioncertif.IDCERTIFICATION WHERE IDINSCRIT = :idUtilisateur ORDER BY DATEOBTENTION DESC");
        $stmt->bindParam(':idUtilisateur',$id_utilisateur, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}