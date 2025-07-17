<?php
include 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $Email = $_POST['email'];
    $Psw = $_POST['psw'];

    $query = 'SELECT * FROM users WHERE Email = ?';
    $pdoStmt = $pdo->prepare($query);
    $pdoStmt->execute([$Email]);
    $user = $pdoStmt->fetch();

    if ($user) {
        if (password_verify($Psw, $user['Psw'])) {
            session_start();
            $_SESSION['user_id'] = $user['Id'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Incorrect Password";
        }
    } else {
        $error = "User Not Found";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="Assets/style.css" rel="stylesheet">

</head>

<body>

    <div>
        <h2 class="text-center mb-4">Login</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                 <?= htmlspecialchars($error) ?> 
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="email" >Email:</label>
                <input type="email" id="email" name="email" required />
            </div>

            <div class="mb-4">
                <label for="password" >Password:</label>
                <input type="password" id="password" name="psw"  required />
            </div>

            <button type="submit">Login</button>
        </form>

        <p>
            Don't have an account? <a href="register.php" class="RegisterBtn">Register here</a>
        </p>
    </div>

</body>

</html>