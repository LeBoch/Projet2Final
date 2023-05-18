<?php
include ('include/initializer.inc.php');
include ('include/entete.inc.php');
?>
<div class="container text-center">
    <?php echo generationEntete("PhotoForYou", "Des pros au service des professionnels de la communication.")?>
</div>
<?php
// Créer une instance de la classe CategoryManager en passant l'objet $db en paramètre
$CategorieManager = new CategorieManager($db);
// On récupère les informations de la catégorie
$category = $CategorieManager->getById($_GET['id']);

// Récupérer la liste des photos associé à la catégorie
$PhotoManager = new PhotoManager($db);
$photos = $PhotoManager->getFromCategory($_GET['id']);
?>

<?= $category->getNom() ?>

<div class="container">
    <div class="row">
        <?php foreach ($photos as $photo): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img class="card-img-top" src="<?= $photo->getChemin() ?>" alt="<?= $photo->getNom() ?>">
                    <div class="card-body">
                        <p class="card-text"><?= $photo->getNom() ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="AfficherPhoto.php?id=<?= $photo->getId() ?>" class="btn btn-dark">Voir les détails</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include ("include/piedDePage.inc.php");?>
!