<?php
class Upload extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->model('users');
		}

		//This function takes a csv of users and inserts them into the database.
		//The csv should be setup without headers in the first row.
		//Details should be entered in the order: username, password, email, firstname, lastname, address
		function users($csv)
		{
			$row = 1;
			$ins = 0;
			if (($handle = fopen("test.csv", "r")) !== false) {
				while (($data = fgetcsv($handle, 1000, ",")) !== false) {
					//Check that there is the correct amount of values in the row to reduce errors in the database
					if(count($data) == 6) {
						$username 	= $data[0];
						$password 	= $data[1];
						$email 		= $data[2];
						$firstname 	= $data[3];
						$lastname 	= $data[4];
						$address 	= $data[5];
						//Use Blowfish to generate a password hash.
						//We're using a default cost of 10 and an automatically generated salt.
						$password = password_hash($password, PASSWORD_BCRYPT);
						$duplicates = $this->check_duplicates($username, $email);
						if($duplicates) {
							echo "There is already a user with the username: $username or email: $email. User was not added.\n";
						}
						else {
							//If tests pass then we insert this user into the database.
							$inserted = $this->users->insert_user($username, $password, $email, $firstname, $lastname, $address);
							if($inserted) {
								$ins++;
							}
							else {
								echo "Row $row failed to insert into the database.\n";
							}
						}
					}
					else {
						echo "Row $row insert failed. Either some fields are empty or there are too many.\n";
					}
					$row++;
				}
				fclose($handle);
			}
			echo "$ins users successfully inserted into the database.";
		}

		//This function checks to see if there is already a user with the entered username or email in the database.
		//Returns true if there is a duplicate of either.
		function check_duplicates($username, $email)
		{
			$duplicate_user = $this->users->get_user($username);
			$duplicate_email = $this->users->check_email($email);

			if($duplicate_user !== false || $duplicate_email !== false) {
				return true;
			}
			else {
				return false;
			}
		}

}