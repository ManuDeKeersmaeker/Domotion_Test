<!-- Jorben Wauters     Domotion        nr.:10 -->
<link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" />
<html>
<form method='post' >
    Menu:<br>
    <select name='menu' onchange="redirectToPage(this.value)">      <!-- bij verandering, de geselecteerde waarde (value) meegeven -->
        <option value=''></option>
        <option value='schermBeheerderToevoegen.php'<?php //if ($_POST['menu'] == 'Toevoegen') echo 'selected="selected"'; ?> >Toevoegen </option>
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

<?php /*
if(isset($_POST['menu']) && $_POST['menu'] != "") {
    $menu = $_POST['menu'];

    switch ($menu) {
        case "Toevoegen":
            echo: '<form method="post" action="schermBeheerderAanpassen.php">
                    </form>';

            break;
        case "Aanpassen":



            echo "Aanpassen";
            break;
        case "Verwijderen":
            echo "Verwijderen";
            break;
    }

}*/
?>

