<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="text-center pb-3">Mes certifications</h1>
                <?php if (sizeof($certifications) > 0) { ?>
                    <table  class="table table-hover" >
                        <thead>
                        <tr>
                            <th scope="col" style="width:15%">Image</th>
                            <th scope="col" style="width:25%">Titre</th>
                            <th scope="col" style="width:10%">Compétences</th>
                            <th scope="col" style="width:20%">Prénom auteur</th>
                            <th scope="col" style="width:20%">Nom auteur</th>
                            <th scope="col" style="width:15%">Date d'obtention</th>
                            <th scope="col" style="width:15%">PDF</th>
                        </tr>
                        </thead>
                        <?php
                        foreach ($certifications as $certification) { ?>
                            <tr>
                                <td><img src="<?= $certification['IMAGE'] ?>" width="185" height="100"/></td>
                                <td><?= $certification['LIBELLE'] ?></td>
                                <td><?= $certification['LIBELLECOMPETENCE'] ?></td>
                                <td><?= $certification['PRENOM'] ?></td>
                                <td><?= $certification['NOM'] ?></td>
                                <td><?= $certification['DATEOBTENTION'] ?></td>
                                <td><a href="./formations" class="btn btn-danger">
                                        Génerer PDF</a>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } else {
                    ?>
                    <h3>Vous n'avez pas encore acquérie de certification ! Pour découvrir les formations cliquez sur le bouton ci-dessous :</h3>
                    <a class="w-100 mt-5 btn btn-lg btn-primary" href="./formations">Voir les formations</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div><br>
