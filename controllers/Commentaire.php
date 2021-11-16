<?php


namespace controllers;


use controllers\base\Web;
use models\CommentaireModel;

class Commentaire extends Web
{
    protected $commentaireModel;

    public function __construct()
    {
        $this->commentaireModel = new CommentaireModel();
    }
    function insCommentaire()
    {
        $diplomes = $this->commentaireModel->getNoteCommentaire();
        if (isset($_POST['libcomm']) && strlen($_POST['libcomm']) <= 400 && isset($_POST['radioCom'])) {
            $libcomm = strip_tags($_POST["libcomm"]);

            var_dump($_POST['radioCom']);
            if ($this->commentaireModel->insCommentaire($libcomm, ($_POST['radioCom']), $idformation, $idinscrit)) {
                $this->redirect("tv");
            }
        }
    }
}