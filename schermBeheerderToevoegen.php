<!-- Jorben Wauters     Domotion        nr.:10 -->

<html>
<form method='post' >
    Menu:<br>
    <select name='menu' onchange="redirectToPage(this.value)">      <!-- bij verandering, de geselecteerde waarde (value) meegeven -->
        <option value='schermBeheerderToevoegen.php' selected<?php //if ($_POST['menu'] == 'Toevoegen') echo 'selected="selected"'; ?> >Toevoegen </option>
        <option value='schermBeheerderAanpassen.php'<?php //if ($_POST['menu'] == 'Aanpassen') echo 'selected="selected"'; ?> >Aanpassen </option>
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
echo '<form method="post">
                    <lable>Achternaam:</lable>
                    <input type="text" name="Achternaam" ><br>
                    <lable>Voornaam:</lable>
                    <input type="text" name="Voornaam" ><br>
                    <lable>Badge nummer*:</lable>
                    <input type="text" name="BadgeNummer" ><br>
                    <lable>Telefoonnummer*:</lable>
                    <input type="number" name="Telefoonnummer" ><br>
                    <lable>Rol:</lable>
                    <input type="text" name="Rol" ><br>
                    <lable>Wachtwoord*:</lable>
                    <input type="text" name="Wachtwoord" ><br><br>
                    <input type="submit" value="pas aan" name="cmdVerstuur" >
                </form>';
echo "* --> optioneel <br>";

if(isset($_POST['cmdVerstuur']))
{

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

}
?>