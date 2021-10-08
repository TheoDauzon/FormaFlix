<?php


namespace controllers;

use controllers\base\Web;
use models\DiplomeModel;

class Diplome extends Web
{
    private $diplomeModel;

    function __construct()
    {
        $this->diplomeModel = new DiplomeModel();
    }

    function home($filterDiplome = "")
    {
        $diplomes = $this->diplomeModel->getDiplomes();
    }
}