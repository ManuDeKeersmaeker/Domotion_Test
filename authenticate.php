<?php
session_start();
// connectie maken
include 'verbinding.php';

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['voornaam'], $_POST['achternaam'], $_POST['badgenummer'], $_POST['wachtwoord']) ) {
	// Could not get the data that should have been sent.
	die ('Please fill all the fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $link->prepare('SELECT gebruikerid, wachtwoord FROM gebruikers WHERE badgenummer = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['badgenummer']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
}

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		// Account exists, now we verify the password.
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
		if (password_verify($_POST['wachtwoord'], $password)) {
			// Verification success! User has loggedin!
			// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['voornaam'] = $_POST['voornaam'];
			$_SESSION['achternaam'] = $_POST['achternaam'];
			$_SESSION['id'] = $id;

			echo '<form action="data.php">';
			//echo '<input type="submit" name="data" value="data"/>';

		}
	else {
		echo 'Foutief password!';//.$_POST['username'].'" "'.$_POST['password'];
	}
} else {
	echo 'Onbekende gebruikersnaam!';
}
$stmt->close();
?>
