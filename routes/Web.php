<?php

namespace routes;

use controllers\Account;
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

        Route::Add('/', [$main, 'home']);
        Route::Add('/formations', [$formation, 'home']);
        Route::Add('/tv', [$formation, 'tv']);
        Route::Add('/about', [$main, 'about']);
        Route::Add('/login', [$account, 'login']);
        Route::Add('/register', [$account, 'register']);

        if (SessionHelpers::isLogin()) {
            Route::Add('/me', [$account, 'me']);
<<<<<<< HEAD
            Route::Add('/modifInfos', [$account, 'modifInfos']);
            Route::Add('/modifDiplome', [$account, 'modifDiplome']);
            Route::Add('/modifMdp', [$account, 'modifMdp']);
            Route::Add('/gestionProfil', [$account, 'gestionProfil']);
            Route::Add('/gestionCommentaire', [$account, 'gestionCommentaire']);
            Route::Add('/voirCertification', [$account, 'voirCertification']);
            Route::Add('/logout', [$account, 'logout']);
=======
            Route::Add('/gestionProfil', [$account, 'gestionProfil']);
            Route::Add('/gestionCommentaire', [$account, 'gestionCommentaire']);
            Route::Add('/logout', [$account, 'logout']);
            //Route::Add('/tv', [$formation, 'insCommentaire']);

>>>>>>> 9e72c99c69e74e115762d4364d0cad97387252fb
        }
    }
}

