<?php
include "hidden/Header.php";
echo "Hier sollte jeder User seinen Account zu einem gewissen maßen verwalten können?";
?>

<form action="accountverwaltung.php" method="post">
    Guthaben aufladen:<input type="text" name="guthaben"/>
    <input type="hidden" id="aufladen" name="aufladen" value="true" />
    <input type="Submit" value="aufladen" class="ButtonGroup"/>
</form>

<?php
    if(@$_POST['aufladen'] == true) {
        @$_SESSION['guthaben'] += @$_POST['guthaben'];

        $_POST['aufladen'] = false;
    }
    echo "Ihr Guthaben beträgt: ".@$_SESSION['guthaben']."€<br>";
?>

<?php
include "hidden/Footer.php";
?>

