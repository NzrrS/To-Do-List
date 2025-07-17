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

    <!-- Bootstrap && Css styling files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="Assets/style.css" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body>

    <div class="container login-card">
        <h2 class="text-center mb-4">Sign in</h2>

        <?php if (!empty($error)): ?>
            <div>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="input-group mb-3">
                <input type="email" id="email" name="email" class="pe-5" placeholder="Email" />
                <i class="fa-solid fa-envelope"></i>
            </div>

            <div class="input-group mb-3">
                <input type="password" id="password" name="psw" class="pe-5" placeholder="Password" />
                <i class="fa-solid fa-eye-slash" id="eyeicon"></i>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="text-center bottom-text">
        Don't have an account ? <br> <a href="register.php" class="link"> Register here</a>
        </p>
    </div>
    <script src="Assets/script.js"></script>
</body>

</html>