<?php include ('include/initializer.inc.php'); ?>

<div class="container text-center">
    <?php echo generationEntete("PhotoForYou", "Des pros au service des professionnels de la communication.")?>
</div>
<?php

  if (isset($_POST['DeleteFromCart'])) {
    $CartManager = new CartManager($db);
    $cart = $CartManager->getCartByUserId($_SESSION['Id']);

    $DeleteCart = $CartManager->deleteProduct($cart ,$_POST['id_photo']);
  }


  if(isset($_POST['ConfirmCart'])){
    $OrderManager = new OrderManager($db);
    $order = $OrderManager->ValidateUserCart($_SESSION['Id']);
  }

  $allcart = new PhotoManager($db);
  $photos = $allcart->getFromUserCart($_SESSION['Id']);
?>

<?php include ("include/entete.inc.php"); ?>
<div class="container mx-auto">
    <?php foreach ($photos as $photo): ?>
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
        <div class="d-flex justify-content-between align-items-center">
          <form method="post">
          <input type="hidden" name="id_photo" value="<?= $photo->getId() ?>">
            <button type="submit" class="btn btn-dark" name="DeleteFromCart">Supprimer du panier</button>
          </form>
        </div>
      </div>
    </div>
  </div>
      <?php endforeach; ?>
    <form method ="post">
      <button type="submit" class ="btn btn-dark" name="ConfirmCart">  Validation de la commande</button>
    </form>
</div>
<?php include ("include/piedDePage.inc.php");?> 