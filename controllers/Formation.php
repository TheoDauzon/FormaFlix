<?php

namespace controllers;

use controllers\base\Web;
use models\CompetenceModel;
use models\FormationModel;
<<<<<<< HEAD
=======
use models\CommentaireModel;
>>>>>>> 9e72c99c69e74e115762d4364d0cad97387252fb
use utils\SessionHelpers;

/**
 * Contrôleur des formations
 * Affichage de la liste des formations.
 */
class Formation extends Web
{
    private $formationModel;
    private $competenceModel;
<<<<<<< HEAD
=======
    private $commentaireModel;
>>>>>>> 9e72c99c69e74e115762d4364d0cad97387252fb

    function __construct()
    {
        $this->formationModel = new FormationModel();
        $this->competenceModel = new CompetenceModel();
<<<<<<< HEAD
=======
        $this->commentaireModel = new CommentaireModel();
>>>>>>> 9e72c99c69e74e115762d4364d0cad97387252fb
    }

    // Affichage de la page d'accueil avec en fonction si connecté ou non une liste plus complète.
    function home($filterCompet = "")
    {
        if (SessionHelpers::isLogin()) {
            if ($filterCompet == "") {
                $formations = $this->formationModel->getVideos();
                $competences = $this->competenceModel->getCompetences();
            } else {
                // Récupération des vidéos par le modèle
                $formations = $this->formationModel->getVideosComp($filterCompet);
                $competences = $this->competenceModel->getCompetences();
            }
        } else {
            if ($filterCompet == "") {
                $formations = $this->formationModel->getPublicVideos();
                $competences = $this->competenceModel->getCompetences();
            } else {
                $formations = $this->formationModel->getPublicVideosComp($filterCompet);
                $competences = $this->competenceModel->getCompetences();
            }
        }
        $this->header();
        include("./views/formation/filter.php");
        include("./views/formation/list.php");
        $this->footer();
    }

    /**
     * $id est automatiquement rempli via la valeur du GET
     * @param $id
     */
    function tv($id)
    {
        // Récupération de la vidéo par rapport à l'ID demandé
        $video = $this->formationModel->getByVideoId($id);
        if (!$video) {
            $this->redirect("./formations");
        }

        // Les vidéos non public ne doivent pas être visible si non connecté
        if ($video['VISIBILITEPUBLIC'] == 0 && !SessionHelpers::isLogin()) {
            $this->redirect("./formations");
        }

        // Compétences associées à la vidéo
        $competences = $this->formationModel->competencesFormation($video["IDFORMATION"]);

<<<<<<< HEAD
=======
        //commentaires associées à la vidéo
        $commentaires = $this->commentaireModel->getCommentaireById($video["IDFORMATION"]);

        $idForm = $video['IDFORMATION'];
        var_dump($idForm);
        $idInscrit = $_SESSION['USER']['id'];
        $idStatut = 1;

        if (isset($_POST['validInsComm'])) {
            if (isset($_POST['libcomm']) && isset($_POST['radioCom'])) {
                $idnote = $_POST['radioCom'];
                $libcomm = strip_tags($_POST["libcomm"]);

                if ($this->commentaireModel->insCommentaire($libcomm, $idnote, $idStatut, $idForm, $idInscrit)) {
                    $idVideoUrl =$video['IDENTIFIANTVIDEO'];
                    $this->redirect("tv?id=$idVideoUrl");
                }
            }
        }

>>>>>>> 9e72c99c69e74e115762d4364d0cad97387252fb
        $this->header();
        include("./views/formation/tv.php");
        $this->footer();
    }
}