<?php
  require_once("constants.php");

 	class Database {
    
	    private $conn;

        private $hashing_salt = "dsaf7493^&$(#@Kjh";

	    public function __construct($configFile = "config.ini") {
			if($config = parse_ini_file($configFile)) {
				$host = $config["host"];
				$database = $config["database"];
				$user = $config["user"];
				$password = $config["password"];
				$this->conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
	    }

	    public function __destruct() {
	    	$this->conn = null;
	    }

        public function insertUser ($username, $password, $name, $surname, $gender, $address, $birthday) {
            try {
                $sql_existing_user = "SELECT * FROM " . TBL_KORISNIK . " WHERE " . COL_KORISNIK_KORISNICKO_IME . "= :username";
                $st = $this->conn->prepare($sql_existing_user);
                $st->bindValue(":username", $username, PDO::PARAM_STR);
                $st->execute();
                if ($st->fetch()) {
                    return false;
                }
                
                $hashed_password = crypt($password, $this->hashing_salt);
    
                $sql_insert = "INSERT INTO " . TBL_KORISNIK . " (".COL_KORISNIK_KORISNICKO_IME.","
                                                              .COL_KORISNIK_SIFRA.","
                                                              .COL_KORISNIK_IME.","
                                                              .COL_KORISNIK_PREZIME.","
                                                              .COL_KORISNIK_POL.","
                                                              .COL_KORISNIK_ADRESA.","
                                                              .COL_KORISNIK_DATUM_RODJENJA.")"
                            ." VALUES (:username, :password, :name, :surname, :gender, :address, :birthday)";
    
                $st = $this->conn->prepare($sql_insert);
                $st->bindValue("username", $username, PDO::PARAM_STR);
                $st->bindValue("password", $hashed_password, PDO::PARAM_STR);
                $st->bindValue("name", $name, PDO::PARAM_STR);
                $st->bindValue("surname", $surname, PDO::PARAM_STR);
                $st->bindValue("gender", $gender, PDO::PARAM_STR);
                $st->bindValue("address", $address, PDO::PARAM_STR);
                $st->bindValue("birthday", $birthday, PDO::PARAM_STR);
                
                return $st->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function checkLogin($username, $password) {
            try {
                $hashed_password = crypt($password, $this->hashing_salt);
                $sql = "SELECT * FROM " . TBL_KORISNIK . " WHERE " . COL_KORISNIK_KORISNICKO_IME . "=:username and " . COL_KORISNIK_SIFRA . "=:password";
                $st = $this->conn->prepare($sql);
                $st->bindValue("username", $username, PDO::PARAM_STR);
                $st->bindValue("password", $hashed_password, PDO::PARAM_STR);
                $st->execute();
                return $st->fetch();
            } catch (PDOException $e) {
                return null;
            }
        }

        public function updateUsername ($id, $username_new) {
            try {
                $sql_existing_user = "SELECT * FROM " . TBL_KORISNIK . " WHERE " . COL_KORISNIK_ID . "= :id";
                $st = $this->conn->prepare($sql_existing_user);
                $st->bindValue(":id", $id, PDO::PARAM_STR);
                $st->execute();
                if (!$st->fetch()) {
                    return false;
                }

                $sql_update = "UPDATE " . TBL_KORISNIK . " SET " . COL_KORISNIK_KORISNICKO_IME . "= :username_new"
                            . " WHERE " . COL_KORISNIK_ID . "= :id";

                $st = $this->conn->prepare($sql_update);
                $st->bindValue("username_new", $username_new, PDO::PARAM_STR);
                $st->bindValue("id", $id, PDO::PARAM_STR);

                return $st->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function updatePassword ($id, $password_new) {
            try {
                $sql_existing_user = "SELECT * FROM " . TBL_KORISNIK . " WHERE " . COL_KORISNIK_ID . "= :id";
                $st = $this->conn->prepare($sql_existing_user);
                $st->bindValue(":id", $id, PDO::PARAM_STR);
                $st->execute();
                if (!$st->fetch()) {
                    return false;
                }

                $hashed_password = crypt($password_new, $this->hashing_salt);
                $sql_update = "UPDATE " . TBL_KORISNIK . " SET " . COL_KORISNIK_SIFRA . "= :password_new"
                            . " WHERE " . COL_KORISNIK_ID . "= :id";

                $st = $this->conn->prepare($sql_update);
                $st->bindValue("password_new", $hashed_password, PDO::PARAM_STR);
                $st->bindValue("id", $id, PDO::PARAM_STR);

                return $st->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function updateName ($id, $name_new) {
            try {
                $sql_existing_user = "SELECT * FROM " . TBL_KORISNIK . " WHERE " . COL_KORISNIK_ID . "= :id";
                $st = $this->conn->prepare($sql_existing_user);
                $st->bindValue(":id", $id, PDO::PARAM_STR);
                $st->execute();
                if (!$st->fetch()) {
                    return false;
                }

                $sql_update = "UPDATE " . TBL_KORISNIK . " SET " . COL_KORISNIK_IME . "= :name_new"
                            . " WHERE " . COL_KORISNIK_ID . "= :id";

                $st = $this->conn->prepare($sql_update);
                $st->bindValue("name_new", $name_new, PDO::PARAM_STR);
                $st->bindValue("id", $id, PDO::PARAM_STR);

                return $st->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function updateSurname ($id, $surname_new) {
            try {
                $sql_existing_user = "SELECT * FROM " . TBL_KORISNIK . " WHERE " . COL_KORISNIK_ID . "= :id";
                $st = $this->conn->prepare($sql_existing_user);
                $st->bindValue(":id", $id, PDO::PARAM_STR);
                $st->execute();
                if (!$st->fetch()) {
                    return false;
                }

                $sql_update = "UPDATE " . TBL_KORISNIK . " SET " . COL_KORISNIK_PREZIME . "= :surname_new"
                            . " WHERE " . COL_KORISNIK_ID . "= :id";

                $st = $this->conn->prepare($sql_update);
                $st->bindValue("surname_new", $surname_new, PDO::PARAM_STR);
                $st->bindValue("id", $id, PDO::PARAM_STR);

                return $st->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function updateAddress ($id, $address_new) {
            try {
                $sql_existing_user = "SELECT * FROM " . TBL_KORISNIK . " WHERE " . COL_KORISNIK_ID . "= :id";
                $st = $this->conn->prepare($sql_existing_user);
                $st->bindValue(":id", $id, PDO::PARAM_STR);
                $st->execute();
                if (!$st->fetch()) {
                    return false;
                }

                $sql_update = "UPDATE " . TBL_KORISNIK . " SET " . COL_KORISNIK_ADRESA . "= :address_new"
                            . " WHERE " . COL_KORISNIK_ID . "= :id";

                $st = $this->conn->prepare($sql_update);
                $st->bindValue("address_new", $address_new, PDO::PARAM_STR);
                $st->bindValue("id", $id, PDO::PARAM_STR);

                return $st->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function updateBirthday ($id, $birthday_new) {
            try {
                $sql_existing_user = "SELECT * FROM " . TBL_KORISNIK . " WHERE " . COL_KORISNIK_ID . "= :id";
                $st = $this->conn->prepare($sql_existing_user);
                $st->bindValue(":id", $id, PDO::PARAM_STR);
                $st->execute();
                if (!$st->fetch()) {
                    return false;
                }

                $sql_update = "UPDATE " . TBL_KORISNIK . " SET " . COL_KORISNIK_DATUM_RODJENJA . "= :birthday_new"
                            . " WHERE " . COL_KORISNIK_ID . "= :id";

                $st = $this->conn->prepare($sql_update);
                $st->bindValue("birthday_new", $birthday_new, PDO::PARAM_STR);
                $st->bindValue("id", $id, PDO::PARAM_STR);

                return $st->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function updatePicture ($id, $picture_new) {
            try {
                $sql_existing_user = "SELECT * FROM " . TBL_KORISNIK . " WHERE " . COL_KORISNIK_ID . "= :id";
                $st = $this->conn->prepare($sql_existing_user);
                $st->bindValue(":id", $id, PDO::PARAM_STR);
                $st->execute();
                if (!$st->fetch()) {
                    return false;
                }

                $sql_update = "UPDATE " . TBL_KORISNIK . " SET " . COL_KORISNIK_PROFILNA_SLIKA . "= :picture_new"
                            . " WHERE " . COL_KORISNIK_ID . "= :id";

                $st = $this->conn->prepare($sql_update);
                $st->bindValue("picture_new", $picture_new, PDO::PARAM_STR);
                $st->bindValue("id", $id, PDO::PARAM_STR);

                return $st->execute();
            } catch (PDOException $e) {
                return false;
            }
        }
	}
?>
