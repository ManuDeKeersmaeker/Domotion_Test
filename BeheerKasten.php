<!--
Dit project is de testomgeving voor het schoolproject Domotion. De bedoeling hiervan
is dat de beheerder bepaalde kasten defect en actief kan zetten. Dit wordt aangegeven door
de kleur groen of rood van de knoppen in de testomgeving

Gemaakt door: Manu De Keersmaeker
-->
<?php
include ('verbindingDB.php');
session_start();

//Hier controleren we wanneer er op de knop wordt geklikt. De kleur wordt veranderd en er wordt naar de db geschreven
//----------------------------------------------------------------------------------------------------------------------
for ($Teller = 1; $Teller <= $_SESSION['AantalKasten']; $Teller++){
    if (isset($_POST['Beheer'.$Teller])) {
        if ($_SESSION['KleurKast' . $Teller] == "green") {
            $_SESSION['KleurKast' . $Teller] = "red";
        } elseif ($_SESSION['KleurKast' . $Teller] == "red") {
            $_SESSION['KleurKast' . $Teller] = "green";
        }

        //Verbinding naar de database (past 'in_de_kast' aan in de tabel 'kasten')
        //Er wordt 0 geschreven als deze actief is
        //Er wordt 1 geschreven als deze defect is
        $Status = 0;
        if ($_SESSION['KleurKast' . $Teller] == "red") {
            $Status = 1;
        }
        //Hier schrijven we naar de db
        if ($link) {
            $query = "update kasten set actief_defect = ? where kastid = ?";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'ii', $Status, $Teller);
            }
            if (mysqli_stmt_execute($stmt)) {
                echo "Aanpassing gelukt!!";
            } else {
                echo "Aanpassing niet gelukt :(";
                echo mysql_stmt_error($stmt);
            }
            mysqli_close($link);
        }
    }
}
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

<!--Het maken van de knoppen en kasten -->
<!--------------------------------------------------------------------------------------------------------------------->
<body>
<form method='post'>
    <h3>Kasten beheren</h3>
    <table border = 5>
        <?php
        for ($Teller = 1; $Teller <= $_SESSION['AantalKasten']; $Teller++){
            echo "
            <tr>
                <td>Kast {$Teller}</td>
                <td><input type='submit' name='Beheer{$Teller}' value='{$_SESSION['KleurKast'.$Teller]}' style='background-color: {$_SESSION['KleurKast'.$Teller]}'></td>
            </tr>
            ";
        }
        ?>
    </table>
</form>
<form method="post" action="data.php">
    <input type="submit" name="GoToData" value="Ga terug">
</form>
</body>
</html>