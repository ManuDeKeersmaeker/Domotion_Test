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
                     <form method="post" action="schermBeheerder.php">
                        <div class="container">
                            <div class="horizontal-center">
                                 <input type="submit" value="Mensen beheren" name="knop1" class="keuze-button"/>
                            </div>
                        </div>
                     </form>
                     <form method="post" action="BeheerKasten.php">
                         <div class="container">
                             <div class="horizontal-center">
                                 <input type="submit" value="Kasten beheren" name="knop2" class="keuze-button"/>
                             </div>
                         </div>
                     </form>
                     <form method="post" action="logboek.php">
                      <div class="container">
                          <div class="horizontal-center">
                              <input type="submit" value="Logboek" name="knop3" class="keuze-button"/>
                         </div>
                     </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>




EOT;

echo '<form action="index.html" method="post">';
echo	'<input type="submit" name="home" value="home"/>';
echo'</form>';

?>
