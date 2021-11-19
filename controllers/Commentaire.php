<?php


namespace controllers;


use controllers\base\Web;
use models\CommentaireModel;
use utils\SessionHelpers;


class Commentaire extends Web
{
    private $commentaireModel;

    public function __construct()
    {
        $this->CommentaireModel = new CommentaireModel();
    }

    function listeCommentaire()
    {
        $id_utilisateur = $_SESSION['USER']["id"];
        $listecommentaires = $this->commentaireModel->listeCommentaire($id_utilisateur); // Récupération des TODOS présents en base.

        $this->header();
        include("views/account/gestionCommentaire.php");
        $this->footer();
    }

    function modifier(){

    }

    // Méthode pour changer l'état d'une tâche
    function supprimer($id = '')
    {
        if ($id != "") {
            $this->commentaireModel->supprimerCommentaire($id);
        }

        $this->redirect("./listeCommentaire");
    }
}