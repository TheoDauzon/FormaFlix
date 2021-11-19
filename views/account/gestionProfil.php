<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="text-center pb-3">Modification du profil</h1>
                <div class="card">
                    <div class="card-body text-center">
                        <form method="POST" action="./me">
                            <h3 class="text-center pb-2">Modification du nom</h3>
                            <input name="nom" type="text" class="form-control" id="floatingInput" placeholder="Nom"
                                   required="required"><br>
                            <h3 class="text-center pb-2">Modification du prénom</h3>
                            <input name="prenom" type="text" class="form-control" id="floatingInput"
                                   placeholder="Prénom" required="required"><br>
                            <h3 class="text-center pb-2">Modification de l'adresse mail</h3>
                            <input name="mail" type="email" class="form-control" id="floatingInput" placeholder="Email"
                                   required="required"><br>
                            <h3 class="text-center pb-2">Modification du mot de passe</h3>
                            <input name="mdp" type="password" class="form-control" id="floatingPassword"
                                   placeholder="Mot de passe" required="required"><br>
                            <h3 class="text-center pb-2">Modification du dernier diplôme obtenu</h3>
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
        https://www.developpez.net/forums/d1722287/php/langage/pre-remplir-formulaire-partir-base-donnees/