<?php 
	require_once("db_utils.php");

	$d = new Database();
	$username = $password = $name = $surname = $gender = $address = $birthday =  "";

	if (isset($_POST["registerButton"])){
		if ($_POST["username"]) {
			$username = htmlspecialchars($_POST["username"]);
		}
		if ($_POST["password"]) {
			$password = $_POST["password"];
		}
		if ($_POST["name"]) {
			$name = htmlspecialchars($_POST["name"]);
		}
		if ($_POST["surname"]) {
			$surname = htmlspecialchars($_POST["surname"]);
		}
		if ($_POST["gender"]) {
			$gender = htmlspecialchars($_POST["gender"]);
		}
		if ($_POST["address"]) {
			$address = htmlspecialchars($_POST["address"]);
		}
		if ($_POST["birthday"]) {
			$birthday = htmlspecialchars($_POST["birthday"]);
		}

		if ($username != "" and $password != "" and $name != "" and $surname != "" and $gender != "" and $address != "" and $birthday != ""){
			$success = $d->insertUser($username, $password, $name, $surname, $gender, $address, $birthday);
			if ($success){
				echo "Uspešno ste se registrovali.<br><br>";
			} else {
				echo "Registracija nije uspela.<br><br>";
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
</head>
<body>
    <form method="post" action="">
		<label for="username">Korisničko ime:</label>
		<input type="text" name="username" value="<?php echo $username;?>"><br>
					
		<label for="password">Lozinka:</label>
		<input type="password" name="password" value="<?php echo $password;?>"><br>
					
		<label for="name">Ime:</label>
		<input type="text" name="name" value="<?php echo $name;?>"><br>
					
		<label for="surname">Prezime:</label>
		<input type="text" name="surname" value="<?php echo $surname;?>"><br>
					
		<label for="gender">Pol:</label>
		<input type="radio" name="gender" value="m" checked> M 
		<input type="radio" name="gender" value="z" <?php if ($gender == "z") echo 'checked'; ?>> Ž <br>

		<label for="address">Adresa:</label>
		<input type="text" name="address" value="<?php echo $address;?>"><br>
					
		<label for="birthday">Datum rođenja:</label>
		<input type="date" name="birthday" value="<?php echo $birthday;?>"><br>
		
		<input type="submit" name="registerButton" value="Registruj se">
	</form>
	<a href="login.php"><h4>Nazad</h4></a>
</body>
</html>