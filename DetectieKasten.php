<!--
In dit project wordt er gekeken of er een interactie gebeurd is met de kasten. Wanneer dit gebeurd
wordt dit in een ander project naar de database geschreven.

Gemaakt door: Manu De Keersmaeker
-->

<?php
//Hier wordt gecontroleerd of de kast deur geopend of gesloten wordt.
//----------------------------------------------------------------------------------------------------------------------
if ($_SESSION['VorigeKast01'] == "Gesloten" && $_SESSION['Kast01'] == "Open"){
    $_SESSION['VorigeKast01'] = "Open";
    $Kast01_Geopend = true;
}
if ($_SESSION['VorigeKast01'] == "Open" && $_SESSION['Kast01'] == "Gesloten"){
    $_SESSION['VorigeKast01'] = "Gesloten";
    $Kast01_Sluiten = true;
}

if ($_SESSION['VorigeKast02'] == "Gesloten" && $_SESSION['Kast02'] == "Open"){
    $_SESSION['VorigeKast02'] = "Open";
    $Kast02_Geopend = true;
}
if ($_SESSION['VorigeKast02'] == "Open" && $_SESSION['Kast02'] == "Gesloten"){
    $_SESSION['VorigeKast02'] = "Gesloten";
    $Kast02_Sluiten = true;
}

if ($_SESSION['VorigeKast03'] == "Gesloten" && $_SESSION['Kast03'] == "Open"){
    $_SESSION['VorigeKast03'] = "Open";
    $Kast03_Geopend = true;
}
if ($_SESSION['VorigeKast03'] == "Open" && $_SESSION['Kast03'] == "Gesloten"){
    $_SESSION['VorigeKast03'] = "Gesloten";
    $Kast03_Sluiten = true;
}

if ($_SESSION['VorigeKast04'] == "Gesloten" && $_SESSION['Kast04'] == "Open"){
    $_SESSION['VorigeKast04'] = "Open";
    $Kast04_Geopend = true;
}
if ($_SESSION['VorigeKast04'] == "Open" && $_SESSION['Kast04'] == "Gesloten"){
    $_SESSION['VorigeKast04'] = "Gesloten";
    $Kast04_Sluiten = true;
}

if ($_SESSION['VorigeKast05'] == "Gesloten" && $_SESSION['Kast05'] == "Open"){
    $_SESSION['VorigeKast05'] = "Open";
    $Kast05_Geopend = true;
}
if ($_SESSION['VorigeKast05'] == "Open" && $_SESSION['Kast05'] == "Gesloten"){
    $_SESSION['VorigeKast05'] = "Gesloten";
    $Kast05_Sluiten = true;
}

if ($_SESSION['VorigeKast06'] == "Gesloten" && $_SESSION['Kast06'] == "Open"){
    $_SESSION['VorigeKast06'] = "Open";
    $Kast06_Geopend = true;
}
if ($_SESSION['VorigeKast06'] == "Open" && $_SESSION['Kast06'] == "Gesloten"){
    $_SESSION['VorigeKast06'] = "Gesloten";
    $Kast06_Sluiten = true;
}

//Hier worden de variabelen (tijd en datum) opgeslagen.
//----------------------------------------------------------------------------------------------------------------------
if ($Kast01_Geopend){

}
?>