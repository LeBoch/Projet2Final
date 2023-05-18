<?php
set_include_path(__DIR__.'/../');

require_once ('Test.php');
require_once ('include/initializer.inc.php');
require_once ('include/connection.inc.php');

function test_cart_is_cleaned(PDO $db) {
    // Crée un environnement de base
    // Créer un utilisateur
    $userManager = new UserManager($db);
    $user = new user([
        'Nom' => 'Toto',
        'Prenom' => 'Tata',
        'Mdp' => 'Toto',
        'Type' => 'client',
        'Mail' => 'IsBack@gmail.com',
        'Credit' => 1000
    ]);
    $userManager->add($user);

    // Créer un panier et l'associer à l'utilisateur
    $cartManager = new CartManager($db);
    $cart = new cart ([
        'IdUser'=> $user->getId()
    ]);
    $cartManager->add($cart);
    
    // Créer deux photo et les associer au panier
    $photoManager = new PhotoManager($db);
    $photo = new photo([
        'Nom'=>'QS',
        'TailleX'=>'2341',
        'TailleY'=>'3234',
        'Poids'=>'342',
        'NbreDePhotos'=>'12',
        'IdProprietaire'=>'23',
        'IdCategory'=>'2323',
        'Chemin'=>__DIR__.'/uploads/2.png',
        'Prix'=>'12'
    ]);
    $photoManager->add($photo);

    $cartManager->addProduct($cart, $photo->getId());

    // Là tu exécute la fonction que tu veux tester
    $cartManager->cleanCart($cart);

    // Là tu vérifie dans un monde parfait que le résultat est ok
    verifyIsEmpty($photoManager->getFromUserCart($user->getId()));
}

launchTest('test_cart_is_cleaned', $db);
