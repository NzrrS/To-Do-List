<?php
session_start();
include 'db.php';
if (isset($_POST['sign-up']) && $_SERVER['REQUEST_METHOD'] === "POST") {

    $userName = trim($_POST['user']);
    $Email = trim($_POST['email']);
    $Password = trim($_POST['password']);
    $passwordConfirm = trim($_POST['passwordConfirm']);


    if (empty($userName) || empty($Email) || empty($Password) || empty($passwordConfirm)) {
        $_SESSION["error"] = "Please fill in all fields.";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "Invalid email format.";
    } elseif (strlen($Password) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters.";
    } elseif ($Password != $passwordConfirm) {
        $_SESSION['error'] = "Password doesn't match.";
    } else {
        $query1 = "SELECT * FROM users WHERE Email = ?";
        $pdoStmt = $pdo->prepare($query1);
        $pdoStmt->execute([$Email]);
        if ($pdoStmt->fetch()) {
            $_SESSION['error'] = "Email is already registered.";
        } else {
            $hashed = password_hash($Password, PASSWORD_DEFAULT);
            $query2 = "INSERT INTO users(Email,Psw,Username) VALUES (?,?,?)";
            $pdoStmt = $pdo->prepare($query2);
            $pdoStmt->execute([$Email, $hashed, $userName]);
            $_SESSION['success'] = "Account created! Please log in.";
            header("Location: login.php");
            exit;
        }
    }
    if (isset($_SESSION['error'])) {
		header("Location: " . $_SERVER['PHP_SELF']);
		exit;
	} 
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
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
        <h2 class="text-center mb-4">Sign up</h2>
        <form action="#" method="post">
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger mt-3" role="alert">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']);
            }
            ?>
            <div class="input-group mb-3">
                <input type="text" placeholder="Username" name="user" id="userName">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-group mb-3">
                <input type="email" placeholder="Email" name="email">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input-group mb-3">
                <input type="password" placeholder="Password" id="psw" name="password">
                <i class="fa-solid fa-eye-slash" id="eyeicon1"></i>
            </div>
            <div class="input-group mb-3">
                <input type="password" placeholder="Confirm your Password" id="psw2" name="passwordConfirm">
                <i class="fa-solid fa-eye-slash" id="eyeicon2"></i>
            </div>

            <button class="btn btn-primary w-100" name="sign-up">Create Account</button>
            <p class="text-center bottom-text">Already have an account ? <br><a href="login.php" class="link">Sign in</a></p>
        </form>
    </div>
    <script src="Assets/script.js"></script>
</body>

</html>