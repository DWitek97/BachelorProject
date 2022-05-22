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
</style>
</head>
<body></body>
</html>

<?php
include "hidden/Header.php";
?>
<form action="produkteingabe.php" method="post">
    <input type="Submit" value="Neue Produkte eingeben" class="ButtonGroup"/>
</form>
<form action="produktliste.php" method="post">
    Nutzer Löschen:<input type="text" name="delet" />
    <input type="Submit" value="Produkt löschen" class="ButtonGroup"/><br/>
</form>
<form action="produktliste.php" method="post">
    ProductID auswählen:<input type="text" name="ProductID" /><br/>
    Produkt ändern:<input type="text" name="produkt" /><br/>
    Kategorie ändern:<input type="text" name="kategorie" /><br/>
    Preis ändern:<input type="text" name="preis" /><br/>
    Gewicht ändern:<input type="text" name="gewicht" /><br/>
    Bestand ändern:<input type="text" name="bestand" /><br/>
    <input type="Submit" value="Produkt ändern" class="ButtonGroup"/><br/>
</form>
Bild Hochladen
<form action="produktliste.php" method="post" enctype="multipart/form-data">
    ProductID auswählen:<input type="text" name="productImageID" /><br/>
    <input type="file" name="bilddatei" class="ButtonGroup"/><br/>
    <input type="submit" name="submit" value="Upload" class="ButtonGroup"/>
</form>
<?php
//Verbindung
$con = new mysqli("localhost", "root", "","userdatabase");
if($con->connect_error) {
    die("Verbindung fehlgeschlagen:".$con->connect_error);
}
//Löschung
if(isset($_POST["delet"])){
    @$delet = $_POST["delet"];
}
if(@$_POST["delet"] != "") {
    $sql = "DELETE FROM productdatabase WHERE id=$delet;";
    $result = mysqli_query($con, $sql);
    echo "<br >Produkt ID: $delet gelöscht.<br >";
}
//Änderung
@$ProductID = $_POST["ProductID"];
@$produkt = $_POST["produkt"];
@$kategorie = $_POST["kategorie"];
@$preis = $_POST["preis"];
@$gewicht = $_POST["gewicht"];
@$bestand = $_POST["bestand"];

if(@$_POST["produkt"] != "") {
    $sql = "UPDATE productdatabase SET produkt='$produkt' WHERE id=$ProductID;";
    $result = mysqli_query($con, $sql);
}
if(@$_POST["kategorie"] != "") {
    $sql = "UPDATE productdatabase SET kategorie='$kategorie' WHERE id=$ProductID;";
    $result = mysqli_query($con, $sql);
}
if(@$_POST["preis"] != "") {
    $sql = "UPDATE productdatabase SET preis='$preis' WHERE id=$ProductID;";
    $result = mysqli_query($con, $sql);
}
if(@$_POST["gewicht"] != "") {
    $sql = "UPDATE productdatabase SET gewicht='$gewicht' WHERE id=$ProductID;";
    $result = mysqli_query($con, $sql);
}
if(@$_POST["bestand"] != "") {
    $sql = "UPDATE productdatabase SET bestand='$bestand' WHERE id=$ProductID;";
    $result = mysqli_query($con, $sql);
}
//Bild Hochladen
    if(isset($_POST['submit'])) {
        if(getimagesize($_FILES['bilddatei']['tmp_name']) == false) { //bilddatei ist der submit aus der Uploadform
            echo "Bitte Bild aussuchen";                              //tmp_name ist ein temporärer name, welcher der Server dem blob gibt
        } else {
            $image = $_FILES['bilddatei']['tmp_name'];
            $image = base64_encode(file_get_contents(addslashes($image))); //addsl added slashes und file_ konviertiert datei zu string
            $productImageID = $_POST['productImageID'];                    //base64 decodiert den String dann in ein Blob

            $sqlInsertimageintodb = "UPDATE productdatabase SET bild='$image' WHERE id=$productImageID;"; //ergo result

            if(mysqli_query($con, $sqlInsertimageintodb)) { //Wurde das Hochladen ausgeführt?
                echo "<br />Bild erfolgreich hochgeladen<br />";
            } else {
                echo "<br />Bild hochladen fehlgeschlagen!<br />";
            }
        }
    }

//Auflistung
$sql = "SELECT * FROM productdatabase;";
$result = mysqli_query($con, $sql);
$resultCheck = mysqli_num_rows($result); //checkt ob was drinne, weil sonst error
echo "<table>";
if($resultCheck > 0) {
while($row = mysqli_fetch_assoc($result)) {
echo "<tr><td>Produkt Nummer "." ".$row['id'].": ".$row['produkt']." <br> Kategorie: ".$row['kategorie']." <br> Preis: ".$row['preis']." € <br> Gewicht: ".$row['gewicht']." Kg<br> Bestand: ".$row['bestand']." Stk.<br><br></td></tr>";
}
}
?>

<?php
include "hidden/Footer.php";
?>
