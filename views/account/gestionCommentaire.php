<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="text-center pb-3">Mes commentaires postés</h1>
                <ul class="list-group pt-3">
                    <?php
                    foreach ($commentaires as $commentaire) { ?>
                        <li class="list-group-item">
                            <div class="d-flex">
                                <div class="flex-grow-1 align-self-center"><?= $commentaire['LIBELLECOM'] ?></div>
                                <div class="flex-grow-1 align-self-center"><?= $commentaire['NOTECOM'] ?></div>
                                <div class="flex-grow-1 align-self-center"><?= $commentaire['DATECOM'] ?></div>
                                <!--<a href="./modifier?id=<?= $commentaire['id'] ?>" class="btn btn-outline-success">
                                    <i class="bi bi-pencil-fill"></i>
                                    <a href="./supprimer?id=<?= $commentaire['id'] ?>" class="btn btn-outline-success">
                                        <i class="bi bi-trash"></i>
                                    </a>-->
                                </a>
                            </div>
                        </li>
                        <?php
                    }
                    if (sizeof($commentaires) > 0) {
                        ?>
                        <h3>Vous n'avez pas encore commenté de formations ! Pour découvrir les formations cliquez sur
                            le
                            bouton
                            ci-dessous :</h3>
                        <a class="w-100 mt-5 btn btn-lg btn-primary" href="./formations">Voir les formations</a>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
