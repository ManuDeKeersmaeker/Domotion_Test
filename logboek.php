<?php
/*  Dit is de code voor de insert statement zelf die de gegevens naar het logboek stuurt, deze is nog niet gekoppeld
    met de functie bij de testomgeving voor de kasten.
*/

function SchrijvenNaarDatabase($Teller)
{
    session_start();
    include "verbindingDB.php";
    if ($stmt = $link->prepare('SELECT gebruikerid FROM gebruikers WHERE badgenummer = ?')) {

        $stmt->bind_param('s', $_SESSION['BadgeId']);
        $stmt->execute();
        $stmt->store_result();
        //GebruikersID bestaat
        if ($stmt = $link->prepare('INSERT INTO logboek (idkast, idgebruiker, datum, time, actie) VALUES (?, ?, ?, ?, ?)')) {
            //Er mogen geen leesbare ww opgeslagen worden, het ww wordt gehashed opgeslagen en steeds
            //gehashed geverifieerd.
            $date = $_SESSION['DatumKast'.$Teller];
            $tijd = $_SESSION['TijdKast'.$Teller];
            $kastid = $Teller;
            $gebruikerid = $_SESSION['BadgeId'];
            $actie = 0;
            //echo 'insert';
            $stmt->bind_param('iissi', $kastid, $gebruikerid, $date, $tijd, $actie);
            $stmt->execute();

        } else {
            // Fout in het sql statement, komen de namen van de velden overeen met de tabel?.
            echo mysqli_stmt_error($stmt);
        }

        $stmt->close();
    }
    $link->close();

}
?>


