<!--
Dit project is de testomgeving voor het schoolproject Domotion. De bedoeling hiervan
is dat er verschillende kasten te zien zijn en men virtueel materiaal uit de kasten kan nemen

Gemaakt door: Manu De Keersmaeker
-->

<html>
<head>
    <title>TestOmgeving</title>
</head>
<body>
<form method="post">
    <h1>Test omgeving</h1>
    <input type = "number" name = "BadgeId">
    <input type = "submit" name = "SubmitBadgeId" value = "Verstuur">
    <br>
</form>
</body>
</html>

<?php
if (isset($_POST['SubmitBadgeId']))
{
    //Wanneer een badge wordt ingescant worden de kasten getoond
    echo "
    <html>
    <body>
    <h3>Kasten</h3>
    <table border = 5>
        <tr>
            <td>Kast 1</td>
            <td><input type = 'button' name = 'Kast01' value = 'Gesloten'></td>
            <td><input type = 'button' name = 'StatusKast01' value = 'vol'></td>
            <td>Kast 2</td>
            <td><input type = 'button' name = 'Kast02' value = 'Gesloten'></td>
            <td><input type = 'button' name = 'StatusKast02' value = 'vol'></td>
        </tr>
        <tr>
            <td>Kast 3</td>
            <td><input type = 'button' name = 'Kast03' value = 'Gesloten'</td>
            <td><input type = 'button' name = 'StatusKast03' value = 'vol'></td>
            <td>Kast 4</td>
            <td><input type = 'button' name = 'Kast04' value = 'Gesloten'></td>
            <td><input type = 'button' name = 'StatusKast04' value = 'vol'></td>
        </tr>
        <tr>
            <td>Kast 5</td>
            <td><input type = 'button' name = 'Kast05' value = 'Gesloten'></td>
            <td><input type = 'button' name = 'StatusKast05' value = 'vol'></td>
            <td>Kast 6</td>
            <td><input type = 'button' name = 'Kast06' value = 'Gesloten'></td>
            <td><input type = 'button' name = 'StatusKast06' value = 'vol'></td>
        </tr>
    </table>
    </body>
    </html>
    ";
    $BadgeId = $_POST['BadgeId'];
    echo $BadgeId;
}

if (isset($_POST['Kast01']))
{
    if($_POST['Kast01'])//Value controleren
    {
        $_POST5 = 5; //tset
    }
}

?>