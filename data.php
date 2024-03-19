<?php
session_start();
// Include functions and connect to the database
include 'verbinding.php';

echo <<<EOT

<!-- Page Content -->
<!-- Login scherm -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="caption">
                    <h2>Naar de producten</h2>
                    <div class="line-dec"></div>
                    <!-- tonen van de knoppen die naar producten gaan -->
                    <form method="post" action="index.php">
                        <div class="container">
                            <div class="horizontal-center">
                                <input type="submit" value="Alle producten" name="knop1" class="keuze-button"/>
                            </div>
                        </div>
                        <div class="container">
                            <div class="horizontal-center">
                                <input type="submit" value="GTI kleding" name="knop2" class="keuze-button"/>
                            </div>
                        </div>
                        <div class="container">
                            <div class="horizontal-center">
                                <input type="submit" value="Andere Kleding" name="knop3" class="keuze-button"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




EOT;

$soort = "test";
if (isset($_POST['knop1']))
{ $soort = "alles";}
else {
    if (isset($_POST['knop2']))
    {
        $soort = "GTI";
    } else {
        $soort = "andere";
    }
}
$_SESSION['soort'] = $soort;

//echo $_SESSION['soort'];
// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
// Include and show the requested page
include $page . '.php';

?>
