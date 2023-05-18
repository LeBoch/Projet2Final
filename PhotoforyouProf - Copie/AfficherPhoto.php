<?php
include ('include/initializer.inc.php');

if (isset($_POST['AddTocart'], $_SESSION['login']) && $_SESSION['login']) {
  $cartManager = new CartManager($db);
  $userCart = $cartManager->getCartByUserId($_SESSION['Id']);

  if ($userCart == null )
  {
    $userCart = new Cart(['IdUser' => $_SESSION['Id']]);
    $cartManager->add($userCart);
  }

  try {
    $cartManager->addProduct($userCart, $_GET['id']);
  } catch (\Exception $e) {
    // Si le produit est déjà dans le panier
    // Une erreur 23000 est émise à cause de la contrainte d'unicité de la table
    // On la rattrape pour la traiter de façon user-friendly
    if ($e->getCode() === '23000') {
      $erreur = 'Déjà ajouté au panier';
    } else {
      throw $e;
    }
  }
}

// Créer une instance de la classe CategoryManager en passant l'objet $db en paramètre
$PhotoManager = new PhotoManager($db);
// On récupère les informations de la catégorie
$photo = $PhotoManager->getById($_GET['id']);
?>

<?php include ("include/entete.inc.php"); ?>

<div class="container text-center">
    <?php echo generationEntete("PhotoForYou", "Des pros au service des professionnels de la communication.")?>
</div>

<div class="container mx-auto">
  <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
      <img src="<?= $photo->getChemin() ?>" alt="<?= $photo->getNom() ?>"class="img-fluid rounded-start">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><?= $photo->getNom() ?></h5>
          <p class="card-text"><b>Dimensions: </b><?= $photo->getTailleX() ?>px * <?= $photo->getTailleY() ?>px </p>
          <p class="card-text"><small class="text-body-secondary"><b>Poids: </b><?= $photo->getPoids() ?> Kb</small></p>
        </div>
        <?php if(isset($erreur)): ?>
        <div class="car-body">
            <?= $erreur ?>
        </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center">
          <form method="post">
            <button type="submit"
                    class="btn btn-dark"
                    name="AddTocart"
            >Ajouter au panier</button>
          </form>
          <a href="AfficherPhotoCategories.php?id=<?= $photo->getIdCategory() ?>" class="btn btn-dark">Retour à la catégorie</a>
        </div>
      </div>
    </div>
  </div>
</div>
</script>
<?php include ("include/piedDePage.inc.php");?>