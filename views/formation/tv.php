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
    <div class="w-100">

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
        </div>

        <div class="card card-dark mt-5 p-3">
            <form method="POST" action="formations">
                <div class="row g-0 text-light">
                    <h6>Editer un commentaire</h6>
                    <div class="col-md-1" style="text-align: center;">

                        <h6>Note</h6>
                        <?php for ($i = 1; $i <= 5; $i++) {
                            ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radioCom"
                                       id="radioCom<?php echo $i ?>"
                                       value="radioCom">
                                <label class="form-check-label" for="radioCom"> <?php echo $i ?></label>
                            </div>
                        <?php }
                        ?>

                    </div>
                    <div class="col-md-10">
                        <label for="contentcomm" class="form-label">Contenu</label>
                        <textarea class="form-control" id="contentcomm" rows="3"></textarea>
                        <div id="commhelp" class="form-text">Doit contenir au moins 10 caractères</div>
                    </div>
                </div>
                <input type="submit" name="validComm" class="btn btn-primary" value="VALIDER">
            </form>
        </div>

        <div class="card card-dark mt-5 p-3">
            <div class="text-light">COMMENTAIRES</div>
            <?php
            foreach ($commentaires as $commentaire) { ?>
                <div class="card card-dark mb-3" style="max-width: 570px;">
                    <div class="row g-0">
                        <div class="col-md-2" style="text-align: center;">
                            <p class="text-light"> <?php
                                echo $commentaire["NOTECOM"];
                                ?> </p>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body fst-italic">
                                <?php
                                echo $commentaire["LIBELLECOM"];
                                ?>
                            </div>
                            <br>
                            <!--<footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>-->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <br>
</div>




