<?php

use utils\Gravatar;
use utils\SessionHelpers;

$account = SessionHelpers::getConnected();
?>
<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <img class="m-5" src="<?= Gravatar::get_gravatar($account['email']) ?>"/>
                <h3 class="text-center pb-5">Bienvenue <?= $account['username'] ?></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo labore libero neque perferendis
                    praesentium quae. Accusamus ad aperiam architecto cumque eligendi enim facilis illo, incidunt nemo
                    quae quia quo voluptate?</p>

                <div class="mt-5">

                    <a class="btn btn-danger d-block full" href="./logout">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <form method="POST" action="./me">
                    <h3 class="text-center pb-5">Modification du dernier diplôme obtenu</h3>
                    <select name="filterDiplome" class="form-select form-select-lg mb-3"
                            aria-label=".form-select-lg example" required="required">
                        <option value="">Dernier diplôme obtenu</option>
                        <?php
                        foreach ($diplomes as $diplome) {
                            ?>
                            <option value=<?= $diplome["IDDIPLOME"] ?>><?= $diplome["LIBELLEDIPLOME"] ?></option>

                            <?php
                        }
                        ?>
                    </select>

                    <button class="w-100 mt-5 btn btn-lg btn-primary" type="submit">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
