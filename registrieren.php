<?php
include 'hidden/Header.php';
?>
    <form action="hidden/registrierung.php" method="post">
        Vorname:<input type="text" name="vorname"
        /><br/>
        Nachname:<input type="text" name="nachname"
        /><br/>
        Adresse:<input type="text" name="addresse"
        /><br/>
        Geburtsdatum:<input type="text" name="geburtsdatum"
        /><br/>
        E-Mail:<input type="text" name="email"
        /><br/>
        Passwort:<input type="password" name="passwort"
        /><br/>
        Passwort wiederholen:<input type="password" name="passwort2"
        /><br/>
        <input type="Submit" value="Absenden" class="ButtonGroup"/>
    </form>
<?php
include "hidden/Footer.php";
?>

