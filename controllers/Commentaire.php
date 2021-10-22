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

}