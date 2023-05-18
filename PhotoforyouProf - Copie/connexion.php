<?php
include ('include/initializer.inc.php');
include ('include/entete.inc.php');


if (isset($_POST['identifier'])) {
  $pwd = $_POST["motdepasse"];
  $utilisateur = $manager->getUser($_POST['mail']);

  if ($utilisateur && password_verify($pwd, $utilisateur->getMdp())) {
    // Les identifiants sont corrects
    $_SESSION['login'] = true;
    $_SESSION['Id'] = $utilisateur->getId();
    $_SESSION['Type'] = $utilisateur->getType();
    $_SESSION['Prenom'] = $utilisateur->getPrenom();
   
    header('Location: membres.php');
  } else {
    // Identifiant incorrect
    $messageErreur = "Identifiant incorrect";
  }
}

?>




	<div class="container">
  <?php echo generationEntete("Connexion", "Merci de vous identifier") ?>
    <div class="jumbotron">
    <form method="post" id="formId"  novalidate>
      <?php if (isset($messageErreur)): ?>
      <div>
          <?= $messageErreur ?>
      </div>
      <?php endif; ?>
      <div class="form-group row">
        <div class="col-md-4 mb-3">
          <label for="email">Adresse électronique : </label>
          <input type="email" class="form-control" name="mail" id="email" placeholder="E-mail" required>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-4 mb-3">
          <label for="motDePasse1">Mot de passe :</label>
          <input type="password" class="form-control" name="motdepasse" required>
        </div>
        <div class="invalid-feedback">
            Vous devez fournir un mot de passe.
        </div>
      </div>
      <input type="submit" value="Valider" class="btn btn-primary" name="identifier" />
    </form>
  </div>
 

  <?php
    include ("include/piedDePage.inc.php");
  ?>