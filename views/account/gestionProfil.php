<?php

use utils\SessionHelpers;

$account = SessionHelpers::getConnected();

?>

<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="text-center pb-3">Modifier mes informations</h1>
                <div class="card">
                    <div class="card-body text-center">
                        <form method="POST" action="./modifInfos">
                            <h3 class="text-center pb-2">Modification du nom</h3>
                            <input name="nomModif" type="text" class="form-control" id="floatingInput"
                                   required="required" value="<?= $account["nom"] ?>"><br>
                            <h3 class="text-center pb-2">Modification du prénom</h3>
                            <input name="prenomModif" type="text" class="form-control" id="floatingInput"
                                   required="required" value="<?= $account["prenom"] ?>"><br>
                            <h3 class="text-center pb-2">Modification de l'adresse mail</h3>
                            <input name="mailModif" type="email" class="form-control" id="floatingInput"
                                   required="required" value="<?= $account['email'] ?>"><br>
                            <h3 class="text-center pb-2">Pour confirmer vos modifications, veuillez rentrer votre mot de
                                passe</h3>
                            <input name="mdpModif" type="password" class="form-control" id="floatingPassword"
                                   placeholder="Mot de passe" required="required"><br><br>
                            <button class="w-100 btn btn-lg btn-primary" type="submit">Modifier mes informations</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="text-center pb-3">Modifier mon mot de passe</h1>
                <div class="card">
                    <div class="card-body text-center">
                        <form method="POST" action="./modifMdp">
                            <h3 class="text-center pb-2">Mot de passe actuel</h3>
                            <input name="mdpModifMdp" type="password" class="form-control" id="floatingPassword"
                                   placeholder="Mot de passe" required="required"><br>
                            <h3 class="text-center pb-2">Nouveau mot de passe</h3>
                            <input name="NouvMdp" type="password" class="form-control" id="floatingPassword"
                                   placeholder="Mot de passe" required="required"><br><br>
                            <button class="w-100 btn btn-lg btn-primary" type="submit">Modifier mon mot de passe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="text-center pb-3">Modifier mon dernier diplôme obtenu</h1>
                <div class="card">
                    <div class="card-body text-center">
                        <form method="POST" action="./modifDiplome">
                            <h3 class="text-center pb-2">Modification du dernier diplôme obtenu</h3>
                            <select name="filterModifDiplome" class="form-select form-select-lg mb-3"
                                    aria-label=".form-select-lg example" required="required" value="">
                                <option value="">Dernier diplôme obtenu</option>
                                <?php
                                foreach ($diplomes as $diplome) {
                                    ?>
                                    <option value=<?= $diplome["IDDIPLOME"] ?>><?= $diplome["LIBELLEDIPLOME"] ?></option>

                                    <?php
                                }
                                ?>
                            </select>
                            <h3 class="text-center pb-2">Pour confirmer votre modification, veuillez rentrer votre mot de
                                passe</h3>
                            <input name="mdpModifDiplome" type="password" class="form-control" id="floatingPassword"
                                   placeholder="Mot de passe" required="required"><br><br>
                            <button class="w-100 btn btn-lg btn-primary" type="submit">Modifier mon dernier diplôme obtenu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>
