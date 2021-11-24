<?php

namespace controllers;

use controllers\base\Web;
use models\CompetenceModel;
use models\FormationModel;
use models\CommentaireModel;
use utils\SessionHelpers;

/**
 * Contrôleur des formations
 * Affichage de la liste des formations.
 */
class Formation extends Web
{
    private $formationModel;
    private $competenceModel;
    private $commentaireModel;


    function __construct()
    {
        $this->formationModel = new FormationModel();
        $this->competenceModel = new CompetenceModel();
        $this->commentaireModel = new CommentaireModel();
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

        //insertion et affichage commentaire si l'ut est connecté
        if (SessionHelpers::isLogin()) {
            //commentaires associées à la vidéo
            $commentaires = $this->commentaireModel->getCommentaireById($video["IDFORMATION"]);

            //récupération des données à insérer
            $idForm = $video['IDFORMATION'];
            $idInscrit = $_SESSION['USER']['id'];
            $idStatut = 1;

            //vérification que tous les champs sont remplis
            if (isset($_POST['validInsComm'])) {
                if (isset($_POST['libcomm']) && isset($_POST['radioCom'])) {
                    //récupération données rentrées par l'ut
                    $idnote = $_POST['radioCom'];
                    $libcomm = strip_tags($_POST["libcomm"]);

                    //si l'insertion se fait bien -> actualisation de la page formation avec l'affichage du comm
                    if ($this->commentaireModel->insCommentaire($libcomm, $idnote, $idStatut, $idForm, $idInscrit)) {
                        $idVideoUrl = $video['IDENTIFIANTVIDEO'];
                        $this->redirect("tv?id=$idVideoUrl");
                    }
                }
            }
        }

        $this->header();
        include("./views/formation/tv.php");
        $this->footer();
    }
}