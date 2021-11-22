<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="text-center pb-3">Mes commentaires postés</h1>
                <?php
                    if (sizeof($commentaires) > 0) {
                        ?>
                <ul class="list-group pt-3">
                    <li class="list-group-item">
                        <div class="d-flex">
                            <table>
                                <tr>
                                    <th>Image</th>
                                    <th>Titre</th>
                                    <th>Note</th>
                                    <th>Commentaire</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </table>
                        </div>
                    </li>
                    <?php
                    }
                    foreach ($commentaires as $commentaire) { ?>
                        <li class="list-group-item">
                            <div class="d-flex">
                                <table>
                                    <tr>
                                        <div class="flex-grow-1 align-self-center">
                                            <td><img src="<?= $commentaire['IMAGE'] ?>" width="170" height="120" /></td>
                                        </div>
                                        <div class="flex-grow-1 align-self-center">
                                            <td><?= $commentaire['LIBELLE'] ?></td>
                                        </div>
                                        <div class="flex-grow-1 align-self-center">
                                            <td><?= $commentaire['NOTECOM'] ?></td>
                                        </div>
                                        <div class="flex-grow-1 align-self-center">
                                            <td><?= $commentaire['LIBELLECOM'] ?></td>
                                        </div>
                                        <div class="flex-grow-1 align-self-center">
                                            <td><?= $commentaire['DATECOM'] ?></td>
                                        </div>
                                        <td><a href="./tv?id=<?= $commentaire['IDENTIFIANTVIDEO'] ?>" class="btn btn-outline-secondary">
                                                <i class="bi bi-pencil-fill"></i></a></td>
                                        <td><a href="./supprimer?<?= $commentaire['IDCOMMENTAIRE'] ?>" class="btn btn-outline-danger">
                                            <i class="bi bi-trash"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </li>
                        <?php
                    }
                    if (sizeof($commentaires) == 0) {
                        ?>
                        <h3>Vous n'avez pas encore commenté de formations ! Pour découvrir les formations cliquez sur
                            le
                            bouton
                            ci-dessous :</h3>
                        <a class="w-100 mt-5 btn btn-lg btn-primary" href="./formations">Voir les formations</a>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
</div><br>
