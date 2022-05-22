<?php
include "hidden/Header.php";
?>

<form action="produktliste.php" method="post">
    <input type="Submit" value="Zurück zur Produktliste" class="ButtonGroup"/>
</form>

<form action="produkteingabe.php" method="post">
    Produkt eingeben:<input type="text" name="produkt" /><br/>
    Kategorie eingeben:<input type="text" name="kategorie" /><br/>
    Preis eingeben:<input type="text" name="preis" /><br/>
    Gewicht eingeben:<input type="text" name="gewicht" /><br/>
    Bestand eingeben:<input type="text" name="bestand" /><br/>
    <input type="Submit" value="Produkt erstellen" class="ButtonGroup"/><br/>
</form>

<?php
    //David kp wie das funkt wie bei der registrierung.php -Anonymus Michaelus
    $con = new mysqli("localhost", "root", "", "userdatabase");
    if ($con->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $con->connect_error);
    }

    if(@$_POST['produkt'] != ""){
        $produkt = $_POST['produkt'];
        $kategorie = $_POST['kategorie'];
        $preis = $_POST['preis'];
        $gewicht = $_POST['gewicht'];
        $bestand = $_POST['bestand'];

        $sql = "INSERT INTO productdatabase (produkt, kategorie, preis, gewicht, bestand) VALUES ('$produkt', '$kategorie', '$preis', '$gewicht', '$bestand');";
        $result = mysqli_query($con, $sql);

        echo "Produkt erfolgreich eingefügt";
    }
?>

<?php
include "hidden/Footer.php";
?>
