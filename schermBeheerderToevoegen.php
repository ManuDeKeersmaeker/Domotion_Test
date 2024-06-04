<!-- Jorben Wauters     Domotion        nr.:10 -->

<html>
<!-- navigatie maken (menu balk)-->
<!--------------------------------------------------------------------------------------------------------------------->
<link rel="stylesheet" href="OpmaakMenubalk.css" type="text/css">
<ul>
    <li><a href="schermBeheerderAanpassen.php">Mensen aanpassen</a></li>
    <li><a href="schermBeheerderToevoegen.php">Mensen toevoegen</a></li>
    <li><a href="schermBeheerderVerwijderen.php">Mensen verwijderen</a></li>
    <li><a href="BeheerKasten.php">Beheer kasten</a></li>
    <li><a href="RolKastenAanpassen.php">Rol kasten aanpassen</a></li>
    <li><a href="LogboekTabel.php">Logboek</a></li>
    <li><a href="index.php">Uitloggen</a></li>

</ul>

<!-- <form method='post' >
    Menu:<br>
    <select name='menu' onchange="redirectToPage(this.value)">      -- bij verandering, de geselecteerde waarde (value) meegeven --
        <option value='schermBeheerderToevoegen.php' selected>Toevoegen </option>   -- De value is het bestandsnaam waar naar toe gegaan moet worden --
        <option value='schermBeheerderAanpassen.php'>Aanpassen </option>
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
/*
ob_start();     // Start output buffering. Dit zorgt ervoor dat er geen output naar de browser wordt gestuurd totdat ob_end_flush() wordt aangeroepen.

if(!isset($_COOKIE['ingelogd'])) {
    header('Location: index.php');
    exit;       // Zorg ervoor dat de scriptuitvoering hier stopt, zodat de rest van de code niet wordt uitgevoerd.
}
ob_end_flush();     // Stuur de output buffer naar de browser en stop met bufferen.*/

echo '<form method="post" id="formInvullen">
                    <lable>Achternaam*:</lable>
                    <input type="text" name="achternaam" required><br>
                    <lable>Voornaam*:</lable>
                    <input type="text" name="voornaam" required><br>
                    <lable>Badge nummer*:</lable>
                    <input type="text" name="badgenummer" required><br>
                    <lable>Telefoonnummer:</lable>
                    <input type="number" name="telefoonnr" ><br>
                    <lable>Rol*:</lable>
                    <select name="rol" required>
                    <option value="" selected>Selecteer Rol</option>
                    <option value="Beheerder">Beheerder</option>
                    <option value="Rol1">Rol 1</option>
                    <option value="Rol2">Rol 2</option>
                    <option value="Rol3">Rol 3</option>
                    </select><br>
                    <lable>Wachtwoord:</lable>
                    <input type="text" name="wachtwoord" ><br><br>
                    <input type="submit" value="Toevoegen" name="cmdVerstuur" id="submitButton" disabled>
                </form>';
echo "* --> Verplicht in te vullen <br>";
?>
<html>
<script>    /*code om de knop pas te ontgrendelen als de info is ingevuld*/
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('formInvullen');
        const inputs = form.querySelectorAll('input:not([name="Telo"]), input[type="number"], select');
        const submitButton = document.getElementById('submitButton');

        function checkInputs() {
            let allFilled = true;
            inputs.forEach(input => {
                if (!input.value && input.hasAttribute('required')) {
                    allFilled = false;
                }
            });
            submitButton.disabled = !allFilled;
        }

        inputs.forEach(input => {
            input.addEventListener('input', checkInputs);
        });
    });
</script>
</html>
<?php

if(isset($_POST['cmdVerstuur']))
{
    include('register.php');
}
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

}*/
?>