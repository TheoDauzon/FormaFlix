<?php


namespace controllers;


use controllers\base\Web;
use models\CommentaireModel;
use models\FormationModel;
use utils\SessionHelpers;


class Commentaire extends Web
{
    private $commentaireModel;
    private $formationModel;

    public function __construct()
    {
        $this->commentaireModel = new CommentaireModel();
        $this->formationModel = new FormationModel();
    }

    function listeCommentaire()
    {
        $this->header();
        $id_utilisateur = $_SESSION['USER']["id"];
        $commentaires = $this->commentaireModel->Commentaire($id_utilisateur); // Récupération des commentaires présents en base.
        include("views/account/gestionCommentaire.php"); // Affichage de votre vue.
        $this->footer(); // Affichage de votre pied de page.
    }

    function listeCertification()
    {
        $this->header();
        $id_utilisateur = $_SESSION['USER']["id"];
        $certifications = $this->commentaireModel->Certification($id_utilisateur); // Récupération des commentaires présents en base.
        include("views/account/voirCertification.php"); // Affichage de votre vue.
        $this->footer(); // Affichage de votre pied de page.
    }

    function supprimer($id = '')
    {
        $this->commentaireModel->supprimerCommentaire($id);
        $this->redirect("./gestionCommentaire");
    }

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

        if (SessionHelpers::isLogin()) {
            //commentaires associées à la vidéo
            $commentaires = $this->commentaireModel->getCommentaireById($video["IDFORMATION"]);

            $idForm = $video['IDFORMATION'];
            $idInscrit = $_SESSION['USER']['id'];
            $idStatut = 1;

            if (isset($_POST['validInsComm'])) {
                if (isset($_POST['libcomm']) && isset($_POST['radioCom'])) {
                    $idnote = $_POST['radioCom'];
                    $libcomm = strip_tags($_POST["libcomm"]);

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