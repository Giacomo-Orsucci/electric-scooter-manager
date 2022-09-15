<?php 

    require "funzioni.php";

    controlloSessione();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "Monopattino";
    $ids;

    $conn = @mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        die("Connessione fallita: " . mysqli_connect_error());
    }
    session_start(); //recupero della sessione utente inizializzata precedentemente

    $username = $_SESSION['username'];

    $query = "UPDATE utenteGestione SET loggato = 0 WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    $_SESSION = array();
    unset($_SESSION);

    session_destroy();

    header("Location: loginGestione.html");

?>