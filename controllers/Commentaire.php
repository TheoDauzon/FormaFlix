<?php


namespace controllers;


use controllers\base\Web;
use models\CommentaireModel;


class Commentaire extends Web
{
    private $commentaireModel;

    public function __construct()
    {
        $this->commentaireModel = new CommentaireModel();
    }

    function listeCommentaire()
    {
        $this->header();
        $id_utilisateur = $_SESSION['USER']["id"];
        $commentaires = $this->commentaireModel->Commentaire($id_utilisateur); // Récupération des commentaires présents en base.
        include("views/account/gestionCommentaire.php"); // Affichage de votre vue.
        $this->footer(); // Affichage de votre pied de page.
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