<?php
include ('include/initializer.inc.php');
include ("include/entete.inc.php");
include("classes/CategorieManager.class.php");


$Photomanager = new PhotoManager($db);


$photos = $Photomanager->GetByIdPro($_SESSION['Id']);
?>

<div class="container">
    <div class="row">
        <?php foreach ($photos as $photo): ?>
   
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img class="card-img-top" src="<?= $photo->getChemin() ?>" alt="<?= $photo->getNom() ?>">
                    <div class="card-body">
                             <p class="card-text"><?= $photo->getTailleY() ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><?= $photo->getTailleY() ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
