<?php

use utils\Gravatar;
use utils\SessionHelpers;

$account = SessionHelpers::getConnected();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-3">
            <a class="w-100 mt-2 btn btn-lg btn-primary" href="./gestionProfil">Gestion de mon profil</a>
            <a class="w-100 mt-5 btn btn-lg btn-primary" href="./gestionCommentaire">Gestion des commentaires</a>
            <a class="w-100 mt-5 btn btn-lg btn-primary" href="./voirCertification">Voir mes certifications</a>
            <a class="w-100 mt-5 btn btn-lg btn-danger" href="./logout">Déconnexion</a>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body text-center">
                    <img class="m-5" src="<?= Gravatar::get_gravatar($account['email']) ?>"/>
                    <h3 class="text-center pb-2">Bienvenue <?= $account['username'] ?></h3>
                    <p>Vous pouvez désormais suivre des formations et tenter de décrocher une certification qui prouve que vous
                        l'avez suivi. Vous êtes sur la page de gestion de votre compte, vous pouvez ainsi gérer votre
                        profil en y
                        modifiant certaines coordonnées. Vous pouvez également gérer les commentaires que vous avez
                        publié pour les modifier ou bien les
                        supprimer.</p>

                </div>
            </div>
        </div>
    </div>
</div>
