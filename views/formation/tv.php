<div class="d-flex flex-column align-items-center fit-content m-auto">
    <div class="fit-content">
        <div class="frame">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $video['IDENTIFIANTVIDEO']; ?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>
        <div class="stand">
            <?= $video['LIBELLE'] ?>

        </div>
    </div>
    <div class="w-100" style="max-width: 1000px">

        <div class="card card-dark mt-5 p-3">
            <div class="text-light"><?= $video['DESCRIPTION'] ?></div>

            <?php
            if (sizeof($competences) > 0) {
                ?>
                <hr class="dropdown-divider">
                <div>
                    <?php
                    foreach ($competences as $competence) {
                        ?>
                        <span class="badge bg-primary"><?= $competence["LIBELLECOMPETENCE"] ?></span>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
            <hr class="dropdown-divider">
            <p class="text-light">Auteur de la formation : <?= $video['PRENOM'] ?> <?= $video['NOM'] ?></p>
        </div>

        <?php
        if (\utils\SessionHelpers::isLogin()) {
        if ($questionCertif['QUESTION'] == NULL) { ?>

        <?php }
        else {
            ?>

            <div class="card card-dark mt-5 p-3" style="margin-bottom: -26px">
                <form method="POST" action="tv?id=<?= $video['IDENTIFIANTVIDEO']; ?>">
                    <div class="row g-0">
                        <h5 style="text-align: center" class="text-light">--- FORMATION CERTIFIABLE ---</h5>
                        <hr class="dropdown-divider ">
                        <p class="text-light" style="text-align: center">Cette formation est certifiable.<br>
                            Vous pourrez générer un pdf de la certification si vous répondez correctement à la question
                            ci-dessous.</p>
                        <hr class="dropdown-divider">
                        <div style="text-align: center">
                            <p class="text-light question"
                               style="text-align: center"><?= $questionCertif['QUESTION'] ?></p>
                            <br>
                            <label for="reponse" class="form-label text-light">Réponse</label>
                            <input class="form-control" id="reponse" name="reponse"><br>
                            <input type="submit" name="validReponse" class="btn btn-primary" value="VALIDER">
                        </div>
                    </div>
                </form>
            </div>
        <?php
        }
        ?>


        <div class="card card-dark mt-5 p-3" style="margin-bottom: -26px">
            <form method="POST" action="tv?id=<?= $video['IDENTIFIANTVIDEO']; ?>">
                <div class="row g-0">
                    <h5 style="text-align: center" class="text-light">--- EDITER UN COMMENTAIRE ---</h5>
                    <hr class="dropdown-divider">
                    <div class="col-md-1 text-light" style=" margin-bottom: 10px;">

                        <h7>Note</h7>
                        <?php for ($i = 1; $i <= 5; $i++) {
                            ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radioCom"
                                       id="radioCom<?php echo $i ?>"
                                       value="<?php echo $i ?>">
                                <label class="form-check-label" for="radioCom"> <?php echo $i ?></label>
                            </div>
                        <?php }
                        ?>
                    </div>

                    <div class="col-md-10">
                        <label for="contentcomm" class="form-label text-light">Contenu</label>
                        <textarea class="form-control" id="contentcomm" name="libcomm" "rows="3" style="height: 90px;
                        "></textarea>
                        <div id="commhelp" class="form-text">Doit contenir au moins 5 caractères</div>
                    </div>
                    <input type="submit" name="validInsComm" class="btn btn-primary" value="ENVOYER">
                </div>
            </form>
        </div>

        <div class="card card-dark mt-5 p-3">
            <div class="text-light" style="margin-bottom: 13px; text-align: center; font-size: 20px">--- COMMENTAIRES
                ---
            </div>
            <hr class="dropdown-divider ">
            <?php
            if (sizeof($commentaires) == 0) { ?>
                <p class="text-light" style="text-align: center"> Aucun commentaire posté sur cette formation.</br>
                    Il est toutefois possible qu'un commentaire soit en cours de modération. </p>
            <?php } else {
                foreach ($commentaires as $commentaire) { ?>
                    <div class="card card-dark mb-3" style=" margin-left: 13px; margin-right: 13PX;">
                        <div class="row g-0">
                            <div class="col-md-2" style="text-align: center; font-size:42px;">
                                <p class="text-light" style="text-shadow: 2px 2px 4px #dc3545;"> <?php
                                    echo $commentaire["NOTECOM"];
                                    ?>
                                    <i class="bi bi-star"
                                       style="font-size: 25px; text-shadow: 2px 2px 4px #dc3545;"></i></p>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body fst-italic text-light">
                                    <?php
                                    echo $commentaire["LIBELLECOM"];
                                    ?>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                <?php }
            }
            } ?>
        </div>
    </div>
    <br>