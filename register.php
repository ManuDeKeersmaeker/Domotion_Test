<?php
include('verbindingDB.php');
//echo 'register';
// kijken of er data werd doorgestuurd, isset() function kijkt of de data bestaat.

if (!isset($_POST['voornaam'], $_POST['achternaam'], $_POST['badgenummer'], $_POST['telefoonnr'], $_POST['rol'])) {
	// Could not get the data that should have been sent.
	die ('Er ging iets fout, gelieve het registratieformulier nogmaals in te vullen');
}
// Check of de velden niet leeg werden gelaten
if (empty($_POST['voornaam']) || empty($_POST['achternaam']) || empty($_POST['badgenummer']) || empty($_POST['telefoonnr']) || empty($_POST['rol']) || empty($_POST['wachtwoord'])) {
	// One or more values are empty.
	die ('Gelieve het registratieformulier volledig in te vullen!');
}
//echo $_POST['username'];
//echo $_POST['password'];
// Bestaat de gebruikersnaam al? zo nee: toevoegen in DB
if ($stmt = $link->prepare('SELECT gebruikerid,  wachtwoord FROM lockers_gebruikers WHERE badgenummer = ?')) {
	// Bind parameters, hash the password using the PHP password_hash function.
	//echo 'prepare';
	$stmt->bind_param('s', $_POST['badgenummer']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Deze badgenummer bestaat al, kies een andere badgenummer!';
	} else {
		//echo 'new';
		// Nieuw account toevoegen
		// Gebruikersnaam bestaat niet: gebruikersnaam en ww toevoegen
		if ($stmt = $link->prepare('INSERT INTO lockers_gebruikers (voornaam, achternaam, badgenummer, telefoonnr, rol, wachtwoord) VALUES (?, ?, ?, ?, ?, ?)')) {
			//Er mogen geen leesbare ww opgeslagen worden, het ww wordt gehashed opgeslagen en steeds
			//gehashed geverifieerd.
			//echo 'insert';
			$password = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);      //incryptie van het wachtwoord
			$stmt->bind_param('ssssss', $_POST['voornaam'], $_POST['achternaam'], $_POST['badgenummer'], $_POST['telefoonnr'], $_POST['rol'], $password);
			$stmt->execute();
			echo $stmt->error;
			echo 'Registratie is gelukt!';
		} else {
			// Fout in het sql statement, komen de namen van de velden overeen met de tabel?.
			echo 'fout in query statement!';
			echo mysqli_stmt_error($stmt);
		}
	}
	$stmt->close();
} else {
	// Fout in het sql statement
	echo 'fout in query statement!';
}
$link->close();
?>