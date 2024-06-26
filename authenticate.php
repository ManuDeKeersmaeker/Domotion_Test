<?php
session_start();
ob_start();     // Start output buffering. Dit zorgt ervoor dat er geen output naar de browser wordt gestuurd totdat ob_end_flush() wordt aangeroepen.
// connectie maken
include 'verbindingDB.php';

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['voornaam'], $_POST['achternaam'], $_POST['badgenummer'], $_POST['wachtwoord']) ) {
	// Could not get the data that should have been sent.
	die ('Please fill all the fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $link->prepare('SELECT gebruikerid, wachtwoord FROM lockers_gebruikers WHERE badgenummer = ?')) {
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

            //Deze cookie zou ervoor zorgen dat je niet naar een andere pagina kan zonder dat er ingelogd is
            //Dit is nog niet af
            setcookie('ingelogd', true, time()+3600);
			header('Location: schermBeheerderAanpassen.php');
			exit;       // Zorg ervoor dat de scriptuitvoering hier stopt, zodat de rest van de code niet wordt uitgevoerd.
		}
	else {
		echo 'Foutief password!';//.$_POST['username'].'" "'.$_POST['password'];
	}
} else {
	echo 'Onbekende gebruikersnaam!';
}
$link->close();
ob_end_flush();     // Stuur de output buffer naar de browser en stop met bufferen.
?>