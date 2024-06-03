<?php
ob_start();

if(!isset($_COOKIE['ingelogd'])) {
    header('Location: index.php');
    exit;
}
ob_end_flush();
?>

<html>
<!-- navigatie maken -->
<!--------------------------------------------------------------------------------------------------------------------->
<link rel="stylesheet" href="OpmaakMenubalk.css" type="text/css">
<ul>
    <li><a href="schermBeheerderAanpassen.php">Mensen aanpassen</a></li>
    <li><a href="schermBeheerderToevoegen.php">Mensen toevoegen</a></li>
    <li><a href="schermBeheerderVerwijderen.php">Mensen verwijderen</a></li>
    <li><a href="BeheerKasten.php">Beheer kasten</a></li>
    <li><a href="LogboekTabel.php">Logboek</a></li>
    <li><a href="index.php">Uitloggen</a></li>

</ul>

<!-- Dit stuk van de code dient ervoor een tabel te maken van alle rijen en kolommen in de database van het logboek, waar alle nodigde data van de ondernomen acties in de kasten word bijgehouden.
     Ik gebruik eerst een if statement om alle data uit het logboek te halen en save did resultaat in de variabele $Resultaat, dan maak ik de header kolom aan om de variabelen er onderling in te verdelen.
     Dit doe ik door een while functie te gebruiken terwijl ik steeds de eerstvolgende kolom data uit de variabele $Resultaat haal en deze in de $Row functie gebruik.
     Hierna maak ik gebruik van nog een if statement om apart de voornaam en achternaam te achterhalen uit de gebruikers database, omdat dit niet in de database van het logboek staat.
     Hierna maak ik gebruik van de sessionID 'actie' uit de schermBeheerder file om te bepalen welke actie word ondernomen en in plaats van een integer te gebruiken een string gebruiken om dit beter te verwoorden.
     Ten laatste zet je deze variabelen met de juiste waarden en gegevens in kolommen die per rij overeenkomen met de header in elke rij.
     -->

<body>
<form method='post'>
    <h2>Logboek</h2>
    <table border = 5>
        <?php
        session_start();
        include "verbindingDB.php";

        if ($stmt = $link->prepare('SELECT * FROM logboek')) { // Selecteer alles uit het logboek om te gebruiken in de tabel.
            $stmt->execute();
            $Resultaat = mysqli_stmt_get_result($stmt);

            //Voeg de header kolom toe in de tabel om de verschillende rijen te categoriseren.
            echo "
                <thead>
                    <tr>
                        <th>Log</th>
                        <th>Kast</th>
                        <th>Naam</th>
                        <th>Datum</th>
                        <th>Time</th>
                        <th>Actie</th>
                    </tr>
                </thead>
            ";

            while ($Row = mysqli_fetch_assoc($Resultaat)) {
                $Badgenr = $Row['idgebruiker']; // Aparte variabele die als parameter dient om de voornaam en achternaam in de andere database gebruikers te vinden.
                if ($stmt2 = $link->prepare('SELECT voornaam, achternaam FROM gebruikers WHERE gebruikerid = ?')) { // Aparte query voor het verkrijgen van de juiste volledige naam van de persoon rechststreeks uit de gebruikers database.
                    $stmt2->bind_param('s', $Badgenr);
                    $stmt2->execute();
                    $Resultaat2 = mysqli_stmt_get_result($stmt2);
                    $userRow = mysqli_fetch_assoc($Resultaat2);

                    $fullName = $userRow['voornaam'] . ' ' . $userRow['achternaam']; //We maken de variabele aan voor de volledige naam van de gebruiker te weergeven.

                    $actie = $Row['actie'] == 1 ? 'Teruggebracht' : 'Weggenomen'; //Variabele voor het bepalen van de actie, word het item in de kast weggenomen of teruggebracht?

                    //Voeg de nieuwe kolommen toe met de nodige gegevens in de juiste tabelcellen.
                    echo "
                        <tr>
                            <td>{$Row['logid']}</td>
                            <td>{$Row['idkast']}</td>
                            <td>{$fullName}</td>
                            <td>{$Row['datum']}</td>
                            <td>{$Row['time']}</td>
                            <td>{$actie}</td>
                        </tr>
                    ";


                    $stmt2->close(); // Sluit de 2de statement.
                }
            }

            $stmt->close(); // Sluit de originele statement.
        }
        $link->close(); // Sluit de link met de database.
        ?>

    </table>
</form>
</body>
</html>