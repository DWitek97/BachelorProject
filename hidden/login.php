<?php

    $email = $_POST["email"];
    $password = $_POST["passwort"];


    $con = new mysqli("localhost", "root", "", "userdatabase");
    if ($con->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $con->connect_error);
    }

    if(empty($email) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
    } else {
        $sql = "SELECT * FROM userdatabase WHERE email =? AND passwort =?";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            //prüft ob sql statement funktioniert
            header("Location: ../index.php?sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck == 0) {
                header("Location: ../index.php?nomatch");
                exit();
            } else {
                session_start();
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $password;
                header("Location: ../index.php?login=success");
                exit();
            }
        }

    }

