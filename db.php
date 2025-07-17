<?php
try {

    $dsn = 'mysql:host=localhost;dbname=toDoApp';
    $user = 'root';
    $psw = '';
    $pdo = new PDO($dsn, $user, $psw);
} catch (PDOException $e) {
    die('erreur de connection' . $e->getMessage());
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
