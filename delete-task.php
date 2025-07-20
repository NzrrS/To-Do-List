<?php
session_start();
require 'db.php';

$user_id = $_SESSION['user_id'] ?? null;
$task_id = $_POST['id'] ?? null;

if (!$user_id || !$task_id) {
  http_response_code(400);
  exit;
}

$stmt = $pdo->prepare("DELETE FROM tasks WHERE Id = ? AND user_id = ?");
$stmt->execute([$task_id, $user_id]);

echo json_encode(['success' => true]);
