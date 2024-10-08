<?php 
	session_start();
	if (isset($_GET["logout"])){
		session_destroy();
	} elseif (isset($_SESSION["user"])) {
		header( "Location: profile.php" );
	}

	if (isset($_GET["delete"])) {
		setcookie("username", "", time()-1000);
		header("Location: login.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijavljivanje</title>
</head>
<body>
    <div class="login">
		<form method="post" action="profile.php">
			<label for="username">Korisničko ime:</label> 
			<input type="text" name="username"><br>

			<label for="password">Lozinka:</label>
			<input	type="password" name="password"><br>

			<input type="submit" name="loginButton" value="Uloguj se">
		</form>
	</div>
    <div class="registration">
		<a href="registration.php"><h4>Registruj se</h4></a>
	</div>
	Poslednja prijava: <?php echo isset($_COOKIE["username"]) ? $_COOKIE["username"] : "";?><br>
	<a href="?delete">Obriši</a>
</body>
</html>