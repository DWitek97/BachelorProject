<?php
include "hidden/Header.php";
?>

<?php
    $total = 0;
    $cart = $_SESSION['cart'];
    echo "Ihr Guthaben beträgt ".@$_SESSION['guthaben']."€<br>Möchten sie die Produkte ";
    foreach($cart as $carts) {
        // print_r($carts); zum anschauen des arrays
        $produkt = $carts['produkt'];
        $anzahl = $carts['anzahl'];
        $preis = $carts['preis'];
        echo $produkt." ".$anzahl." mal für jeweils ".$preis."€<br>";
        $total = $total+$anzahl*$preis;
    }
    $_SESSION['total'] = $total;
    echo "Für Insgesamt ".$_SESSION['total']."€ kaufen?"
?>
<form action="index.php" method="post">
    <input type="hidden" id="gekauft" name="gekauft" value="true" />
    <input type="Submit" value="Kaufen" class="ButtonGroup"/>
</form>

<?php
include "hidden/Footer.php";
?>
