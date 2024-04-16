<html>
<form method='post' >
    Menu:<br>
    <select name='menu' onchange="this.form.submit()">
        <option value='Toevoegen'<?php //if ($_POST['menu'] == 'Toevoegen') echo 'selected="selected"'; ?> >Toevoegen </option>
        <option value='Aanpassen'<?php //if ($_POST['menu'] == 'Aanpassen') echo 'selected="selected"'; ?> >Aanpassen </option>
        <option value='Verwijderen'<?php //if ($_POST['menu'] == 'Verwijderen') echo 'selected="selected"'; ?> >Verwijderen </option>
    </select><br><br>
</html>

<?php
if(isset($_POST['menu']) && $_POST['menu'] != "") {
    $menu = $_POST['menu'];

    switch ($menu) {
        case "Toevoegen":


            break;
        case "Aanpassen":



            echo "Aanpassen";
            break;
        case "Verwijderen":
            echo "Verwijderen";
            break;
    }

}
?>

