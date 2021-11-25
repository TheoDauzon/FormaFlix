<div class="container mt-5">
    <div class="row">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="text-center pb-3">Mes certifications</h1>

                <?php
                foreach ($certifications as $certification) {?>
                <li class="list-group-item">
                    <div class="d-flex">
                        <div class="flex-grow-1 align-self-center"><?= $certification['texte'] ?></div>
                    </div>
                </li>
                <?php }

                if (sizeof($certifications) == 0) {
                ?>
                <h3>Vous n'avez pas encore obtenu de certifications ! Pour découvrir les formations cliquez sur le
                    bouton
                    ci-dessous :</h3>
                <a class="w-100 mt-5 btn btn-lg btn-primary" href="./formations">Voir les formations</a>
                <?php
                }
                ?>
