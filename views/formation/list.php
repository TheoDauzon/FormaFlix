<div class="container">
    <div class="row pt-5">
        <?php
        $selectComp=0;
        if(isset($_POST['filterCompet'])){
            $selectComp=$_POST["filterCompet"];


        }

        foreach ($formations as $formation) {

            //si la competence selectionnée est égale à ['idformation'] : afficher $formation['image']
            //if ($selectComp==$formation['IDFORMATION']){


            ?>

            <div class="col-sm-12 p-3">
                <div class="card card-hover">
                    <div class="card-body d-flex">
                        <div class="p-3">
                            <img class="preview-image" src="<?= $formation["IMAGE"]?>">
                        </div>
                        <div class="p-3 flex-grow-1">
                            <h5 class="mb-0 pb-0"><?= $formation['LIBELLE']; ?></h5>
                            <p><?= $formation['DESCRIPTION'] ?></p>
                            <a href="./tv?id=<?= $formation['IDENTIFIANTVIDEO'] ?>" class="btn btn-outline-primary">Voir la formation →</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>
    </div>
</div>