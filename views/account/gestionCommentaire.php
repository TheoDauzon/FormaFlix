<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="text-center pb-3">Mes commentaires postés</h1> <br>
                <?php if (sizeof($commentaires) > 0) { ?>
                    <table  class="table table-hover" >
                        <thead>
                    <tr>
                        <th scope="col" style="width:15%">Image</th>
                        <th scope="col" style="width:25%">Titre</th>
                        <th scope="col" style="width:10%">Note</th>
                        <th scope="col" style="width:20%">Libellé</th>
                        <th scope="col" style="width:15%">Date</th>
                        <th scope="col" style="width:15%">Actions</th>
                    </tr>
                        </thead>
                    <?php
                    foreach ($commentaires as $commentaire) { ?>
                        <tr>
                            <td><img src="<?= $commentaire['IMAGE'] ?>" width="185" height="100"/></td>
                            <td><?= $commentaire['LIBELLE'] ?></td>
                            <td><?= $commentaire['NOTECOM'] ?></td>
                            <td><?= $commentaire['LIBELLECOM'] ?></td>
                            <td><?= $commentaire['DATECOM'] ?></td>
                            <td><a href="./tv?id=<?= $commentaire['IDENTIFIANTVIDEO'] ?>" class="btn btn-outline-secondary">
                                    <i class="bi bi-pencil-fill"></i></a>
                                <a href="./supprimer?<?= $commentaire['IDCOMMENTAIRE'] ?>" class="btn btn-outline-danger">
                                    <i class="bi bi-trash"></i></a></td>
                        </tr>
                    <?php } ?>
                    </table>
                <?php } else {
                        ?>
                        <h3>Vous n'avez pas encore commenté de formations ! Pour découvrir les formations cliquez sur le bouton ci-dessous :</h3>
                        <a class="w-100 mt-5 btn btn-lg btn-primary" href="./formations">Voir les formations</a>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
</div><br>
