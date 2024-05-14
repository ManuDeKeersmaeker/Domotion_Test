<!--
Dit project is de testomgeving voor het schoolproject Domotion. De bedoeling hiervan
is dat er verschillende kasten te zien zijn en men virtueel materiaal uit de kasten kan nemen.

Handige variabelen (Vul op xx in de kastnummer in (bv: 1, 2 ,..., 10, 11)):
$_SESSION['BadgeId'] ==> Dit is het badge id dat de gebruiker heeft ingegeven of dat gescant is
$_SESSION['KleurKastxx'] ==> Dit is de kleur van de knop.  Mogelijke kleure "red" en "green".
$_SESSION['Kastxx'] ==> Dit geeft aan of de kast "Open" of "Gesloten" is.
$_SESSION['StatusKastxx'] ==> Dit geeft aan of de kast "Leeg" of "Vol" is.

Gemaakt door: Manu De Keersmaeker
-->


<?php
//Het importeren van de code uit een ander php file & het aantal kasten instellen
//----------------------------------------------------------------------------------------------------------------------
session_start();
include ('verbindingDB.php');
$_SESSION['AantalKasten'] = 2;

//Hieronder wordt ervoor gezorgd dat de inhoud van de kast kan veranderen en dat de kast open en dicht kan.
//----------------------------------------------------------------------------------------------------------------------
for ($Teller = 1; $Teller <= $_SESSION['AantalKasten']; $Teller++){
    if (isset($_POST['Kast'.$Teller])) {    
        if ($_POST['Kast'.$Teller] == "Open" || $_POST['Kast'.$Teller] == null){
            $_SESSION['Kast'.$Teller] = "Gesloten";
            $_SESSION['VorigeKast'.$Teller] = "Open";
        }
        else{
            $_SESSION['Kast'.$Teller] = "Open";
            $_SESSION['VorigeKast'.$Teller] = "Gesloten";
        }
    }
    if (isset($_POST['StatusKast'.$Teller])){
        if ($_POST['StatusKast'.$Teller] == "Leeg" || $_POST['StatusKast'.$Teller] == null){
            $_SESSION['StatusKast'.$Teller] = "Vol";
            $_SESSION['VorigeStatusKast'.$Teller] = "Leeg";
        }
        else{
            $_SESSION['StatusKast'.$Teller] = "Leeg";
            $_SESSION['VorigeStatusKast'.$Teller] = "Vol";
        }

        //Verbinding naar de database (past 'in_de_kast' aan in de tabel 'kasten'
        $inhoud = 0;
        if ($_SESSION['StatusKast'.$Teller] == "Vol") {
            $inhoud = 1;
        }
        if($link){
            $query = "update lockers_kasten set in_de_kast = ? where kastid = ?";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'ii', $inhoud, $Teller);


            }
            if (mysqli_stmt_execute($stmt)){
                echo "Aanpassing gelukt!!";
            }
            else{
                echo "Aanpassing niet gelukt :(";
                echo mysql_stmt_error($stmt);
            }
            mysqli_close($link);
        }
    }
}

//Hier wordt ervoor gezorgd dat de kasten allemaal in het begin van het programma actief worden gesteld.
//----------------------------------------------------------------------------------------------------------------------
if ($_SESSION['KleurKast1'] == null){
    for ($Teller = 1; $Teller <= $_SESSION['AantalKasten']; $Teller++){
        $_SESSION['KleurKast'.$Teller] = "green";
    }
}

//Hier wordt het BadgeId opgeslagen in een session variabelen
//----------------------------------------------------------------------------------------------------------------------
if ($_SESSION['BadgeId'] == null){
    $_SESSION['BadgeId'] =  $_POST['BadgeId'];
}

//Het importeren van de code uit een andere php file
//----------------------------------------------------------------------------------------------------------------------
include ('DetectieKasten.php');
?>

<!--Het maken van de kasten visueel -->
<!--------------------------------------------------------------------------------------------------------------------->
<html>
<body>
<form method='post'>
    <h3>Kasten</h3>
    <table border = 5>
        <?php
        for ($Teller = 1; $Teller <= $_SESSION['AantalKasten']; $Teller++){
            echo "
            <tr>
                <td>Kast {$Teller}</td>
                <td><input type='submit' name='Kast{$Teller}' value='{$_SESSION['Kast'.$Teller]}' style='background-color: {$_SESSION['KleurKast'.$Teller]}'></td>
                <td><input type='submit' name='StatusKast{$Teller}' value='{$_SESSION['StatusKast'.$Teller]}' style='background-color: {$_SESSION['KleurKast'.$Teller]}'></td>
            </tr>
            ";
        }
        ?>

    </table>
</form>
<form method="post" action="TestOmgeving.php">
    <input type="submit" name="GoToBadgeId" value="Ga terug">
</form>
</body>
</html>