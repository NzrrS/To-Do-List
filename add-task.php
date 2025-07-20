<?php
session_start();
require 'db.php';

$user_id = $_SESSION['user_id'] ?? null;
$content = $_POST['content'] ?? '';

if (!$user_id || !$content) {
  http_response_code(400);
  exit;
}

$stmt = $pdo->prepare("INSERT INTO tasks (user_id, content) VALUES (?, ?)");
$stmt->execute([$user_id, $content]);

echo json_encode(['id' => $pdo->lastInsertId(), 'content' => $content]);
