<html>
<link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" />
<body>
<form method='post'>
    <h2>Logboek</h2>
    <table border = 5>
        <?php
        include "verbindingDB.php";

        if ($stmt = $link->prepare('SELECT * FROM logboek')) {
            $stmt->execute();
            $Resultaat = mysqli_stmt_get_result($stmt);
            $Row = mysqli_fetch_row($Resultaat);

            echo "
                <tr>
                    <th>logid</th>
                    <th>idkast</th>
                    <th>idgebruiker</th>
                    <th>datum</th>
                    <th>time</th>
                    <th>actie</th>
                </tr>
            ";

            while ($Row = mysqli_fetch_assoc($Resultaat)) {
                echo "
               <tr>
                   <td>{$Row['logid']}</td>
                   <td>{$Row['idkast']}</td>
                   <td>{$Row['idgebruiker']}</td>
                   <td>{$Row['datum']}</td>
                   <td>{$Row['time']}</td>
                   <td>{$Row['actie']}</td>
               </tr>
               ";
            }

            $stmt->close();
        }
        $link->close();
        ?>

    </table>
</form>
</body>
</html>