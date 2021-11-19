<div class="cover-gradient full-height pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="card card-dark">
                    <div class="card-body text-center p-5">
                        <main class="form-signin">
                            <?php
                            if (isset($error) && $error === true) {
                                ?>
                                <div class="alert alert-danger">Erreur dans votre inscription</div>
                                <?php
                            }
                            ?>
                            <form method="POST" action="./register">
                                <h1 class="h3 mb-3 fw-normal text-light">Inscription</h1>

                                <div class="form-floating">
                                    <input name="nom" type="text" class="form-control" id="floatingInput" placeholder="Nom" required="required">
                                    <label for="floatingInput">Nom</label>
                                </div>

                                <div class="form-floating mt-2">
                                    <input name="prenom" type="text" class="form-control" id="floatingInput" placeholder="Prénom" required="required">
                                    <label for="floatingInput">Prénom</label>
                                </div>

                                <div class="form-floating mt-2">
                                    <input name="mail" type="email" class="form-control" id="floatingInput" placeholder="Email" required="required">
                                    <label for="floatingInput">Adresse email</label>
                                </div>

                                <div class="form-floating mt-2">
                                    <input name="mdp" type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe" required="required">
                                    <label for="floatingPassword">Mot de passe</label>
                                </div><br>

                                <select name="filterDiplome" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required="required">
                                    <option value="">Dernier diplôme obtenu</option>
                                    <?php
                                    foreach ($diplomes as $diplome) {
                                        ?>
                                        <option value=<?= $diplome["IDDIPLOME"] ?>><?= $diplome["LIBELLEDIPLOME"] ?></option>

                                        <?php
                                    }
                                    ?>
                                </select>

                                <button class="w-100 mt-5 btn btn-lg btn-primary" type="submit">S'inscrire</button>
                            </form>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
