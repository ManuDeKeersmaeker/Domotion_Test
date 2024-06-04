<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="OpmaakMenubalk.css" type="text/css">
</head>
<body>
<ul>
    <li><a href="schermBeheerderAanpassen.php">Mensen aanpassen</a></li>
    <li><a href="schermBeheerderToevoegen.php">Mensen toevoegen</a></li>
    <li><a href="schermBeheerderVerwijderen.php">Mensen verwijderen</a></li>
    <li><a href="BeheerKasten.php">Beheer kasten</a></li>
    <li><a href="RolKastenAanpassen.php">Rol kasten aanpassen</li>
    <li><a href="LogboekTabel.php">Logboek</a></li>
    <li><a href="index.html">Uitloggen</a></li>
</ul>

<?php

ob_start();

if (!isset($_COOKIE['ingelogd'])) {
    header('Location: index.php');
    exit;
}
ob_end_flush();

//1: verbinding meken met de database
include ('verbindingDB.php');

//2: als de verbinding gelukt is
if ($link) {
    //3: opbouw van de query
    $query = 'select kastid from lockers_kasten';

    //4a: statement initialiseren op basis van de verbinding
    $statement = mysqli_stmt_init($link);

    //4b: prepared statement maken op basis van de query en het statement
    if (mysqli_stmt_prepare($statement, $query)) {
        //5a: statement uitvoeren
        mysqli_stmt_execute($statement);
        //5b: resultaat ophalen
        $resultaat = mysqli_stmt_get_result($statement);
        //5c: record uit het resultaat halen
        $row  = mysqli_fetch_assoc($resultaat);
        if ($row != null) {
            session_start();
            echo '<form method="post"><select name="kast" onchange="this.form.submit()">';
            mysqli_data_seek($resultaat, 0);
            echo "<option value='' selected>Selecteer kast</option>";
            while ($row  = mysqli_fetch_assoc($resultaat)) {
                $kastid1 = $row["kastid"];
                echo "<option value='$kastid1'>$kastid1</option>";
            }
            echo '</select><br><br></form>';
        } else {
            echo "geen kast gevonden";
        }
    } else {
        echo mysqli_stmt_error($statement);
    }
    //6: verbinding sluiten
    mysqli_close($link);
}

if (isset($_POST['kast']) && $_POST['kast'] != "") {
    $_SESSION['IdselectedK'] = $_POST['kast'];
    $IdSelcted = $_POST['kast'];
}
?>

<?php
//1: verbinding meken met de database
include ('verbindingDB.php');

//2: als de verbinding gelukt is
if ($link) {
    //3: opbouw van de query
    $query = 'select * from lockers_kasten where kastid=?';

    //4a: statement initialiseren op basis van de verbinding
    $statement = mysqli_stmt_init($link);

    //4b: prepared statement maken op basis van de query en het statement
    if (mysqli_stmt_prepare($statement, $query)) {
        //4c: parameter een waarde geven
        mysqli_stmt_bind_param($statement, 'i',  $IdSelcted);

        //5a: statement uitvoeren
        mysqli_stmt_execute($statement);
        //5b: resultaat ophalen
        $resultaat = mysqli_stmt_get_result($statement);
        //5c: record uit het resultaat halen

        //5d: toon rij per rij
        $row  = mysqli_fetch_assoc($resultaat);
        if ($row != null) {
            echo "Geselecteerde kast: ".$row["kastid"];
            echo "<form method='post'>
                    <label>Rol 1:</label>
                    <input type='checkbox' name='rol1' value='1'".($row['rol1'] ? ' checked' : '')."><br>
                    <label>Rol 2:</label>
                    <input type='checkbox' name='rol2' value='1'".($row['rol2'] ? ' checked' : '')."><br>
                    <label>Rol 3:</label>
                    <input type='checkbox' name='rol3' value='1'".($row['rol3'] ? ' checked' : '')."><br>";
            echo "<input type='hidden' name='Id' value='{$row['kastid']}'>
                      <input type='submit' value='pas aan' name='cmdVerstuur'>
                      </form>";
            $SelectedId = $row['kastid'];
        }

        mysqli_stmt_close($statement);

        //6: verbinding sluiten
        mysqli_close($link);
    } else {
        echo mysqli_connect_error();
    }
}

//-------------------------------------------------------------------------------
//gegevens updaten/aanpassen in DB
if (isset($_POST['cmdVerstuur'])) {
    //1: verbinding meken met de database
    include ('verbindingDB.php');

    //2: als de verbinding gelukt is
    if ($link) {
        //3: opbouw van de query
        $query = 'UPDATE lockers_kasten SET rol1 = ?, rol2 = ?, rol3 = ? WHERE kastid = ?';

        //4a: statement initialiseren op basis van de verbinding
        $statement = mysqli_stmt_init($link);

        //4b: prepared statement maken op basis van de query en het statement
        if (mysqli_stmt_prepare($statement, $query)) {
            //4c: parameter een waarde geven
            mysqli_stmt_bind_param($statement, 'iiii', $rol1, $rol2, $rol3, $SelectedId);

            // Parameter waarden toekennen
            $rol1 = isset($_POST['rol1']) ? 1 : 0;      //? 1: Als de conditie isset($_POST['rol1']) waar is (dus als rol1 is ingesteld), wordt 1 toegewezen aan $rol1.
            $rol2 = isset($_POST['rol2']) ? 1 : 0;      //: 0: Als de conditie niet waar is (dus als rol1 niet is ingesteld), wordt 0 toegewezen aan $rol1
            $rol3 = isset($_POST['rol3']) ? 1 : 0;
            $SelectedId = $_POST['Id'];

            //5a: statement uitvoeren
            if (mysqli_stmt_execute($statement)) {
                echo 'Kast is aangepast';
            } else {
                echo 'Kast is niet aangepast: '.mysqli_stmt_error($statement);
            }
        } else {
            echo mysqli_stmt_error($statement);
        }

        //6: statement sluiten
        mysqli_stmt_close($statement);

        //6: verbinding sluiten
        mysqli_close($link);
    } else {
        echo mysqli_connect_error();
    }
}
?>
</body>
</html>
