<?php
/*  Dit is de code voor de insert statement zelf die de gegevens naar het logboek stuurt, deze is nog niet gekoppeld
    met de functie bij de testomgeving voor de kasten.
*/

function SchrijvenNaarDatabase($Teller)
{
    include "verbindingDB.php";
    if ($stmt = $link->prepare('SELECT gebruikerid FROM lockers_gebruikers WHERE badgenummer = ?')) {

        $stmt->bind_param('s', $_SESSION['BadgeId']);
        $stmt->execute();
        $IdGebruiker = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_row($IdGebruiker);
        //GebruikersID bestaat
        if ($stmt = $link->prepare('INSERT INTO lockers_logboek (idkast, idgebruiker, datum, time, actie) VALUES (?, ?, ?, ?, ?)')) {
            //Deze statement zal de juiste waarden in de database steken.
            //Hieronder ziet u de variabelen dat ik ga gebruiken als parameters die de waarden in de database gaan vullen.
            $date = $_SESSION['DatumKast'.$Teller];
            $tijd = $_SESSION['TijdKast'.$Teller];
            $kastid = $Teller;
            $gebruikerid = $row[0];
            $actie = $_SESSION['actie'];

            /*
            if ($_SESSION['StatusKast'.$Teller] == "Vol" && $_SESSION['VorigeKast'.$Teller] == "Open") {
                $actie = 0;
            }
            elseif ($_SESSION['Kast'.$Teller] == "Open" && $_SESSION['VorigeKast'.$Teller] == "Gesloten") {
                $actie = 1;
            }
            */
            //echo 'insert';
                $stmt->bind_param('iissi', $kastid, $gebruikerid, $date, $tijd, $actie);
                $stmt->execute();
        }
        $stmt->close();
    }
    $link->close();
}
?>