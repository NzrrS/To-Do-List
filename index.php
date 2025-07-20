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
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TodoApp</title>
  <link href="Assets/index.css" rel="stylesheet" />
  <!-- Google font  -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />

  <script src="Assets/index.js" defer></script>
</head>

<body>
<!-- Sidebar -->


  <h1>TOdo App</h1>
  <h2>Welcome back, <?php echo htmlspecialchars($userName); ?> !</h2>
  <div class="container">
    <form>
      <input
        type="text"
        autocomplete="off"
        placeholder="Write anything and hit enter to add"
        id="todo-input" />
      <button class="addBtn" id="addBtn">ADD</button>
    </form>
    <ul id="todo-list">
    </ul>
  </div>
  <footer>
    <button id="outBtn">
      <a href="logout.php"> <svg fill="var(--secondary-color)" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
          <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
        </svg></a>

    </button>
  </footer>


</body>

</html>