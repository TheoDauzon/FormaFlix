<?php

namespace routes;

use controllers\Account;
use controllers\Commentaire;
use controllers\Formation;
use controllers\Main;
use routes\base\Route;
use utils\SessionHelpers;

class Web
{
    function __construct()
    {
        $main = new Main();
        $formation = new Formation();
        $account = new Account();
        $commentaire = new Commentaire();

        Route::Add('/', [$main, 'home']);
        Route::Add('/formations', [$formation, 'home']);
        Route::Add('/tv', [$formation, 'tv']);
        Route::Add('/about', [$main, 'about']);
        Route::Add('/login', [$account, 'login']);
        Route::Add('/register', [$account, 'register']);

        if (SessionHelpers::isLogin()) {
            Route::Add('/me', [$account, 'me']);
            Route::Add('/gestionCommentaire', [$commentaire, 'listeCommentaire']);
            Route::Add('/supprimer', [$commentaire, 'supprimer']);
            Route::Add('/tv', [$commentaire, 'tv']);
            Route::Add('/tv', [$formation, 'tv']);
            //Route::Add('/tv', [$formation, 'tv']);
            Route::Add('/modifier', [$commentaire, 'modifier']);
            Route::Add('/modifInfos', [$account, 'modifInfos']);
            Route::Add('/modifDiplome', [$account, 'modifDiplome']);
            Route::Add('/modifMdp', [$account, 'modifMdp']);
            Route::Add('/gestionProfil', [$account, 'gestionProfil']);
            Route::Add('/voirCertification', [$account, 'voirCertification']);
            Route::Add('/logout', [$account, 'logout']);

        }
    }
}

