<?php

/** @var PhotoManager $PhotoManager */

  // Gestion de la session


  if (isset($_SESSION['login']) && $_SESSION['login']) {
      $Photomanager = new PhotoManager($db);
      $Photo = $Photomanager->getFromUserCart($_SESSION['Id']);
      $nbrphotocart = count($Photo);
  } else {
      echo "Veuillez vous connectez ou vous inscrire";
  }
  ?>



<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        	
    <a class="navbar-brand" href="index.php">PhotoForYou</a>
    <!-- Pour passer en mode hamburger si on est sur un petit écran -->

    <button class="navbar-toggler" type="button" data-toggle="collapse" 
        data-target="#navbarCollapse" aria-controls="navbarCollapse" 
        aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
            <?php if (isset($_SESSION['Type']) && $_SESSION['Type'] === 'client') : ?>
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="index.php">Client</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="credit.php">Ajouter du Crédit</a>
                    <a class="dropdown-item" href="Client.php">Affichez vos photos</a>
                </div>
            </li>
            
                <li class="nav-item">
            <li class="nav-item">
            <?php elseif (isset($_SESSION['Type']) && $_SESSION['Type'] === 'Photographe') : ?>
                    <a class="nav-link" href="AjouterPhoto.php">Photographe</a>
            </li>
            <li class="nav-item dropdown">

            <?php elseif (isset($_SESSION['Type']) && $_SESSION['Type'] === 'Admin') : ?>
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="index.php">Admin</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="SupprimerPhoto.php">Supprimer des Photos</a>
                    <a class="dropdown-item" href="AjouterCategories.php">Ajouter des Catégories</a>
                </div>
            </li>
           
        </ul>
        <?php endif; ?>
        <!-- formulaire de recherche -->
        <form method="POST" class="form-inline mt-md-0">
            <?php if (isset($_SESSION['login']) && !$_SESSION['login']): ?>
                <ul class="navbar-nav mr-right">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark" href="inscription.php">S'inscrire</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-dark"  type="submit"  href="connexion.php">S'identifier</a>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="navbar-nav mr-right">
                    <li class="nav-item">
                        <input type="submit" value="Deconnexion" class="btn btn-primary" name="deconnexion" />
                    </li>
                        
                    <li class="nav-item">
                        <a href="Panier.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            <span id="nbProduct"><?= $nbrphotocart ?></span>
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
            
        </form>
    </div>
</nav>
