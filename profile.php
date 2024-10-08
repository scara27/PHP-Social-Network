<?php
    require_once("db_utils.php");
    session_start();
    $d = new Database();
    $main_user = false;

    if (isset($_POST["loginButton"])) {
        $main_user = $d->checkLogin($_POST["username"], $_POST["password"]);
        if (!$main_user) {
			header( "Location: login.php" );
		} else {
            $_SESSION["user"] = $main_user;
            setcookie("username", $main_user[COL_KORISNIK_KORISNICKO_IME], time()+60*60*2);
        }
    }

    if (!isset($_SESSION["user"])) {
		header( "Location: login.php" );
	}
    if (!$main_user) {
		$main_user = $_SESSION["user"];
	}

    $username_new = $password_new = $name_new = $surname_new = $address_new = $birthday_new =  "";
    if (isset($_POST["change"])){
		if ($_POST["username_new"]) {
			$username_new = htmlspecialchars($_POST["username_new"]);
		}
		if ($_POST["password_new"]) {
			$password_new = $_POST["password_new"];
		}
		if ($_POST["name_new"]) {
			$name_new = htmlspecialchars($_POST["name_new"]);
		}
		if ($_POST["surname_new"]) {
			$surname_new = htmlspecialchars($_POST["surname_new"]);
		}
		if ($_POST["address_new"]) {
			$address_new = htmlspecialchars($_POST["address_new"]);
		}
		if ($_POST["birthday_new"]) {
			$birthday_new = htmlspecialchars($_POST["birthday_new"]);
		}

		$change = false;

		if (isset($_FILES["photo"])) {
			if ($_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
				if (!move_uploaded_file($_FILES["photo"]["tmp_name"], "photos\\" . basename($_FILES["photo"]["name"]))) {
					if ($_FILES["photo"]["tmp_name"] != "") {
						echo "Promena profilne slike nije uspela.";
					}
				} else if ($_FILES["photo"]["type"] == "image/jpeg" || $_FILES["photo"]["type"] == "image/png"){
					$success = $d->updatePicture($main_user[COL_KORISNIK_ID], "photos/" . $_FILES["photo"]["name"]);
					if ($success) {
						echo "Uspešno promenjena profilna slika.<br>";
						$_SESSION["user"][COL_KORISNIK_PROFILNA_SLIKA] = "photos/" . $_FILES["photo"]["name"];

						$change = true;
					} else {
						echo "Promena profilne slike nije uspela.<br>";
					}
				} 
			} else {
				if ($_FILES["photo"]["tmp_name"] != "") {
					echo "Promena profilne slike nije uspela.";
				}
			}
		}
        if ($username_new != ""){
            $success = $d->updateUsername($main_user[COL_KORISNIK_ID], $username_new);
            if ($success){
				echo "Uspešno promenjeno korisničko ime.<br>";
				$_SESSION["user"][COL_KORISNIK_KORISNICKO_IME] = $username_new;
				setcookie("username", $_SESSION["user"][COL_KORISNIK_KORISNICKO_IME], time()+60*60*2);

				$change = true;
			} else {
				echo "Promena korisničkog imena nije uspela.<br>";
			}
        }
		if ($password_new != ""){
            $success = $d->updatePassword($main_user[COL_KORISNIK_ID], $password_new);
            if ($success){
				echo "Uspešno promenjena lozinka.<br>";
				$_SESSION["user"][COL_KORISNIK_SIFRA] = $password_new;
				
				$change = true;
			} else {
				echo "Promena lozinke nije uspela.<br>";
			}
        }
		if ($name_new != ""){
			$success = $d->updateName($main_user[COL_KORISNIK_ID], $name_new);
			if ($success){
				echo "Uspešno promenjeno ime.<br>";
				$_SESSION["user"][COL_KORISNIK_IME] = $name_new;

				$change = true;
			} else {
				echo "Promena imena nije uspela.<br>";
			}
		}
		if ($surname_new != ""){
			$success = $d->updateSurname($main_user[COL_KORISNIK_ID], $surname_new);
			if ($success){
				echo "Uspešno promenjeno prezime.<br>";
				$_SESSION["user"][COL_KORISNIK_PREZIME] = $surname_new;
				
				$change = true;
			} else {
				echo "Promena prezimena nije uspela.<br>";
			}
		}
		if ($address_new != ""){
			$success = $d->updateAddress($main_user[COL_KORISNIK_ID], $address_new);
			if ($success){
				echo "Uspešno promenjena adresa.<br>";
				$_SESSION["user"][COL_KORISNIK_ADRESA] = $address_new;
				
				$change = true;
			} else {
				echo "Promena adrese nije uspela.<br>";
			}
		}
		if ($birthday_new != ""){
			$success = $d->updateBirthday($main_user[COL_KORISNIK_ID], $birthday_new);
			if ($success){
				echo "Uspešno promenjen datum rođenja.<br>";
				$_SESSION["user"][COL_KORISNIK_DATUM_RODJENJA] = $birthday_new;
				
				$change = true;
			} else {
				echo "Promena datuma rođenja nije uspela.<br>";
			}
		}
		if ($change)
			echo "<br>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proifl</title>
</head>
<body>
    
    <?php
		if(!isset($_GET["change"]) && !isset($_GET["info"])) {
	?>	
		Dobrodošli, <?php echo $_SESSION["user"][COL_KORISNIK_KORISNICKO_IME]; ?>.<br>
		<a href="?info"><h4>Prikaz profila</h4></a>
        <a href="?change"><h4>Izmeni profil</h4></a>
		<a href="login.php?logout"><h4>Izloguj se</h4></a>
	<?php
		}
	?>

	<?php
		if(isset($_GET["info"])) {
	?>
		<?php  
		if($_SESSION["user"][COL_KORISNIK_PROFILNA_SLIKA] != NULL && $_SESSION["user"][COL_KORISNIK_PROFILNA_SLIKA] != ""){ ?>
			<img src="<?php echo $_SESSION["user"][COL_KORISNIK_PROFILNA_SLIKA]?>" width="70" height="70"><br>
		<?php }
		?>
		Korisničko ime: <?php echo $main_user[COL_KORISNIK_KORISNICKO_IME]?><br>
		Ime: <?php echo $main_user[COL_KORISNIK_IME]?><br>
		Prezime: <?php echo $main_user[COL_KORISNIK_PREZIME]?><br>
		Pol: <?php
			if ($main_user[COL_KORISNIK_POL] == "m") {
				echo "Muški";
			} else {
				echo "Ženski";
			}
		?><br>
		Adresa: <?php echo $main_user[COL_KORISNIK_ADRESA]?><br>
		Datum rođenja: <?php echo $main_user[COL_KORISNIK_DATUM_RODJENJA]?><br>

		<a href="profile.php"><h4>Nazad</h4></a>
	<?php
		}
	?>

    <?php
		if(isset($_GET["change"])) {
	?>
	<form method="post" action="" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="500000">
		<label for="photo">Profilna slika:</label>
        <input type="file" name="photo" id="photo" value=""><br>

		<label for="username_new">Korisničko ime:</label>
		<input type="text" name="username_new"><br>

		<label for="password_new">Lozinka:</label>
		<input type="password" name="password_new"><br>
					
		<label for="name_new">Ime:</label>
		<input type="text" name="name_new"><br>
					
		<label for="surname_new">Prezime:</label>
		<input type="text" name="surname_new"><br>

		<label for="address_new">Adresa:</label>
		<input type="text" name="address_new"><br>
					
		<label for="birthday_new">Datum rođenja:</label>
		<input type="date" name="birthday_new"><br>
		
		<input type="submit" name="change" value="Sačuvaj promene">
	</form>
	<a href="profile.php"><h4>Nazad</h4></a>
	<?php
		}
	?>
</body>
</html>