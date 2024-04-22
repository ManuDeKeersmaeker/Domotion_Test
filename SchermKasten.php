<!--
Dit project is de testomgeving voor het schoolproject Domotion. De bedoeling hiervan
is dat er verschillende kasten te zien zijn en men virtueel materiaal uit de kasten kan nemen.

Handige variabelen (Vul op xx in de kastnummer in (bv: 01, 02 ,...)):
$_SESSION['BadgeId'] ==> Dit is het badge id dat de gebruiker heeft ingegeven of dat gescant is
$_SESSION['KleurKastxx'] ==> Dit is de kleur van de knop.  Mogelijke kleure "red" en "green".
$_SESSION['Kastxx'] ==> Dit geeft aan of de kast "Open" of "Gesloten" is.
$_SESSION['StatusKastxx'] ==> Dit geeft aan of de kast "Leeg" of "Vol" is.

Gemaakt door: Manu De Keersmaeker
-->


<?php
$AantalKasten = 1;

//Hieronder wordt ervoor gezorgd dat de inhoud van de kast kan veranderen en dat de kast open en dicht kan.
session_start();
/*
if (isset($_POST['Kast01'])) {
    if ($_POST['Kast01'] == "Gesloten" || $_POST['Kast01'] == null){
        $_SESSION['Kast01'] = "Open";
        $_SESSION['VorigeKast01'] = "Gesloten";
    }
    else{
    $_SESSION['Kast01'] = "Gesloten";
    $_SESSION['VorigeKast01'] = "Open";
    }
}
if (isset($_POST['StatusKast01'])){
    if ($_POST['StatusKast01'] == "Vol" || $_POST['StatusKast01'] == null){
        $_SESSION['StatusKast01'] = "Leeg";
        $_SESSION['VorigeStatusKast01'] = "Vol";
    }
    else{
        $_SESSION['StatusKast01'] = "Vol";
        $_SESSION['VorigeStatusKast01'] = "Leeg";
    }
}*/
for ($Teller = 1; $Teller <= $AantalKasten; $Teller++){
    if (isset($_POST['Kast'.$Teller])) {
        if ($_POST['Kast'.$Teller] == "Gesloten" || $_POST['Kast'.$Teller] == null){
            $_SESSION['Kast'.$Teller] = "Open";
            $_SESSION['VorigeKast'.$Teller] = "Gesloten";
        }
        else{
            $_SESSION['Kast'.$Teller] = "Gesloten";
            $_SESSION['VorigeKast'.$Teller] = "Open";
        }
    }
    if (isset($_POST['StatusKast'.$Teller])){
        if ($_POST['StatusKast'.$Teller] == "Vol" || $_POST['StatusKast'.$Teller] == null){
            $_SESSION['StatusKast'.$Teller] = "Leeg";
            $_SESSION['VorigeStatusKast'.$Teller] = "Vol";
        }
        else{
            $_SESSION['StatusKast'.$Teller] = "Vol";
            $_SESSION['VorigeStatusKast'.$Teller] = "Leeg";
        }
    }
}












if (isset($_POST['Kast02'])) {
    if ($_POST['Kast02'] == "Gesloten" || $_POST['Kast02'] == null){
        $_SESSION['Kast02'] = "Open";
        $_SESSION['VorigeKast02'] = "Gesloten";
    }
    else{
        $_SESSION['Kast02'] = "Gesloten";
        $_SESSION['VorigeKast02'] = "Open";
    }
}
if (isset($_POST['StatusKast02'])){
    if ($_POST['StatusKast02'] == "Vol" || $_POST['StatusKast02'] == null){
        $_SESSION['StatusKast02'] = "Leeg";
        $_SESSION['VorigeStatusKast02'] = "Vol";
    }
    else{
        $_SESSION['StatusKast02'] = "Vol";
        $_SESSION['VorigeStatusKast02'] = "Gesloten";
    }
}

if (isset($_POST['Kast03'])) {
    if ($_POST['Kast03'] == "Gesloten" || $_POST['Kast03'] == null){
        $_SESSION['Kast03'] = "Open";
        $_SESSION['VorigeKast03'] = "Gesloten";
    }
    else{
        $_SESSION['Kast03'] = "Gesloten";
        $_SESSION['VorigeKast03'] = "Open";
    }
}
if (isset($_POST['StatusKast03'])){
    if ($_POST['StatusKast03'] == "Vol" || $_POST['StatusKast03'] == null){
        $_SESSION['StatusKast03'] = "Leeg";
        $_SESSION['VorigeStatusKast03'] = "Vol";
    }
    else{
        $_SESSION['StatusKast03'] = "Vol";
        $_SESSION['VorigeStatusKast03'] = "Leeg";
    }
}

if (isset($_POST['Kast04'])) {
    if ($_POST['Kast04'] == "Gesloten" || $_POST['Kast04'] == null){
        $_SESSION['Kast04'] = "Open";
        $_SESSION['VorigeKast04'] = "Gesloten";
    }
    else{
        $_SESSION['Kast04'] = "Gesloten";
        $_SESSION['VorigeKast04'] = "Open";
    }
}
if (isset($_POST['StatusKast04'])){
    if ($_POST['StatusKast04'] == "Vol" || $_POST['StatusKast04'] == null){
        $_SESSION['StatusKast04'] = "Leeg";
        $_SESSION['VorigeStatusKast04'] = "Vol";
    }
    else{
        $_SESSION['StatusKast04'] = "Vol";
        $_SESSION['VorigeStatusKast04'] = "Leeg";
    }
}

if (isset($_POST['Kast05'])) {
    if ($_POST['Kast05'] == "Gesloten" || $_POST['Kast05'] == null){
        $_SESSION['Kast05'] = "Open";
        $_SESSION['VorigeKast05'] = "Gesloten";
    }
    else{
        $_SESSION['Kast05'] = "Gesloten";
        $_SESSION['VorigeKast05'] = "Open";
    }
}
if (isset($_POST['StatusKast05'])){
    if ($_POST['StatusKast05'] == "Vol" || $_POST['StatusKast05'] == null){
        $_SESSION['StatusKast05'] = "Leeg";
        $_SESSION['VorigeStatusKast05'] = "Vol";
    }
    else{
        $_SESSION['StatusKast05'] = "Vol";
        $_SESSION['VorigeStatusKast05'] = "Leeg";
    }
}

if (isset($_POST['Kast06'])) {
    if ($_POST['Kast06'] == "Gesloten" || $_POST['Kast06'] == null){
        $_SESSION['Kast06'] = "Open";
        $_SESSION['VorigeKast06'] = "Gesloten";
    }
    else{
        $_SESSION['Kast06'] = "Gesloten";
        $_SESSION["VorigeKast06"] = "Open";
    }
}
if (isset($_POST['StatusKast06'])){
    if ($_POST['StatusKast06'] == "Vol" || $_POST['StatusKast06'] == null){
        $_SESSION['StatusKast06'] = "Leeg";
        $_SESSION['VorigeStatusKast06'] = "Vol";
    }
    else{
        $_SESSION['StatusKast06'] = "Vol";
        $_SESSION['VorigeStatusKast06'] = "Leeg";
    }
}


if ($_SESSION['BadgeId'] == null){
    $_SESSION['BadgeId'] =  $_POST['BadgeId'];
}

if ($_SESSION['KleurKast01'] == null){
    $_SESSION['KleurKast01'] = "green";
    $_SESSION['KleurKast02'] = "green";
    $_SESSION['KleurKast03'] = "green";
    $_SESSION['KleurKast04'] = "green";
    $_SESSION['KleurKast05'] = "green";
    $_SESSION['KleurKast06'] = "green";
}
include ('DetectieKasten.php');
?>


<html>
<body>
<form method='post'>
    <h3>Kasten</h3>
    <table border = 5>
        <tr>
            <td>Kast 1</td>
            <td><input type = 'submit' name = 'Kast01' value = '<?php echo $_SESSION['Kast01']; ?>' style="background-color: <?php echo $_SESSION['KleurKast01'] ?>"></td>
            <td><input type = 'submit' name = 'StatusKast01' value = '<?php  echo $_SESSION['StatusKast01'] ?>' style="background-color: <?php echo $_SESSION['KleurKast01'] ?>"></td>
            <td>Kast 2</td>
            <td><input type = 'submit' name = 'Kast02' value = '<?php echo $_SESSION['Kast02']; ?>' style="background-color: <?php echo $_SESSION['KleurKast02'] ?>"></td>
            <td><input type = 'submit' name = 'StatusKast02' value = '<?php  echo $_SESSION['StatusKast02'] ?>' style="background-color: <?php echo $_SESSION['KleurKast02'] ?>"></td>
        </tr>
        <tr>
            <td>Kast 3</td>
            <td><input type = 'submit' name = 'Kast03' value = '<?php echo $_SESSION['Kast03']; ?>' style="background-color: <?php echo $_SESSION['KleurKast03'] ?>"</td>
            <td><input type = 'submit' name = 'StatusKast03' value = '<?php  echo $_SESSION['StatusKast03'] ?>' style="background-color: <?php echo $_SESSION['KleurKast03'] ?>"></td>
            <td>Kast 4</td>
            <td><input type = 'submit' name = 'Kast04' value = '<?php echo $_SESSION['Kast04']; ?>'style="background-color: <?php echo $_SESSION['KleurKast04'] ?>"></td>
            <td><input type = 'submit' name = 'StatusKast04' value = '<?php  echo $_SESSION['StatusKast04'] ?>' style="background-color: <?php echo $_SESSION['KleurKast04'] ?>"></td>
        </tr>
        <tr>
            <td>Kast 5</td>
            <td><input type = 'submit' name = 'Kast05' value = '<?php echo $_SESSION['Kast05']; ?>' style="background-color: <?php echo $_SESSION['KleurKast05'] ?>"></td>
            <td><input type = 'submit' name = 'StatusKast05' value = '<?php  echo $_SESSION['StatusKast05'] ?>' style="background-color: <?php echo $_SESSION['KleurKast05'] ?>"></td>
            <td>Kast 6</td>
            <td><input type = 'submit' name = 'Kast06' value = '<?php echo $_SESSION['Kast06'] ?>' style="background-color: <?php echo $_SESSION['KleurKast06'] ?>"></td>
            <td><input type = 'submit' name = 'StatusKast06' value = '<?php  echo $_SESSION['StatusKast06'] ?>' style="background-color: <?php echo $_SESSION['KleurKast06'] ?>"></td>
        </tr>
    </table>
</form>
<form method="post" action="TestOmgeving.php">
    <input type="submit" name="GoToBadgeId" value="Ga terug">
</form>
</body>
</html>