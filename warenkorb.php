<?php
include "hidden/Header.php";
?>

<?php
    //Warenkorbarray wird erstellt:
    if($_SESSION['gesucht'] == true) {
        echo $_POST['produkt'] . " wurde in 1 mal in ihr Warenkorb angelegt<br>";
        $id = $_POST['id'];
        if (!isset($_SESSION['cart'])) {
            $cart = array();
            $_SESSION['cart'] = $cart;
        }
        @$cart = @$_SESSION['cart'];
        @$cart[$id]['anzahl'] += 1;
        $cart[$id]['preis'] = $_POST['preis'];
        $cart[$id]['produkt'] = $_POST['produkt'];
        $_SESSION['cart'] = $cart;
    }
   // print_r($_SESSION['cart']); zum anschauen des arrays
    $_SESSION['gesucht'] = false;

    //Warenkorb Gesamtbetrag und Auflistung:
    $total = 0;
    $cart = $_SESSION['cart'];
    foreach($cart as $carts) {
        // print_r($carts); zum anschauen des arrays
        $produkt = $carts['produkt'];
        $anzahl = $carts['anzahl'];
        $preis = $carts['preis'];
        echo $produkt." ".$anzahl." mal für jeweils ".$preis."€<br>";
        $total = $total+$anzahl*$preis;
    }
    $_SESSION['total'] = $total;
    echo "Gesamtbetrag: ".$total."€";

?>
    <form action="kasse.php" method="post">
        <input type="Submit" value="Zur Kasse" class="ButtonGroup"/>
    </form>

<?php
include "hidden/Footer.php";
?>