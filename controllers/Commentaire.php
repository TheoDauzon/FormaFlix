<?php


namespace controllers;


use controllers\base\Web;
use models\CommentaireModel;
use models\formationModel;
use utils\SessionHelpers;

class Commentaire extends Web
{
    protected $commentaireModel;
    private $formationModel;


    public function __construct()
    {
        $this->commentaireModel = new CommentaireModel();
        $this->formationModel = new FormationModel();
    }

    /**
     * $id est automatiquement rempli via la valeur du GET
     * @param $id
     */

    function insCommentaire($id, $validInsComm)
    {
        $video = $this->formationModel->getByVideoId($id);
        $idForm = $this-> commentaireModel->getCommentaireById($video["IDFORMATION"]);
        $idInscrit = $_SESSION['USER']['id'];

        if (isset($_POST['libcomm']) && strlen($_POST['libcomm']) <= 400 && isset($_POST['radioCom'])) {
            $libcomm = strip_tags($_POST["libcomm"]);

            var_dump($_POST['radioCom']);
            if ($this->commentaireModel->insCommentaire($libcomm, ($_POST['radioCom']), $idForm, $idInscrit)) {
                $this->redirect("tv");
            }
        }
    }
}