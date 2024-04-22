<html>
<form method='post' >
    Menu:<br>
    <select name='menu' onchange="redirectToPage(this.value)">
        <option value='schermBeheerderToevoegen.php'<?php //if ($_POST['menu'] == 'Toevoegen') echo 'selected="selected"'; ?> >Toevoegen </option>
        <option value='schermBeheerderAanpassen.php' selected<?php //if ($_POST['menu'] == 'Aanpassen') echo 'selected="selected"'; ?> >Aanpassen </option>
        <option value='schermBeheerderVerwijderen.php'<?php //if ($_POST['menu'] == 'Verwijderen') echo 'selected="selected"'; ?> >Verwijderen </option>
    </select><br><br>

    <script>
        function redirectToPage(url) {
            if (url) {
                window.location.href = url;
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
            echo '<form method="post" ><select name="gebruiker" onchange="this.form.submit()">';
            while ($row  = mysqli_fetch_assoc($resultaat)){
                //5d: toon resultaat
                $badgenummer1 = $row["badgenummer"];
                $voornaam1 = $row["voornaam"];
                $achternaam1 = $row["achternaam"];

                //echo "<br> de naam van de klant is ".$achternaam1.$voornaam1." <br>";

                echo "<option value='$badgenummer1'>$achternaam1 $voornaam1</option>";


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
if(isset($_POST['gebruiker']) && $_POST['gebruiker'] != "") {
    $BadgeSelcted = $_POST['gebruiker'];
}

//------------------------------------------------------------------------------------------------------

//1: verbinding meken met de database
include ('verbinding.php');

//2: als de verbinding gelukt is
if ($link)
{
    //3: opbouw van de query
    //query met een parameter
    $query = 'select * from gebruikers where badgenummer=?';
    echo $query.'<br>';

    //4a: statement initialiseren op basis van de verbinding
    $statement = mysqli_stmt_init($link);

    //4b: prepared statement maken op basis van de query en het statement
    if(mysqli_stmt_prepare($statement, $query))
    {
        //4c: parameter een waarde geven (= vraagteken vervangen)
        mysqli_stmt_bind_param($statement, 's',  $badgenummer1);

        //5a: statement uitvoeren
        mysqli_stmt_execute($statement);
        //5b: resultaat ophalen
        $resultaat = mysqli_stmt_get_result($statement);
        //5c: record uit het resultaat halen

        //5d: toon rij per rij
        $row  = mysqli_fetch_assoc($resultaat); //vervang fetch_row door fetch_assoc
        if($row != null)
        {

            echo "<form method='post'>
                    <lable>Achternaam:</lable>
                    <input type='text' name='Achternaam' value='{$row['achternaam']}'><br>
                    <lable>Voornaam:</lable>
                    <input type='text' name='Voornaam' value='{$row['voornaam']}'><br>
                    <lable>Badge nummer:</lable>
                    <input type='text' name='BadgeNummer' value='{$row['badgenummer']}'><br>
                    <lable>Telefoonnummer:</lable>
                    <input type='number' name='Telefoonnummer' value='{$row['telefoonnr']}'><br>
                    <lable>Rol:</lable>
                    <input type='text' name='Rol' value='{$row['rol']}'><br>
                    <lable>Wachtwoord:</lable>
                    <input type='text' name='Wachtwoord' value='{$row['wachtwoord']}'><br><br>
                    <input type='submit' value='pas aan' name='cmdVerstuur' >
                </form>";
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
/*
//1: verbinding meken met de database
include ('verbindingDB.php');

//2: als de verbinding gelukt is
if ($link)
{
    //3: opbouw van de query
    //query met een parameter
    $query = 'insert into gebruikers(achternaam, voornaam, badgenummer, telefoonnr, rol, wachtwoord) values (?,?,?,?,?,?)';

    //4a: statement initialiseren op basis van de verbinding
    $statement = mysqli_stmt_init($link);

    //4b: prepared statement maken op basis van de query en het statement
    if(mysqli_stmt_prepare($statement, $query))
    {
        //4c: parameter een waarde geven (= vraagteken vervangen)
        mysqli_stmt_bind_param($statement, 'ssssss',  $achternaam, $voornaam, $badgenummer, $telefoonnr, $rol, $wachtwoord);

        $achternaam = $_POST['Achternaam'];
        $voornaam = $_POST['Voornaam'];
        $badgenummer = $_POST['BadgeNummer'];
        $telefoonnr = $_POST['Telefoonnummer'];
        $rol= $_POST['Rol'];
        $wachtwoord = $_POST['Wachtwoord'];


        //5a: statement uitvoeren
        if (mysqli_stmt_execute($statement))
        {
            echo 'gebruiker is toegevoegd';
        }
        else
        {
            echo 'insert niet gelukt'.mysqli_stmt_error($statement);
        }

    }
    else
    {
        echo mysqli_stmt_error($statement);
    }


    //6: verbinding sluiten
    mysqli_close($link);
}
*/
?>
