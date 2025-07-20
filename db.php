<?php
try {

    $dsn = 'mysql:host=sql104.infinityfree.com;dbname=if0_39518287_mytodo';
    $user = 'if0_39518287';
    $psw = 'xWy61raWM6';
    $pdo = new PDO($dsn, $user, $psw);
} catch (PDOException $e) {
    die('erreur de connection' . $e->getMessage());
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>