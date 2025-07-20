<?php
try {

    $dsn = 'mysql:host=sql201.infinityfree.com;dbname=if0_39518719_todoo';
    $user = 'if0_39518719';
    $psw = 'nAeCqc8baYW';
    $pdo = new PDO($dsn, $user, $psw);
} catch (PDOException $e) {
    die('erreur de connection' . $e->getMessage());
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>