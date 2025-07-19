<?php
session_start();
$id = $_SESSION['user_id'] ?? null;

if ($id) {

	include 'db.php';
	$req = "SELECT Username FROM users WHERE Id = ?";
	$pdoStmt = $pdo->prepare($req);
	$pdoStmt->execute([$id]);
	$user = $pdoStmt->fetch();
	$userName = $user['Username'];
} else {
	$userName = "Guest";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TodoApp</title>
	<!-- Bootstrap && Css styling files -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="Assets/main-style.css" rel="stylesheet">

	<!-- Font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

	<!-- Google font  -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


</head>

<body>
  <div class="todo-card">
    <h2 class="text-light"><?php echo htmlspecialchars($userName); ?>'s Checklist</h2>

    <form class="task-form" method="post" action="">
      <input type="text" name="task" placeholder="Enter a new task" required class="form-control">
      <button type="submit" class="">Add Task</button>
    </form>

    <ul class="task-list">
      <li>
        <label>
          <input type="checkbox" name="done">
          <span>Test</span>
        </label>
		<!-- Future edit model -->
        <a href="delete.php?id=<?php echo htmlspecialchars($id); ?>" class="delete-task" title="Delete Task"><i class="fa-solid fa-trash"></i></a>
      </li>
    </ul>
  </div>
</body>

</html>