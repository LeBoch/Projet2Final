<?php
include ('include/initializer.inc.php');
include ('include/entete.inc.php');
?>
<?php include("classes/CategorieManager.class.php")?>
<div class="container text-center">
    <?php echo generationEntete("PhotoForYou", "Des pros au service des professionnels de la communication.")?>
    <?php include("include/carrousel.inc.php");?>
</div>
<?php


// Créer une instance de la classe Categorie Manager en passant l'objet $db en paramètre
$CategorieManager = new CategorieManager($db);

// Récupérer la liste des categories
$categories = $CategorieManager->getAll();
?>

<div class="container">
    <div class="row">
        <?php foreach ($categories as $categorie): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    
                    <div class="card-body">
                        <p class="card-text"><?= $categorie->getNom() ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><?= $categorie->getDescription() ?></small>
                        </div>
                    </div>
                    <div class="card-footer">
                            <a name="id_category" href="AfficherPhotoCategories.php?id=<?= $categorie->getId() ?>" class="btn btn-dark">Voir les photos de la catégorie </a>
						
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>





<?php include ("include/piedDePage.inc.php");?>
