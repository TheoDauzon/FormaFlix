<div class="container">
    <div class="row pt-5">
        <form method="POST" action="formations">
            <select name="filterCompet" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected value="">Toutes les compétences</option>
                <?php
                foreach ($competences as $competence) {
                ?>
                <option value=<?= $competence["IDCOMPETENCE"] ?>><?= $competence["LIBELLECOMPETENCE"] ?></option>

                    <?php
                }
                ?>
                <input type="submit" name="validFormat" class="btn btn-primary" value="VALIDER">
            </select>
        </form>
    </div>
</div>
