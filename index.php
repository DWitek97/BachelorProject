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
}
#suchfeld {
	vertical-align: middle;
	height: 22px;
	width: 250px;
	
	font-size: 1em;
}
#suchen {
	font-size: 0.9em; 
	padding: 0.2% 0.2%;
	font-family: Roboto, sans-serif;
	font-weight: 300;
	color: black;
	border: 1px solid black;
	border-radius: 5px;
}

#Produktverwaltung {
	float: right;
	font-size: 1em; 
	padding: 0.3% 0.3%;
	font-family: Roboto, sans-serif;
	font-weight: 300;
	color: black;
	border: 1px solid black;
	border-radius: 7%;	
	right: 300mm;
}

#Nutzerverwaltung {
	float: right;
	font-size: 1em; 
	padding: 0.3% 0.3%;
	font-family: Roboto, sans-serif;
	font-weight: 300;
	color: black;
	border: 1px solid black;
	border-radius: 7%;	
}

.Sucheingabe {
	margin-left: 7%;
}
</style>
</head>

<body>

</body>

</html>




<?php
include "hidden/Header.php";
?>
<main>
    <?php
    if(isset($_SESSION["email"])) {
        echo "<p>Eingeloggt</p>";
    } else {
        echo"<p>Ausgeloggt</p>";
    }

    if(@$_POST['gekauft'] == true) {
        $check = @$_SESSION['guthaben'] - $_SESSION['total'];
        if($check < 0) {
            echo "Ihr Guthaben ist zu niedrig!";
        } else {
            $_SESSION['guthaben'] -= $_SESSION['total'];
            $cart = array();
            $_SESSION['cart'] = $cart;

            echo "<br>Vielen Dank für ihren Einkauf!<br>";
        }
        $_POST['gekauft'] = false;
    }
    ?>




</main>
    <layer class="Sucheingabe">
	<form action="produktsuche.php" method="post">
        Suche:<input type="text" name="suche" id="suchfeld"/>
        <input type="Submit" value="Suchen" id="suchen"/>
    </form>
	</layer>

    <form action="produktliste.php" method="post">
        <input type="Submit" value="Produkte Verwalten (admin?)" id="Produktverwaltung"/>
    </form>
    <form action="nutzerliste.php" method="post">
        <input type="Submit" value="Nutzer verwalten (admin)" id="Nutzerverwaltung"/>
    </form>
	
<?php
include "hidden/Footer.php";
?>