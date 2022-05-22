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
}
#Bildspalte {
	width: 1%;
}
#Infospalte {
	width: 15%;
}
#Produktinfo {
	
}
</style>
</head>
<body> </body>
</html>

<?php
include "hidden/Header.php";
?>

<?php
    $_SESSION['suche'] = $_POST['suche'];
    //Verbindung
    $con = new mysqli("localhost", "root", "","userdatabase");
    if($con->connect_error) {
        die("Verbindung fehlgeschlagen:".$con->connect_error);
    }
    //Suchergebnis
    if($_POST['suche'] != "") {
        $suche = $_POST['suche'];

        $sql_search = "SELECT * from productdatabase where produkt like '%$suche%'";
        $result = mysqli_query($con, $sql_search);
        $resultCheck = mysqli_num_rows($result); //checkt ob was drinne, weil sonst error

		
        if ($resultCheck > 0) {
			echo "<table>
			<colgroup id='Bildspalte'> </colgroup>
			<colgroup id='Infospalte'> </colgroup>";
			
            while ($row = mysqli_fetch_assoc($result)) {
			   echo "<tr>";
               echo "<td id='Bildzelle'>" .'<img height="280px" weight="280px" src="data:image/jpeg;base64,'.$row['bild'].'" id="Bild"/>'."<br>" ."</td>";

				echo "<td id='Produktinfo'>"."<br>"."Produkt: " .$row['produkt'] . "<br>"."Kategorie: " .$row['kategorie'] . "<br>". "Preis: " .$row['preis'] . "€" . "<br>"."Gewicht: " . $row['gewicht'] ."<br>". "Noch " . $row['bestand'] . " auf Lager" ;
				
				
				
                $id = $row['id'];
                $produkt = $row['produkt'];
                $preis =  $row['preis'];
                $_SESSION['gesucht'] = true;

                echo "<form action=\"warenkorb.php\" method=\"post\">
                          <input type=\"hidden\" id=\"id\" name=\"id\" value=\"$id\" />
                          <input type=\"hidden\" id=\"produkt\" name=\"produkt\" value=\"$produkt\" />
                          <input type=\"hidden\" id=\"preis\" name=\"preis\" value=\"$preis\" />
                         <input type=\"Submit\" value=\"In den Warenkorb\" class='ButtonGroup'/> 
                      </form>" ."</td>";
              echo "</tr>";
			  
			}
			echo "</table>";


        } else {
            echo "Kein Produkt gefunden!";
            echo "<form action=\"index.php\" method=\"post\">
                          <input type=\"Submit\" value=\"Zurück zur Hauptseite\" />
                      </form>";
        }
    }


?>

<?php
include "hidden/Footer.php";
?>
