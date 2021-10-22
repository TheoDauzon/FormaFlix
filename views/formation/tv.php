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
            <div class="row g-0 text-light">
                <h6>Editer un commentaire</h6>
                <div class="col-md-2" style="text-align: center;">
                    <h6>Note</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                               value="option1">
                        <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                               value="option2">
                        <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                               value="option3">
                        <label class="form-check-label" for="inlineRadio3">3 </label>
                    </div>
                </div>
                <div class="col-md-9">
                    <label for="exampleFormControlTextarea1" class="form-label">Contenu</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <div id="emailHelp" class="form-text">Doit contenir au moins 10 caractères</div>
                </div>
            </div>
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




