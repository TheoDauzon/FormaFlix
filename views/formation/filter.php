<div class="container">
    <div class="row pt-5">
<?php var_dump($competence);?>
        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option selected>Selon quelle compétence?</option>
            <?php
            foreach ($competences as $competence) {
            ?>
            <option value=<?= $competence["IDCOMPETENCE"] ?>><?= $competence["LIBELLECOMPETENCE"] ?></option>

                <?php
            }
            ?>
        </select>
    </div>
</div>
