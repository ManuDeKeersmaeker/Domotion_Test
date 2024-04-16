<!--
Dit project is de testomgeving voor het schoolproject Domotion. De bedoeling hiervan
is dat er verschillende kasten te zien zijn en men virtueel materiaal uit de kasten kan nemen.

Gemaakt door: Manu De Keersmaeker
-->

<?php
//Hieronder wordt ervoor gezorgdt dat de inhoud van de kast kan veranderen en dat de kast open en dicht kan.
session_start();
if (isset($_POST['BadgeId'])){
    $BadgeId = $_POST['BadgeId'];
}

if (isset($_POST['Kast01'])) {
    if ($_POST['Kast01'] == "Gesloten" || $_POST['Kast01'] == null){
        $_SESSION['Kast01'] = "Open";
    }
    else{
    $_SESSION['Kast01'] = "Gesloten";
    }
}
if (isset($_POST['StatusKast01'])){
    if ($_POST['StatusKast01'] == "Vol" || $_POST['StatusKast01'] == null){
        $_SESSION['StatusKast01'] = "Leeg";
    }
    else{
        $_SESSION['StatusKast01'] = "Vol";
    }
}

if (isset($_POST['Kast02'])) {
    if ($_POST['Kast02'] == "Gesloten" || $_POST['Kast02'] == null){
        $_SESSION['Kast02'] = "Open";
    }
    else{
        $_SESSION['Kast02'] = "Gesloten";
    }
}
if (isset($_POST['StatusKast02'])){
    if ($_POST['StatusKast02'] == "Vol" || $_POST['StatusKast02'] == null){
        $_SESSION['StatusKast02'] = "Leeg";
    }
    else{
        $_SESSION['StatusKast02'] = "Vol";
    }
}

if (isset($_POST['Kast03'])) {
    if ($_POST['Kast03'] == "Gesloten" || $_POST['Kast03'] == null){
        $_SESSION['Kast03'] = "Open";
    }
    else{
        $_SESSION['Kast03'] = "Gesloten";
    }
}
if (isset($_POST['StatusKast03'])){
    if ($_POST['StatusKast03'] == "Vol" || $_POST['StatusKast03'] == null){
        $_SESSION['StatusKast03'] = "Leeg";
    }
    else{
        $_SESSION['StatusKast03'] = "Vol";
    }
}

if (isset($_POST['Kast04'])) {
    if ($_POST['Kast04'] == "Gesloten" || $_POST['Kast04'] == null){
        $_SESSION['Kast04'] = "Open";
    }
    else{
        $_SESSION['Kast04'] = "Gesloten";
    }
}
if (isset($_POST['StatusKast04'])){
    if ($_POST['StatusKast04'] == "Vol" || $_POST['StatusKast04'] == null){
        $_SESSION['StatusKast04'] = "Leeg";
    }
    else{
        $_SESSION['StatusKast04'] = "Vol";
    }
}

if (isset($_POST['Kast05'])) {
    if ($_POST['Kast05'] == "Gesloten" || $_POST['Kast05'] == null){
        $_SESSION['Kast05'] = "Open";
    }
    else{
        $_SESSION['Kast05'] = "Gesloten";
    }
}
if (isset($_POST['StatusKast05'])){
    if ($_POST['StatusKast05'] == "Vol" || $_POST['StatusKast05'] == null){
        $_SESSION['StatusKast05'] = "Leeg";
    }
    else{
        $_SESSION['StatusKast05'] = "Vol";
    }
}

if (isset($_POST['Kast06'])) {
    if ($_POST['Kast06'] == "Gesloten" || $_POST['Kast06'] == null){
        $_SESSION['Kast06'] = "Open";
    }
    else{
        $_SESSION['Kast06'] = "Gesloten";
    }
}
if (isset($_POST['StatusKast06'])){
    if ($_POST['StatusKast06'] == "Vol" || $_POST['StatusKast06'] == null){
        $_SESSION['StatusKast06'] = "Leeg";
    }
    else{
        $_SESSION['StatusKast06'] = "Vol";
    }
}
if ($_SESSION['BadgeId'] == null){
    $_SESSION['BadgeId'] =  $_POST['BadgeId'];
}
echo $_SESSION['BadgeId'];
?>


<html>
<body>
<form method='post'>
    <h3>Kasten</h3>
    <table border = 5>
        <tr>
            <td>Kast 1</td>
            <td><input type = 'submit' name = 'Kast01' value = '<?php echo $_SESSION['Kast01']; ?>'></td>
            <td><input type = 'submit' name = 'StatusKast01' value = '<?php  echo $_SESSION['StatusKast01'] ?>'></td>
            <td>Kast 2</td>
            <td><input type = 'submit' name = 'Kast02' value = '<?php echo $_SESSION['Kast02']; ?>'></td>
            <td><input type = 'submit' name = 'StatusKast02' value = '<?php  echo $_SESSION['StatusKast02'] ?>'></td>
        </tr>
        <tr>
            <td>Kast 3</td>
            <td><input type = 'submit' name = 'Kast03' value = '<?php echo $_SESSION['Kast03']; ?>'</td>
            <td><input type = 'submit' name = 'StatusKast03' value = '<?php  echo $_SESSION['StatusKast03'] ?>'></td>
            <td>Kast 4</td>
            <td><input type = 'submit' name = 'Kast04' value = '<?php echo $_SESSION['Kast04']; ?>'></td>
            <td><input type = 'submit' name = 'StatusKast04' value = '<?php  echo $_SESSION['StatusKast04'] ?>'></td>
        </tr>
        <tr>
            <td>Kast 5</td>
            <td><input type = 'submit' name = 'Kast05' value = '<?php echo $_SESSION['Kast05']; ?>'></td>
            <td><input type = 'submit' name = 'StatusKast05' value = '<?php  echo $_SESSION['StatusKast05'] ?>'></td>
            <td>Kast 6</td>
            <td><input type = 'submit' name = 'Kast06' value = '<?php echo $_SESSION['Kast06'] ?>'></td>
            <td><input type = 'submit' name = 'StatusKast06' value = '<?php  echo $_SESSION['StatusKast06'] ?>'></td>
        </tr>
    </table>
</form>
<form method="post" action="TestOmgeving.php">
    <input type="submit" name="GoToBadgeId" value="Ga terug">
</form>
</body>
</html>