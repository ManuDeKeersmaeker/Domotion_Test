<!-- Jorben Wauters     Domotion        nr.:10 -->
<html>
<!-- navigatie maken -->
<!--------------------------------------------------------------------------------------------------------------------->
<link rel="stylesheet" href="OpmaakMenubalk.css" type="text/css">
<ul>
    <li><a href="schermBeheerderAanpassen.php">Mensen aanpassen</a></li>
    <li><a href="schermBeheerderToevoegen.php">Mensen toevoegen</a></li>
    <li><a href="schermBeheerderVerwijderen.php">Mensen verwijderen</a></li>
    <li><a href="BeheerKasten.php">Beheer kasten</a></li>
    <li><a href="LogboekTabel.php">Logboek</a></li>
    <li><a href="index.php">Uitloggen</a></li>

</ul>

<!-- <form method='post' >
    Menu:<br>
    <select name='menu' onchange="redirectToPage(this.value)">      -- bij verandering, de geselecteerde waarde (value) meegeven --
        <option value='schermBeheerderToevoegen.php'>Toevoegen </option>    -- De value is het bestandsnaam waar naar toe gegaan moet worden --
        <option value='schermBeheerderAanpassen.php'>Aanpassen </option>
        <option value='schermBeheerderVerwijderen.php' selected>Verwijderen </option>
    </select><br><br>

    <script>
        function redirectToPage(url) {  --gebruiker naar url sturen --
            if (url) {
                window.location.href = url;     -- als er een url is dan openen, url is afkomstig van de value van de geselecteerde optsie (aanpassen, toevoe...) --
            }
        }
    </script>
</form>-->
</html>




<?php

ob_start();

if(!isset($_COOKIE['ingelogd'])) {
    header('Location: index.php');
    exit;
}
ob_end_flush();

$BadgeSelctedBadge = "";
$BadgeSelctedNaam = "";


//1: verbinding meken met de database
include ('verbindingDB.php');

//2: als de verbinding gelukt is
if ($link)
{
    //3: opbouw van de query
    //query met een parameter
    $query = 'select * from lockers_gebruikers';

    //4a: statement initialiseren op basis van de verbinding
    $statement = mysqli_stmt_init($link);

    //4b: prepared statement maken op basis van de query en het statement
    if(mysqli_stmt_prepare($statement, $query))
    {

        //5a: statement uitvoeren
        mysqli_stmt_execute($statement);
        //5b: resultaat ophalen
        $resultaat = mysqli_stmt_get_result($statement);
        //5c: record uit het resultaat halen
        $row  = mysqli_fetch_assoc($resultaat); //vervang fetch_row door fetch_assoc
        if($row != null)
        {
            session_start();
            echo 'Persoon: <form method="post" ><select name="gebruikerNaam" onchange="this.form.submit()">';    //voer actie uit als iets uit de dropdown list wordt geselecteerd
            mysqli_data_seek($resultaat, 0);    //zet $resultaat terug op het begin
            while ($row  = mysqli_fetch_assoc($resultaat)){
                //5d: toon resultaat
                $id1 = $row["gebruikerid"];
                $voornaam1 = $row["voornaam"];
                $achternaam1 = $row["achternaam"];
                echo "<option value='$id1'";

                echo ">$voornaam1 $achternaam1</option>";
            }
            echo '</select></form>';
            echo '<form method="post">
    <input type="submit" value="Verwijder persoon" name="cmdVerstuurNaam" >
</form>';
            mysqli_data_seek($resultaat, 0);    //zet $resultaat terug op het begin
            echo 'Badgenummer: <form method="post" ><select name="gebruikerBadge" onchange="this.form.submit()">';
            while ($row2  = mysqli_fetch_assoc($resultaat)){
                $badgenummer2 = $row2["badgenummer"];
                $id1 = $row2["gebruikerid"];

                echo "<option value='$id1'";

                echo ">$badgenummer2</option>";
            }

                echo '</select><br><br></form>';
        }
        else
        {
            echo "geen klant gevonden";
        }
    }
    else
    {
        echo mysqli_stmt_error($statement);
    }


    //6: verbinding sluiten
    mysqli_close($link);
}
if(isset($_POST['gebruikerNaam']) && $_POST['gebruikerNaam'] != "") {
    $_SESSION['Badgeselected'] = $_POST['gebruikerNaam'];
    $BadgeSelctedNaam = $_POST['gebruikerNaam'];
    echo "naam: gebruikersid: $BadgeSelctedNaam";
}
if(isset($_POST['gebruikerBadge']) && $_POST['gebruikerBadge'] != "") {
    $_SESSION['Badgeselected'] = $_POST['gebruikerBadge'];
    $BadgeSelctedBadge = $_POST['gebruikerBadge'];
    echo "badge: gebruikersid: $BadgeSelctedBadge";
}

//-----------------------------------------------------------------------------------
?>


<html>
<body>
<form method="post">
    <input type="submit" value="Verwijder badge" name="cmdVerstuurBadge" >
</form>
</body>
</html>


<?php

if(isset($_POST['cmdVerstuurNaam']) || isset($_POST['cmdVerstuurBadge'])) {

        //1: verbinding meken met de database
        include('verbindingDB.php');

        //2: als de verbinding gelukt is
        if ($link) {
            //3: opbouw van de query
            //query met een parameter
            $query = 'delete from lockers_gebruikers where gebruikerid = ?';

            //4a: statement initialiseren op basis van de verbinding
            $statement = mysqli_stmt_init($link);

            //4b: prepared statement maken op basis van de query en het statement
            if (mysqli_stmt_prepare($statement, $query)) {
                //4c: parameter een waarde geven (= vraagteken vervangen)
                mysqli_stmt_bind_param($statement, 's', $GebruikeridSelcted);
                $GebruikeridSelcted = $_SESSION['Badgeselected'];
                //5a: statement uitvoeren
                if (mysqli_stmt_execute($statement)) {
                    echo 'Gebruiker is verwijderd';
                } else {
                    echo 'verwijdering is niet gelukt' . mysqli_stmt_error($statement);
                }

            } else {
                echo mysqli_stmt_error($statement);
            }

            //6: verbinding sluiten
            mysqli_close($link);
    }
}

?>