<?php


namespace controllers;


use controllers\base\Web;
use models\CommentaireModel;


class Commentaire extends Web
{

    public function __construct()
    {
        $this->commentaireModel = new CommentaireModel();
    }

    function listeCommentaire()
    {
        $this->header();
        $id_utilisateur = $_SESSION['USER']["id"];
        $commentaires = $this->commentaireModel->listeCommentaire($id_utilisateur); // Récupération des TODOS présents en base.

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