<!-- Jorben Wauters     Domotion        nr.:10 -->
<link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" />
<html>
<form method='post' >
    Menu:<br>
    <select name='menu' onchange="redirectToPage(this.value)">      <!-- bij verandering, de geselecteerde waarde (value) meegeven -->
        <option value='schermBeheerderToevoegen.php'<?php //if ($_POST['menu'] == 'Toevoegen') echo 'selected="selected"'; ?> >Toevoegen </option>
        <option value='schermBeheerderAanpassen.php'<?php //if ($_POST['menu'] == 'Aanpassen') echo 'selected="selected"'; ?> >Aanpassen </option>
        <option value='schermBeheerderVerwijderen.php' selected<?php //if ($_POST['menu'] == 'Verwijderen') echo 'selected="selected"'; ?> >Verwijderen </option>
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

$BadgeSelctedBadge = "";
$BadgeSelctedNaam = "";


//1: verbinding meken met de database
include ('verbindingDB.php');

//2: als de verbinding gelukt is
if ($link)
{
    //3: opbouw van de query
    //query met een parameter
    $query = 'select * from gebruikers';

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
            echo 'Persoon: <form method="post" ><select name="gebruikerNaam" onchange="this.form.submit()">';
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
    echo "naam.$BadgeSelctedNaam";
}
if(isset($_POST['gebruikerBadge']) && $_POST['gebruikerBadge'] != "") {
    $_SESSION['Badgeselected'] = $_POST['gebruikerBadge'];
    $BadgeSelctedBadge = $_POST['gebruikerBadge'];
    echo "badge.$BadgeSelctedBadge";
}

//-----------------------------------------------------------------------------------
?>


<html>
<body>
<form method="post">
    <input type="submit" value="Verwijder persoon" name="cmdVerstuurNaam" >
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
            $query = 'delete from gebruikers where gebruikerid = ?';

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