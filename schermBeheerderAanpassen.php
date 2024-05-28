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


<form method='post' >
    Menu:<br>
    <select name='menu' onchange="redirectToPage(this.value)">      <!-- bij verandering, de geselecteerde waarde (value) meegeven -->
        <option value='schermBeheerderToevoegen.php'>Toevoegen </option>        <!-- De value is het bestandsnaam waar naar toe gegaan moet worden -->
        <option value='schermBeheerderAanpassen.php' selected>Aanpassen </option>
        <option value='schermBeheerderVerwijderen.php'>Verwijderen </option>
    </select><br><br>

    <script>
        function redirectToPage(url) {  <!--gebruiker naar url sturen -->
            if (url) {
                window.location.href = url;     <!-- als er een url is dan openen, url is afkomstig van de value van de geselecteerde optsie (aanpassen, toevoe...) -->
            }
        }
    </script>
</form>
</html>


<?php
//1: verbinding meken met de database
include ('verbindingDB.php');

//2: als de verbinding gelukt is
if ($link)
{
    //3: opbouw van de query
    //query met een parameter
    $query = 'select * from gebruikers';
    echo $query.'<br>';

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

            echo '<form method="post" ><select name="gebruiker" onchange="this.form.submit()">';    //voer actie uit als iets uit de dropdown list wordt geselecteerd
            mysqli_data_seek($resultaat, 0);    //zet $resultaat terug op het begin
            echo "<option value='' selected>Selecteer persoon</option>";    //basis geselecteerde optie omdat de geselecteerde optie altijd een delay had van 1 refresh
            while ($row  = mysqli_fetch_assoc($resultaat)){
                //5d: toon resultaat
                $gebruikerid1 = $row["gebruikerid"];
                $voornaam1 = $row["voornaam"];
                $achternaam1 = $row["achternaam"];

                echo "<option value='$gebruikerid1'";   //gebruiker toevoegen aan lijst

                echo ">$achternaam1 $voornaam1</option>";
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
if(isset($_POST['gebruiker']) && $_POST['gebruiker'] != "") {   //als er een waarde is en deze is niet niks
    $_SESSION['Idselected'] = $_POST['gebruiker'];
    $IdSelcted = $_POST['gebruiker'];
}

//------------------------------------------------------------------------------------------------------
?>



<?php
//1: verbinding meken met de database
include ('verbinding.php');

//2: als de verbinding gelukt is
if ($link)
{
    //3: opbouw van de query
    //query met een parameter
    $query = 'select * from gebruikers where gebruikerid=?';

    //4a: statement initialiseren op basis van de verbinding
    $statement = mysqli_stmt_init($link);

    //4b: prepared statement maken op basis van de query en het statement
    if(mysqli_stmt_prepare($statement, $query))
    {
        //4c: parameter een waarde geven (= vraagteken vervangen)
        mysqli_stmt_bind_param($statement, 's',  $IdSelcted);

        //5a: statement uitvoeren
        mysqli_stmt_execute($statement);
        //5b: resultaat ophalen
        $resultaat = mysqli_stmt_get_result($statement);
        //5c: record uit het resultaat halen

        //5d: toon rij per rij
        $row  = mysqli_fetch_assoc($resultaat); //vervang fetch_row door fetch_assoc
        if($row != null)
        {
            echo "Geselecteede persoon: ".$row["achternaam"]." ".$row["voornaam"];

            echo "<form method='post'>            <!-- de gegevens van de geselecteede persoon in de textboxxes zetten -->
                    <lable>Achternaam:</lable>
                    <input type='text' name='Achternaam' value='{$row['achternaam']}'><br>
                    <lable>Voornaam:</lable>
                    <input type='text' name='Voornaam' value='{$row['voornaam']}'><br>
                    <lable>Badge nummer:</lable>
                    <input type='text' name='BadgeNummer' value='{$row['badgenummer']}'><br>
                    <lable>Telefoonnummer:</lable>
                    <input type='number' name='Telefoonnummer' value='{$row['telefoonnr']}'><br>
                    <lable>Rol:</lable>
                    <input type='text' name='Rol' value='{$row['rol']}'><br>";
            if ($row['rol'] == 'Beheerder'){
                echo "<lable>Wachtwoord:</lable>
                        <input type='text' name='Wachtwoord' value=''><br><br>";
            }
            echo "<input type='hidden' name='Id' value='{$row['gebruikerid']}'>
                    <input type='submit' value='pas aan' name='cmdVerstuur' >
                </form>";
            $SelectedId = $row['gebruikerid'];
            $_SESSION['RolAanpassen'] = $row['rol'];
        }

    }
    else
    {
        echo mysqli_stmt_error($statement);
    }


    //6: verbinding sluiten
    mysqli_close($link);
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
        if ($_SESSION['RolAanpassen'] == 'Beheerder') {
            $query = 'UPDATE gebruikers SET achternaam = ?, voornaam = ?, badgenummer = ?, telefoonnr = ?, rol = ?, wachtwoord = ? WHERE gebruikerid = ?';
        } else {
            $query = 'UPDATE gebruikers SET achternaam = ?, voornaam = ?, badgenummer = ?, telefoonnr = ?, rol = ? WHERE gebruikerid = ?';
        }

        //4a: statement initialiseren op basis van de verbinding
        $statement = mysqli_stmt_init($link);

        //4b: prepared statement maken op basis van de query en het statement
        if(mysqli_stmt_prepare($statement, $query))
        {
            //4c: parameter een waarde geven (= vraagteken vervangen)
            if ($_SESSION['RolAanpassen'] == 'Beheerder' && $_SESSION['RolAanpassen'] != "") {
                mysqli_stmt_bind_param($statement, 'ssssssi',  $achternaam, $voornaam, $badgenummer, $telefoonnr, $rol, $wachtwoord, $SelectedId);
                $wachtwoord = password_hash($_POST['Wachtwoord'], PASSWORD_DEFAULT);
            } else {
                mysqli_stmt_bind_param($statement, 'sssssi',  $achternaam, $voornaam, $badgenummer, $telefoonnr, $rol, $SelectedId);
            }

            $achternaam = $_POST['Achternaam'];
            $SelectedId = $_POST['Id'];
            $voornaam = $_POST['Voornaam'];
            $badgenummer = $_POST['BadgeNummer'];
            $telefoonnr = $_POST['Telefoonnummer'];
            $rol= $_POST['Rol'];

            //5a: statement uitvoeren
            if (mysqli_stmt_execute($statement))
            {
                echo 'gebruiker is aangepast';
            }
            else
            {
                echo 'gebruiker is niet aangepast'.mysqli_stmt_error($statement);
            }
        }
        else
        {
            echo mysqli_stmt_error($statement);
        }


        //6: verbinding sluiten
        mysqli_close($link);
    }
}

?>
