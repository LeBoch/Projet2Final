<?php
function launchTest(Callable $test, PDO $db) {

    $testName = func_get_args()[0];
    echo $testName . ': ';

    $db->beginTransaction();
    $test($db);
    $db->rollBack();

    echo 'ça marche';
}

function verifyEqual($a, $b)
{
    if ($a !== $b) {
        throw new \Exception('a est différent de b [a => '. $a .', b => ' . $b .']');
    }
}

function verifyIsEmpty($a)
{
    if (!empty($a)) {
        throw new \Exception("a n'est pas vide: ". var_dump($a));
    }
} 