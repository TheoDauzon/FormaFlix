<?php

namespace controllers;

use controllers\base\Web;
use models\CompetenceModel;
use models\FormationModel;
use utils\SessionHelpers;

/**
 * Contrôleur des formations
 * Affichage de la liste des formations.
 */
class Formation extends Web
{
    private $formationModel;
    private $competenceModel;

    function __construct()
    {
        $this->formationModel = new FormationModel();
        $this->competenceModel= new CompetenceModel();
    }


    // Affichage de la page d'accueil avec en fonction si connecté ou non une liste plus complète.
    function home()
    {
        $formations = [];
        $competences = [];

        if (SessionHelpers::isLogin()) {
            // Récupération des vidéos par le modèle
            $formations = $this->formationModel->getVideos();
            $competences = $this->competenceModel->getCompetences();

        } else {
            $formations = $this->formationModel->getPublicVideos();
            $competences = $this->competenceModel->getCompetences();


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
        if($video['VISIBILITEPUBLIC'] == 0 && !SessionHelpers::isLogin()){
            $this->redirect("./formations");
        }

        // Compétences associées à la vidéo
        $competences = $this->formationModel->competencesFormation($video["IDFORMATION"]);

        $this->header();
        include("./views/formation/tv.php");
        $this->footer();
    }
}