<?php

?>

<link rel="stylesheet" href="OpmaakMenubalk.css" type="text/css">
<!DOCTYPE HTML>

<html>
<head>
    <title>PROJECT</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>
<!-- Header -->
<!--section id="header"-->
<div class = "HeaderLogo">
</div>
<header align="center">

    <table>
        <tr>
            <td>
                <a href="https://www.gtibeveren.be"><img src="assets/images/logoBV.png" alt="" align="left"/></a>
            </td>
            <td width="80%">
                <!--img src="images/cheese3.jpg" alt="" style="display: block; margin-left: auto; margin-right: auto;"/-->
            </td>

        </tr>
    </table>
</header>

<body>
<div class="main-block">
    <!-- <div class="register">
      <h1>Register</h1>
      <form action="register.php" method="post">
        <label >Voornaam
          <input type="text" name="voornaam" required><br><br>
        </label>
        <label>Achternaam
          <input type="text" name="achternaam" required><br><br>
        </label>
        <label>Badgenummer
          <input type="text" name="badgenummer" required><br><br>
        </label>
        <label>Telefoonnummer
          <input type="text" name="telefoonnr" required><br><br>
        </label>
        <label>Rol
          <input type="text" name="rol" required><br><br>
        </label>
        <label>Wachtwoord
          <input type="password" name="wachtwoord" required><br><br>
        </label>
        <input type="submit" value="Register">
      </form>
    </div> -->

    <div class="login">
        <h1>Login</h1>
        <form action="authenticate.php" method="post">
            <label>Voornaam
                <input type="text" name="voornaam" required>
            </label>
            <label>Achternaam
                <input type="text" name="achternaam" required>
            </label>
            <label>Badgenummer
                <input type="password" name="badgenummer" required>
            </label>
            <label>Wachtwoord
                <input type="password" name="wachtwoord" required>
            </label>
            <input type="submit" value="Login">
        </form>
    </div>
</div>

<!-- Footer Starts Here -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="logo">
                    <img src="assets/images/logoBV.png" alt="">
                </div>
                <!--div class="footer-menu">
                  <ul>
                    <li><a href="index.html">Login</a></li>
                  </ul>
                </div-->
            </div>
        </div>
    </div>
</div>
<!-- Footer Ends Here -->
<!-- Sub Footer Starts Here -->
<div class="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright-text">
                    <p>Copyright &copy; GTI team </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sub Footer Ends Here -->
</body>
</html>

</body>
</html>
