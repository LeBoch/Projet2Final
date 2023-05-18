<?php
include ('include/initializer.inc.php');
include ('include/entete.inc.php');
?>
	<div class="container text-center">
		<?php echo generationEntete("PhotoForYou", "Des pros au service des professionnels de la communication.")?>
		

<?php


// Créer une instance de la classe PhotoManager en passant l'objet $db en paramètre
$photoManager = new PhotoManager($db);

// Vérifier si le formulaire de suppression a été soumis
if (isset($_POST['supprimer'])) {
    // Appeler la méthode "supprimer()" pour supprimer la photo en fonction de son identifiant
    $photoManager->delete($_POST['id']);

    // Rediriger l'utilisateur vers la page des photos après la suppression
    header('Location: SupprimerPhoto.php');
    exit;
}

// Récupérer la liste des photos
$photos = $photoManager->getAll();
?>

<div class="container">
  <div class="row">
    <?php foreach ($photos as $photo): ?>
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img class="card-img-top" src="<?= $photo->getChemin() ?>" alt="<?= $photo->getNom() ?>">
        <div class="card-body">
          <p class="card-text"><?= $photo->getNom() ?></p>
          <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted"><?= $photo->getIdCategory() ?></small>
          </div>
        </div>
        <div class="card-footer">
          <form method="post">
            <input type="hidden" name="id" value="<?= $photo->getId() ?>">
            <input type="submit" name="supprimer" value="Supprimer" class="btn btn-danger">
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include ("include/piedDePage.inc.php") ?>