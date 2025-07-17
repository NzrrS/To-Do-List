<?php
session_start();
include 'db.php';
if (isset($_POST['sign-up']))
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
            <div class="input-group mb-3">
                <input type="text" placeholder="Username" name="user" id="userName">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-group mb-3">
                <input type="email" placeholder="Email">
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