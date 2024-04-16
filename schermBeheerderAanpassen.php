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
            echo '<select name="menu" onchange="this.form.submit()">';
            while ($row  = mysqli_fetch_assoc($resultaat)){
                //5d: toon resultaat
                $badgenummer1 = $row["badgenummer"];
                $voornaam1 = $row["voornaam"];
                $achternaam1 = $row["achternaam"];

                //echo "<br> de naam van de klant is ".$achternaam1.$voornaam1." <br>";

                echo "<option value='$badgenummer1'>$achternaam1 $voornaam1</option>";


            }
            echo '</select><br><br>';
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
?>
