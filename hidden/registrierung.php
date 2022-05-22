<?php
// Variablen aus Registrierformular erhalten
    $vorname = $_POST["vorname"];
    $nachname = $_POST["nachname"];
    $addresse = $_POST["addresse"];
    $email = $_POST["email"];
    $passwort = $_POST["passwort"];
    $passwort2 = $_POST["passwort2"];
    $geburtsdatum = $_POST["geburtsdatum"];

//prüft ob ein Feld leer gelassen wurde
    if(empty($vorname) || empty($nachname) || empty($addresse) || empty($email) || empty($passwort) || empty($geburtsdatum)) {
        header("Location: ../registrieren.php?error=emptyfields&vorname=".$vorname."&nachname=".$nachname."&addresse=".$addresse."&email=".$email."&geburtsdatum=".$geburtsdatum);
        exit();
//prüft ob email ok
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../registrieren.php?invalidemail&vorname=".$vorname."&nachname=".$nachname."&addresse=".$addresse."&geburtsdatum=".$geburtsdatum);
        exit();
// prüft ob passwort und passwort wiederholen gleich sind
    } else if ($passwort != $passwort2) {
        header("Location: ../registrieren.php?error=password&vorname=".$vorname."&nachname=".$nachname."&addresse=".$addresse."&email=".$email."&geburtsdatum=".$geburtsdatum);
        exit();
    } else {
        //verbindungsaufbau
        $con = new mysqli("localhost", "root", "", "userdatabase");
        if ($con->connect_errno) {
                die("Verbindung fehlgeschlagen: " . $con->connect_error);
        }
        //prüft ob Datenbank leer
        $sql = "SELECT email FROM userdatabase WHERE email =?";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            //prüft ob sql statement funktioniert
                header("Location: ../registrieren.php?sqlerror&vorname=".$vorname."&nachname=".$nachname."&addresse=".$addresse."&geburtsdatum=".$geburtsdatum);
                exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0 ) {
                header("Location: ../registrieren.php?emailtaken&vorname=".$vorname."&nachname=".$nachname."&addresse=".$addresse."&geburtsdatum=".$geburtsdatum);
                exit();
            } else {
                //Variablen in Datenbank schreiben
                $sql_insert = "INSERT INTO userdatabase (vorname, nachname, addresse, geburtsdatum, email, passwort) VALUES ('$vorname', '$nachname', '$addresse', '$geburtsdatum', '$email', '$passwort')";
                if (mysqli_multi_query($con, $sql_insert)) {
                    echo "Erfolgreich registriert";
                } else {
                    echo "Error: " . $sql_insert . "<br>" . mysqli_error($con);
                }
                mysqli_close($con);
            }
        }
    }
?>


