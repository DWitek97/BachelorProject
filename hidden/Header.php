<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Fruktur|Merienda&display=swap" rel="stylesheet">
<i class="fab fa-accessible-icon"></i>
<link href="https://fontawesome.com/icons/accessible-icon?style=brands"; rel="stylesheet">
<style type="text/css">
body {
	background-image: url(tastatur.jpg);
	color: white;
	font-family: Roboto, sans-serif;
}
a {
	color: white;
	text-decoration: none;
}
</style>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <body> <h1>Polski PC-Teile Geschäft GmbH & Co. KG</h1>
    <header>
        <nav>
            <ul class="navibereich">
                <li class="achtive"><a href="../index.php"><i class="fa fa-fw fa-home"></i> Home</a> </li>
                <li id="navi02"><a href="../warenkorb.php"><i class="fa fa-shopping-bag"></i> Warenkorb</a> </li>
                <li id="navi03"><a href="../accountverwaltung.php"><i class="fa fa-fw fa-user"></i> Account</a> </li>
                <li id="navi04"><a href="#"><i class="fa fa-address-card"></i> Kontakt</a> </li>
            </ul>
            <div>
                <?php
                if(!isset($_SESSION["email"])) {
                    echo "<form action=\"hidden/login.php\" method=\"post\">
                    <input type=\"text\" name=\"email\" placeholder=\"Email\">
                    <input type=\"password\" name=\"passwort\" placeholder=\"Passwort\">
                    <button type=\"submit\" name=\"login\" class='ButtonLogin'>Login</button>
                    </form> <a href=\"registrieren.php\">Registrieren</a>
                </form>";
                } else {
                    echo "<form action=\"hidden/logout.php\" method=\"post\">
                    <button type=\"submit\" name=\"logout\">Logout</button>
                    </form>";
                }
                ?>
            </div>
        </nav>
    </header>



