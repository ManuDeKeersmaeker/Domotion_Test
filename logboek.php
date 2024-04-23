<?php
echo '<h2>Domotion Logboek</h2>';
include "verbindingDB.php";
session_start();
    if ($stmt = $link->prepare('INSERT INTO logboek (idkast, idgebruiker, datum, time, actie) VALUES (?, ?, ?, ?, ?)')) {
        //Er mogen geen leesbare ww opgeslagen worden, het ww wordt gehashed opgeslagen en steeds
        //gehashed geverifieerd.
        $date = date("Y-m-d");
        $tijd = date("H:i:s");
        $kastid = 1;
        $gebruikerid = 3;
        $actie = 0;
        //echo 'insert';
        $stmt->bind_param('iissi', $kastid, $gebruikerid, $date, $tijd, $actie);
        $stmt->execute();
        echo $stmt->error;
        echo 'You have successfully registered, you can now login!';
    } else {
        // Fout in het sql statement, komen de namen van de velden overeen met de tabel?.
        echo 'fout in query statement!_1';
        echo mysqli_stmt_error($stmt);
    }
    $stmt->close();
$link->close();
?>
