<html>
<form method='post' >
    Menu:<br>
    <select name='menu' onchange="redirectToPage(this.value)">
        <option value=''></option>
        <option value='schermBeheerderToevoegen.php'<?php //if ($_POST['menu'] == 'Toevoegen') echo 'selected="selected"'; ?> >Toevoegen </option>
        <option value='schermBeheerderAanpassen.php'<?php //if ($_POST['menu'] == 'Aanpassen') echo 'selected="selected"'; ?> >Aanpassen </option>
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

