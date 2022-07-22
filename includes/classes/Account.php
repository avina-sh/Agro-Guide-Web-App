<?php
	class Account {

		private $con;
		private $errorArray;

		public function __construct($con) {
			$this->con = $con;
			$this->errorArray = array();
		}

		public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $em2);
			$this->validatePasswords($pw, $pw2);

			if(empty($this->errorArray) == true) {
				//Insert into db
				return $this->insertUserData($un, $fn, $ln, $em, $pw);
			}
			else {
				return false;
			}
		}

		public function login($un, $pw){
			$pw  = md5($pw);

			$query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$un' AND password = '$pw'");

			if(mysqli_num_rows($query) == 1){
				return true;
			}
			else {
				array_push($this->errorArray, constants::$loginFailed);
				return false;
			}
		}

		public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function insertUserData($un, $fn, $ln, $em, $pw){
			$encrytPw = md5($pw);
			$profilePic = "assests\images\profile pic\dp.png";
			$date = date("Y-m-d");
			
			$result = mysqli_query($this->con,"INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encrytPw', '$date', '$profilePic')");
			
			return $result;
		}

		private function validateUsername($un) {

			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray, constants::$usernameCharacters);
				return;
			}

			$checkUsernameQurey = mysqli_query($this->con, " SELECT username FROM users WHERE username='$un'");
			if (mysqli_num_rows($checkUsernameQurey) != 0){
				array_push($this->errorArray, constants::$nameAlreadyTaken);
			}

		}

		private function validateFirstName($fn) {
			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, constants::$firstnameCharacters);
				return;
			}
		}

		private function validateLastName($ln) {
			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, constants::$lastnameCharacters);
				return;
			}
		}

		private function validateEmails($em, $em2) {
			if($em != $em2) {
				array_push($this->errorArray, constants::$EmailsDoNotMatch);
				return;
			}

			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, constants::$EmailInvalid);
				return;
			}

			$checkEmailQurey = mysqli_query($this->con, " SELECT username FROM users WHERE email='$em'");
			if (mysqli_num_rows($checkEmailQurey) != 0){
				array_push($this->errorArray, constants::$emailAlreadyTaken);
			}
		}

		private function validatePasswords($pw, $pw2) {
			
			if($pw != $pw2) {
				array_push($this->errorArray, constants::$passwordsDoNotMatch);
				return;
			}

			if(preg_match('/[^A-Za-z0-9]/', $pw)) {
				array_push($this->errorArray, constants::$passwordsNotAlphanumeric);
				return;
			}

			if(strlen($pw) > 30 || strlen($pw) < 5) {
				array_push($this->errorArray, constants::$passwordsCharacters);
				return;
			}

		}


	}
?>