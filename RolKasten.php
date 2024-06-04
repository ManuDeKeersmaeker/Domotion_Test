<!-- Jorben Wauters     Domotion        nr.:10 -->
<html>




<!-- Nog niet afgewerkt, werkt nog niet!!!! -->




<!-- navigatie maken -->
<!--------------------------------------------------------------------------------------------------------------------->
<link rel="stylesheet" href="OpmaakMenubalk.css" type="text/css">
<ul>
    <li><a href="schermBeheerderAanpassen.php">Mensen aanpassen</a></li>
    <li><a href="schermBeheerderToevoegen.php">Mensen toevoegen</a></li>
    <li><a href="schermBeheerderVerwijderen.php">Mensen verwijderen</a></li>
    <li><a href="BeheerKasten.php">Beheer kasten</a></li>
    <li><a href="LogboekTabel.php">Logboek</a></li>
    <li><a href="index.html">Uitloggen</a></li>

</ul>

<!--
<form method='post' >
    Menu:<br>
    <select name='menu' onchange="redirectToPage(this.value)">      -- bij verandering, de geselecteerde waarde (value) meegeven --
        <option value='schermBeheerderToevoegen.php'>Toevoegen </option>        -- De value is het bestandsnaam waar naar toe gegaan moet worden --
        <option value='schermBeheerderAanpassen.php' selected>Aanpassen </option>
        <option value='schermBeheerderVerwijderen.php'>Verwijderen </option>
    </select><br><br>

    <script>
        function redirectToPage(url) {  --gebruiker naar url sturen --
            if (url) {
                window.location.href = url;     -- als er een url is dan openen, url is afkomstig van de value van de geselecteerde optsie (aanpassen, toevoe...) --
            }
        }
    </script>
</form> -->
</html>


<?php
//1: verbinding meken met de database
include ('verbindingDB.php');

//2: als de verbinding gelukt is
if ($link)
{
    //3: opbouw van de query
    //query met een parameter
    $query = 'select kastid from lockers_kasten';

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

            echo '<form method="post" ><select name="kast" onchange="this.form.submit()">';    //voer actie uit als iets uit de dropdown list wordt geselecteerd
            mysqli_data_seek($resultaat, 0);    //zet $resultaat terug op het begin
            echo "<option value='' selected>Selecteer kast</option>";    //basis geselecteerde optie omdat de geselecteerde optie altijd een delay had van 1 refresh
            while ($row  = mysqli_fetch_assoc($resultaat)){
                //5d: toon resultaat
                $kastid1 = $row["kastid"];

                echo "<option value='$kastid1'";   //gebruiker toevoegen aan lijst

                echo ">$kastid1</option>";
            }
            echo '</select><br><br></form>';

        }
        else
        {
            echo "geen kast gevonden";
        }
    }
    else
    {
        echo mysqli_stmt_error($statement);
    }


    //6: verbinding sluiten
    mysqli_close($link);
}
if(isset($_POST['kast']) && $_POST['kast'] != "") {   //als er een waarde is en deze is niet niks
    $_SESSION['IdselectedK'] = $_POST['kast'];
    $IdSelcted = $_POST['kast'];
}

//------------------------------------------------------------------------------------------------------
?>



<?php
//1: verbinding meken met de database
include ('verbindingDB.php');

//2: als de verbinding gelukt is
if ($link)
{
    //3: opbouw van de query
    //query met een parameter
    $query = 'select * from lockers_kasten where kastid=?';

    //4a: statement initialiseren op basis van de verbinding
    $statement = mysqli_stmt_init($link);

    //4b: prepared statement maken op basis van de query en het statement
    if(mysqli_stmt_prepare($statement, $query))
    {
        //4c: parameter een waarde geven (= vraagteken vervangen)
        mysqli_stmt_bind_param($statement, 'i',  $IdSelcted);

        //5a: statement uitvoeren
        mysqli_stmt_execute($statement);
        //5b: resultaat ophalen
        $resultaat = mysqli_stmt_get_result($statement);
        //5c: record uit het resultaat halen

        //5d: toon rij per rij
        $row  = mysqli_fetch_assoc($resultaat); //vervang fetch_row door fetch_assoc
        if($row != null)
        {
            echo "Geselecteede kast: ".$row["kastid"];

            echo "<form method='post'>            <!-- de gegevens van de geselecteede persoon in de textboxxes zetten -->
                    <lable>Rol 1:</lable>
                    <input type='text' name='rol1' value='{$row['rol1']}'><br>
                    <lable>Rol 2:</lable>
                    <input type='text' name='rol2' value='{$row['rol2']}'><br>
                    <lable>Rol 3:</lable>
                    <input type='text' name='rol3' value='{$row['rol3']}'><br>";
            //--------------++++++++-++*-+=-+=-+=-=+--==+-=+=-+=-+=-=+-==-+=-=- HIER VERDER WERKEN
            echo "<input type='hidden' name='Id' value='{$row['kastid']}'>
      <input type='submit' value='pas aan' name='cmdVerstuur' >
      </form>";
            $SelectedId = $row['kastid'];
        }
        else
        {
            echo "geen kast gevonden";
        }

        mysqli_stmt_close($statement);

//6: verbinding sluiten
        mysqli_close($link);
    }
    else
    {
        echo mysqli_connect_error();
    }
}

//-------------------------------------------------------------------------------
//gegevens updaten/aanpassen in DB
if(isset($_POST['cmdVerstuur'])){
//1: verbinding meken met de database
    include ('verbindingDB.php');

//2: als de verbinding gelukt is
    if ($link)
    {
//3: opbouw van de query
//query met een parameter
        $query = 'UPDATE lockers_kasten SET rol1 = ?, rol2 = ?, rol3 = ? WHERE kastid = ?';

//4a: statement initialiseren op basis van de verbinding
        $statement = mysqli_stmt_init($link);

//4b: prepared statement maken op basis van de query en het statement
        if(mysqli_stmt_prepare($statement, $query))
        {
//4c: parameter een waarde geven (= vraagteken vervangen)
            mysqli_stmt_bind_param($statement, 'sssi', $rol1, $rol2, $rol3, $SelectedId);

// Parameter waarden toekennen
            $rol1 = $_POST['rol1'];
            $rol2 = $_POST['rol2'];
            $rol3 = $_POST['rol3'];
            $SelectedId = $_POST['Id'];

//5a: statement uitvoeren
            if (mysqli_stmt_execute($statement))
            {
                echo 'Kast is aangepast';
            }
            else
            {
                echo 'Kast is niet aangepast: '.mysqli_stmt_error($statement);
            }
        }
        else
        {
            echo mysqli_stmt_error($statement);
        }

//6: statement sluiten
        mysqli_stmt_close($statement);

//6: verbinding sluiten
        mysqli_close($link);
    }
    else
    {
        echo mysqli_connect_error();
    }
}
?>
