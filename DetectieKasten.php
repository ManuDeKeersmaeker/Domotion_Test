<!--
In dit project wordt er gekeken of er een interactie gebeurd is met de kasten. Wanneer een kast geopend wordt wordt de
datum en tijd opgeslagen in variabelen. Wanneer de kast gesloten wordt, wordt er geschreven naar de database. Dit wordt
gedaan aan de hand van een functie 'SchrijvenNaarDatabase' die men in het bestand 'logboek.php' vindt.

Handige variabelen (Vul op xx in de kastnummer in (bv: 1, 2 ,..., 10, 11)):
$_SESSION['DatumKast'.$Teller] ==> Dit is de datum van wanneer de kast geopend wordt.
$_SESSION['TijdKast'.$Teller] ==> Dit is de tijd van wanneer de kast geopend wordt.

Gemaakt door: Manu De Keersmaeker
-->

<?php
session_start();
//Hier wordt gecontroleerd of de kast deur geopend of gesloten wordt.
//----------------------------------------------------------------------------------------------------------------------
for ($Teller = 1; $Teller <= $_SESSION['AantalKasten']; $Teller++) {
    if ($_SESSION['VorigeKast' . $Teller] == "Gesloten" && $_SESSION['Kast' . $Teller] == "Open") {
        $_SESSION['VorigeKast' . $Teller] = "Open";
        $_SESSION['Kast' . $Teller . '_Geopend'] = true;
    }
    if ($_SESSION['VorigeKast' . $Teller] == "Open" && $_SESSION['Kast' . $Teller] == "Gesloten") {
        $_SESSION['VorigeKast' . $Teller] = "Gesloten";
        $_SESSION['Kast' . $Teller . '_Sluiten'] = true;
    }
}

//Hier worden de variabelen (tijd en datum) opgeslagen en wordt er vewezen naar een functie in een ander bestand als de
//kastdeur gesloten wordt.
//----------------------------------------------------------------------------------------------------------------------
for ($Teller = 1; $Teller <= $_SESSION['AantalKasten']; $Teller++){
    if ($_SESSION['Kast'.$Teller.'_Geopend'] == true){
        $_SESSION['DatumKast'.$Teller] = date("Y-m-d");
        $_SESSION['TijdKast'.$Teller] = date("H:i");
        $_SESSION['Kast'.$Teller.'_Geopend'] = false;
    }
    if ($_SESSION['Kast'.$Teller.'_Sluiten'] == true){
        include ('logboek.php');
        SchrijvenNaarDatabase($Teller);
        $_SESSION['Kast'.$Teller.'_Sluiten'] = false;
    }
}
?>