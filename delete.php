<?php
// delete.php
include 'db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$id]);

    // redirect back to main page
    header("Location: index.php");
    exit;
} else {
    echo "No ID provided.";
}
