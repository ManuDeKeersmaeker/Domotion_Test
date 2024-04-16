<!--
Dit project is de testomgeving voor het schoolproject Domotion. De bedoeling hiervan
is dat er verschillende kasten te zien zijn en men virtueel materiaal uit de kasten kan nemen.
De kasten zelf vind je in het bestand SchermKasten.php.

Gemaakt door: Manu De Keersmaeker
-->

<?php
session_start();
$_SESSION['BadgeId'] = null;
?>

<html>
<head>
    <title>TestOmgeving</title>
</head>
<body>
<form method="post" action="SchermKasten.php">
    <h1>Test omgeving</h1>
    <input type = "number" name = "BadgeId">
    <input type = "submit" name = "SubmitBadgeId" value = "Verstuur">
    <br>
</form>
</body>
</html>