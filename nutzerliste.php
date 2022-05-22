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

.Nutzerliste {
		
}
</style>
</head>
<body>
</body>
</html>

<?php
include 'hidden/Header.php';
?>
<form action="registrieren.php" method="post">
	<input type="Submit" value="Nutzereingabe" class="ButtonGroup"/><br/>
</form>
<form action="nutzerliste.php" method="post">
<layer class="Nutzerliste">
    Nutzer Löschen:<input type="text" name="delet" />
	<input type="Submit" value="Nutzer löschen" class="ButtonGroup"/><br/>
	</layer>
</form>
<form action="nutzerliste.php" method="post">
<layer class="Nutzerliste">
    UserID auswählen:<input type="text" name="UserID" /><br/>
    Vorname ändern:<input type="text" name="vorname" /><br/>
	Nachname ändern:<input type="text" name="nachname" /><br/>
    Addresse ändern:<input type="text" name="addresse" /><br/>
	Geburtsdatum ändern:<input type="text" name="geburtsdatum" /><br/>
	Email ändern:<input type="text" name="email" /><br/>
	Passwort ändern:<input type="text" name="passwort" /><br/>
	</layer>
	<input type="Submit" value="Nutzer ändern"class="ButtonGroup"/><br/>
</form>

<?php
$con = new mysqli("localhost", "root", "","userdatabase");

if($con->connect_error) {
    die("Verbindung fehlgeschlagen:".$con->connect_error);
}
//Löschung
if(isset($_POST["delet"])){
    $delet = $_POST["delet"];
}
if(@$_POST["delet"] != "") {
    $sql = "DELETE FROM userdatabase WHERE id=$delet;";
    $result = mysqli_query($con, $sql);
}
//Änderung
//$_POST["Irgendwas"] gibt IMMER einen Wert (bei nichts NULL oder "") zurück bei einer Abfrage. Wenn wir wie vorhin
//mit $_POST["Nutzer ändern"] nur Abfragen würden, dass etwas geändert werden sollte und dabei nicht alles von vorname
//bis passwort nochmal eintippen, ändert er nur die Änderung und speichert beim Rest "" bzw. NULL ein. Deshalb die
//abfragen ob $_POST[""] != "" ist. Die isset dinger sind etwas verwirrend und unnötig von mir und waren dazu
//geplant fehlermeldungen auszumerzen (tldr. Wir brauchen die If Abfragen damit man auch nur einzelne Werte ändern
//kann ohne beim Rest Null zu speichern.
@$UserID = $_POST["UserID"];
@$vorname = $_POST["vorname"];
@$nachname = $_POST["nachname"];
@$addresse = $_POST["addresse"];
@$geburtsdatum = $_POST["geburtsdatum"];
@$email = $_POST["email"];
@$passwort = $_POST["passwort"];

if(@$_POST["vorname"] != "") {
    $sql = "UPDATE userdatabase SET vorname='$vorname' WHERE id=$UserID;";
    $result = mysqli_query($con, $sql);
}
if(@$_POST["nachname"] != "") {
    $sql = "UPDATE userdatabase SET nachname='$nachname' WHERE id=$UserID;";
    $result = mysqli_query($con, $sql);
}
if(@$_POST["addresse"] != "") {
    $sql = "UPDATE userdatabase SET addresse='$addresse' WHERE id=$UserID;";
    $result = mysqli_query($con, $sql);
}
if(@$_POST["geburtsdatum"] != "") {
    $sql = "UPDATE userdatabase SET geburtsdatum='$geburtsdatum' WHERE id=$UserID;";
    $result = mysqli_query($con, $sql);
}
if(@$_POST["email"] != "") {
    $sql = "UPDATE userdatabase SET email='$email' WHERE id=$UserID;";
    $result = mysqli_query($con, $sql);
}
if(@$_POST["passwort"] != "") {
    $sql = "UPDATE userdatabase SET passwort='$passwort' WHERE id=$UserID;";
    $result = mysqli_query($con, $sql);
}

//Auflistung
$sql = "SELECT * FROM userdatabase;";
$result = mysqli_query($con, $sql);
$resultCheck = mysqli_num_rows($result); //checkt ob was drinne, weil sonst error

if($resultCheck > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "UserID"." ".$row['id'].": ".$row['vorname']." ".$row['nachname']." ".$row['addresse']." ".$row['geburtsdatum']." ".$row['email']." ".$row['passwort']."<br>";
    }
}
include 'hidden/Footer.php';
?>
