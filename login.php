<?php
session_start();
include 'db.php';

if (isset($_POST['sign-in']) && $_SERVER['REQUEST_METHOD'] === "POST") {
	$Email = trim($_POST['email']);
	$Psw = trim($_POST['psw']);

	// Validate inputs
	if (empty($Email) || empty($Psw)) {
		$_SESSION['error'] = "Please fill in all fields.";
	} elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['error'] = "Invalid email format.";
	} elseif (strlen($Psw) < 8) {
		$_SESSION['error'] = "Password must be at least 8 characters.";
	} else {
		$query = 'SELECT * FROM users WHERE Email = ?';
		$pdoStmt = $pdo->prepare($query);
		$pdoStmt->execute([$Email]);
		$user = $pdoStmt->fetch();

		if ($user) {
			if (password_verify($Psw, $user['Psw'])) {
				$_SESSION['user_id'] = $user['Id'];
				header("Location: index.php");
				exit;
			} else {
				$_SESSION['error'] = "Incorrect password.";
			}
		} else {
			$_SESSION['error'] = "User not found.";
		}
	}

	// Redirect to clear POST data and show error once
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



		<form method="POST">
			<?php

			if (isset($_SESSION['error'])) {
				echo '<div class="alert alert-danger mt-3" role="alert">' . htmlspecialchars($_SESSION['error']) . '</div>';
				unset($_SESSION['error']);
			}

			if (isset($_SESSION['success'])) {
				echo '<div class="alert alert-success mt-3" role="alert">' . htmlspecialchars($_SESSION['success']) . '</div>';
				unset($_SESSION['success']);
			}

			?>



			<div class="input-group">
				<input type="email" id="email" name="email" class="pe-5" placeholder="Email" />
				<i class="fa-solid fa-envelope"></i>
			</div>

			<div class="input-group">
				<input type="password" id="psw" name="psw" class="pe-5" placeholder="Password" />
				<i class="fa-solid fa-eye-slash" id="eyeicon1"></i>
			</div>

			<button type="submit" class="btn btn-primary w-100" name="sign-in">Login</button>
		</form>

		<p class="text-center bottom-text">
			Don't have an account ? <br> <a href="register.php" class="link"> Register here</a>
		</p>
	</div>
	<script src="Assets/script.js"></script>
</body>

</html>