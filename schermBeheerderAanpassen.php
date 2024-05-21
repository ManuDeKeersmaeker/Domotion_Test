<!-- Jorben Wauters     Domotion        nr.:10 -->

<html>
<form method='post' >
    Menu:<br>
    <select name='menu' onchange="redirectToPage(this.value)">      <!-- bij verandering, de geselecteerde waarde (value) meegeven -->
        <option value='schermBeheerderToevoegen.php'<?php //if ($_POST['menu'] == 'Toevoegen') echo 'selected="selected"'; ?> >Toevoegen </option>
        <option value='schermBeheerderAanpassen.php' selected<?php //if ($_POST['menu'] == 'Aanpassen') echo 'selected="selected"'; ?> >Aanpassen </option>
        <option value='schermBeheerderVerwijderen.php'<?php //if ($_POST['menu'] == 'Verwijderen') echo 'selected="selected"'; ?> >Verwijderen </option>
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

            echo '<form method="post" ><select name="gebruiker" onchange="/*OnSelectionChange()*/this.form.submit()">';
            mysqli_data_seek($resultaat, 0);    //zet $resultaat terug op het begin
            echo "<option value='' selected>Selecteer persoon</option>";
            while ($row  = mysqli_fetch_assoc($resultaat)){
                //5d: toon resultaat
                $gebruikerid1 = $row["gebruikerid"];
                $voornaam1 = $row["voornaam"];
                $achternaam1 = $row["achternaam"];

                //echo "<br> de naam van de klant is ".$achternaam1.$voornaam1." <br>";

                echo "<option value='$gebruikerid1'";

                /*if (isset($_SESSION['Idselected'])){
                    if($gebruikerid1 == $_SESSION['Idselected']){
                        echo "selected";
                    }
                }*/
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
if(isset($_POST['gebruiker']) && $_POST['gebruiker'] != "") {
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
                    <input type='hidden' name='Id' value='{$row['gebruikerid']}'>
                    <input type='submit' value='pas aan' name='cmdVerstuur' >
                </form>";
            $SelectedId = $row['gebruikerid'];
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

if(isset($_POST['cmdVerstuur'])){
    //1: verbinding meken met de database
    include ('verbindingDB.php');

//2: als de verbinding gelukt is
    if ($link)
    {
        //3: opbouw van de query
        //query met een parameter
        //$query = 'insert into update gebruikers(achternaam, voornaam, badgenummer, telefoonnr, rol, wachtwoord) values (?,?,?,?,?,?)';
        $query = 'UPDATE gebruikers SET achternaam = ?, voornaam = ?, badgenummer = ?, telefoonnr = ?, rol = ?, wachtwoord = ? WHERE gebruikerid = ?';

        //4a: statement initialiseren op basis van de verbinding
        $statement = mysqli_stmt_init($link);

        //4b: prepared statement maken op basis van de query en het statement
        if(mysqli_stmt_prepare($statement, $query))
        {
            //4c: parameter een waarde geven (= vraagteken vervangen)
            mysqli_stmt_bind_param($statement, 'ssssssi',  $achternaam, $voornaam, $badgenummer, $telefoonnr, $rol, $wachtwoord, $SelectedId);

            $achternaam = $_POST['Achternaam'];
            $SelectedId = $_POST['Id'];
            $voornaam = $_POST['Voornaam'];
            $badgenummer = $_POST['BadgeNummer'];
            $telefoonnr = $_POST['Telefoonnummer'];
            $rol= $_POST['Rol'];
            $wachtwoord = $_POST['Wachtwoord'];


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
/*if (isset($_SESSION['Herlaad'])){
    if ($_SESSION['Herlaad'] == 1){
        $_SESSION['Herlaad'] = 0;
        echo 0000;
        header( 'location: '.$_SERVER['PHP_SELF']);
    }
    else{
        $_SESSION['Herlaad'] = 1;
        echo 1111;
    }
}
else {
    echo 11111111112;
    $_SESSION['Herlaad'] = 1;
}*/
?>
