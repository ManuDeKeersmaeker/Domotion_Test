<html>
<link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" />
<body>
<form method='post'>
    <h2>Logboek</h2>
    <table border = 5>
        <?php
        session_start();
        include "verbindingDB.php";

        if ($stmt = $link->prepare('SELECT * FROM logboek')) {
            $stmt->execute();
            $Resultaat = mysqli_stmt_get_result($stmt);

            echo "
                <tr>
                    <th>Log</th>
                    <th>Kast</th>
                    <th>Naam</th>
                    <th>Datum</th>
                    <th>Time</th>
                    <th>Actie</th>
                </tr>
            ";

            while ($Row = mysqli_fetch_assoc($Resultaat)) {
                $Badgenr = $Row['idgebruiker'];
                if ($stmt2 = $link->prepare('SELECT voornaam, achternaam FROM gebruikers WHERE gebruikerid = ?')) {
                    $stmt2->bind_param('s', $Badgenr);
                    $stmt2->execute();
                    $Resultaat2 = mysqli_stmt_get_result($stmt2);
                    $userRow = mysqli_fetch_assoc($Resultaat2);

                    $fullName = $userRow['voornaam'] . ' ' . $userRow['achternaam']; //We maken de variabele aan voor de volledige naam van de gebruiker te weergeven.

                    $actie = $Row['actie'] == 1 ? 'Teruggebracht' : 'Weggenomen'; //Variabele voor het bepalen

                    echo "
                        <tr>
                            <td>{$Row['logid']}</td>
                            <td>{$Row['idkast']}</td>
                            <td>{$fullName}</td>
                            <td>{$Row['datum']}</td>
                            <td>{$Row['time']}</td>
                            <td>{$actie}</td>
                        </tr>
            ";

                    $stmt2->close();
                }
            }

            $stmt->close();
        }
        $link->close();
        ?>

    </table>
</form>
</body>
</html>