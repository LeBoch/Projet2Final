<?php
set_include_path(__DIR__.'/../');

require_once ('Test.php');
require_once ('include/initializer.inc.php');
require_once ('include/connection.inc.php');

function test_user_credit_is_reduced(PDO $db) {
    $user = new User([
        'Nom' => 'Toto',
        'Prenom' => 'Tata',
        'Mdp' => 'Toto',
        'Type' => 'client',
        'Mail' => 'IsBack@gmail.com',
        'Credit' => 1000
    ]);

    $userManager = new UserManager($db);

    $userManager->add($user);
    $userManager->updateCredit($user, $user->getCredit(), 250);

    verifyEqual($user->getCredit(), 750);
}

launchTest('test_user_credit_is_reduced', $db);
